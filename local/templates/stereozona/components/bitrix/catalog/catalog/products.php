<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Application;
use Its\Config\ComponentInterface;

/**
 * @var CAllMain $APPLICATION
 * @var CBitrixComponent $component
 * @var array $arParams
 * @var array $arResult
 * @var array $sectionAddParameters
 * @var array $filterAddParameters
 *
 * @var ComponentInterface $cSection
 * @var ComponentInterface $cSmartFilter
 */

if($arParams['DISABLE_SECTIONS_PAGE'] && __CURRENT_PAGE__ === 'catalog_sections') {
    LocalRedirect(SITE_DIR);
}

if(!is_array($filterAddParameters)) {
    $filterAddParameters = [];
}
if(!is_array($sectionAddParameters)) {
    $sectionAddParameters = [];
}

if(__CURRENT_PAGE__ === 'catalog_section') {
    $filterAddParameters = array_merge($filterAddParameters, [
        'SECTION_ID' => $arResult['VARIABLES']['SECTION_ID'],
        'SHOW_ALL_WO_SECTION' => 'N'
    ]);

    $sectionAddParameters = array_merge($sectionAddParameters, [
        'SECTION_ID' => $arResult['VARIABLES']['SECTION_ID'],
        'SHOW_ALL_WO_SECTION' => 'N'
    ]);
}

$currentSortingParams = [];
$request = Application::getInstance()->getContext()->getRequest();
$xhrRequest = in_array($request->getHeader('x-requested-with'), ['deferredload', 'load-and-replace' ]);

foreach($arParams['child_components'] as $componentName => $componentConfig){
    $class = new ReflectionClass($componentConfig);
    if($class->implementsInterface(ComponentInterface::class)) {
        $$componentName = new $componentConfig($arParams['IBLOCK_TYPE'], $arParams['IBLOCK_ID'], $arParams, $arResult);
    }
}

if($cSection) {
    $cSection->addParameters($sectionAddParameters);
    $arSectionParameters = $cSection->getParameters();
}

if($cSmartFilter) {
    $cSmartFilter->addParameters($filterAddParameters);
    $arFilterParameters = $cSmartFilter->getParameters();

    $arSectionVars = Its\Lib\Utils::getVarsSection($arParams['IBLOCK_ID'], $arResult);
    $inheritedProperties = Its\Lib\Utils::getFinalSectionProperties(
        [
            'UF_QUICK_BAR_FILTERS',
        ],
        $arSectionVars['CHAIN']
    );

    if(!is_array($arFilterParameters['QUICK_FILTERS'])) $arFilterParameters['QUICK_FILTERS'] = [];
    if(!is_array($inheritedProperties['UF_QUICK_BAR_FILTERS'])) $inheritedProperties['UF_QUICK_BAR_FILTERS'] = [];

    if(!is_array($arFilterParameters['SKIP_PROPERTIES'])) $arFilterParameters['SKIP_PROPERTIES'] = [];

    $arFilterParameters['QUICK_FILTERS'] = array_merge(
        $inheritedProperties['UF_QUICK_BAR_FILTERS'],
        $arFilterParameters['QUICK_FILTERS']
    );
}

if (!$xhrRequest) {
    if(!$arParams['EXCLUDE_MAIN'])
        include('include/section/main_head.php');

    include('include/section/catalog_head.php');
} else {
    $APPLICATION->ShowViewContent('catalog_section: element_count');
}

if($cSmartFilter) {
    $APPLICATION->IncludeComponent(
        "bitrix:catalog.smart.filter",
        $xhrRequest ? 'null' : "catalog",
        $arFilterParameters,
        false
    );
}

if(!empty($currentSortingParams)) {
    $arSectionParameters['ELEMENT_SORT_FIELD'] = $currentSortingParams['HTML'];
    $arSectionParameters['ELEMENT_SORT_ORDER'] = $currentSortingParams['ORDER'];
}

if($cSection) {
    $intSectionID = $APPLICATION->IncludeComponent(
        "bitrix:catalog.section",
        "catalog-section",
        $arSectionParameters,
        false,
        array('HIDE_ICONS' => 'Y')
    );
    $GLOBALS['CATALOG_CURRENT_SECTION_ID'] = $intSectionID;
}

if (!$xhrRequest){
    include('include/section/catalog_tail.php');

    if(!$arParams['EXCLUDE_MAIN'])
        include('include/section/main_tail.php');
}
