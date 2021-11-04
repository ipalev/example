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


    <div class="modal__form-top">
        <p class="modal__form-top-title">Свяжитесь с нами</p>
        <p class="modal__form-top-subtitle">Укажите необходимую информацию и наш оператор свяжется с вами</p>
    </div>
    <div class="modal__form-center">
        <?php

        include($_SERVER['DOCUMENT_ROOT'].SITE_TEMPLATE_PATH.'/include/blocks/form/fields_template.php');

        ?>
    </div>
    <div class="modal__form-bottom">
        <button class="btn btn-primary"
                data-is-goal="click"
                data-base-goal-name="contacts_send"
                type="submit"
        >
            Отправить
        </button>
        <p class="xs form__agreement">Нажимая «Отправить», я подтверждаю согласие с <a href="/info/policy/" target="_blank">условиями обработки персональных данных</a></p>
    </div>
</form>
