<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

use Its\Config\Catalog\Complex;
use Its\Config\Catalog\Section;
use Its\Config\Catalog\SectionList;
use Its\Config\Catalog\SmartFilter;

/** @var CAllMain $APPLICATION */

$APPLICATION->SetTitle('Каталог');
$iblock = \Its\Lib\Iblock::getInstance();

$complex = new Complex('catalog', $iblock->get('catalog'));
$complex->addParameters([
    "SEF_FOLDER" => "/",
    'SEF_URL_TEMPLATES' => [
        "smart_filter" => "catalog/#SECTION_CODE_PATH#/filter/#SMART_FILTER_PATH#/apply/",
        "sections" => "catalog/",
        "section" => "catalog/#SECTION_CODE_PATH#/",
        "element" => "product/#ELEMENT_CODE#/",
        "compare" => "",
    ],
    'EXCLUDE_MAIN' => false,
    'DISABLE_SECTIONS_PAGE' => true,

    'child_components' => [
        'cSection' => Section::class,
        'cSmartFilter' => SmartFilter::class,
        'cSectionList' => SectionList::class,
    ]
]);

$APPLICATION->IncludeComponent(
    'bitrix:catalog',
    'catalog',
    $complex->getParameters()
);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
