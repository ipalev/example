<?php

/**
 * @var CMain $APPLICATION
 * @var CUser $USER
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 */

use \Bitrix\Main\Localization\Loc;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

if ($USER->IsAuthorized()) {
    echo 'Вы зарегистрированы на сервере и успешно авторизованы';
}
?>

<form class="modal__form-wrapper modal__form-registration js__ajax-register"
      action="/ajax/auth/register/"
      method="POST"
      enctype="multipart/form-data"
      name="regform"
>
    <div class="modal__form-top">
        <p class="modal__form-top-title">Регистрация</p>
    </div>
    <?php

    if($arParams['ADD_FIELDS']) {
        foreach ($arParams['ADD_FIELDS'] as $field => $value) {
            printf('<input type="hidden" name="%s" value="%s">', $field, $value);
        }
    }

    if (array_key_exists('BACKURL', $arResult) && !empty($arResult['BACKURL'])) { ?>
        <input type="hidden" name="backurl" value="<?= $arResult["BACKURL"] ?>"/>
    <?php } ?>
    <div class="modal__form-center">
        <?php if($arResult['ERRORS']) {
            foreach ($arResult["ERRORS"] as $key => $error) {
                if((int)$key === 0 && $key !== 0) {
                    $error = str_replace(
                        "#FIELD_NAME#",
                        "&quot;" . Loc::getMessage("REGISTER_FIELD_" . $key) . "&quot;",
                        $error
                    );
                }

                printf('<font color="#FF0000">%s</font>', $error);
            }
        }

        ?>
        <div class="form__item form-group">
            <input class="input form-control"
                   type="text"
                   placeholder="Имя"
                   name="REGISTER[NAME]"
                   value="<?= $arResult['VALUES']['NAME'] ?>"
            >
        </div>
        <div class="form__item form-group">
            <input class="input form-control js-mask-email"
                   type="text"
                   placeholder="Email"
                   name="REGISTER[EMAIL]"
                   value="<?= $arResult['VALUES']['EMAIL'] ?>"
                   autocomplete="off"
            >
        </div>
        <div class="form__item form-group">
            <input class="input form-control js-mask-phone"
                   type="tel"
                   placeholder="Телефон"
                   name="REGISTER[PERSONAL_PHONE]"
                   value="<?= $arResult['VALUES']['PHONE'] ?>"
            >
        </div>
        <div class="form__item form-group">
            <input class="input form-control"
                   type="password"
                   autocomplete="off"
                   placeholder="Пароль"
                   name="REGISTER[PASSWORD]"
                   value="<?= $arResult['VALUES']['PASSWORD'] ?>"
            >
        </div>
        <div class="form__item form-group">
            <input class="input form-control"
                   type="password"
                   autocomplete="off"
                   placeholder="Подтвердите пароль"
                   name="REGISTER[CONFIRM_PASSWORD]"
                   value="<?= $arResult['VALUES']['CONFIRM_PASSWORD'] ?>"
            >
        </div>
        <div class="checkbox checkbox--switch checkbox--switch-reverse">
            <div class="custom-control custom-checkbox">
                <input class="custom-control-input" type="checkbox" id="switch13" checked required>
                <label class="custom-control-label" for="switch13">Даю согласие на <a href="/info/policy/" target="_blank">обработку данных</a></label>
            </div>
        </div>
        <div class="checkbox checkbox--switch checkbox--switch-reverse">
            <div class="custom-control custom-checkbox">
                <input class="custom-control-input" type="checkbox" id="switch14" checked name="SUBSCRIBE_EMAIL">
                <label class="custom-control-label" for="switch14">Хочу получать Email-рассылки</label>
            </div>
        </div>
    </div>
    <div class="modal__form-bottom-wrapper">
        <div class="modal__form-bottom">
            <input class="btn btn-primary"
                   type="submit"
                   value="Создать аккаунт"
                   data-is-goal="click"
                   data-base-goal-name="akk_reg"
            >
        </div>
        <div class="modal__form-bottom">
            <a class="btn btn-outline-primary" href="#">Войти</a>
        </div>
    </div>
</form>
