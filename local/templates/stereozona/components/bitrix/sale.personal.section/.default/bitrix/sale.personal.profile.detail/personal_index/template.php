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

if(!$arResult['RES_MOD']['ADDRESS_VALUE']) {
    return;
} ?>
<div class="col-lg-6 profile__short-col">
    <h4 class="mb-15 mb-sm-25">Адрес</h4>
    <p><?=$arResult['RES_MOD']['ADDRESS_VALUE']?></p>
    <a class="profile__edit" href="<?=SITE_DIR.$arParams["PATH_TO_DETAIL"]?>">Редактировать</a>
</div>
