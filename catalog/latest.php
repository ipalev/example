<?php

use Its\Config\Catalog\Complex;
use Its\Config\Catalog\Section;
use Its\Config\Catalog\SmartFilter;

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

/** @var CAllMain $APPLICATION */

$APPLICATION->SetTitle('Новинки');
$iblock = \Its\Lib\Iblock::getInstance();

$complex = new Complex('catalog', $iblock->get('catalog'));

$complex->addParameters([
    "SEF_FOLDER" => "/",
    'SHOW_ALL_WO_SECTION' => 'Y',
    'SEF_URL_TEMPLATES' => [
        "smart_filter" => "catalog-latest/filter/#SMART_FILTER_PATH#/apply/",
        "sections" => "catalog-latest/",
        "section" => "catalog-latest/#SECTION_CODE_PATH#/",
        "element" => "product/#ELEMENT_CODE#/",
        "compare" => "",
    ],
    'EXCLUDE_MAIN' => false,
    'DISABLE_SECTIONS_PAGE' => false,
    'QUICK_FILTERS' => [
        'BREND'
    ],
    'child_components' => [
        'cSection' => Section::class,
        'cSmartFilter' => SmartFilter::class,
    ]
]);

$GLOBALS[$complex->getParameter('FILTER_NAME')] =
$GLOBALS[$complex->getParameter('PREFILTER_NAME')] = [
    'PROPERTY_NEW_PRODUCT_VALUE' => 'Y'
];

$APPLICATION->IncludeComponent(
    'bitrix:catalog',
    'catalog',
    $complex->getParameters()
);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
