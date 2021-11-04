<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$catalogIblockId = \Its\Lib\Iblock::getInstance()->get('catalog', SITE_ID);

$arResult['OBZORI_SECTION_CODE'] = \Its\Lib\Utils::getSectionIdByCode('obzori');

//получаем ID разделов привязанных товаров для обзоров и считаем количество по разделам
$res = \CIBlockElement::GetList(
    [],
    [
        'IBLOCK_ID' => $arResult['ID'],
        'ACTIVE' => 'Y',
        'IBLOCK_SECTION_ID' => $arResult['OBZORI_SEC_CODE'],
        '!PROPERTY_PRODUCT' => false
    ],
    false,
    false,
    [ 'ID', 'IBLOCK_ID', 'PROPERTY_PRODUCT_SECTION']
);
$productSections = [];
$productSectionIds = [];
while($product = $res->GetNext()) {
    foreach ($product['PROPERTY_PRODUCT_SECTION_VALUE'] as $sectionId) {
        if (empty($productSections[$sectionId])) {
            $productSections[$sectionId] = ['COUNT_PRODUCT' => 1];
            $productSectionIds[] = $sectionId;
        } else {
            $productSections[$sectionId]['COUNT_PRODUCT'] += 1;
        }
    }
}

$res = \CIBlockSection::GetList(
    [],
    [
        'IBLOCK_ID' => $catalogIblockId,
        'ID' => $productSectionIds,
        'ACTIVE' => 'Y',
    ],
    false,
    [ 'ID', 'CODE', 'NAME' ],
    false
);
while ($arSect = $res->GetNext()) {
    $productSections[$arSect['ID']]['NAME'] = $arSect['NAME'];
    $productSections[$arSect['ID']]['CODE'] = $arSect['CODE'];
}

$size = count($productSections) <= 3 ? 1 : round(count($productSections)/3);
$arResult['PRODUCT_SECTIONS'] = array_chunk($productSections, $size);

$arResult['SECTIONS'] = Its\Lib\Utils::getActiveSection($arResult['ID']);

$arResult['DIV_MAP'] = [
    ['card', 'card', 'card', 'card', 'card card--big'],
    ['card card--big', 'card', 'card', 'card', 'card']
];

foreach ($arResult["ITEMS"] as &$arItem) {
    $arItem['ACTIVE_FROM'] = FormatDate('d F', MakeTimeStamp($arItem['ACTIVE_FROM']));
}
$arResult["ITEMS"] = array_chunk($arResult["ITEMS"], 5);

$this->__component->arResult['PAGEN_MANAGER'] = $arResult['PAGEN_MANAGER'] = new \Its\Lib\PagenManager($arParams['PAGER_TITLE']);
$this->__component->SetResultCacheKeys(['PAGEN_MANAGER']);
