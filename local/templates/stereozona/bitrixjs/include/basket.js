"use strict";

import Utils from "../include/utils";
import BasketPoolQuantity from "./basket-pool-quantity";

export default class Basket {

    static updateBasketTable(basketItemId, res, extEventData = false) {
        let table = BX("basket_items");

        if (!table || typeof res !== 'object') return;

        table.innerHTML = '';
        let productFields = {};

        if (
            window.cartTemplate
            && res.BASKET_DATA.MUTATOR
            && typeof res.BASKET_DATA.MUTATOR.REPLACE_FIELDS == 'object'
        ) {

            for (let itemId in res.BASKET_DATA.MUTATOR.REPLACE_FIELDS) {
                if (res.BASKET_DATA.MUTATOR.REPLACE_FIELDS.hasOwnProperty(itemId)) {

                    let item = res.BASKET_DATA.MUTATOR.REPLACE_FIELDS[itemId];
                    let html = '';

                    html += Utils.replaceArrays(window.cartTemplate, Object.keys(item), Object.values(item));

                    table.insertAdjacentHTML('beforeend', html);
                }
            }
        }

        if (BX('allSum')) BX('allSum').innerHTML = res.BASKET_DATA['allSum_FORMATED'];
        if (BX('allSumFull')) BX('allSumFull').innerHTML = res.BASKET_DATA['PRICE_WITHOUT_DISCOUNT'];
        if (BX('count_text')) BX('count_text').innerHTML = res.BASKET_DATA.MUTATOR.BASKET_COUNT_TEXT;
        if (BX('minicart_sum')) BX('minicart_sum').innerHTML = res.BASKET_DATA['allSum_FORMATED'];
        if (BX('minicart_count')) BX('minicart_count').innerHTML = res.BASKET_DATA.MUTATOR.BASKET_COUNT;
        if (BX('discount')) BX('discount').innerHTML = res.BASKET_DATA['DISCOUNT_PRICE_ALL_FORMATED'];

        let isModalBasket = !!window.basketJSParams.MODAL;

        if(res.BASKET_DATA.MUTATOR && res.BASKET_DATA.MUTATOR.PRODUCT_FIELDS) {
            for (let productId in res.BASKET_DATA.MUTATOR.PRODUCT_FIELDS) {
                if (res.BASKET_DATA.MUTATOR.PRODUCT_FIELDS.hasOwnProperty(productId)) {

                    productFields[productId] = res.BASKET_DATA.MUTATOR.PRODUCT_FIELDS[productId];
                }
            }
        }

        let existingProducts = {};

        Object.keys(res.BASKET_DATA.GRID.ROWS).forEach(el => {

            if (res.BASKET_DATA.GRID.ROWS.hasOwnProperty(el)) {
                let basketItem = res.BASKET_DATA.GRID.ROWS[el];

                existingProducts[basketItem.PRODUCT_ID] = basketItem.QUANTITY;
            }
        });

        let data = {};
        if (typeof extEventData === 'object') {
            data = extEventData;
        }

        data.products_count = existingProducts;
        data.product_fields = productFields;
        data.modal_basket = isModalBasket;

        let ev = new CustomEvent('basket:onchange', {
            'detail': data
        });

        document.dispatchEvent(ev);
        BX.onCustomEvent('OnBasketChange');
    }

    static updateBasket(params = {}) {
        params = typeof params === 'object' ? params : {};
        Basket.recalcBasketAjax(params);
    }

    static enterCoupon() {
        let newCoupon = BX('coupon');

        if (!!newCoupon && !!newCoupon.value)
            Basket.recalcBasketAjax({
                'coupon' : newCoupon.value
            });
    }

