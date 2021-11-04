<?php
define('__CURRENT_PAGE__', 'cart');

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

/** @var CAllMain $APPLICATION */

$APPLICATION->SetTitle('Корзина');
?>
    <main class="page-content" id="swup">
        <div class="container-fluid cart__container">
            <div class="cart" id="cart-page">
                <div class="cart__wrapper">
                    <?$APPLICATION->IncludeComponent(
                        'bitrix:sale.basket.basket',
                        'cart',
                        array(
                            "COLUMNS_LIST_EXT" => array(
                                0 => "DETAIL_PAGE_URL",
                                1 => "PROPERTY_GALLERY",
                                2 => "DISCOUNT",
                                3 => "SUM",
                                4 => "PRICE",
                            ),
                            "PATH_TO_ORDER" => "/cart/order/",
                            "HIDE_COUPON" => "N",
                            "PRICE_VAT_SHOW_VALUE" => "N",
                            "USE_PREPAYMENT" => "N",
                            "QUANTITY_FLOAT" => "N",
                            "CORRECT_RATIO" => "Y",
                            "AUTO_CALCULATION" => "Y",
                            "SET_TITLE" => "N",
                            "ACTION_VARIABLE" => "action",
                            "COMPATIBLE_MODE" => "Y",
                            "BASKET_IMAGES_SCALING" => "adaptive",
                            "USE_GIFTS" => "N",
                        ),
                        false
                    );?>
                </div>
            </div>
        </div>
    </main>
<?php

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");
