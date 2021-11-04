<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) {
    die();
}

use Bitrix\Main\AccessDeniedException;
use Its\Lib\Modal\NewPasswordModal;
use Its\Lib\Modal\Processor;
use Its\Lib\SaleHelper;

/**
 * @var CAllUser $USER
 * @var CAllMain $APPLICATION
 * @var CBitrixComponent $component
 * @var array $arParams
 * @var array $arResult
 */

if ($arParams['SHOW_PRIVATE_PAGE'] !== 'Y' && $arParams['USE_PRIVATE_PAGE_TO_AUTH'] !== 'Y') {
    LocalRedirect($arParams['SEF_FOLDER']);
}

if ($arParams['SET_TITLE'] === 'Y') {
    $APPLICATION->SetTitle('Личные данные');
}

if (!$USER->IsAuthorized() || $arResult['SHOW_LOGIN_FORM'] === 'Y') {
    throw new AccessDeniedException();
}


?>
<main class="page-content" id="swup">
    <div class="profile">
        <?php
        include('include/aside.php');
        ?>
        <div class="profile__wrapper">
            <div class="container-fluid">
                <div class="profile__wrapper-top">
                    <div class="badge">
                        <a class="logo badge__logo" href="<?=SITE_DIR?>">
                            <img src="/assets/img/logo--white.svg" alt>
                        </a>
                        <div class="badge__status">Premium</div>
                    </div>
                </div>
                <div class="profile__content">
                    <?php
                    if($profileId = SaleHelper::getUserProfileId($USER->GetID())) {
                        $passwordModal = new NewPasswordModal();
                        Processor::getInstance()->addModal($passwordModal);

                        $APPLICATION->IncludeComponent(
                            "bitrix:sale.personal.profile.detail",
                            "personal_data",
                            array(
                                "PATH_TO_DETAIL" => $APPLICATION->GetCurPage(),
                                "SET_TITLE" => 'N',
                                "ID" => $profileId,
                                "AUTH_FORM_IN_TEMPLATE" => 'N',
                                "PASSWORD_MODAL_ID" => $passwordModal->getModalId(),
                            ),
                            $component
                        );
                    }?>
                </div>
            </div>
        </div>
    </div>
</main>