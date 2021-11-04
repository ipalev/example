<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$arResult['SECTIONS'] = \Its\Lib\Utils::getActiveSection($arResult['ID']);

foreach ($arResult["ITEMS"] as &$arItem) {
    $arItem['ACTIVE_FROM'] = FormatDate('d F', MakeTimeStamp($arItem['ACTIVE_FROM']));
    $arItem['ACTIVE_TO'] = FormatDate('d F', MakeTimeStamp($arItem['ACTIVE_TO']));
}

$activePromo = \Bitrix\Iblock\Elements\ElementPromotionsTable::getList([
    'select' => ['ID', 'NAME', 'CODE', 'BRANDS_' => 'BRANDS'],
    'filter' => ['=ACTIVE' => 'Y'],
]);
$brandIds = [];
while ($promotion = $activePromo->fetch()) {
    if ($promotion['BRANDS_VALUE']) {
        $brandIds[] = (int) $promotion['BRANDS_VALUE'];
    }
}
$brandsIblickId = \Its\Lib\Iblock::getInstance()->get('brands');
if ($brandIds && $brandsIblickId !== null) {
    $brands = \Bitrix\Iblock\ElementTable::query()
        ->setSelect(['ID', 'NAME', 'CODE'])
        ->where('IBLOCK_ID', $brandsIblickId)
        ->whereIn('ID', $brandIds)
        ->fetchAll();
}
$arResult['BRANDS'] = [];
foreach ($brands as $brand) {
    $arResult['BRANDS'][] = [
        'ID' => $brand['ID'],
        'NAME' => $brand['NAME'],
        'CODE' => $brand['CODE']
    ];
}
$size = count($arResult['BRANDS']) <= 3 ? 1 : round(count($arResult['BRANDS'])/3);
$arResult['BRANDS'] = array_chunk($arResult['BRANDS'], $size);

$this->__component->arResult['PAGEN_MANAGER'] = $arResult['PAGEN_MANAGER'] = new \Its\Lib\PagenManager($arParams['PAGER_TITLE']);
$this->__component->SetResultCacheKeys(['PAGEN_MANAGER']);