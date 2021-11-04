<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Grid\Declension;
use Its\Lib\Sizes;
use Its\Lib\Constant;

/**
 * @var CAllMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 */

$decl = new Declension('товар','товара','товаров');

$result['MUTATOR']['BASKET_COUNT'] = 0;
$result['MUTATOR']['BASKET_COUNT_TEXT'] = '0 '. $decl->get(0);

if(!empty($result['GRID']['ROWS'])) {

    foreach($result['GRID']['ROWS'] as $key => $arItem) {
        if ($arItem['DELAY'] == 'Y') continue;
        ++$result['MUTATOR']['BASKET_COUNT'];

        $img = Sizes::resize((int) $arItem['~PROPERTY_GALLERY_VALUE'], Sizes::CATALOG_ITEM);

        $result['MUTATOR']['REPLACE_FIELDS'][$key] = [
            '{id}' => $arItem['ID'],
            '{name}' => $arItem["NAME"],
            '{url}' => $arItem['DETAIL_PAGE_URL'],
            '{quantity}' => $arItem['QUANTITY'],
            '{product_id}' => $arItem['PRODUCT_ID'],
            '{picture}' => $img,
            '{use_float}' => $arParams["QUANTITY_FLOAT"] == 'Y' ? 'true' : 'false',
            '{ratio}' => isset($arItem["MEASURE_RATIO"]) ? $arItem["MEASURE_RATIO"] : 0,

            '{price}' => $arItem['PRICE'],
            '{price_f}' => $arItem['PRICE_FORMATED'],
            '{old_price}' => $arItem['FULL_PRICE'],
            '{old_price_f}' => $arItem['FULL_PRICE_FORMATED'],
            '{price_sum}' => $arItem['SUM_VALUE'],
            '{price_sum_f}' => $arItem['SUM'],
            '{old_price_sum}' => $arItem['SUM_FULL_PRICE'],
            '{old_price_sum_f}' => $arItem['SUM_FULL_PRICE_FORMATED'],

            '{old_price_style}' => $arItem['FULL_PRICE'] == $arItem['PRICE'] ? 'display: none' : '',
            '{add_price_classes}' => $arItem['FULL_PRICE'] == $arItem['PRICE'] ? '' : 'text-danger',

        ];

        $result['MUTATOR']['PRODUCT_FIELDS'][$arItem['PRODUCT_ID']] =[
            'basket_id' => $arItem['ID'],
            'name' => $arItem["NAME"],
            'url' => $arItem['DETAIL_PAGE_URL'],
            'quantity' => $arItem['QUANTITY'],
            'picture' => $img,
        ];
    }
    $result['MUTATOR']['BASKET_COUNT_TEXT'] = $result['MUTATOR']['BASKET_COUNT'].' '.$decl->get($result['MUTATOR']['BASKET_COUNT']);
}