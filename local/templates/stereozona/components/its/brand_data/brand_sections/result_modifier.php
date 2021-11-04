<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

foreach ($arResult['sections'] as &$arSection) {
    if (empty($arSection['PICTURE'])) {
        $arSection['PICTURE'] = CFile::GetPath($arSection['UF_BAR_ICON']);
    }
}
