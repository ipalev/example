<?php

use Its\Lib\Modal\BaseModal;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

global $APPLICATION;

/**
 * @var CAllMain $APPLICATION
 * @var BaseModal $this
 */

?>
<div class="modal modal--right modal--right-narrow modal--new-password modal--form" id="<?=$this->getModalId()?>">
    <a class="modal__close" href="#" data-fancybox-close data-no-swup></a>
    <div class="container-fluid px-md-0">
        <div class="modal__content">
            <?php $APPLICATION->IncludeComponent(
                "bitrix:system.auth.confirmation",
                "confirm_mail",
                Array(
                    "USER_ID" => "confirm_user_id",
                    "CONFIRM_CODE" => "confirm_code",
                    "LOGIN" => "login"
                )
            );?>
        </div>
    </div>
</div>
<?php
if($this->isInstantOpen()) {
    echo '
    <script data-skip-moving="true">
        document.addEventListener("pageLoaded", function () {
            window.showModal("#' . $this->getModalId() . '");
        }, {once: true});
    </script>
    ';
}
