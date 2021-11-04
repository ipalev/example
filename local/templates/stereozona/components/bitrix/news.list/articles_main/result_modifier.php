<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/** @var array $arParams */

$arResult['DIV_MAP'] = ['card', 'card', 'card', 'card', 'card--big'];
$arResult['OBZORI_SEC_CODE'] = CIBlockSection::GetList(
    [],
    ['CODE' => 'obzori'],
    false,
    ['ID']
)->GetNext()['ID'];
foreach ($arResult["ITEMS"] as &$arItem) {
    $arItem['ACTIVE_FROM'] = FormatDate('d F', MakeTimeStamp($arItem['ACTIVE_FROM']));
}