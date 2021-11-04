<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

if ($arResult["VARIABLES"]['BRAND']) {
    global $brandFilter;
    $brandIblockId = Its\Lib\Iblock::getInstance()->get('brands');
    if ($brandIblockId !== null) {
        $brandId = Its\Lib\Utils::getElementIdByCode($arResult["VARIABLES"]['BRAND'], $brandIblockId);
        $brandFilter = ['PROPERTY_BRANDS' => $brandId];
        $arParams["FILTER_NAME"] = 'brandFilter';
    }
}
include ('section.php');