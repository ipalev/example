<?php

/**
 * @var array $arResult
 * @var array $arParams
 * @var CAllMain $APPLICATION
 */

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) {
	die();
}

use \Bitrix\Main\Localization\Loc;

if ($arResult['AUTHORIZED'])
{
	echo Loc::getMessage('MAIN_AUTH_PWD_SUCCESS');
	return;
}
?>
<form class="modal__form-wrapper modal__form-lost-password" 
    action="<?= POST_FORM_ACTION_URI;?>" 
    method="POST" 
    name="bform"
>
    <div class="modal__form-top">
        <p class="modal__form-top-title">Забыли пароль?</p>
        <p class="modal__form-top-subtitle">Укажите контакты для восстановления</p>
    </div>
    <div class="modal__form-center">
        <?php if($arResult['ERRORS']) {
            foreach ($arResult['ERRORS'] as $error) {
                printf('<font color="#FF0000">%s</font>', $error);
            }
        }?>
        <div class="form__item form-group">
            <input class="input form-control js-mask-email"
                   type="text"
                   name="<?= $arResult['FIELDS']['email'] ?>"
                   placeholder="Email"
                   autocomplete="off"
            >
        </div>
        <div class="modal__form-footer">
            <input class="btn btn-primary send-btn"
                   type="submit"
                   name="<?= $arResult['FIELDS']['action'];?>"
                   value="Отправить"
                   disabled
            >
            <a class="btn btn-link" href="#">Назад</a>
        </div>
    </div>
</form>
