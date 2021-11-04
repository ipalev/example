<?

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

/** @var array $arParams */

$arResult['COUNTRY'] = \Its\Lib\Utils::getHLClass('Brandcountry')::getList(
    array(
        'select' => [
            'UF_NAME',
            'UF_FILE'
        ],
        'filter' => [
            'UF_XML_ID' => $arResult['PROPERTIES']['COUNTRY']['VALUE']
        ],
        'limit' => 1
    )
)->fetch();
$arResult['COUNTRY']['UF_FILE'] = \CFile::GetPath($arResult['COUNTRY']['UF_FILE']);

if (strpos($arResult['PROPERTIES']['BRAND_LINK']['VALUE'], 'https://') !== false) {
    $arResult['PROPERTIES']['BRAND_LINK']['HREF'] = $arResult['PROPERTIES']['BRAND_LINK']['VALUE'];
    $arResult['PROPERTIES']['BRAND_LINK']['VALUE'] = str_replace(
        'https://',
        '',
        $arResult['PROPERTIES']['BRAND_LINK']['VALUE']
    );
} elseif (strpos($arResult['PROPERTIES']['BRAND_LINK']['VALUE'], 'http://') !== false) {
    $arResult['PROPERTIES']['BRAND_LINK']['HREF'] = $arResult['PROPERTIES']['BRAND_LINK']['VALUE'];
    $arResult['PROPERTIES']['BRAND_LINK']['VALUE'] = str_replace(
        'http://',
        '',
        $arResult['PROPERTIES']['BRAND_LINK']['VALUE']
    );
} else {
    $arResult['PROPERTIES']['BRAND_LINK']['HREF'] = 'https://' . $arResult['PROPERTIES']['BRAND_LINK']['VALUE'];
}

//работа с метатегами

//запрос на мин. цену
$addDataForMeta = [
    "MIN_PRICE" => "",
    "COUNT" => "",
];
$catalogIblockId = \Its\Lib\Iblock::getInstance()->get('catalog');
$dbItems = \CIBlockElement::GetList(
    ['PRICE_1' => 'ASC'],
    ['IBLOCK_ID' => $catalogIblockId, 'PROPERTY_BREND' => $arResult["ID"], 'ACTIVE' => 'Y','>PRICE' => 0],
    false,
    ["nPageSize" => 1],
    ['ID', 'NAME', 'IBLOCK_ID', 'SORT', 'PROPERTY_BREND']
);
if ($item = $dbItems->fetch()) {
    if (intval($item["PRICE_1"]) > 0) {
        $addDataForMeta["MIN_PRICE"] = " от " . intval($item["PRICE_1"]) . " ₽";
    }
}

//запрос на кол-во товара
$dbItems = \CIBlockElement::GetList(
  ['ID' => 'ASC'],
  ['IBLOCK_ID' => $catalogIblockId, 'PROPERTY_BREND' => $arResult["ID"], 'ACTIVE' => 'Y'],
  false,
  ["nPageSize" => 1],
  ['ID', 'NAME', 'IBLOCK_ID', 'SORT', 'PROPERTY_BREND']
);
$dbItems->NavStart();
$allCount = $dbItems->NavRecordCount;
if ($allCount > 0) {
    $addDataForMeta["COUNT"] = " Более " . $allCount . " товаров в каталоге.";
}


if ($arResult["IPROPERTY_VALUES"]["ELEMENT_META_DESCRIPTION"] != "") {
    $arResult["IPROPERTY_VALUES"]["ELEMENT_META_DESCRIPTION"] = str_replace(
        array("[MIN_PRICE]", "[COUNT]"),
        array(
            $addDataForMeta["MIN_PRICE"],
            $addDataForMeta["COUNT"]
        ),
        $arResult["IPROPERTY_VALUES"]["ELEMENT_META_DESCRIPTION"]
    );
}
