<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CAllMain $APPLICATION
 * @var CBitrixComponent $component
 * @var array $arParams
 * @var array $arResult
 * @var array $currentSortingParams
 */

?>
<div id="vuex-script" data-src="https://unpkg.com/vuex@3.5.1/dist/vuex.js"></div>
<div class="catalog" id="catalog">
    <div class="container-fluid">
        <div class="catalog__wrapper">
            <div class="catalog__wrapper-header">
                <a class="catalog__wrapper-header-text catalog__filters-all"
                   href="#"
                   data-fancybox
                   data-no-swup
                   data-src="#modalFilters"
                   data-touch="false"
                   data-modal="true"
                   data-base-class="fancybox--modal-filters"
                >
                    Все фильтры
                </a>
                <?php
                $APPLICATION->ShowViewContent('catalog_section: element_count');

                $currentSortingParams = $APPLICATION->IncludeComponent(
                    "its:catalog.sorting",
                    "catalog",
                    array(
                        "IBLOCK_ID" => "1",
                        "SECTION_ID" => "",
                        "PRICE_INCLUDE" => "Y",
                        "PRICE_ID" => "1",
                        "SORT_COOKIENAME" => "main_catalog_personal_sort",
                        "DEFAULT_SORT_ORDER" => "ASC",
                        "PROPERTY_FIELDS" => array(
                            0 => "CODE",
                            1 => "ID",
                            2 => "NAME",
                        ),
                        "ADDITIONAL_FIELDS" => array(
                            0 => "created",
                            1 => "shows",
                        ),
                        "SHOW_PROPERTIES" => false,
                        "CACHE_TYPE" => "A",
                        "CACHE_TIME" => "3600",
                        "COMPOSITE_FRAME_MODE" => "N",
                        "COMPOSITE_FRAME_TYPE" => "AUTO",
                        "COMPONENT_TEMPLATE" => "catalog"
                    ),
                    false
                );?>
            </div>
            <div class="catalog__content">