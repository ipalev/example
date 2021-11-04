<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) {
    die();
}

/**
 * @var CAllUser $USER
 * @var CAllMain $APPLICATION
 * @var CBitrixComponent $component
 * @var array $arParams
 * @var array $arResult
 */
 
?>
<form class="modal__form-wrapper js__ajax-passwd-change"
      action="/ajax/auth/changePassword/"
      enctype="multipart/form-data"
      method="POST"
>
    <?php if($arParams['ADD_FIELDS']) {
        foreach ($arParams['ADD_FIELDS'] as $field => $value) {
            printf('<input type="hidden" name="%s" value="%s">', $field, $value);
        }
    }?>
    <?=$arResult["BX_SESSION_CHECK"]?>
    <input type="hidden" name="ID" value=<?=$arResult["ID"]?> />

    <div class="modal__form-top">
        <p class="modal__form-top-title">Новый пароль</p>
        <p class="modal__form-top-subtitle">Придумайте новый пароль. Используйте надеждные сочетания: не используйте свой логин, номер телефона или день рождения вашей бабушки</p>
    </div>
    <div class="modal__form-center">
        <div class="form__item form-group">
            <input class="input form-control"
                   type="password"
                   placeholder="Пароль"
                   autocomplete="off"
                   name="NEW_PASSWORD"
                   value=""
            >
        </div>
        <div class="form__item form-group">
            <input class="input form-control"
                   type="password"
                   name="NEW_PASSWORD_CONFIRM"
                   value=""
                   autocomplete="off"
                   placeholder="Подтверждение пароля"
            >
        </div>
        <div class="modal__form-footer">
            <input class="btn btn-primary"
                   type="submit"
                   name="save"
                   value="Сохранить"
            >
            <a class="btn btn-link" href="#">Назад</a>
        </div>
    </div>
</form>
