<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) {
    die();
}

use Bitrix\Main\AccessDeniedException;
use Bitrix\Sale\Internals\UserPropsTable;
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
	$APPLICATION->SetTitle('Профиль');
}

if (!$USER->IsAuthorized() || $arResult['SHOW_LOGIN_FORM'] === 'Y') {
    throw new AccessDeniedException();
}

$request = \Bitrix\Main\Context::getCurrent()->getRequest();
$fullName = $USER->GetFullName() ?: $USER->GetEmail();

?>
<main class="page-content" id="swup">
    <div class="profile profile--home">
        <?php
        include('include/aside.php');
        ?>
        <div class="profile__wrapper">
            <div class="container-fluid">
                <div class="profile__wrapper-top">
                    <div class="badge">
                        <a class="logo badge__logo" href="index.html">
                            <img src="/assets/img/logo--white.svg" alt>
                        </a>
                        <div class="badge__status">Premium</div>
                    </div>
                </div>
                <div class="profile__content">
                    <div class="row">
                        <div class="col-xl-8 col-lg-11 offset-lg-1">
                            <div class="row">
                                <div class="col-lg-6 profile__short-col">
                                    <h4 class="mb-15 mb-sm-25">Личные данные</h4>
                                    <p>
                                        <?php printf('%s<br>%s', $fullName, $fullName !== $USER->GetEmail() ? $USER->GetEmail() : '') ?>
                                    </p>
                                    <a class="profile__edit" href="<?=SITE_DIR?>personal/data/">Редактировать</a>
                                </div>
                                <?php

                                if($profileId = SaleHelper::getUserProfileId($USER->GetID())) {
                                    $APPLICATION->IncludeComponent(
                                        "bitrix:sale.personal.profile.detail",
                                        "personal_index",
                                            Array(
                                            "COMPATIBLE_LOCATION_MODE" => "N",
                                            "PATH_TO_DETAIL" => "personal/data/",
                                            "ID" => $profileId,
                                            "USE_AJAX_LOCATIONS" => "Y",
                                            "SET_TITLE" => "N"
                                        ), $component
                                    );

                                }

                                $request->set('filter_history', 'Y');
                                $_REQUEST['filter_history'] = 'Y';

                                $APPLICATION->IncludeComponent(
                                    "bitrix:sale.personal.order.list",
                                    "last",
                                    array(
                                        "SAVE_IN_SESSION" => $arParams["SAVE_IN_SESSION"],
                                        "ORDERS_PER_PAGE" => 1,
                                        "SET_TITLE" =>"N",
                                        "HISTORIC_STATUSES" => $arParams["ORDER_HISTORIC_STATUSES"],
                                        "ALLOW_INNER" => $arParams["ALLOW_INNER"],
                                        "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                                        "CACHE_TIME" => $arParams["CACHE_TIME"],
                                        "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                                        "DEFAULT_SORT" => $arParams["ORDER_DEFAULT_SORT"],
                                        "AUTH_FORM_IN_TEMPLATE" => 'N',
                                    ),
                                    $component
                                );?>
                                <div class="col-lg-6 profile__short-col">
                                    <h4 class="mb-15 mb-sm-25">Помощь и сервис</h4>
                                    <div class="profile__help-links">
                                        <a href="/info/delivery/" class="mb-5">Доставка и оплата</a>
                                        <a href="/info/vozvrat-i-obmen/">Условия возврата</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
