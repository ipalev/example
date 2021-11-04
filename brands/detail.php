<?php

/**
 * @var array $APPLICATION
 */

use \Its\Lib\Utils;
use Its\Config\Catalog\Complex;
use Its\Config\Catalog\Section;
use Its\Config\Catalog\SmartFilter;

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

$iblock = \Its\Lib\Iblock::getInstance();
$request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();
$xhrRequest = in_array($request->getHeader('x-requested-with'), ['deferredload', 'load-and-replace' ]);

$urlVars = Utils::getUrlVariables();
$brandIblockId = $iblock->get('brands');

$brandCode = $urlVars && array_key_exists('brand', $urlVars) ? $urlVars['brand'] : null;
$brandId = $brandIblockId && $brandCode ? Utils::getElementIdByCode($urlVars['brand'], $brandIblockId) : null;

if(!$xhrRequest) {?>
    <main class="page-content" id="swup">
        <div class="brand">
            <div class="brand__top">
                <div class="container-fluid pr-lg-0">
                    <div class="row no-gutters">
                        <div class="col-lg-6">
                            <div class="brand__left">
                                <div class="pt-15 pb-10 pt-md-20 pb-md-15">
                                    <?php
                                    $APPLICATION->IncludeComponent(
                                        "bitrix:breadcrumb",
                                        "main",
                                        [
                                            "START_FROM" => "0",
                                            "PATH" => "",
                                            "SITE_ID" => SITE_ID
                                        ]
                                    );
                                    ?>
                                </div>
                                <?php
                                    $APPLICATION->ShowViewContent('brand_detail: name_detail_text');
                                ?>
                            </div>
                        </div>
                        <?php
                            $APPLICATION->ShowViewContent('brand_detail: detail_picture');
                        ?>
                    </div>
                    <div class="brand__section-list">
                        <?php
                        if($brandId) {
                            $APPLICATION->IncludeComponent(
                                'its:brand_data',
                                'brand_sections',
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
                        ?>
                    </div>
                </div>
            </div>
    <?php
}

        if($brandId) {
            $complex = new Complex('catalog', $iblock->get('catalog'));
            $complex->addParameters([
                'SHOW_ALL_WO_SECTION' => 'Y',
                "SET_STATUS_404" => "N",
                "SHOW_404" => "N",
                'SEF_FOLDER' => "/brands/$brandCode/",
                'SEF_URL_TEMPLATES' => [
                    "smart_filter" => "filter/#SMART_FILTER_PATH#/apply/",
                    "section" => "category/#SECTION_CODE#/",
                    "sections" => ""
                ],
                'EXCLUDE_MAIN' => true,
                'SKIP_PROPERTIES' => [
                    'BREND'
                ],

                'child_components' => [
                    'cSection' => Section::class,
                    'cSmartFilter' => SmartFilter::class,
                ]
            ]);

            $GLOBALS[$complex->getParameter('FILTER_NAME')] =
            $GLOBALS[$complex->getParameter('PREFILTER_NAME')] = [
                'PROPERTY_BREND' => $brandId
            ];

            $APPLICATION->IncludeComponent(
                'bitrix:catalog',
                'catalog',
                $complex->getParameters()
            );
        }

        if ($brandId && !$xhrRequest) {
            $APPLICATION->IncludeComponent(
                "bitrix:news.detail",
                "brand",
                array(
                    "DISPLAY_DATE" => "Y",
                    "DISPLAY_NAME" => "Y",
                    "DISPLAY_PICTURE" => "Y",
                    "DISPLAY_PREVIEW_TEXT" => "Y",
                    "USE_SHARE" => "Y",
                    "SHARE_HIDE" => "N",
                    "SHARE_TEMPLATE" => "",
                    "SHARE_HANDLERS" => array("delicious"),
                    "SHARE_SHORTEN_URL_LOGIN" => "",
                    "SHARE_SHORTEN_URL_KEY" => "",
                    "AJAX_MODE" => "Y",
                    "IBLOCK_ID" => $brandIblockId,
                    "ELEMENT_ID" => $brandId,
                    "CHECK_DATES" => "Y",
                    "FIELD_CODE" => array("ID", "PREVIEW_PICTURE"),
                    "PROPERTY_CODE" => array("BRAND_LINK", "BRAND_YEAR", "COUNTRY"),
                    "IBLOCK_URL" => "",
                    "DETAIL_URL" => "",
                    "SET_TITLE" => "Y",
                    "SET_CANONICAL_URL" => "Y",
                    "SET_BROWSER_TITLE" => "Y",
                    "BROWSER_TITLE" => "-",
                    "SET_META_KEYWORDS" => "Y",
                    "META_KEYWORDS" => "-",
                    "SET_META_DESCRIPTION" => "N",
                    "META_DESCRIPTION" => "-",
                    "SET_STATUS_404" => "Y",
                    "SET_LAST_MODIFIED" => "Y",
                    "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
                    "ADD_SECTIONS_CHAIN" => "N",
                    "ADD_ELEMENT_CHAIN" => "Y",
                    "ACTIVE_DATE_FORMAT" => "d.m.Y",
                    "USE_PERMISSIONS" => "N",
                    "GROUP_PERMISSIONS" => array("1"),
                    "CACHE_TYPE" => "A",
                    "CACHE_TIME" => "3600",
                    "CACHE_GROUPS" => "N",
                    "DISPLAY_TOP_PAGER" => "Y",
                    "DISPLAY_BOTTOM_PAGER" => "Y",
                    "PAGER_TITLE" => "",
                    "PAGER_TEMPLATE" => "",
                    "PAGER_SHOW_ALL" => "Y",
                    "PAGER_BASE_LINK_ENABLE" => "Y",
                    "SHOW_404" => "Y",
                    "MESSAGE_404" => "",
                    "STRICT_SECTION_CHECK" => "Y",
                    "PAGER_BASE_LINK" => "",
                    "PAGER_PARAMS_NAME" => "arrPager",
                    "AJAX_OPTION_JUMP" => "N",
                    "AJAX_OPTION_STYLE" => "N",
                    "AJAX_OPTION_HISTORY" => "N"
                )
            );
        }
        ?>
    </div>
</main>

<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");
