<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CAllMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 */

if (isset($arParams['RCM_TYPE']) && !empty($arParams['RCM_TYPE'])) {
    $navParams = ['NavPageCount' => 1, 'NavPageNomer' => 1, 'NavNum' => $this->randString()];

    if (!empty($arResult['NAV_RESULT'])) {
        $navParams = [
            'NavPageCount' => $arResult['NAV_RESULT']->NavPageCount,
            'NavPageNomer' => $arResult['NAV_RESULT']->NavPageNomer,
            'NavNum' => $arResult['NAV_RESULT']->NavNum
        ];
    }

    $templateLibrary = array('popup', 'ajax', 'fx');
    $currencyList = '';

    if (!empty($arResult['CURRENCIES'])) {
        $templateLibrary[] = 'currency';
        $currencyList = CUtil::PhpToJSObject($arResult['CURRENCIES'], false, true, true);
    }

    $templateData = [
        'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
        'TEMPLATE_LIBRARY' => $templateLibrary,
        'CURRENCIES' => $currencyList
    ];

    unset($currencyList, $templateLibrary);

    $obName = 'ob' . preg_replace('/[^a-zA-Z0-9_]/', 'x', $this->GetEditAreaId($navParams['NavNum']));
    $containerName = 'container-' . $arParams['DEFERRED_BLOCK_CODE'];

    $signer = new \Bitrix\Main\Security\Sign\Signer;
    $signedTemplate = $signer->sign($templateName, 'catalog.section');
    $signedParams = $signer->sign(base64_encode(serialize($arResult['ORIGINAL_PARAMETERS'])), 'catalog.section');
}

echo '<div data-entity="'.$containerName.'">';

$wrapper = $arParams['VIEW_PARAMS']['WRAPPER'] && $arParams['VIEW_PARAMS']['WRAPPER']['tag'];

if (!empty($arResult['ITEMS']) && !empty($arResult['ITEM_ROWS'])) {
    echo '<!-- items-container -->';

    foreach ($arResult['ITEM_ROWS'] as $rowData) {

        if($wrapper)
            printf(
                '<%s class="%s" %s data-entity="items-row">',
                $arParams['VIEW_PARAMS']['WRAPPER']['tag'],
                $arParams['VIEW_PARAMS']['WRAPPER']['class'],
                $arParams['VIEW_PARAMS']['WRAPPER']['attributes']
            );

        $rowItems = array_splice($arResult['ITEMS'], 0, $rowData['COUNT']);

        for ($i = 0; $i < count($rowItems); $i++) {

            $APPLICATION->IncludeComponent(
                'bitrix:catalog.item',
                'catalog',
                [
                    'RESULT' => $rowItems[$i],
                    'VIEW_PARAMS' => $arParams['VIEW_PARAMS']
                ],
                false
            );

        }

        if($wrapper)
            printf('</%s>', $arParams['VIEW_PARAMS']['WRAPPER']['tag']);

        if($arParams['DISPLAY_BOTTOM_PAGER'] == 'Y') {
            echo '<!-- pagination-container -->';

            echo $arResult['NAV_STRING'];

            echo '<!-- pagination-container -->';
        }
    }

    echo '<!-- items-container -->';

    unset($generalParams, $rowItems);
} else {
    // nothing as in default bitrix template
}

echo '</div>';

if( isset($arParams['RCM_TYPE']) && !empty($arParams['RCM_TYPE']) ) {?>
    <script>
        var <?=$obName?> = new JCCatalogSectionComponent({
            siteId: '<?=CUtil::JSEscape($component->getSiteId())?>',
            componentPath: '<?=CUtil::JSEscape($componentPath)?>',
            navParams: <?=CUtil::PhpToJSObject($navParams)?>,
            deferredLoad: true,
            initiallyShowHeader: '<?=!empty($arResult['ITEM_ROWS'])?>',
            bigData: <?=CUtil::PhpToJSObject($arResult['BIG_DATA'])?>,
            lazyLoad: !!'<?=$showLazyLoad?>',
            loadOnScroll: !!'<?=($arParams['LOAD_ON_SCROLL'] === 'Y')?>',
            template: '<?=CUtil::JSEscape($signedTemplate)?>',
            ajaxId: '<?=CUtil::JSEscape($arParams['AJAX_ID'])?>',
            parameters: '<?=CUtil::JSEscape($signedParams)?>',
            container: '<?=$containerName?>'
        });
    </script>
<?php }
