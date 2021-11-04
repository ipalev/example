<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) {
	die();
}

use Bitrix\Main\Context;
use Its\Lib\Modal\PersonalOrderModal;
use Its\Lib\Modal\Processor as ModalProcessor;

/**
 * @var CAllUser $USER
 * @var CAllMain $APPLICATION
 * @var CBitrixComponent $component
 * @var array $arParams
 * @var array $arResult
 */

$request = Context::getCurrent()->getRequest();

if ($request->getHeader('x-requested-with') !== 'load-and-replace') {
    include('orders.php');
}

ModalProcessor::getInstance()->addModal(
	(new PersonalOrderModal())->setOrderId((int)$arResult["VARIABLES"]["ID"])->setInstantOpen(true)
);