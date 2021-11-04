<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Its\Lib\Sizes;

$arResult['RES_MOD']['IMAGES'] = [];

if(!empty($arResult['PROPERTIES']['GALLERY']['VALUE'])) {
    foreach($arResult['PROPERTIES']['GALLERY']['VALUE'] as $img) {
        $arResult['RES_MOD']['IMAGES'][] = [
            'PATH' => Sizes::resize($img, Sizes::CATALOG_ELEMENT),
            'PATH_THUMB' => Sizes::resize($img, Sizes::CATALOG_THUMB),
        ];
    }
}

if(empty($arResult['RES_MOD']['IMAGES'])) {
    $arResult['RES_MOD']['IMAGES'][] = [
        'PATH' => \Its\Lib\Constant::NOIMG_COMMON,
        'PATH_THUMB' => \Its\Lib\Constant::NOIMG_COMMON,
    ];
}

$excludedProperties = [
    'GALLERY', 'BREND',
];

$arResult['RES_MOD']['PROP_LIST'] = [];
foreach($arResult['DISPLAY_PROPERTIES'] as $property){

    if(in_array($property['CODE'], $excludedProperties)) continue;

    $multiple = $property['MULTIPLE'] == 'Y';
    $value = $property['VALUE'];

    switch($property['PROPERTY_TYPE']){
        case 'S':
            if($property['USER_TYPE'] == 'HTML') {
                $value = $multiple ? array_column($value, 'TEXT') : $value['TEXT'];
            }
            break;
    }

    $arResult['RES_MOD']['PROP_LIST'][$property['NAME']] = $value;
}

if (!empty($arResult['PROPERTIES']['BADGE']['VALUE'])) {
    $res = \Its\Lib\Utils::getHLClass('Badges')::getList(
        array(
            'select' => [
                'UF_XML_ID', 'UF_DESCRIPTION'
            ]
        )
    )->fetchAll();
    $arBadges = [];
    foreach ($res as $badge) {
        $arBadges[$badge['UF_XML_ID']] = $badge['UF_DESCRIPTION'];
    }
    $arResult['BADGES'] = [];
    foreach ($arResult['PROPERTIES']['BADGE']['VALUE'] as $badge) {
        $arResult['BADGES'][] = $arBadges[$badge];
    }
}

$res = CIBlockElement::GetByID($arResult['PROPERTIES']['BREND']['VALUE']);
$arResult['BRAND_INFO'] = $res->GetNext();
if (empty($arResult['BRAND_INFO']['PREVIEW_PICTURE'])) {
    $arResult['BRAND_INFO']['PREVIEW_PICTURE'] = $arResult['BRAND_INFO']['DETAIL_PICTURE'];
}
$arResult['BRAND_INFO']['PREVIEW_PICTURE'] = CFile::GetPath($arResult['BRAND_INFO']['PREVIEW_PICTURE']);

$deliveries = \Bitrix\Sale\Delivery\Services\Manager::getActiveList();
$arResult['DELIVERIES'] = [];
foreach ($deliveries as $delivery) {
    if ($delivery['VAT_ID'] !== null && $delivery['PARENT_ID'] == '0') {
        $posHint = strpos($delivery['DESCRIPTION'], '##HINT##');
        if ($posHint === false) {
            $arResult['DELIVERIES'][$delivery['NAME']] = $delivery['DESCRIPTION'];
        } else {
            $arResult['DELIVERIES'][$delivery['NAME']] = substr($delivery['DESCRIPTION'], $posHint + 8);
        }
    }
}