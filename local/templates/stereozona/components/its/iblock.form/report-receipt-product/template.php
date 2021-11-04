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
        <p class="modal__form-top-title">Сообщить о поступлении товара</p>
        <p class="modal__form-top-subtitle">Мы с вами свяжемся и сообщим когда товар появиться в продаже. Пожалуйста, оставьте свои контактные данные </p>
    </div>
    <div class="modal__form-center">
        <?php

        include($_SERVER['DOCUMENT_ROOT'].SITE_TEMPLATE_PATH.'/include/blocks/form/fields_template.php');

        ?>
    </div>
    <div class="modal__form-bottom">
        <div class="checkbox checkbox--switch checkbox--switch-reverse">
            <div class="custom-control custom-checkbox">
                <input class="custom-control-input" type="checkbox" id="switch-receipt-product-agree" checked required>
                <label class="custom-control-label" for="switch-receipt-product-agree">Даю согласие на <a href="/info/policy/">обработку данных</a>
                </label>
            </div>
        </div>
        <button id="product-receipt-submit-btn"
                class="btn btn-primary"
                type="submit"
                data-is-goal="click"
                data-base-goal-name="nalichie_send"
        >
            Отправить
        </button>
    </div>
</form>
