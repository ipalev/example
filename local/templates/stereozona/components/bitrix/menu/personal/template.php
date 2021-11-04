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

$selected = $arResult['RES_MOD']['SELECTED'];
 ?>
<div class="profile__menu">
    <?php if($selected) {?>
        <a class="profile__menu-link profile__menu-link--active" data-no-swup href="#"><?=$selected['TEXT']?></a>
    <?php }?>
    <div class="profile__menu-wrap">
        <?php foreach($arResult['RES_MOD']['ITEMS'] as $item) {
            if($item['LINK'] === $selected['LINK']) {
                continue;
            } ?>
            <a class="profile__menu-link" href="<?=$item['LINK']?>"><?=$item['TEXT']?></a>
        <?php }?>
    </div>
</div>
