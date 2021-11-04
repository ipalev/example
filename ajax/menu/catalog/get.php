<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');


define("NO_KEEP_STATISTIC", true);

use Bitrix\Main\Context;

\Bitrix\Main\Loader::includeModule('iblock');

$status = [
    'success' => false,
    'data' => [],
    'msg' => '',
];

$obCache = new CPHPCache();
$iblockId = \Its\Lib\Iblock::getInstance()->get('catalog');
$bannerIblockId = \Its\Lib\Iblock::getInstance()->get('banner_main');
$whereShowProp = array_column(\Its\Lib\Utils::getEnumValues((int) $bannerIblockId, 'WHERE_SHOW'), null, 'XML_ID');
$cachePath = '/its/iblock/catalog_menu/';
$arBanners = [];
if ($whereShowProp !== null && array_key_exists('menu_catalog', $whereShowProp)) {
    $res = CIBlockElement::GetList(
        [],
        ["IBLOCK_ID" => $bannerIblockId, "PROPERTY_WHERE_SHOW" => $whereShowProp['menu_catalog']['ID'], "ACTIVE"=>"Y"],
        false,
        false,
        ["ID", "IBLOCK_ID", "NAME", "PREVIEW_PICTURE", "PREVIEW_TEXT", "PROPERTY_DISPLAY_SECTIONS", "PROPERTY_LINK"]
    );

    while($ob = $res->GetNextElement())
    {
        $arBanners[] = $ob->GetFields();
    }
}

$data = [];
if ($obCache->InitCache(86400, serialize([$iblockId]), $cachePath)) {
    $data = $obCache->GetVars();
} elseif ($obCache->StartDataCache()) {

    if (defined("BX_COMP_MANAGED_CACHE")) {
        global $CACHE_MANAGER;
        $CACHE_MANAGER->StartTagCache($cachePath);
        $CACHE_MANAGER->RegisterTag("iblock_id_" . $iblockId);
    }

    $arSections = [];
    $rsSections = CIBlockSection::GetList(
        [],
        [
            'ACTIVE' => 'Y',
            'GLOBAL_ACTIVE' => 'Y',
            'IBLOCK_ID' => $iblockId,
            'ELEMENT_SUBSECTIONS' => 'Y',
            'CNT_ACTIVE' => 'Y'
        ],
        true,
        [
            'NAME', 'SORT', 'ELEMENT_CNT', 'SECTION_PAGE_URL', 'ID', 'IBLOCK_SECTION_ID'
        ]
    );

    while($arSection = $rsSections->GetNext()) {
        $arSections[] = $arSection;
    }

    $arSectionsTree = [];
    $sectionLinc = [];
    $sectionLinc[0] = &$arSectionsTree;

    foreach ($arSections as $arSection) {
        $sectionLinc[intval($arSection['IBLOCK_SECTION_ID'])]['CHILD'][$arSection['ID']] = $arSection;
        $sectionLinc[$arSection['ID']] = &$sectionLinc[intval($arSection['IBLOCK_SECTION_ID'])]['CHILD'][$arSection['ID']];
    }

    foreach($sectionLinc as $section) {
        foreach($section['CHILD'] as $sectionChild) {
            if($sectionChild['ELEMENT_CNT'] <= 0) continue;

            $menuItem = [
                "name" => $sectionChild['~NAME'],
                "path" => $sectionChild['SECTION_PAGE_URL'],
                "sort" => $sectionChild['SORT'],
                "amount" => $sectionChild['ELEMENT_CNT'],
                "banners" => [],
            ];
            if($section['SECTION_PAGE_URL']) {
                $menuItem["parentPath"] = $section['SECTION_PAGE_URL'];
            } else {
                foreach ($arBanners as $arBanner) {
                    if (in_array($sectionChild['ID'], $arBanner['PROPERTY_DISPLAY_SECTIONS_VALUE'])) {
                        $menuItem["banners"][] = [
                            "url" => $arBanner['PROPERTY_LINK_VALUE'],
                            "image" => CFile::GetPath($arBanner['PREVIEW_PICTURE']),
                            "title" => $arBanner['NAME'],
                            "text" => $arBanner['PREVIEW_TEXT']
                        ];
                    }
                }
            }

            $data[] = $menuItem;
        }
    }

    unset($sectionLinc);

    usort($data, function ($a, $b) {
        if($a['sort'] == $b['sort']) return 0;
        return ($a['sort'] < $b['sort']) ? -1 : 1;
    });

    if(defined("BX_COMP_MANAGED_CACHE"))
    {
        $CACHE_MANAGER->EndTagCache();
    }

    $obCache->EndDataCache($data);
}

$status['data'] = $data;

$status['success'] = true;

if(empty($status['data'])) $status['msg'] = 'Не удалось найти ни одного элемента';

if (!$status['success'] && empty($status['msg'])) $status['msg'] = 'Неизвестная ошибка';

header('Content-Type: application/json');

echo json_encode($status);
