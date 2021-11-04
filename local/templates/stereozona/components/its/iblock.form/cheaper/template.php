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
        <p class="modal__form-top-title">Нашли дешевле?</p>
        <p class="modal__form-top-subtitle">Пришлите нам ссылку на этот товар в другом магазине и в течение 24-х часов вы получите SMS с уникальным промокодом. В случае отказа информация поступит на указанный Вами E-mail.</p>
    </div>
    <div class="modal__form-center">
        <?php

        include($_SERVER['DOCUMENT_ROOT'].SITE_TEMPLATE_PATH.'/include/blocks/form/fields_template.php');

        ?>
    </div>
    <div class="modal__form-bottom">
        <button class="btn btn-primary"
                type="submit"
                data-is-goal="click"
                data-base-goal-name="low_price_send"
        >
            Отправить
        </button>
        <p class="sm mb-0">Нажимая кнопку «Отправить» подтверждаю свое согласие с условиями обработки персональных данных</p>
    </div>
</form>
