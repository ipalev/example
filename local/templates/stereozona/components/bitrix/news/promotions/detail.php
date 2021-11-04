<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<main class="page-content" id="swup">
    <div class="article">
        <div class="article__top its-fade js-observe">
            <div class="container-fluid pr-lg-0">
                <div class="row no-gutters">
                    <div class="col-lg-6">
                        <div class="article__left">
                            <div class="article__left-top">
                                <div class="pt-15 pb-10 pt-md-30 pb-md-40">
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
                                <?php $APPLICATION->ShowViewContent('articles: name and date');?>
                            </div>
                            <?php $APPLICATION->ShowViewContent('articles: quote');?>
                        </div>
                    </div>
                    <?php $APPLICATION->ShowViewContent('articles: detail_picture');?>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="article__wrapper pt-25 pt-md-60 pt-md-80">
                <div class="row justify-content-between flex-lg-nowrap no-gutters">
                    <div class="article__aside article__aside--left">
                        <div class="article__sticky">
                            <div class="article__sticky-content">

                                <div class="socials socials--share">
                                    <a class="socials__item socials__item--email" href="mailto:"></a>
                                    <a class="socials__item socials__item--link js-copy" data-no-swup href="#"></a>
                                    <div class="likely socials__item socials__item--vk">
                                        <div class="vkontakte"></div>
                                    </div>
                                    <div class="likely socials__item socials__item--fb">
                                        <div class="facebook"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="article__center">
                        <?php
                        $APPLICATION->IncludeComponent(
                            "bitrix:news.detail",
                            "",
                            Array(
                                "DISPLAY_DATE" => $arParams["DISPLAY_DATE"],
                                "DISPLAY_NAME" => $arParams["DISPLAY_NAME"],
                                "DISPLAY_PICTURE" => $arParams["DISPLAY_PICTURE"],
                                "DISPLAY_PREVIEW_TEXT" => $arParams["DISPLAY_PREVIEW_TEXT"],
                                "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                                "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                                "FIELD_CODE" => $arParams["DETAIL_FIELD_CODE"],
                                "PROPERTY_CODE" => $arParams["DETAIL_PROPERTY_CODE"],
                                "DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"],
                                "SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
                                "META_KEYWORDS" => $arParams["META_KEYWORDS"],
                                "META_DESCRIPTION" => $arParams["META_DESCRIPTION"],
                                "BROWSER_TITLE" => $arParams["BROWSER_TITLE"],
                                "SET_CANONICAL_URL" => $arParams["DETAIL_SET_CANONICAL_URL"],
                                "DISPLAY_PANEL" => $arParams["DISPLAY_PANEL"],
                                "SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
                                "SET_TITLE" => $arParams["SET_TITLE"],
                                "MESSAGE_404" => $arParams["MESSAGE_404"],
                                "SET_STATUS_404" => $arParams["SET_STATUS_404"],
                                "SHOW_404" => $arParams["SHOW_404"],
                                "FILE_404" => $arParams["FILE_404"],
                                "INCLUDE_IBLOCK_INTO_CHAIN" => $arParams["INCLUDE_IBLOCK_INTO_CHAIN"],
                                "ADD_SECTIONS_CHAIN" => $arParams["ADD_SECTIONS_CHAIN"],
                                "ACTIVE_DATE_FORMAT" => $arParams["DETAIL_ACTIVE_DATE_FORMAT"],
                                "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                                "CACHE_TIME" => $arParams["CACHE_TIME"],
                                "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                                "USE_PERMISSIONS" => $arParams["USE_PERMISSIONS"],
                                "GROUP_PERMISSIONS" => $arParams["GROUP_PERMISSIONS"],
                                "DISPLAY_TOP_PAGER" => $arParams["DETAIL_DISPLAY_TOP_PAGER"],
                                "DISPLAY_BOTTOM_PAGER" => $arParams["DETAIL_DISPLAY_BOTTOM_PAGER"],
                                "PAGER_TITLE" => $arParams["DETAIL_PAGER_TITLE"],
                                "PAGER_SHOW_ALWAYS" => "N",
                                "PAGER_TEMPLATE" => $arParams["DETAIL_PAGER_TEMPLATE"],
                                "PAGER_SHOW_ALL" => $arParams["DETAIL_PAGER_SHOW_ALL"],
                                "CHECK_DATES" => $arParams["CHECK_DATES"],
                                "ELEMENT_ID" => $arResult["VARIABLES"]["ELEMENT_ID"],
                                "ELEMENT_CODE" => $arResult["VARIABLES"]["ELEMENT_CODE"],
                                "SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
                                "SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
                                "IBLOCK_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["news"],
                                "USE_SHARE" => $arParams["USE_SHARE"],
                                "SHARE_HIDE" => $arParams["SHARE_HIDE"],
                                "SHARE_TEMPLATE" => $arParams["SHARE_TEMPLATE"],
                                "SHARE_HANDLERS" => $arParams["SHARE_HANDLERS"],
                                "SHARE_SHORTEN_URL_LOGIN" => $arParams["SHARE_SHORTEN_URL_LOGIN"],
                                "SHARE_SHORTEN_URL_KEY" => $arParams["SHARE_SHORTEN_URL_KEY"],
                                "ADD_ELEMENT_CHAIN" => (isset($arParams["ADD_ELEMENT_CHAIN"]) ? $arParams["ADD_ELEMENT_CHAIN"] : ''),
                                'STRICT_SECTION_CHECK' => (isset($arParams['STRICT_SECTION_CHECK']) ? $arParams['STRICT_SECTION_CHECK'] : ''),
                            ),
                            $component
                        );
                        ?>
                    </div>
                    <?php
                    global $obzoriSection;
                    $obzoriSection = ['SECTION_CODE' => 'obzori'];
                    $APPLICATION->IncludeComponent(
                        "bitrix:news.list",
                        "popular_reviews",
                        Array(
                            "DISPLAY_DATE" => "N",
                            "DISPLAY_NAME" => "Y",
                            "DISPLAY_PICTURE" => "Y",
                            "DISPLAY_PREVIEW_TEXT" => "Y",
                            "AJAX_MODE" => "N",
                            "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                            "NEWS_COUNT" => "4",
                            "SORT_BY1" => "shows",
                            "SORT_ORDER1" => "ASC",
                            "SORT_BY2" => "SORT",
                            "SORT_ORDER2" => "ASC",
                            "FILTER_NAME" => "obzoriSection",
                            "FIELD_CODE" => Array(""),
                            "PROPERTY_CODE" => Array(""),
                            "CHECK_DATES" => "Y",
                            "DETAIL_URL" => "",
                            "PREVIEW_TRUNCATE_LEN" => "",
                            "ACTIVE_DATE_FORMAT" => "d.m.Y",
                            "SET_TITLE" => "N",
                            "SET_BROWSER_TITLE" => "N",
                            "SET_META_KEYWORDS" => "N",
                            "SET_META_DESCRIPTION" => "N",
                            "SET_LAST_MODIFIED" => "N",
                            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                            "ADD_SECTIONS_CHAIN" => "N",
                            "HIDE_LINK_WHEN_NO_DETAIL" => "Y",
                            "PARENT_SECTION" => "",
                            "PARENT_SECTION_CODE" => "",
                            "INCLUDE_SUBSECTIONS" => "Y",
                            "CACHE_TYPE" => "A",
                            "CACHE_TIME" => "3600",
                            "CACHE_FILTER" => "Y",
                            "CACHE_GROUPS" => "Y",
                            "DISPLAY_TOP_PAGER" => "N",
                            "DISPLAY_BOTTOM_PAGER" => "N",
                            "PAGER_TITLE" => "Новости",
                            "PAGER_SHOW_ALWAYS" => "N",
                            "PAGER_TEMPLATE" => "",
                            "PAGER_DESC_NUMBERING" => "N",
                            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                            "PAGER_SHOW_ALL" => "N",
                            "PAGER_BASE_LINK_ENABLE" => "N",
                            "SET_STATUS_404" => "N",
                            "SHOW_404" => "N",
                            "MESSAGE_404" => "",
                            "PAGER_BASE_LINK" => "",
                            "PAGER_PARAMS_NAME" => "arrPager",
                            "AJAX_OPTION_JUMP" => "N",
                            "AJAX_OPTION_STYLE" => "N",
                            "AJAX_OPTION_HISTORY" => "N",
                            "AJAX_OPTION_ADDITIONAL" => ""
                        )
                    );
                    ?>
                </div>
            </div>
        </div>
        <?php
        global $newsFilter;
        $newsFilter = [
            '!SECTION_CODE' => 'obzori',
            '!CODE' => $arResult["VARIABLES"]["ELEMENT_CODE"]
        ];
        $APPLICATION->IncludeComponent(
            "bitrix:news.list",
            "articles_bottom",
            Array(
                "DISPLAY_DATE" => "N",
                "DISPLAY_NAME" => "Y",
                "DISPLAY_PICTURE" => "Y",
                "DISPLAY_PREVIEW_TEXT" => "Y",
                "AJAX_MODE" => "N",
                "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                "NEWS_COUNT" => "4",
                "SORT_BY1" => "shows",
                "SORT_ORDER1" => "ASC",
                "SORT_BY2" => "SORT",
                "SORT_ORDER2" => "ASC",
                "FILTER_NAME" => "newsFilter",
                "FIELD_CODE" => Array(""),
                "PROPERTY_CODE" => Array(""),
                "CHECK_DATES" => "Y",
                "DETAIL_URL" => "",
                "PREVIEW_TRUNCATE_LEN" => "",
                "ACTIVE_DATE_FORMAT" => "d.m.Y",
                "SET_TITLE" => "N",
                "SET_BROWSER_TITLE" => "N",
                "SET_META_KEYWORDS" => "N",
                "SET_META_DESCRIPTION" => "N",
                "SET_LAST_MODIFIED" => "N",
                "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                "ADD_SECTIONS_CHAIN" => "N",
                "HIDE_LINK_WHEN_NO_DETAIL" => "Y",
                "PARENT_SECTION" => "",
                "PARENT_SECTION_CODE" => "",
                "INCLUDE_SUBSECTIONS" => "Y",
                "CACHE_TYPE" => "A",
                "CACHE_TIME" => "3600",
                "CACHE_FILTER" => "Y",
                "CACHE_GROUPS" => "Y",
                "DISPLAY_TOP_PAGER" => "N",
                "DISPLAY_BOTTOM_PAGER" => "N",
                "PAGER_TITLE" => "Новости",
                "PAGER_SHOW_ALWAYS" => "N",
                "PAGER_TEMPLATE" => "",
                "PAGER_DESC_NUMBERING" => "N",
                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                "PAGER_SHOW_ALL" => "N",
                "PAGER_BASE_LINK_ENABLE" => "N",
                "SET_STATUS_404" => "N",
                "SHOW_404" => "N",
                "MESSAGE_404" => "",
                "PAGER_BASE_LINK" => "",
                "PAGER_PARAMS_NAME" => "arrPager",
                "AJAX_OPTION_JUMP" => "N",
                "AJAX_OPTION_STYLE" => "N",
                "AJAX_OPTION_HISTORY" => "N",
                "AJAX_OPTION_ADDITIONAL" => "",
                // castom parameter
                'HEADER' => 'Читать далее'
            )
        );
        ?>
    </div>
</main>