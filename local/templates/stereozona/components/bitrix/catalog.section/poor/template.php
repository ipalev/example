<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CAllMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 */

$wrapper = $arParams['VIEW_PARAMS']['WRAPPER'] && $arParams['VIEW_PARAMS']['WRAPPER']['tag'];

if($wrapper)
    printf(
        '<%s class="%s" %s>',
        $arParams['VIEW_PARAMS']['WRAPPER']['tag'],
        $arParams['VIEW_PARAMS']['WRAPPER']['class'],
        $arParams['VIEW_PARAMS']['WRAPPER']['attributes']
    );

foreach ($arResult['ITEMS'] as $arItem) {

    $APPLICATION->IncludeComponent(
        'bitrix:catalog.item',
        'catalog',
        [
            'RESULT' => $arItem,
            'VIEW_PARAMS' => $arParams['VIEW_PARAMS']
        ],
        false
    );
}

if($wrapper)
    printf('</%s>', $arParams['VIEW_PARAMS']['WRAPPER']['tag']);
