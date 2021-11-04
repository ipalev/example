<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CAllMain $APPLICATION
 * @var CBitrixComponent $component
 * @var array $arParams
 * @var array $arResult
 */

?>
<div class="modal modal--right modal--discount" id="modalContactUs">
    <a class="modal__close" href="#" data-fancybox-close data-no-swup></a>
    <div class="container-fluid px-md-0">
        <div class="modal__content">
            <?php $APPLICATION->IncludeComponent(
                "its:iblock.form",
                "callback",
                array(
                    "IBLOCK_TYPE" => "forms",
                    "TYPE_CODE" => "",
                    "FORM_CODE" => "callback-form",
                    "RESP_SUCCESS_MSG_FIELD" => "",
                    "RESP_DEFAULT_ERROR_MSG_FIELD" => "",
                    "CACHE_TYPE" => "A",
                    "CACHE_TIME" => "3600",
                    "EVENT_FILE_PROPS" => array(
                        0 => "",
                    )
                ),
                false
            ); ?>
        </div>
    </div>
</div>
