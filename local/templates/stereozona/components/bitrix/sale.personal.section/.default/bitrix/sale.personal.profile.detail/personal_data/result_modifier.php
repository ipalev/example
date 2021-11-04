<?php

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) {
    die();
}
$properties = [];
$excludeProp = ['MIDDLE_NAME'];
foreach($arResult["ORDER_PROPS"] as $block) {
    foreach ($block["PROPS"] as $property) {
        if (!in_array($property['CODE'], $excludeProp)) {
            $properties[$property['CODE']] = $property;
        }
    }
}
$arResult["ORDER_PROPS"] = $properties;
$arResult["ERROR_MESSAGE"] = str_replace('Местоположение', 'Адрес доставки', $arResult["ERROR_MESSAGE"]);