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
 $request = Bitrix\Main\Context::getCurrent()->getRequest();
?>
<form class="modal__form-wrapper js__ajax-passwd-change"
      action="/ajax/auth/changeForgotPass/"
      enctype="multipart/form-data"
      method="POST"
>

    <input type="hidden" name="USER_CHECKWORD" value=<?=$request->get('USER_CHECKWORD')?>>
    <input type="hidden" name="USER_LOGIN" value=<?=$request->get('USER_LOGIN')?>>
    <input type="hidden" name="AUTH_ACTION" value="Y">

    <div class="modal__form-top">
        <h2 class="modal__form-top-title">Новый пароль</h2>
        <p class="modal__form-top-subtitle">Придумайте новый пароль. Используйте надеждные сочетания: не используйте свой логин, номер телефона или день рождения вашей бабушки</p>
    </div>
    <div class="modal__form-center">
        <div class="form__item form-group">
            <input class="input form-control"
                   type="password"
                   placeholder="Пароль"
                   autocomplete="off"
                   name="USER_PASSWORD"
                   value=""
            >
        </div>
        <div class="form__item form-group">
            <input class="input form-control"
                   type="password"
                   name="USER_CONFIRM_PASSWORD"
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