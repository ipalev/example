<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

/**
 * @var CAllMain $APPLICATION
 * @var CBitrixComponent $component
 * @var array $arParams
 * @var array $arResult
 */

$request = Bitrix\Main\Application::getInstance()->getContext()->getRequest();

if( $request->isAjaxRequest() ) {
    \Its\Lib\Store\ComponentDataTransfer::setStoreData('main_register_result', $arResult);
}