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
<div class="modal modal--right modal--close-outside modal--order-info" id="<?=$this->getModalId()?>">
    <a class="modal__close" href="#" data-fancybox-close data-no-swup></a>
    <div class="container-fluid px-md-0">
        <div class="modal__content">
            <?php
            $APPLICATION->IncludeComponent(
                "its:sale.personal.order.detail",
                "personal-order",
                [
                    "SET_TITLE" =>'N',
                    "ID" => $this->getOrderId(),
                    "CACHE_TYPE" => "A",
                    "CACHE_TIME" => "3600",
                    "CACHE_GROUPS" => "N",
                    "HIDE_USER_INFO" => 'N',
                    "AUTH_FORM_IN_TEMPLATE" => 'N',
                    "CONTEXT_SITE_ID" => SITE_ID,
                    "CUSTOM_SELECT_PROPS" => [
                        'PROPERTY_GALLERY'
                    ]
                ],
                false
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