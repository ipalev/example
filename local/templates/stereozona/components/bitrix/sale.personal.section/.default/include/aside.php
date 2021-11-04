<?php

use Its\Lib\Utils;
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

/**
 * @var CAllUser $USER
 * @var CAllMain $APPLICATION
 * @var CBitrixComponent $component
 * @var array $arParams
 * @var array $arResult
 */
 
 ?>
<div class="profile__left">
    <div class="container-fluid">
        <div class="profile__left-wrapper">
            <div class="profile__left-top">
                <?php
                if($USER->IsAuthorized()) {
                    $fullName = $USER->GetFullName();
                    if($fullName) {
                        printf('<h2 class="profile__name">%s</h2>', $fullName);
                    }

                    $APPLICATION->IncludeComponent(
                        "bitrix:menu",
                        "personal",
                        [
                            "ROOT_MENU_TYPE" => "personal",
                            "MAX_LEVEL" => "1",
                            "MENU_CACHE_TYPE" => "A",
                            "CACHE_SELECTED_ITEMS" => "N",
                            "MENU_CACHE_TIME" => "3600",
                            "MENU_CACHE_USE_GROUPS" => "Y",
                            "MENU_CACHE_GET_VARS" => [],
                        ],
                        false
                    );
                }
                ?>
            </div>
            <div class="profile__left-bottom">
                <a class="profile__logout" href="<?=SITE_DIR?>?logout=yes">Выйти</a>
            </div>
        </div>
    </div>
</div>