    static updateQuantity(controlId, basketId, ratio, bUseFloatQuantity, mode) {
        let oldVal = BX(controlId).defaultValue,
            newVal = parseFloat(BX(controlId).value) || 0,
            bIsCorrectQuantityForRatio = false,
            autoCalculate = ((BX("auto_calculation") && BX("auto_calculation").value == "Y") || !BX("auto_calculation"));

        if (ratio === 0 || ratio == 1) {
            bIsCorrectQuantityForRatio = true;
        } else {

            let newValInt = newVal * 10000,
                ratioInt = ratio * 10000,
                reminder = newValInt % ratioInt,
                newValRound = parseInt(newVal);

            if (reminder === 0) {
                bIsCorrectQuantityForRatio = true;
            }
        }

        let bIsQuantityFloat = false;

        if (parseInt(newVal) != parseFloat(newVal)) {
            bIsQuantityFloat = true;
        }

        newVal = (bUseFloatQuantity === false && bIsQuantityFloat === false) ? parseInt(newVal) : parseFloat(newVal).toFixed(4);
        newVal = Basket.correctQuantity(newVal);

        let config = {
            product_id: document.querySelector('[data-cart-id="' + basketId + '"]').dataset.productId,
            basket_id: basketId
        };

        if (bIsCorrectQuantityForRatio) {
            BX(controlId).defaultValue = newVal;

            BX("QUANTITY_INPUT_" + basketId).value = newVal;

            // set hidden real quantity value (will be used in actual calculation)
            BX("QUANTITY_" + basketId).value = newVal;

            if (autoCalculate) {
                window.basketPoolQuantity.changeQuantity(config);
            }
        } else {
            newVal = Basket.getCorrectRatioQuantity(newVal, ratio, bUseFloatQuantity);
            newVal = Basket.correctQuantity(newVal);

            if (newVal != oldVal) {
                BX("QUANTITY_INPUT_" + basketId).value = newVal;
                BX("QUANTITY_" + basketId).value = newVal;

                if (autoCalculate) {
                    window.basketPoolQuantity.changeQuantity(config);
                }
            } else {
                BX(controlId).value = oldVal;
            }
        }
    }

    static setQuantity(basketId, ratio, sign, bUseFloatQuantity) {
        let curVal = parseFloat(BX("QUANTITY_INPUT_" + basketId).value),
            newVal;

        newVal = (sign === 'up') ? curVal + ratio : curVal - ratio;

        if (newVal < 0)
            newVal = 0;

        if (bUseFloatQuantity) {
            newVal = parseFloat(newVal).toFixed(4);
        }
        newVal = Basket.correctQuantity(newVal);

        // if (ratio > 0 && newVal < ratio) {
        //     let productId = document.querySelector('[data-cart-id="' + basketId + '"]').dataset.productId;
        //     productAction('remove', productId);
        //     return false;
        // }

        if (!bUseFloatQuantity && newVal != newVal.toFixed(4)) {
            newVal = parseFloat(newVal).toFixed(4);
        }

        newVal = Basket.getCorrectRatioQuantity(newVal, ratio, bUseFloatQuantity);
        newVal = Basket.correctQuantity(newVal);

        BX("QUANTITY_INPUT_" + basketId).value = newVal;
        BX("QUANTITY_INPUT_" + basketId).defaultValue = newVal;

        Basket.updateQuantity('QUANTITY_INPUT_' + basketId, basketId, ratio, bUseFloatQuantity, sign === 'up');
    }

    static getCorrectRatioQuantity(quantity, ratio, bUseFloatQuantity) {
        let newValInt = quantity * 10000,
            ratioInt = ratio * 10000,
            reminder = (quantity / ratio - ((quantity / ratio).toFixed(0))).toFixed(6),
            result = quantity,
            bIsQuantityFloat = false,
            i;
        ratio = parseFloat(ratio);

        if (reminder == 0) {
            return result;
        }

        if (ratio !== 0 && ratio != 1) {
            for (i = ratio, max = parseFloat(quantity) + parseFloat(ratio); i <= max; i = parseFloat(parseFloat(i) + parseFloat(ratio)).toFixed(4)) {
                result = i;
            }

        } else if (ratio === 1) {
            result = quantity | 0;
        }

        if (parseInt(result, 10) != parseFloat(result)) {
            bIsQuantityFloat = true;
        }

        result = (bUseFloatQuantity === false && bIsQuantityFloat === false) ? parseInt(result, 10) : parseFloat(result).toFixed(4);
        result = Basket.correctQuantity(result);
        return result;
    }

