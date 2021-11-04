<?php

/**
 * @var \Bitrix\Main\EventManager $emInstance
 */

use Its\EventHandler\Auth;
use Its\EventHandler\Iblock;
use Its\EventHandler\Sale;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

// iblock
$emInstance->addEventHandler('iblock', 'OnBeforeIBlockElementUpdate', [Iblock::class, 'beforeElementEdit']);
$emInstance->addEventHandler('iblock', 'OnBeforeIBlockElementAdd', [Iblock::class, 'beforeElementEdit']);

//при обмене с МС некторые поля товаров не обновляем, определенные товары деактивируем
$emInstance->addEventHandler('iblock', 'OnBeforeIBlockElementUpdate', [Iblock::class, 'beforeElementUpdateForMS']);
$emInstance->addEventHandler('iblock', 'OnBeforeIBlockElementAdd', [Iblock::class, 'beforeElementUpdateForMS']);

// при обмене с МС некторые поля разделов не обновляем
$emInstance->addEventHandler('iblock', 'OnBeforeIBlockSectionUpdate', [Iblock::class, 'beforeSectionUpdateForMS']);

// auth
$emInstance->addEventHandler('main', 'OnBeforeUserRegister', [Auth::class, 'beforeRegister']);

// replace login with mail
$emInstance->addEventHandler('main', 'OnBeforeUserLogin', [Auth::class, 'loginMailReplace']);

// sale delivery restrictions
$emInstance->addEventHandler(
    'sale',
    'onSaleDeliveryRestrictionsClassNamesBuildList',
    [Sale::class, 'onRestrictionsBuildList']
);

// sale Cancel Order and delete receipt from Evotor
$emInstance->addEventHandler('sale', 'OnSaleCancelOrder', [Sale::class, 'deleteReceiptFromEvotor']);

// Sale Pay Order and sending receipt in Evotor
$emInstance->addEventHandler('sale', 'OnSalePayOrder', [Sale::class, 'sendReceiptInEvotor']);

// SALE_NEW_ORDER добавим телефон пользователя
$emInstance->addEventHandler('main', 'OnBeforeEventAdd', [Sale::class,'OnBeforeEventAddHandler']);
