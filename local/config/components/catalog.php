<?php
/**
 * @var \Its\Config\ComponentInterface $this
 */

return [
    "HIDE_NOT_AVAILABLE" => "N",
    "HIDE_NOT_AVAILABLE_OFFERS" => "N",

    "ADD_PICT_PROP" => "-",
    "LABEL_PROP" => array(
    ),
    "PRODUCT_DISPLAY_MODE" => "N",
    "OFFER_ADD_PICT_PROP" => "-",
    "OFFER_TREE_PROPS" => array(
        0 => "",
        1 => "",
    ),

    "COMMON_SHOW_CLOSE_POPUP" => "N",
    "PRODUCT_SUBSCRIPTION" => "N",
    "SHOW_DISCOUNT_PERCENT" => "Y",
    "SHOW_OLD_PRICE" => "Y",
    "DETAIL_SET_VIEWED_IN_COMPONENT" => "Y",
    "SHOW_MAX_QUANTITY" => "N",
    "USER_CONSENT" => "N",
    "USER_CONSENT_ID" => "0",
    "USER_CONSENT_IS_CHECKED" => "Y",
    "USER_CONSENT_IS_LOADED" => "N",
    "AJAX_MODE" => "N",

    "CACHE_TYPE" => "A",
    "CACHE_TIME" => "10800",
    "CACHE_FILTER" => "N",
    "CACHE_GROUPS" => "Y",

    "USE_MAIN_ELEMENT_SECTION" => "Y",
    "DETAIL_STRICT_SECTION_CHECK" => "Y",

    "ADD_SECTIONS_CHAIN" => "Y",
    "ADD_ELEMENT_CHAIN" => "N",

    "SET_LAST_MODIFIED" => "Y",
    "SET_TITLE" => "Y",
    "LIST_META_KEYWORDS" => "-",
    "LIST_META_DESCRIPTION" => "-",
    "LIST_BROWSER_TITLE" => "-",
    "DETAIL_META_KEYWORDS" => "-",
    "DETAIL_META_DESCRIPTION" => "-",
    "DETAIL_BROWSER_TITLE" => "-",

    "DETAIL_SET_CANONICAL_URL" => "N",
    "USE_SALE_BESTSELLERS" => "N",
    "USE_FILTER" => "Y",
    "INSTANT_RELOAD" => "Y",
    "USE_REVIEW" => "N",
    "ACTION_VARIABLE" => "action",
    "PRODUCT_ID_VARIABLE" => "id",
    "USE_COMPARE" => "N",

    "USE_PRICE_COUNT" => "Y",
    "SHOW_PRICE_COUNT" => "1",
    "PRICE_VAT_INCLUDE" => "Y",
    "PRICE_VAT_SHOW_VALUE" => "N",
    "CONVERT_CURRENCY" => "N",
    "BASKET_URL" => "/cart/",
    "USE_PRODUCT_QUANTITY" => "N",
    "PRODUCT_QUANTITY_VARIABLE" => "quantity",
    "ADD_PROPERTIES_TO_BASKET" => "N",
    "PRODUCT_PROPS_VARIABLE" => "prop",
    "PARTIAL_PRODUCT_PROPERTIES" => "N",
    "USE_COMMON_SETTINGS_BASKET_POPUP" => "Y",
    "SHOW_TOP_ELEMENTS" => "N",
    "SECTION_COUNT_ELEMENTS" => "Y",
    "SECTION_TOP_DEPTH" => "6",
    "PAGE_ELEMENT_COUNT" => "24",
    "LINE_ELEMENT_COUNT" => "24",
    "CNT_VIEW_DEFAULT" => "24",
    "CNT_VIEW_SET" => array(
        0 => "24",
        1 => "48",
        2 => "72",
    ),
    "ELEMENT_SORT_FIELD" => isset($_REQUEST["by"]) ? $_REQUEST["by"] : "sort",
    "ELEMENT_SORT_ORDER" => $_REQUEST["order"]==="desc"?"desc":"asc",
    "ELEMENT_SORT_FIELD2" => "shows",
    "ELEMENT_SORT_ORDER2" => "desc",
    "OFFERS_SORT_FIELD" => "",
    "OFFERS_SORT_ORDER" => "",
    "OFFERS_SORT_FIELD2" => "",
    "OFFERS_SORT_ORDER2" => "",

    "INCLUDE_SUBSECTIONS" => "Y",

    "USE_BIG_DATA" => "N",
    "BIG_DATA_RCM_TYPE" => "any_similar",
    "LIST_PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons",
    "LIST_PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",
    "LIST_ENLARGE_PRODUCT" => "STRICT",

    "LIST_OFFERS_LIMIT" => "0",
    "SECTION_ID_VARIABLE" => "SECTION_ID",
    "DETAIL_CHECK_SECTION_ID_VARIABLE" => "N",
    "DETAIL_BACKGROUND_IMAGE" => "-",
    "SHOW_DEACTIVATED" => "N",

    "USE_STORE" => "N",
    "USE_ENHANCED_ECOMMERCE" => "N",

    "PAGER_TEMPLATE" => "show_more",
    "PAGER_TITLE" => "catalog",
    "DISPLAY_TOP_PAGER" => "N",
    "DISPLAY_BOTTOM_PAGER" => "Y",
    "PAGER_SHOW_ALWAYS" => "N",
    "PAGER_DESC_NUMBERING" => "N",
    "PAGER_DESC_NUMBERING_CACHE_TIME" => "10800",
    "PAGER_SHOW_ALL" => "N",
    "PAGER_BASE_LINK_ENABLE" => "N",
    "PAGER_BASE_LINK" => "",
    "PAGER_PARAMS_NAME" => "arrPager",

    "SET_STATUS_404" => "Y",
    "SHOW_404" => "Y",
    "MESSAGE_404" => "",
    "FILE_404" => "",

    "COMPATIBLE_MODE" => "Y",
    "USE_ELEMENT_COUNTER" => "Y",

    "COMPARE_NAME" => "CATALOG_COMPARE_LIST",
    "COMPARE_FIELD_CODE" => array(
        0 => "",
        1 => "",
    ),
    "COMPARE_PROPERTY_CODE" => array(
        0 => "",
        1 => "",

    ),
    "COMPARE_OFFERS_FIELD_CODE" => "",
    "COMPARE_OFFERS_PROPERTY_CODE" => "",
    "COMPARE_ELEMENT_SORT_FIELD" => "sort",
    "COMPARE_ELEMENT_SORT_ORDER" => "asc",

    "MAX_SHOW_FILTER_ELEMENTS" => "4",

    "FILTER_NAME" => "arrFilter",
    "PREFILTER_NAME" => "arrPreFilter",

    "SHOW_ALL_WO_SECTION" => "N",
    "USE_GIFTS_DETAIL" => "N",
    "USE_GIFTS_SECTION" => "N",
    "USE_GIFTS_MAIN_PR_SECTION_LIST" => "n",

    "STORES" => array(
        0 => "",
        1 => "",
    ),
    "USER_FIELDS" => array(
        0 => "",
        1 => "",
    ),

    "CURRENCY_ID" => "RUB",
    "PRICE_CODE" => ["REGULAR"],
    "FILTER_PRICE_CODE" => ["REGULAR"],

    "USE_MIN_AMOUNT" => "Y",
    "MIN_AMOUNT" => "10",
    "SHOW_GENERAL_STORE_INFORMATION" => "N",
    "DISABLE_INIT_JS_IN_COMPONENT" => "Y",

    "SEF_MODE" => "Y",
    "SEF_FOLDER" => "/",
    "SEF_URL_TEMPLATES" => array(
        "smart_filter" => "catalog/#SECTION_CODE_PATH#/filter/#SMART_FILTER_PATH#/apply/",
        "sections" => "catalog/",
        "section" => "catalog/#SECTION_CODE_PATH#/",
        "element" => "product/#ELEMENT_CODE#/",
        "compare" => "",
    )
];