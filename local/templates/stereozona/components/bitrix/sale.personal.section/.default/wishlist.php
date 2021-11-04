<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) {
    die();
}

use Bitrix\Main\AccessDeniedException;
use Its\Lib\AjaxApiController\Basket;

/**
 * @var CAllUser $USER
 * @var CAllMain $APPLICATION
 * @var CBitrixComponent $component
 * @var array $arParams
 * @var array $arResult
 */


if ($arParams['SET_TITLE'] === 'Y') {
    $APPLICATION->SetTitle('Избранное');
}

if (!$USER->IsAuthorized() || $arResult['SHOW_LOGIN_FORM'] === 'Y') {
    throw new AccessDeniedException();
}

$GLOBALS['productIds']['ID'] = Basket::getDeferredProducts();
if (empty($GLOBALS['productIds']['ID'])) $GLOBALS['productIds']['ID'] = -1;
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
                    <div class="row">
                        <div class="col-xl-10 col-lg-11 offset-lg-1">
                            <h3 class="mb-30 mb-sm-55">
                                Избранное<sup><?= $GLOBALS['productIds']['ID'] == -1 ? 0 : count($GLOBALS['productIds']['ID'])?></sup>
                            </h3>
                            <?php
                            $APPLICATION->IncludeComponent(
                                "bitrix:catalog.section",
                                "whishlist",
                                array(
                                    "ACTION_VARIABLE" => "action",
                                    "ADD_PICT_PROP" => "-",
                                    "ADD_PROPERTIES_TO_BASKET" => "Y",
                                    "ADD_SECTIONS_CHAIN" => "N",
                                    "ADD_TO_BASKET_ACTION" => "ADD",
                                    "AJAX_MODE" => "N",
                                    "BACKGROUND_IMAGE" => "-",
                                    "BASKET_URL" => "/personal/basket.php",
                                    "BROWSER_TITLE" => "-",
                                    "CACHE_FILTER" => "N",
                                    "CACHE_GROUPS" => "N",
                                    "CACHE_TIME" => "3600",
                                    "CACHE_TYPE" => "N",
                                    "COMPATIBLE_MODE" => "Y",
                                    "CONVERT_CURRENCY" => "Y",
                                    "CUSTOM_FILTER" => "",
                                    "DETAIL_URL" => "",
                                    "DISABLE_INIT_JS_IN_COMPONENT" => "N",
                                    "DISPLAY_BOTTOM_PAGER" => "Y",
                                    "DISPLAY_COMPARE" => "N",
                                    "DISPLAY_TOP_PAGER" => "N",
                                    "ELEMENT_SORT_FIELD" => "SHOWS",
                                    "ELEMENT_SORT_FIELD2" => "NAME",
                                    "ELEMENT_SORT_ORDER" => "DESC",
                                    "ELEMENT_SORT_ORDER2" => "ASC",
                                    "ENLARGE_PRODUCT" => "STRICT",
                                    "FILTER_NAME" => "productIds",
                                    "HIDE_NOT_AVAILABLE" => "N",
                                    "HIDE_NOT_AVAILABLE_OFFERS" => "N",
                                    "IBLOCK_ID" => \Its\Lib\Iblock::getInstance()->get('catalog'),
                                    "IBLOCK_TYPE" => "catalog",
                                    "INCLUDE_SUBSECTIONS" => "Y",
                                    "LABEL_PROP" => array(),
                                    "LAZY_LOAD" => "N",
                                    "LINE_ELEMENT_COUNT" => 4,
                                    "LOAD_ON_SCROLL" => "N",
                                    "MESSAGE_404" => "",
                                    "OFFERS_FIELD_CODE" => array(
                                        0 => "",
                                        1 => "",
                                    ),
                                    "OFFERS_LIMIT" => "5",
                                    "OFFERS_SORT_FIELD" => "sort",
                                    "OFFERS_SORT_FIELD2" => "id",
                                    "OFFERS_SORT_ORDER" => "asc",
                                    "OFFERS_SORT_ORDER2" => "desc",
                                    "PAGER_BASE_LINK_ENABLE" => "N",
                                    "PAGER_DESC_NUMBERING" => "N",
                                    "PAGER_DESC_NUMBERING_CACHE_TIME" => "3600",
                                    "PAGER_SHOW_ALL" => "Y",
                                    "PAGER_SHOW_ALWAYS" => "Y",
                                    "PAGER_TEMPLATE" => "show_more",
                                    "PAGER_TITLE" => "Товары",
                                    "PAGE_ELEMENT_COUNT" => 8,
                                    "PARTIAL_PRODUCT_PROPERTIES" => "N",
                                    "PRICE_CODE" => array(
                                        0 => "REGULAR",
                                    ),
                                    "PRICE_VAT_INCLUDE" => "Y",
                                    "PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons",
                                    "PRODUCT_DISPLAY_MODE" => "N",
                                    "PRODUCT_ID_VARIABLE" => "id",
                                    "PRODUCT_PROPS_VARIABLE" => "prop",
                                    "PRODUCT_QUANTITY_VARIABLE" => "quantity",
                                    "PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",
                                    "PRODUCT_SUBSCRIPTION" => "Y",
                                    "SECTION_CODE" => "",
                                    "SECTION_ID" => "",
                                    "SECTION_ID_VARIABLE" => "SECTION_ID",
                                    "SECTION_URL" => "",
                                    "SECTION_USER_FIELDS" => array(
                                        0 => "",
                                        1 => "",
                                    ),
                                    "SEF_MODE" => "N",
                                    "SET_BROWSER_TITLE" => "N",
                                    "SET_LAST_MODIFIED" => "N",
                                    "SET_META_DESCRIPTION" => "N",
                                    "SET_META_KEYWORDS" => "N",
                                    "SET_STATUS_404" => "N",
                                    "SET_TITLE" => "N",
                                    "SHOW_404" => "N",
                                    "SHOW_ALL_WO_SECTION" => "Y",
                                    "SHOW_CLOSE_POPUP" => "N",
                                    "SHOW_DISCOUNT_PERCENT" => "N",
                                    "SHOW_FROM_SECTION" => "N",
                                    "SHOW_MAX_QUANTITY" => "N",
                                    "SHOW_OLD_PRICE" => "N",
                                    "SHOW_PRICE_COUNT" => "1",
                                    "SHOW_SLIDER" => "Y",
                                    "USE_ENHANCED_ECOMMERCE" => "N",
                                    "USE_MAIN_ELEMENT_SECTION" => "N",
                                    "USE_PRICE_COUNT" => "N",
                                    "USE_PRODUCT_QUANTITY" => "N"
                                ),
                                false
                            );?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>