    static correctQuantity(quantity) {
        return parseFloat((quantity * 1).toString());
    }

    static recalcBasketAjax(params) {
        if (window.basketPoolQuantity.isProcessing()) {
            return false;
        }

        let property_values = {},
            action_var = BX('action_var').value,
            items = BX('basket_items'),
            //delayedItems = BX('delayed_items'),
            postData,
            i;

        postData = {
            'sessid': BX.bitrix_sessid(),
            'site_id': BX.message('SITE_ID'),
            'props': property_values,
            'action_var': action_var,
            'select_props': BX('column_headers').value,
            //'offers_props': BX('offers_props').value,
            'quantity_float': BX('quantity_float').value,
            'price_vat_show_value': BX('price_vat_show_value').value,
            'hide_coupon': BX('hide_coupon').value,
            'use_prepayment': BX('use_prepayment').value,
            'template': window.basketJSParams.TEMPLATE
        };
        postData[action_var] = 'recalculate';

        let extEventData = false;
        if (!!params && typeof params === 'object') {

            if (typeof params.extEventData !== 'undefined') {
                extEventData = params.extEventData;
                delete params.extEventData;
            }

            for (i in params) {
                if (params.hasOwnProperty(i)) {
                    postData[i] = params[i];
                }
            }
        }

        let rows = items.querySelectorAll('.cart-item');

        if (!!params.counter && rows.length > 0) {
            rows.forEach(function (i) {
                postData['QUANTITY_' + i.dataset.cartId] = BX('QUANTITY_' + i.dataset.cartId).value;
            });
        }

        // if (!!delayedItems && delayedItems.rows.length > 0)
        // {
        // 	for (i = 1; delayedItems.rows.length > i; i++)
        // 		postData['DELAY_' + delayedItems.rows[i].id] = 'Y';
        // }

        window.basketPoolQuantity.setProcessing(true);
        window.basketPoolQuantity.clearPool();

        BX.ajax({
            url: '/bitrix/components/bitrix/sale.basket.basket/ajax.php',
            method: 'POST',
            data: postData,
            dataType: 'json',
            onsuccess: function (result) {
                window.basketPoolQuantity.setProcessing(false);

                if (params.coupon) {
                    //hello, gifts!
                    if (!!result && !!result.BASKET_DATA && !!result.BASKET_DATA.NEED_TO_RELOAD_FOR_GETTING_GIFTS) {
                        BX.reload();
                    }

                    if(!!result && !!result.BASKET_DATA && result.BASKET_DATA.COUPON_LIST) {
                        let couponData = null;
                        let returnedCoupons = result.BASKET_DATA.COUPON_LIST.filter(e => e.COUPON === params.coupon)

                        if(returnedCoupons.length > 0) {
                            couponData = returnedCoupons[0];
                        }

                        let eventName = `basket:coupon-${!!result.VALID_COUPON ? 'applied' : 'fail'}`;

                        if(couponData) {
                            document.dispatchEvent(new CustomEvent(eventName, {
                                'detail': {
                                    'coupon': couponData
                                }
                            }));
                        }
                    }
                }

                if (window.basketPoolQuantity.isPoolEmpty()) {
                    Basket.updateBasketTable(null, result, extEventData);
                    window.basketPoolQuantity.updateQuantity();
                } else {
                    window.basketPoolQuantity.enableTimer(true);
                }
            }
        });
    }

    static repeatOrder(orderId) {
        BX.ajax({
            url: '/ajax/sale/basket/',
            method: 'POST',
            data: {order_id: orderId, action: 'repeatOrder'},
            dataType: 'json',
            onsuccess: function (result) {
                if (result.STATUS === 'OK') {
                    Basket.updateBasket();
                    document.dispatchEvent(new CustomEvent('personal-order:repeat-success'));
                } else {
                    document.dispatchEvent(new CustomEvent('personal-order:repeat-fail', {detail: {error: answer.MESSAGE}}));
                }
            }
        });
    }
}

window.Basket = Basket;
window.basketPoolQuantity = new BasketPoolQuantity();
