<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CAllMain $APPLICATION
 * @var CBitrixComponent $component
 * @var array $arParams
 * @var array $arResult
 */

$personalGroupId = current($arResult["JS_DATA"]["ORDER_PROP"]['groups'])['ID'];

$arResult['RES_MOD']['PERSONAL_PROPS'] = array_filter(
    $arResult["JS_DATA"]["ORDER_PROP"]['properties'], function($ar) use ($personalGroupId) {
        return $ar['PROPS_GROUP_ID'] === $personalGroupId && $ar['TYPE'] !== 'LOCATION';
    }
);

$arResult['RES_MOD']['HIDDEN_PROPS'] = array_filter(
    $arResult["JS_DATA"]["ORDER_PROP"]['properties'], function($ar) use ($personalGroupId) {
        return $ar['PROPS_GROUP_ID'] !== $personalGroupId && $ar['TYPE'] !== 'LOCATION';
    }
);

$arResult['RES_MOD']['ALL_PROPS'] = array_column($arResult["JS_DATA"]["ORDER_PROP"]['properties'], null, 'CODE');

$psDataClass = \Its\Lib\Utils::getHLClass('PaysystemData');

if($psDataClass) {
    $psData = $psDataClass::query()
        ->setSelect(['*'])
        ->whereNotNull('UF_IMAGE')
        ->fetchAll();

    $arResult['RES_MOD']['PS_DATA'] = array_column($psData, null, 'UF_PS_CODE');
}

//временно отключаем возможность оплаты на сайте, оставляем только оплату при получении
$arResult['PAY_SYSTEM'] = [];