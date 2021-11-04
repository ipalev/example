"use strict";

export default function productAction (action, product, quantity = 1) {
    $.ajax({
        url: '/ajax/sale/basket/',
        type: 'post',
        data: {
            action: action,
            id: product,
            quantity: quantity
        },
        dataType: 'json',
        success: function (answer) {
            let ev;
            let detailData = {
                after: action,
                data: typeof answer.DATA === 'object' ? answer.DATA : {}
            };

            if (answer.STATUS === 'OK') {
                if(typeof answer['REFRESH_BASKET'] === 'object')
                    detailData['refresh_basket'] = !!answer['REFRESH_BASKET'];

                if(!!product) detailData.product_id = product;

                if(typeof answer['EXISTING_PRODUCTS'] === 'object') {
                    detailData.products_count = answer['EXISTING_PRODUCTS'];
                }

                ev = new CustomEvent('onBasketStateChanged', {
                    'detail': detailData
                });

            } else {
                detailData['message'] = answer.MESSAGE;
                ev = new CustomEvent('onFailBasketChanged', {
                    'detail': detailData
                });
            }

            document.dispatchEvent(ev);
        },
        error: function () {
            document.dispatchEvent(new CustomEvent('onFailBasketChanged', {
                'detail': {
                    after: action,
                    message: 'Internal Server Error'
                }
            }));
        }
    })
}
