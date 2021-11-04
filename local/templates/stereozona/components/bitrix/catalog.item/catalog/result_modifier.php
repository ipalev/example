<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/** @var array $arParams */
/** @var array $arResult */

$arResult['PRICE_MISSING'] = true;
foreach($arResult['ITEM_PRICES'] as $itemPrice) {
    if ($itemPrice['BASE_PRICE'] > 0) {
        $arResult['PRICE_MISSING'] = false;
        break;
    }
}