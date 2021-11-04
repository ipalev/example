<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>
<div class="header__top-menu">
    <?php
    $APPLICATION->IncludeComponent(
        "bitrix:menu",
        "top_menu",
        [
            "ROOT_MENU_TYPE" => "top",
            "MAX_LEVEL" => "1",
            "MENU_CACHE_TYPE" => "A",
            "CACHE_SELECTED_ITEMS" => "N",
            "MENU_CACHE_TIME" => "3600000",
            "MENU_CACHE_USE_GROUPS" => "N",
            "MENU_CACHE_GET_VARS" => [],
        ],
        false
    );
    ?>
</div>