<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CAllMain $APPLICATION
 * @var CBitrixComponent $component
 * @var array $arParams
 * @var array $arResult
 */

?>
<form class="modal__form-wrapper js__product-form-ajax"
      action="/ajax/form/handler.php"
      method="post"
>
    <input type="hidden" name="ajax_send" value="y">
    <input type="hidden" name="FORM_CODE" value="<?=$arParams['FORM_CODE']?>">
    <input type="hidden" name="IBLOCK_TYPE" value="<?=$arParams['IBLOCK_TYPE']?>">
    <input type="hidden"
           data-product-id-field
           name="PROPERTY[<?=$arResult['RES_MOD']['FIELDS']['SYS_PRODUCT']?>][0]"
           value=""
    >

    <div class="modal__form-top">
        <p class="modal__form-top-title">Купить в 1 клик</p>
        <p class="modal__form-top-subtitle">Укажите необходимую информацию и наш оператор свяжется с вами для уточнения деталей заказа</p>
    </div>
    <div class="modal__form-center">
        <?php

        include($_SERVER['DOCUMENT_ROOT'].SITE_TEMPLATE_PATH.'/include/blocks/form/fields_template.php');

        ?>
    </div>
    <div class="modal__form-bottom">
        <div class="checkbox checkbox--switch checkbox--switch-reverse">
            <div class="custom-control custom-checkbox">
                <input class="custom-control-input" type="checkbox" id="switch9" checked required>
                <label class="custom-control-label" for="switch9">Соглашаюсь с правилами <a href="/info/delivery/" target="_blank">оплаты и доставки</a>
                </label>
            </div>
        </div>
        <div class="checkbox checkbox--switch checkbox--switch-reverse">
            <div class="custom-control custom-checkbox">
                <input class="custom-control-input" type="checkbox" id="switch10" checked required>
                <label class="custom-control-label" for="switch10">Соглашаюсь с условиями <a href="/info/vozvrat-i-obmen/" target="_blank">обмена и возврата</a>
                </label>
            </div>
        </div>
        <div class="checkbox checkbox--switch checkbox--switch-reverse">
            <div class="custom-control custom-checkbox">
                <input class="custom-control-input" type="checkbox" id="switch092" checked required>
                <label class="custom-control-label" for="switch092">Даю согласие на <a href="/info/policy/" target="_blank">обработку данных</a>
                </label>
            </div>
        </div>
        <button class="btn btn-primary"
                type="submit"
                data-is-goal="click"
                data-base-goal-name="oneclick_send"
        >
            Отправить
        </button>
    </div>
</form>
