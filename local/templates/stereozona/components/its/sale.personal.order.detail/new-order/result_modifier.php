<?php use Bitrix\Sale\Internals\OrderPropsGroupTable;
use Its\Lib\Constant;
use Its\Lib\Sizes;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CAllMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 */

$arResult['RES_MOD']['ITEMS'] = [];

if(!empty($arResult['BASKET'])) {
    foreach($arResult['BASKET'] as $item) {
        $arResult['RES_MOD']['ITEMS'][$item['PRODUCT_ID']] = $item;

        if(is_array($item['PROPERTY_GALLERY_VALUE'])) {
            foreach($item['PROPERTY_GALLERY_VALUE'] as $img) {
                $arResult['RES_MOD']['ITEMS'][$item['PRODUCT_ID']]['IMAGE'] = [
                    'PATH' => Sizes::resize($img, Sizes::CATALOG_ELEMENT),
                    'PATH_THUMB' => Sizes::resize($img, Sizes::CATALOG_THUMB),
                ];

                break;
            }
        }

        if(empty($arResult['RES_MOD']['ITEMS'][$item['PRODUCT_ID']]['IMAGE'])) {
            $arResult['RES_MOD']['ITEMS'][$item['PRODUCT_ID']]['IMAGE'] = [
                'PATH' => Constant::NOIMG_COMMON,
                'PATH_THUMB' => Constant::NOIMG_COMMON,
            ];
        }
    }
}

$personalGroupId = OrderPropsGroupTable::query()
    ->setSelect(['ID'])
    ->setLimit(1)
    ->setOrder(['SORT' => "ASC"])
    ->fetch()['ID'];

$arResult['RES_MOD']['PERSONAL_PROPS'] = array_filter(
    $arResult['ORDER_PROPS'],
    function($ar) use ($personalGroupId) {return $ar['PROPS_GROUP_ID'] == $personalGroupId;}
);

$arResult['RES_MOD']['ORDER_PROPS'] = array_column($arResult['ORDER_PROPS'], null, 'CODE');

$storeId = current($arResult['DELIVERY']['STORE']);
if ($storeId) {
    $addressStore = \Bitrix\Catalog\StoreTable::query()
        ->setSelect(['ADDRESS'])
        ->whereIn('ID', $storeId)
        ->fetch()['ADDRESS'];
    $arResult['PICK-UP_ADDRESS'] = $addressStore;
}
