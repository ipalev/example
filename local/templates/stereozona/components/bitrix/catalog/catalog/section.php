<?php

if (!defined('__CURRENT_PAGE__')) {
    $rootFilter = isset($arResult['VARIABLES']['SMART_FILTER_PATH']) && !isset($arResult['VARIABLES']['SECTION_ID']) && !isset($arResult['VARIABLES']['SECTION_CODE']) && !isset($arResult['VARIABLES']['SECTION_CODE_PATH']);
    define('__CURRENT_PAGE__', $rootFilter ? 'catalog_sections' : 'catalog_section');
}

include('products.php');

//на странице фильтра метатеги зададим кодом.Чтобы отличить от мета разделов
$request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();
$uri = new \Bitrix\Main\Web\Uri($request->getRequestUri());
if ((strpos($uri, "/filter/") !== false) and (strpos($uri, "/apply/") !== false)) {
    $APPLICATION->SetPageProperty("title", "Каталог");
    $APPLICATION->SetPageProperty("description", "");
    $APPLICATION->SetPageProperty("keywords", "");
}
if (\Bitrix\Main\Loader::includeModule('sotbit.seometa')) {
    $APPLICATION->IncludeComponent(
        "sotbit:seo.meta",
        ".default",
        array(
            "FILTER_NAME" => $arParams["FILTER_NAME"],
            "SECTION_ID" => $arResult['VARIABLES']['SECTION_ID'],
            "CACHE_TYPE" => $arParams["CACHE_TYPE"],
            "CACHE_TIME" => $arParams["CACHE_TIME"],
        )
    );
}

