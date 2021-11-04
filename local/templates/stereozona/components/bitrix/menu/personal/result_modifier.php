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
 
$items = $arResult;
$arResult = [];

$arResult['RES_MOD']['ITEMS'] = $items;
$arResult['RES_MOD']['SELECTED'] = current(
    array_filter(
        $arResult['RES_MOD']['ITEMS'],
        static function($item) {
            return (bool)$item['SELECTED'];
}));
