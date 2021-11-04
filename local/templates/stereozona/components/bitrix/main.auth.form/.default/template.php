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

if ($arResult['AUTHORIZED']) {
	echo Loc::getMessage('MAIN_AUTH_FORM_SUCCESS');
	return;
}
?>
<form class="modal__form-wrapper modal__form-login js__ajax-auth" action="/ajax/auth/authorize/" method="POST" name="<?= $arResult['FORM_ID'];?>">
    <?php if($arParams['ADD_FIELDS']) {
        foreach ($arParams['ADD_FIELDS'] as $field => $value) {
            printf('<input type="hidden" name="%s" value="%s">', $field, $value);
        }
    }?>
    <div class="modal__form-top">
        <p class="modal__form-top-title">Войти</p>
    </div>
    <div class="modal__form-center">
        <?php if($arResult['ERRORS']) {
            foreach ($arResult['ERRORS'] as $error) {
                printf('<font color="#FF0000">%s</font>', $error);
            }
        }?>
        <div class="form__item form-group">
            <input class="input form-control"
                   type="text"
                   name="<?= $arResult['FIELDS']['login'] ?>"
                   maxlength="255"
                   placeholder="Email"
                   value="<?= \htmlspecialcharsbx($arResult['LAST_LOGIN']) ?>"
            >
        </div>
        <div class="form__item form-group">
            <input class="input form-control"
                   placeholder="Пароль"
                   type="password"
                   name="<?= $arResult['FIELDS']['password'] ?>"
                   maxlength="255"
                   autocomplete="off"
            >
            <p class="xs form__item-comment mb-0">
                <a href="#"
                   data-fancybox
                   data-no-swup
                   data-src="#modalLostPassword"
                   data-animation-effect="false"
                   data-touch="false"
                   data-modal="true"
                >
                    Напомнить пароль
                </a>
            </p>
        </div>
        <div class="modal__form-footer">
            <input class="btn btn-primary"
                   name="<?= $arResult['FIELDS']['action'] ?>"
                   value="Войти"
                   type="submit"
                   data-is-goal="click"
                   data-base-goal-name="akk_vhod"
            >
            <?php if ($arResult['AUTH_SERVICES']) {
                $APPLICATION->IncludeComponent('bitrix:socserv.auth.form',
                    'flat',
                    array(
                        'AUTH_SERVICES' => $arResult['AUTH_SERVICES'],
                        'AUTH_URL' => $arResult['CURR_URI']
                    ),
                    $component,
                    array('HIDE_ICONS' => 'Y')
                );
            }?>
        </div>
    </div>
    <div class="modal__form-bottom">
        <div class="modal__registration-invite">
            <p class="mb-0">Получайте скидки и выгодные предложения</p>
            <a class="btn btn-outline-primary"
               data-fancybox
               data-no-swup
               data-src="#modalRegistration"
               data-animation-effect="false"
               data-touch="false"
               data-modal="true"
               data-is-goal="click"
               data-base-goal-name="akk_create"
               href="#"
            >
                Создать аккаунт
            </a>
        </div>
    </div>
</form>
