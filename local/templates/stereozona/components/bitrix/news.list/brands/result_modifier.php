<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/** @var array $arParams */
$arResult['BRANDS'] = [];
$arResult['COUNTRIES'] = [];
foreach($arResult["ITEMS"] as &$arItem) {
    $arResult['BRANDS'][strtoupper($arItem['NAME'][0])][] = [
        "ID" => $arItem['ID'],
        "CODE" => $arItem['CODE'],
        "NAME" => $arItem['NAME'],
        "LINK" => $arItem['DETAIL_PAGE_URL'],
        'COUNTRY_CODE' => $arItem['PROPERTIES']['COUNTRY']['VALUE']
    ];
    if (!empty($arItem['PROPERTIES']['COUNTRY']['VALUE'])) {
        $arResult['COUNTRIES'][] = $arItem['PROPERTIES']['COUNTRY']['VALUE'];
    }
}
$arResult['COUNTRIES'] = \Its\Lib\Utils::getHLClass('Brandcountry')::getList(
    array(
        'select' => [
            'UF_NAME', 'UF_XML_ID'
        ],
        'filter' => [
            'UF_XML_ID' => $arResult['COUNTRIES']
        ],
    )
)->fetchAll();
