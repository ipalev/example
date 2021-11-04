<?php

/**
 * @var CMain $APPLICATION
 * @var CUser $USER
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 */

use \Bitrix\Main\Localization\Loc;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

foreach ($arResult["ERRORS"] as $key => $error) {
    if((int)$key === 0 && $key !== 0) {
        $arResult["ERRORS"][$key] = str_replace(
            "#FIELD_NAME#",
            "&quot;" . Loc::getMessage("REGISTER_FIELD_" . $key) . "&quot;",
            $error
        );
    }
}
