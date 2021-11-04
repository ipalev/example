<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CAllMain $APPLICATION
 * @var CBitrixComponent $component
 * @var array $arParams
 * @var array $arResult
 */

?>
<form class="subscribe js__send-ajax"
      method="POST"
      action="/ajax/form/subscribe/handler.php"
>
    <?=bitrix_sessid_post()?>
    <input type="hidden" name="sender_subscription" value="add">
    <div class="form__subscribe-content">
        <input class="subscribe__input"
               type="text"
               placeholder="ваш email"
               name="SENDER_SUBSCRIBE_EMAIL"
               required
               minlength="3"
               pattern="^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$"
        >
        <button class="subscribe__btn"
                data-is-goal="click"
                data-base-goal-name="rassilka_send"
                type="submit"
        ></button>
    </div>
    <p class="subscribe__dscr">
        Подписываясь на рассылку, вы соглашаетесь с условиями оферты и политики конфиденциальности
    </p>
</form>
