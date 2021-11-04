<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-7 d-none d-lg-block">
                        <?php
                        CModule::IncludeModule("fileman");
                        CMedialib::Init();
                        $collection = \CMedialibCollection::GetList([
                            'arFilter' => [
                                'NAME' => 'about'
                            ]
                        ]);
                        if($id = current($collection)['ID']) {
                            $APPLICATION->IncludeComponent(
                                "its:media.list",
                                "about",
                                array(
                                    "COLLECTIONS" => array(
                                        0 => $id
                                    ),
                                    "CACHE_TYPE" => "A",
                                    "CACHE_TIME" => "3600",
                                ),
                                false
                            );
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
        $iblockId = \Its\Lib\Iblock::getInstance()->get('articles');
        if ($iblockId !== null) {
            $APPLICATION->IncludeComponent(
                "bitrix:news.list",
                "articles_bottom",
                Array(
                    "DISPLAY_DATE" => "N",
                    "DISPLAY_NAME" => "Y",
                    "DISPLAY_PICTURE" => "Y",
                    "DISPLAY_PREVIEW_TEXT" => "Y",
                    "AJAX_MODE" => "N",
                    "IBLOCK_ID" => $iblockId,
                    "NEWS_COUNT" => "4",
                    "SORT_BY1" => "shows",
                    "SORT_ORDER1" => "ASC",
                    "SORT_BY2" => "SORT",
                    "SORT_ORDER2" => "ASC",
                    "FILTER_NAME" => "",
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
                    'HEADER' => 'Статьи и обзоры'
                ),
                false,
                array(
                "ACTIVE_COMPONENT" => "N"
                )
            );
        }
        ?>
    </div>
</main>