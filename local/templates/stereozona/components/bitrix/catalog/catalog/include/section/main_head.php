<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CAllMain $APPLICATION
 * @var CBitrixComponent $component
 * @var array $arParams
 * @var array $arResult
 * @var array $currentSortingParams
 *
 * @var \Its\Config\ComponentInterface $cSectionList
 */

?>
<main class="page-content" id="swup">
    <div data-header-classlist="header--white"></div>
    <div class="catalog-page">
        <div class="catalog-page__top">
            <div class="container-fluid">
                <div class="pt-15 pb-5 pt-md-45 pb-md-10">
                    <?php $APPLICATION->IncludeComponent(
                        "bitrix:breadcrumb",
                        "main",
                        [
                            "START_FROM" => "0",
                            "PATH" => "",
                            "SITE_ID" => SITE_ID
                        ]
                    );?>
                </div>
                <h1><?$APPLICATION->ShowTitle(false)?></h1>
                <?
                if($cSectionList) {
                    $APPLICATION->IncludeComponent(
                        "bitrix:catalog.section.list",
                        "catalog-section",
                        $cSectionList->getParameters(),
                        $component,
                        array("HIDE_ICONS" => "Y")
                    );
                }
                ?>
            </div>
        </div>
