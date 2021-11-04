<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

$request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();
$brandCode = $request->get('brandcode');
$brandIlockId = \Its\Lib\Iblock::getInstance()->get('brands', SITE_ID);
if ($brandIlockId !== null) {
    $brandId = \CIBlockElement::GetList(
        [],
        ['CODE' => $brandCode, 'IBLOCK_ID' => $brandIlockId],
        false,
        false,
        ['ID']
    )->fetch();

    $APPLICATION->IncludeComponent(
        'its:brand_data',
        'brand_aside',
        [
            'IBLOCK_CODE' => 'catalog',
            'GET_SECTIONS' => 'Y',
            'BRAND' => $brandCode,
            'filter' => [
                '!IBLOCK_SECTION_ID' => false,
                'PROPERTY_BREND' => $brandId
            ],
        ]
    );
}

