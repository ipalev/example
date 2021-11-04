<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/**
 * @var array $arResult
 * @var array $arParams
 *
 */

$this->SetViewTarget('cart: count');
echo $arResult['MUTATOR']['BASKET_COUNT'];
$this->EndViewTarget();

$this->SetViewTarget('cart: formatted_price');
echo $arResult['allSum_FORMATED'];
$this->EndViewTarget();


?>
<div class="cart__content">
    <?php $APPLICATION->IncludeComponent(
        "bitrix:breadcrumb",
        "main",
        [
            "START_FROM" => "0",
            "PATH" => "",
            "SITE_ID" => SITE_ID
        ]
    ); ?>
    <div class="cart__left">
        <h1>Корзина</h1>
        <p>Цена доставки будет расчитана при оформлении заказа</p>
    </div>
    <div class="cart__center">
        <div class="cart__table">
            <div class="cart__table-header">
                <div class="cart__table-amount" id="count_text"><?=$arResult['MUTATOR']['BASKET_COUNT_TEXT']?></div>
                <a class="cart__table-clear js__product-action"
                   data-no-swup
                   data-action="clear"
                   href="#"
                >
                    очистить корзину
                </a>
            </div>
            <div class="cart__table-content" id="basket_items">
                <?php

                /** @var string $cartTemplate */
                require('basket_items.php');

                foreach($arResult['MUTATOR']['REPLACE_FIELDS'] as $basketItemId => $item) {

                    echo str_replace(
                        array_keys($item),
                        array_values($item),
                        $cartTemplate
                    );
                }

                /** @var string $templateFolder */

                $arBasketJSParams = array(
                    'SALE_TYPE' => GetMessage("SALE_TYPE"),
                    'TEMPLATE_FOLDER' => $templateFolder,
                    'TEMPLATE' => $this->getComponent()->getTemplateName(),
                    'USE_FLOAT' => $arParams["QUANTITY_FLOAT"] == 'Y' ? 'true' : 'false',
                );

                ?>
                <script data-skip-moving="true">
                    window.cartTemplate = '<?=str_replace("'", "\'", $cartTemplate)?>';
                    window.basketJSParams = <?=CUtil::PhpToJSObject($arBasketJSParams);?>;
                </script>
            </div>
        </div>
        <input type="hidden" id="action_var" value="action" />
        <input type="hidden" id="hide_coupon" value="<?=($arParams["HIDE_COUPON"] == "Y") ? "Y" : "N"?>" />
        <input type="hidden" id="quantity_float" value="<?=($arParams["QUANTITY_FLOAT"] == "Y") ? "Y" : "N"?>" />
        <input type="hidden" id="use_prepayment" value="<?=($arParams["USE_PREPAYMENT"] == "Y") ? "Y" : "N"?>" />
        <input type="hidden" id="auto_calculation" value="<?=($arParams["AUTO_CALCULATION"] == "N") ? "N" : "Y"?>" />
        <input type="hidden" id="price_vat_show_value" value="<?=($arParams["PRICE_VAT_SHOW_VALUE"] == "Y") ? "Y" : "N"?>" />
        <input type="hidden" id="column_headers" value="<?=htmlspecialcharsbx(implode(',', $arParams['COLUMNS_LIST_EXT']))?>">

        <div class="cart__features-list">
            <div class="cart-feature">
                <div class="cart-feature__icon"><img src="/assets/img/icon-delivery.svg" alt></div>
                <div class="cart-feature__content">
                    <p class="sm font-weight-medium mb-5">30 дней</p>
                    <p class="mb-0">Возврат или обмен</p>
                </div>
            </div>
            <div class="cart-feature">
                <div class="cart-feature__icon"><img src="/assets/img/icon-moneyback.svg" alt></div>
                <div class="cart-feature__content">
                    <p class="sm font-weight-medium mb-5">14 дней</p>
                    <p class="mb-0">Деньги вернутся на счет</p>
                </div>
            </div>
            <div class="cart-feature">
                <div class="cart-feature__icon"><img src="/assets/img/icon-warranty.svg" alt></div>
                <div class="cart-feature__content">
                    <p class="sm font-weight-medium mb-5">От 1 года</p>
                    <p class="mb-0">Гарантия на товары</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="overall">
    <div class="overall__top">
        <div class="overall__item">
            <p>Сумма</p>
            <p class="mb-0 font-weight-medium" id="allSumFull"><?=$arResult['PRICE_WITHOUT_DISCOUNT']?></p>
        </div>
        <div class="overall__item">
            <p>Скидка</p>
            <p class="mb-0 font-weight-medium" id="discount"><?=$arResult['DISCOUNT_PRICE_ALL_FORMATED']?></p>
        </div>
        <div class="overall__item">
            <p>Итого</p>
            <h4 class="mb-0" id="allSum"><?=$arResult['allSum_FORMATED']?></h4>
        </div>
    </div>
    <div class="overall__bottom">
        <p class="mb-0">
        <?php if($arParams["HIDE_COUPON"] != "Y") {?>
            <form class="promocode">
                <input id="coupon"
                       class="promocode__field"
                       name="COUPON"
                       type="text"
                       placeholder="У меня есть промокод"
                >
                <span class="promocode__tip">Неверный код</span>
                <div class="promocode__btn-wrap">
                    <button class="promocode__btn"
                            type="button"
                            onclick="Basket.enterCoupon();"
                    >
                        <img src="/assets/img/check.svg" alt="Check">
                        <span class="promocode__btn-text promocode__btn-text--default">Проверить</span>
                        <span class="promocode__btn-text promocode__btn-text--success">Подтверждено</span>
                        <span class="promocode__btn-text promocode__btn-text--error">Ввести другой</span>
                    </button>
                </div>
            </form>
        <?php }?>
        <?php
        if ($USER->IsAuthorized()) {?>
            <a class="btn btn-primary js-order-submit-link"
               href="order/"
               data-no-swup
               data-is-goal="click"
               data-base-goal-name="korzina_oform2"
            >
                Оформить заказ
            </a>
        <?php } else {?>
            <a class="btn btn-primary"
               href="#"
               data-fancybox
               data-no-swup
               data-src="#modalEnter"
               data-animation-effect="false"
               data-touch="false"
               data-modal="true"
            >
                Оформить заказ
            </a>
        <?php }?>
        </p>
    </div>
