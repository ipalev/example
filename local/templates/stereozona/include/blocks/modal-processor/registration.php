<?php

use Its\Lib\Modal\BaseModal;
use Its\Lib\Modal\ConfirmMailModal;
use Its\Lib\Modal\Processor;


if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

global $APPLICATION;

/**
 * @var CAllMain $APPLICATION
 * @var BaseModal $this
 */

?>
<div class="modal modal--right modal--right-narrow modal--registration modal--form" id="<?=$this->getModalId()?>">
    <a class="modal__close" href="#" data-fancybox-close data-no-swup></a>
    <div class="container-fluid px-md-0">
        <div class="modal__content">
            <?php $APPLICATION->IncludeComponent(
                "bitrix:main.register",
                "",
                Array(
                    "SEF_MODE" => "N",
                    "SHOW_FIELDS" => [
                        "NAME",
                        "EMAIL",
                        "PERSONAL_PHONE"
                    ],
                    "REQUIRED_FIELDS" => [
                        "NAME",
                        "EMAIL"
                    ],
                    "AUTH" => "Y",
                    "USE_BACKURL" => "Y",
                    "SUCCESS_PAGE" => "",
                    "SET_TITLE" => "N",
                    "CACHE_TYPE" => "A",
                    "CACHE_TIME" => "3600",

                    'ADD_FIELDS' => $this->getFields()
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
