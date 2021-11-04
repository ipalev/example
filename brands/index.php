<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");?>

<main class="page-content" id="swup">
    <div class="container-fluid pr-xl-0">
        <div class="brands">
            <div class="brands__wrapper">
                <div class="pt-15 pb-15 pt-md-20 pb-md-10">
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
                    $brandIblockId = \Its\Lib\Iblock::getInstance()->get('brands', SITE_ID);
                    if ($brandIblockId !== null) {
                        $APPLICATION->IncludeComponent(
                            "bitrix:news.list",
                            "brands",
                            Array(
                                "DISPLAY_DATE" => "Y",
                                "DISPLAY_NAME" => "Y",
                                "DISPLAY_PICTURE" => "Y",
                                "DISPLAY_PREVIEW_TEXT" => "Y",
                                "AJAX_MODE" => "Y",
                                "IBLOCK_ID" => "$brandIblockId",
                                "NEWS_COUNT" => "200",
                                "SORT_BY1" => "name",
                                "SORT_ORDER1" => "ASC",
                                "SORT_BY2" => "SORT",
                                "SORT_ORDER2" => "ASC",
                                "FILTER_NAME" => "",
                                "FIELD_CODE" => Array("ID"),
                                "PROPERTY_CODE" => Array("COUNTRY"),
                                "CHECK_DATES" => "Y",
                                "DETAIL_URL" => "",
                                "PREVIEW_TRUNCATE_LEN" => "",
                                "ACTIVE_DATE_FORMAT" => "d.m.Y",
                                "SET_TITLE" => "Y",
                                "SET_BROWSER_TITLE" => "Y",
                                "SET_META_KEYWORDS" => "Y",
                                "SET_META_DESCRIPTION" => "Y",
                                "SET_LAST_MODIFIED" => "Y",
                                "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
                                "ADD_SECTIONS_CHAIN" => "Y",
                                "HIDE_LINK_WHEN_NO_DETAIL" => "Y",
                                "PARENT_SECTION" => "",
                                "PARENT_SECTION_CODE" => "",
                                "INCLUDE_SUBSECTIONS" => "Y",
                                "CACHE_TYPE" => "A",
                                "CACHE_TIME" => "3600",
                                "CACHE_FILTER" => "Y",
                                "CACHE_GROUPS" => "Y",
                                "DISPLAY_TOP_PAGER" => "Y",
                                "DISPLAY_BOTTOM_PAGER" => "Y",
                                "PAGER_TITLE" => "Новости",
                                "PAGER_SHOW_ALWAYS" => "Y",
                                "PAGER_TEMPLATE" => "",
                                "PAGER_DESC_NUMBERING" => "Y",
                                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                                "PAGER_SHOW_ALL" => "Y",
                                "PAGER_BASE_LINK_ENABLE" => "Y",
                                "SET_STATUS_404" => "Y",
                                "SHOW_404" => "Y",
                                "MESSAGE_404" => "",
                                "PAGER_BASE_LINK" => "",
                                "PAGER_PARAMS_NAME" => "arrPager",
                                "AJAX_OPTION_JUMP" => "N",
                                "AJAX_OPTION_STYLE" => "Y",
                                "AJAX_OPTION_HISTORY" => "N",
                                "AJAX_OPTION_ADDITIONAL" => ""
                            )
                        );
                    }
                ?>
            </div>
            <div class="brands__aside">
                <?php
                    $APPLICATION->ShowViewContent('first_brand_data');
                ?>
            </div>
        </div>
    </div>
</main>

<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");
