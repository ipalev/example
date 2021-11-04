<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

/**
 * @var CAllUser user
 * @var CAllMain $APPLICATION
 * @var CBitrixComponent $component
 * @var array $arParams
 * @var array $arResult
 */

foreach($arResult as $arItem) {
    $attributes = '';
    foreach ($arItem['PARAMS'] as $key => $param) {
        $attributes .= $key . '="' . $param . '" ';
    } ?>
    <a class="header__top-link" href="<?=$arItem['LINK']?>" <?=$attributes?>><?=$arItem['TEXT']?></a>
<?php
}