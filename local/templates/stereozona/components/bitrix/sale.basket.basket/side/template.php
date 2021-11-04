<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/**
 * @var array $arResult
 * @var array $arParams
 *
 */

$this->SetViewTarget('cart: count');
echo $arResult['MUTATOR']['BASKET_COUNT'];
$this->EndViewTarget();

$this->SetViewTarget('cart: empty-class');
echo $arResult['MUTATOR']['BASKET_COUNT'] == 0 ? 'header__controls-item-cart--empty' : '';
$this->EndViewTarget();

$this->SetViewTarget('cart: formatted_price');
echo $arResult['allSum_FORMATED'];
$this->EndViewTarget();


?>
<div class="modal__content">
    <div class="h2 modal__content-title">Ваш выбор</div>
    <div class="modal__cart-top">
        <div class="modal__cart-header">
            <div class="modal__cart-amount" id="count_text"><?=$arResult['MUTATOR']['BASKET_COUNT_TEXT']?></div>
            <a class="modal__cart-clear js__product-action"
               data-no-swup
               href="#"
               data-action="clear"
            >
                Очистить
            </a>
        </div>
        <div class="modal__cart-content" id="basket_items">
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
                'MODAL' => true,
            );

            ?>
            <script data-skip-moving="true">
                window.cartTemplate = '<?=str_replace("'", "\'", $cartTemplate)?>';
                window.basketJSParams = <?=CUtil::PhpToJSObject($arBasketJSParams);?>;
            </script>
        </div>
    </div>
    <div class="modal__cart-bottom">
        <div class="modal__cart-bottom-left">
            <p class="mb-0">Итого</p>
            <div class="modal__cart-overall" id="allSum"><?=$arResult['allSum_FORMATED']?></div>
        </div>
        <div class="modal__cart-bottom-right">
            <a class="btn btn-primary"
               data-no-swup
               data-is-goal="click"
               data-base-goal-name="korzina_oform"
               href="<?=SITE_DIR?>cart/"
            >
                В корзину
            </a>
        </div>
    </div>

    <input type="hidden" id="action_var" value="action" />
    <input type="hidden" id="hide_coupon" value="<?=($arParams["HIDE_COUPON"] == "Y") ? "Y" : "N"?>" />
    <input type="hidden" id="quantity_float" value="<?=($arParams["QUANTITY_FLOAT"] == "Y") ? "Y" : "N"?>" />
    <input type="hidden" id="use_prepayment" value="<?=($arParams["USE_PREPAYMENT"] == "Y") ? "Y" : "N"?>" />
    <input type="hidden" id="auto_calculation" value="<?=($arParams["AUTO_CALCULATION"] == "N") ? "N" : "Y"?>" />
    <input type="hidden" id="price_vat_show_value" value="<?=($arParams["PRICE_VAT_SHOW_VALUE"] == "Y") ? "Y" : "N"?>" />
    <input type="hidden" id="column_headers" value="<?=htmlspecialcharsbx(implode(',', $arParams['COLUMNS_LIST_EXT']))?>">
</div>
