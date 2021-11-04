<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$catalogIblockId = \Its\Lib\Iblock::getInstance()->get('catalog');
$request = Bitrix\Main\Application::getInstance()->getContext()->getRequest();
?>
<main class="page-content" id="swup">
    <div data-header-classlist="header--white header--border-bottom"></div>
    <div class="compare">
        <div class="compare__top">
            <div class="compare__top-left">
                <div class="container-fluid px-md-0">
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
                    <h1>Сравнение товаров</h1>
                    <?php
                        $APPLICATION->ShowViewContent('compare: select section & switch different');
                    ?>
                </div>
            </div>
            <div class="compare__top-items">
                <div class="container-fluid px-0">
                    <?php
                        $APPLICATION->ShowViewContent('compare: items');
                    ?>
                </div>
            </div>
        </div>
        <?php
        $APPLICATION->IncludeComponent (
            "bitrix:catalog.compare.result",
            "compare",
            Array(
                "AJAX_MODE" => "Y",
                "NAME" => "CATALOG_COMPARE_LIST",
                "IBLOCK_TYPE" => "catalog",
                "IBLOCK_ID" => $catalogIblockId,
                "FIELD_CODE" => [],
                "PROPERTY_CODE" => [],
                "OFFERS_FIELD_CODE" => [],
                "OFFERS_PROPERTY_CODE" => [],
                "ELEMENT_SORT_FIELD" => "sort",
                "ELEMENT_SORT_ORDER" => "asc",
                "DETAIL_URL" => "",
                "BASKET_URL" => "/personal/basket.php",
                "ACTION_VARIABLE" => "action",
                "PRODUCT_ID_VARIABLE" => "id",
                "SECTION_ID_VARIABLE" => "SECTION_ID",
                "PRICE_CODE" => [],
                "USE_PRICE_COUNT" => "Y",
                "SHOW_PRICE_COUNT" => "1",
                "PRICE_VAT_INCLUDE" => "Y",
                "DISPLAY_ELEMENT_SELECT_BOX" => "Y",
                "ELEMENT_SORT_FIELD_BOX" => "name",
                "ELEMENT_SORT_ORDER_BOX" => "asc",
                "ELEMENT_SORT_FIELD_BOX2" => "id",
                "ELEMENT_SORT_ORDER_BOX2" => "desc",
                "HIDE_NOT_AVAILABLE" => "N",
                "AJAX_OPTION_SHADOW" => "N",
                "AJAX_OPTION_JUMP" => "N",
                "AJAX_OPTION_STYLE" => "N",
                "AJAX_OPTION_HISTORY" => "N",
                "CONVERT_CURRENCY" => "Y",
                "CURRENCY_ID" => "RUB",
                "TEMPLATE_THEME" => "blue",
                'SECTION_ID' => $request['SECTION_ID'],
                'PAGE_ELEMENT_COUNT' => 4,
            )
        );?>
    </div>
</main>
<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");
