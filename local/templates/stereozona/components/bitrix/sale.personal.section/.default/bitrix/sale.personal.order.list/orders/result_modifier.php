<?php

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) {
    die();
}

use Bitrix\Sale\Internals\ShipmentTable;
use Its\Lib\Sizes;

/**
 * @var array $arResult
 * @var array $order
 * @var array $status
 * @var string $orderTitle
 * @var bool $canceled
 */

$shipmentItemLink = [];
$basketItemMap = [];
$iblockElements = [];

foreach($arResult["ORDERS"] as &$order) {
    foreach($order['SHIPMENT'] as &$shipment) {
        $shipmentItemLink[$order['ORDER']['ID']][$shipment['DELIVERY_ID']] =& $shipment['PRODUCTS'];
    }

    foreach($order['BASKET_ITEMS'] as &$basketItem) {
        $iblockElements[$basketItem['PRODUCT_ID']]['PROPERTIES'] = [];
        $basketItem['PROPS'] =& $iblockElements[$basketItem['PRODUCT_ID']]['PROPERTIES'];
        $basketItemMap[$basketItem['ID']] = $basketItem;
    }
}

CIBlockElement::GetPropertyValuesArray(
    $iblockElements,
    \Its\Lib\Iblock::getInstance()->get('catalog'),
    ['ID' => array_keys($iblockElements)],
    ['CODE' => 'GALLERY']
);

foreach($basketItemMap as &$item) {
    if($image = current($item['PROPS']['GALLERY']['VALUE'])) {
        $item['PICTURE'] = Sizes::resize($image, Sizes::ORDER_THUMB);
    }
}
unset($item);

$userOrders = array_map(function($arOrder){
    return $arOrder['ORDER']['ID'];
}, $arResult["ORDERS"]);

if(!empty($userOrders)) {
    $myShipmentQuery = ShipmentTable::query()
        ->setSelect(['SHIPMENT_ITEM.*', 'ORDER_ID', 'DELIVERY_ID'])
        ->whereNot('SYSTEM')
        ->whereIn('ORDER_ID', $userOrders)->exec();

    while ($shipmentObject = $myShipmentQuery->fetchObject()) {
        $shipmentItem = $shipmentObject->getShipmentItem();
        $shipmentItemLink[$shipmentObject->getOrderId()][$shipmentObject->getDeliveryId()][$shipmentItem->getId()] = [
            'shipment_item' => $shipmentItem,
            'basket_item' => $basketItemMap[$shipmentItem->getBasketId()],
        ];
    }
}

unset($shipmentItemLink, $iblockElements, $basketItem, $shipment, $order);

$arResult["ARCHIVED_ORDERS"] = [];
foreach($arResult["ORDERS"] as $order) {
    if($order['ORDER']['STATUS_ID'] === 'F' || $order['ORDER']['CANCELED'] === 'Y') {
        $arResult["ARCHIVED_ORDERS"][$order['ORDER']['ID']] = $order;
    }
}