</div>
<div class="overall__mobile-overflow"></div>
<div class="overall__mobile">
    <div class="overall__item overall__item--hidden overall__item--first">
        <p>Сумма</p>
        <p class="mb-0 font-weight-medium">1 446 800₽</p>
    </div>
    <div class="overall__item overall__item--hidden">
        <p>Доставка<span class="tooltip tooltip--question"><a class="tooltip__trigger" href="#" data-no-swup data-container="body" data-toggle="popover" data-content="Подойдет, если предпочитаете самостоятельно планировать время и не любите зависеть от курьера."></a></span>
        </p>
        <p class="mb-0 font-weight-medium">0₽</p>
    </div>
    <div class="overall__item overall__item--hidden">
        <p>Скидка</p>
        <p class="mb-0 font-weight-medium">15%</p>
    </div>
    <div class="overall__item overall__item--last">
        <p>Итого</p>
        <h4 class="mb-0">1 126 570₽</h4>
    </div>
    <div class="overall__expand-link">
        <p>Детали заказа</p>
    </div>
    <div class="overall__bottom overall__bottom--hidden">
        <p class="mb-0">
        <form class="promocode">
            <input class="promocode__field" type="text" placeholder="У меня есть промокод"><span class="promocode__tip">Неверный код</span>
            <div class="promocode__btn-wrap">
                <button class="promocode__btn" type="button"><img src="/assets/img/check.svg" alt="Check"><span class="promocode__btn-default">Проверить</span><span class="promocode__btn-success">Подтверждено</span><span class="promocode__btn-error">Ввести другой</span></button>
            </div>
        </form><a class="btn btn-primary" href="#" data-fancybox data-no-swup data-src="#modalOrder" data-touch="false" data-modal="true">Оформить заказ</a>
        </p>
    </div>
</div>
