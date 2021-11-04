<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/** @var array $arParams */
$arResult['BRANDS'] = [];
foreach($arResult["ITEMS"] as &$arItem) {
    $arResult['BRANDS'][strtoupper($arItem['NAME'][0])][] = [
        "NAME" => $arItem['NAME'],
        "LINK" => $arItem['DETAIL_PAGE_URL']
    ];
}

