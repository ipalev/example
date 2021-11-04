<?php

/**
 * @var CAllMain $APPLICATION
 * @var CAllUser $USER
 */

use Its\Lib\Modal\AuthModal;
use Its\Lib\Modal\ForgotPasswordModal;
use Its\Lib\Modal\Processor;
use Its\Lib\Modal\RegisterModal;

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

$APPLICATION->SetTitle('Оформление заказа');
?>
    <main class="page-content" id="swup">
        <div class="container-fluid pr-0">
            <form class="order" id="bx-soa-order-form">
                <div class="order__wrapper" id="bx-soa-order">
                    <div class="order__content">
                        <?php $APPLICATION->IncludeComponent(
                            "bitrix:breadcrumb",
                            "main",
                            [
                                "START_FROM" => "0",
                                "PATH" => "",
                                "SITE_ID" => SITE_ID
                            ]
                        );?>

                        <div class="order__header">
                            <h1 class="mb-0"><?php $APPLICATION->ShowTitle(false);?></h1>
                            <?/*
                            <a class="btn btn-secondary btn-sm" href="#">Войти</a>
                            */?>
                        </div>
                        <?php

                        if(!$USER->IsAuthorized()) {
                            $fields = ['backurl' => $APPLICATION->GetCurUri()];

                            Processor::getInstance()->addModal(
                                (new AuthModal())->setInstantOpen(true)->setFields($fields)
                            )
                                ->addModal(
                                    (new RegisterModal())->setFields($fields)
                                )
                                ->addModal(
                                    (new ForgotPasswordModal())->setFields($fields)
                                );
                        } else {
                            $APPLICATION->IncludeComponent(
                                "bitrix:sale.order.ajax",
                                "order",
                                array(
                                    "PAY_FROM_ACCOUNT" => "N",
                                    "ONLY_FULL_PAY_FROM_ACCOUNT" => "N",
                                    "ALLOW_AUTO_REGISTER" => "Y",
                                    "ALLOW_APPEND_ORDER" => "Y",
                                    "SEND_NEW_USER_NOTIFY" => "N",
                                    "DELIVERY_NO_AJAX" => "Y",
                                    "SHOW_NOT_CALCULATED_DELIVERIES" => "L",
                                    "DELIVERY_NO_SESSION" => "Y",
                                    "TEMPLATE_LOCATION" => "popup",
                                    "SPOT_LOCATION_BY_GEOIP" => "Y",
                                    "DELIVERY_TO_PAYSYSTEM" => "d2p",
                                    "SHOW_VAT_PRICE" => "Y",
                                    "USE_PREPAYMENT" => "N",
                                    "COMPATIBLE_MODE" => "Y",
                                    "USE_PRELOAD" => "Y",
                                    "ALLOW_USER_PROFILES" => "N",
                                    "ALLOW_NEW_PROFILE" => "N",
                                    "TEMPLATE_THEME" => "blue",
                                    "SHOW_ORDER_BUTTON" => "final_step",
                                    "SHOW_TOTAL_ORDER_BUTTON" => "N",
                                    "SHOW_PAY_SYSTEM_LIST_NAMES" => "Y",
                                    "SHOW_PAY_SYSTEM_INFO_NAME" => "Y",
                                    "SHOW_DELIVERY_LIST_NAMES" => "Y",
                                    "SHOW_DELIVERY_INFO_NAME" => "Y",
                                    "SHOW_DELIVERY_PARENT_NAMES" => "Y",
                                    "SHOW_STORES_IMAGES" => "Y",
                                    "SKIP_USELESS_BLOCK" => "Y",
                                    "BASKET_POSITION" => "after",
                                    "SHOW_BASKET_HEADERS" => "N",
                                    "DELIVERY_FADE_EXTRA_SERVICES" => "N",
                                    "SHOW_NEAREST_PICKUP" => "N",
                                    "DELIVERIES_PER_PAGE" => "9",
                                    "PAY_SYSTEMS_PER_PAGE" => "9",
                                    "PICKUPS_PER_PAGE" => "5",
                                    "SHOW_PICKUP_MAP" => "Y",
                                    "SHOW_MAP_IN_PROPS" => "N",
                                    "PICKUP_MAP_TYPE" => "yandex",
                                    "SHOW_COUPONS" => "Y",
                                    "SHOW_COUPONS_BASKET" => "Y",
                                    "SHOW_COUPONS_DELIVERY" => "Y",
                                    "SHOW_COUPONS_PAY_SYSTEM" => "Y",
                                    "USER_CONSENT" => "N",
                                    "USER_CONSENT_ID" => "0",
                                    "USER_CONSENT_IS_CHECKED" => "Y",
                                    "USER_CONSENT_IS_LOADED" => "N",
                                    "ACTION_VARIABLE" => "soa-action",
                                    "PATH_TO_BASKET" => "/cart/",
                                    "PATH_TO_DETAIL" => "/cart/order/#id#/",
                                    "PATH_TO_PERSONAL" => "index.php",
                                    "PATH_TO_PAYMENT" => "payment.php",
                                    "PATH_TO_AUTH" => "/auth/",
                                    "SET_TITLE" => "Y",
                                    "DISABLE_BASKET_REDIRECT" => "N",
                                    "EMPTY_BASKET_HINT_PATH" => "/",
                                    "USE_PHONE_NORMALIZATION" => "Y",
                                    "PRODUCT_COLUMNS_VISIBLE" => array(
                                        0 => "",
                                        1 => "",
                                    ),
                                    "ADDITIONAL_PICT_PROP_1" => "-",
                                    "BASKET_IMAGES_SCALING" => "adaptive",
                                    "SERVICES_IMAGES_SCALING" => "adaptive",
                                    "PRODUCT_COLUMNS_HIDDEN" => array(),
                                    "HIDE_ORDER_DESCRIPTION" => "N",
                                    "USE_YM_GOALS" => "N",
                                    "USE_ENHANCED_ECOMMERCE" => "N",
                                    "USE_CUSTOM_MAIN_MESSAGES" => "N",
                                    "USE_CUSTOM_ADDITIONAL_MESSAGES" => "N",
                                    "USE_CUSTOM_ERROR_MESSAGES" => "N"
                                ),
                                false
                            );
                        }

                        ?>
                    </div>
                    <?php

                    $APPLICATION->ShowViewContent('order: overall');
                    $APPLICATION->ShowViewContent('order: mobile');

                    ?>
                </div>
            </form>
        </div>
    </main>
<?php

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");
