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
<div class="modal modal--right modal--right-narrow modal--lost-password modal--form" id="<?=$this->getModalId()?>">
    <a class="modal__close" href="#" data-fancybox-close data-no-swup></a>
    <div class="container-fluid px-md-0">
        <div class="modal__content">
            <?php $APPLICATION->IncludeComponent(
                    'bitrix:main.auth.forgotpasswd',
                    '.default',
                    [
                        'ADD_FIELDS' => $this->getFields()
                    ]
            ) ?>
        </div>
    </div>
</div>