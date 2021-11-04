<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$bannerIblockId = \Its\Lib\Iblock::getInstance()->get('banner_main', SITE_ID);
$whereShowProp = array_column(\Its\Lib\Utils::getEnumValues((int) $bannerIblockId, 'WHERE_SHOW'), null, 'XML_ID');
global $bannerCatalogFilter;
$bannerCatalogFilter = array("PROPERTY_WHERE_SHOW" => $whereShowProp['menu_catalog']['ID']);
?>
<div class="menu__catalog">
    <form class="search search--header js__searchline" action="<?=SITE_DIR?>search/" method="POST" id="search-header" onsubmit="searchToggle(); closeAllMenu();">
        <input class="search__input" type="text" name="searchline" placeholder="найти товар...">
        <button class="search__close" type="button" onclick="searchToggle()"></button>
    </form>
    <a class="menu__catalog-toggle" id="catalog-btn" href="#" data-no-swup onclick="catalogToggle(this)">Каталог</a>
    <div class="menu__catalog-content" id="catalog-menu" v-cloak>
        <div class="menu__catalog-bg"></div>
        <div class="menu__catalog-nav">
            <a class="menu__back" href="#" data-no-swup onclick="catalogToggle()">Каталог</a>
            <form class="search" action="#" method="POST">
                <input class="search__input" type="text" placeholder="поиск в разделе" v-model="search">
            </form>
            <div :class="['menu__catalog-section', { 'menu__catalog-section--hovered': i === activeCategory }]" v-for="(category, i) in filteredList" :key="category.path" @mouseover="onMouseover(i)">
                <template v-if="category.list &amp;&amp; category.list.length &gt; 0">
                    <a class="menu__catalog-section-btn" :href="category.path" data-no-swup @click.prevent="onSectionBtnClick">{{ category.name }}</a>
                    <div class="menu__catalog-section-content">
                        <div class="menu__catalog-section-nav">
                            <a class="menu__back" href="#" data-no-swup @click.prevent="onBackClick">{{ category.name }}</a>
                            <form class="search" action="#" method="POST">
                                <input class="search__input" type="text" placeholder="поиск в разделе" v-model="listSearch">
                            </form>
                            <a class="menu__catalog-link" data-no-swup v-for="(subcategory, i) in filterList(category.list, listSearch)" :key="subcategory.path" :href="subcategory.path" :style="{ transitionDelay: `${i*50}ms` }" onclick="closeAllMenu()">
                                {{ subcategory.name }}
                                <span class="menu__catalog-link-amount" v-if="subcategory.amount">{{ subcategory.amount }}</span>
                            </a>
                        </div>
                        <div class="menu__catalog-banners" v-if="category.banners &amp;&amp; category.banners.length &gt; 0">
                            <div class="menu__catalog-banner">
                                <a class="promo" data-no-swup :href="category.banners[0].url" :target="category.banners[0].url.startsWith('http') ? '_blank' : '_self'">
                                    <div class="promo__bg" :style="{ backgroundImage: `url(${category.banners[0].image})` }"></div>
                                    <div class="promo__content">
                                        <div class="text-white mb-10 h2">{{category.banners[0].title}}</div>
                                        <p class="mb-0 text-white">{{category.banners[0].text}}</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </template>
                <template v-else><a class="menu__catalog-section-btn" data-no-swup :href="category.path" onclick="closeAllMenu()">{{ category.name }}</a></template>
            </div>
        </div>
        <?if($bannerIblockId !== null) {
            $APPLICATION->IncludeComponent(
                "bitrix:news.list",
                "banner_menu_catalog",
                array(
                    "DISPLAY_DATE" => "N",
                    "DISPLAY_NAME" => "Y",
                    "DISPLAY_PICTURE" => "Y",
                    "DISPLAY_PREVIEW_TEXT" => "Y",
                    "AJAX_MODE" => "N",
                    "IBLOCK_TYPE" => 'baners',
                    "IBLOCK_ID" => $bannerIblockId,
                    "NEWS_COUNT" => "2",
                    "SORT_BY1" => "ACTIVE_FROM",
                    "SORT_ORDER1" => "DESC",
                    "SORT_BY2" => "SORT",
                    "SORT_ORDER2" => "ASC",
                    "FILTER_NAME" => "bannerCatalogFilter",
                    "FIELD_CODE" => array(
                        0 => "ID",
                    ),
                    "PROPERTY_CODE" => array(
                        0 => "DESCRIPTION",
                    ),
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
                    "INCLUDE_SUBSECTIONS" => "N",
                    "CACHE_TYPE" => "A",
                    "CACHE_TIME" => "3600",
                    "CACHE_FILTER" => "Y",
                    "CACHE_GROUPS" => "Y",
                    "DISPLAY_TOP_PAGER" => "N",
                    "DISPLAY_BOTTOM_PAGER" => "N",
                    "PAGER_TITLE" => "",
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
                ),
                false,
                array(
                    "ACTIVE_COMPONENT" => "Y"
                )
            );
        }?>
    </div>
</div>
