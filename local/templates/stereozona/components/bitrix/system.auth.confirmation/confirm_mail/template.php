<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use \Bitrix\Main\Localization\Loc;

if($arResult["SHOW_FORM"] && $arResult['NEED_CONFIRMATION']) {?>
    <form class="modal__form-wrapper" method="get" action="<?=$arResult["FORM_ACTION"]?>">
        <input type="hidden" name="confirm_registration" value="yes">
        <div class="modal__form-top">
            <p class="modal__form-top-title"><?=Loc::getMessage("CT_BSAC_CONFIRM_HEDER")?></p>
        </div>
        <div class="modal__form-center">
            <p><?=$arResult["CONFIRM_CODE"] ? $arResult["MESSAGE_TEXT"] : Loc::getMessage("CT_BSAC_CONFIRM_MESSAGE")?></p>
            <p><?=Loc::getMessage("CT_BSAC_CONFIRM_FORM_MESSAGE")?></p>
            <div class="form__item form-group">
                <input class="input form-control"
                       type="text"
                       name="<?=$arParams["LOGIN"]?>"
                       maxlength="255"
                       placeholder="<?=Loc::getMessage("CT_BSAC_EMAIL")?>"
                       value="<?=$arResult["LOGIN"]?>"
                >
            </div>
            <div class="form__item form-group">
                <input class="input form-control"
                       type="text"
                       name="<?=$arParams["CONFIRM_CODE"]?>"
                       maxlength="255"
                       placeholder="<?=Loc::getMessage("CT_BSAC_CONFIRM_CODE")?>"
                       value="<?=$arResult["CONFIRM_CODE"]?>"
                >
            </div>
            <div class="modal__form-footer">
                <input class="btn btn-primary"
                       value="<?=Loc::getMessage("CT_BSAC_CONFIRM")?>"
                       type="submit"
                >
            </div>
        </div>
    </form>
<?php
} else { ?>
    <div class="modal__form-wrapper">
        <div class="modal__form-top">
            <p class="modal__form-top-title"><?=Loc::getMessage("CT_BSAC_SUCCESS_HEDER")?></p>
            <p class="modal__form-top-subtitle"><?=Loc::getMessage("CT_BSAC_SUCCESS_MESSAGE")?></p>
        </div>
        <div class="modal__form-center text-center">
            <a class="logo logo--big" href="<?=SITE_DIR?>">
                <img src="/assets/img/logo.svg" alt>
            </a>
        </div>
        <div class="modal__form-bottom">
            <?php
            if ($arResult['NEED_CONFIRMATION'] && !$USER->IsAuthorized()) { ?>
                <a
                    class="btn btn-primary"
                    href="#"
                    data-fancybox
                    data-no-swup
                    data-src="#modalEnter"
                    data-animation-effect="false"
                    data-touch="false"
                    data-modal="true"
                >
                    <?=Loc::getMessage("BTN_LOGIN")?>
                </a>
            <?php
            } else { ?>
                <a class="btn btn-primary" href="<?=SITE_DIR?>personal/"><?=Loc::getMessage("BTN_LOG_IN_ACCOUNT")?></a>
            <?php
            } ?>
        </div>
    </div>
<?php
}?>
