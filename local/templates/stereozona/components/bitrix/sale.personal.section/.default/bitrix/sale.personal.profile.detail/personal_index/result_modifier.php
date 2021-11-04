<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

/**
 * @var CAllUser user
 * @var CAllMain $APPLICATION
 * @var CBitrixComponent $component
 * @var array $arParams
 * @var array $arResult
 */

$arResult['RES_MOD']['ADDRESS_PROPERTY'] = null;
$arResult['RES_MOD']['ADDRESS_VALUES'] = null;

$propertyGroup = current($arResult["ORDER_PROPS"]);

$properties = $propertyGroup ? $propertyGroup['PROPS'] : null;

if($properties) {
    $arResult['RES_MOD']['ADDRESS_PROPERTY'] = current(
        array_filter($properties, function ($prop) {
            return $prop['CODE'] === 'DELIVERY_ADDR';
        })
    );
}

if($arResult['RES_MOD']['ADDRESS_PROPERTY']) {
    $addrValueCode = 'ORDER_PROP_' . $arResult['RES_MOD']['ADDRESS_PROPERTY']['ID'];
    $arResult['RES_MOD']['ADDRESS_VALUE'] = $arResult["ORDER_PROPS_VALUES"][$addrValueCode] ?? null;
}
