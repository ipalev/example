<?php

use Its\Lib\Modal\AuthModal;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

global $APPLICATION;

/**
 * @var CAllMain $APPLICATION
 * @var AuthModal $this
 */

?>
<div class="modal modal--right-narrow modal--form modal--enter" id="<?=$this->getModalId()?>">
    <a class="modal__close" href="#" data-fancybox-close data-no-swup></a>
    <div class="container-fluid px-md-0">
        <div class="modal__content">
            <?php $APPLICATION->IncludeComponent(
                'bitrix:main.auth.form',
                '.default',
                [
                    'DISABLE_SOCSERV_AUTH' => 'Y',
                    'ADD_FIELDS' => $this->getFields()
                ],
                false
            ); ?>
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
