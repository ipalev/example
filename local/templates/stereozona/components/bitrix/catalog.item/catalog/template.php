<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Its\Lib\Sizes;

/**
 * @var array $arResult
 * @var array $arParams
 */

?>
<div class="item <?=$arParams['VIEW_PARAMS']['ADD_CLASS']?>" data-product-id="<?=$arResult['ID']?>">
    <div class="catalog-compare__overflow"></div>
    <div class="catalog-compare__dropdown">
        <a class="catalog-compare__item-option" href="/catalog/compare/">
            Перейти к сравнению
        </a>
        <a class="catalog-compare__item-option catalog-compare__item-option--remove js__compare--remove" data-no-swup href="#" data-product-id="<?=$arResult['ID']?>">
            Удалить
        </a>
    </div>
    <div class="item__controls-wrapper">
        <a
            class="item__control item__control-compare js__compare"
            data-no-swup
            data-product-id="<?=$arResult['ID']?>"
            data-is-goal="click"
            data-base-goal-name="sravn_click"
        >
            <img src="/assets/img/icon-items.svg" alt>
            <span class="item__compare-status"></span>
        </a>
        <a
           class="item__control item__control-favorite"
           data-no-swup
           data-product-id="<?=$arResult['ID']?>"
           data-is-goal="click"
           data-base-goal-name="izbran_click"
        >
            <img class="fav-img" src="/assets/img/icon-fav.svg" alt>
            <img class="fav-img--active" src="/assets/img/icon-fav-active.svg" alt>
        </a>
    </div>
    <a class="item__content" href="<?= $arResult['DETAIL_PAGE_URL']?>">
        <p class="item__title"><?= $arResult['NAME']?></p>
        <?php
        if($img = current($arResult['PROPERTIES']['GALLERY']['VALUE'])) {?>
            <div class="item__picture">
                <img src="<?=Sizes::resize($img, Sizes::CATALOG_ITEM)?>" alt="<?=$arResult['NAME']?>">
            </div>
        <?}

        if (!$arResult['PRICE_MISSING']) {
            foreach($arResult['ITEM_PRICES'] as $itemPrice) {
                printf('<div class="item__price">%s</div>', $itemPrice['PRINT_PRICE']);
            }
        }?>
    </a>
    <?php if (!$arResult['PRICE_MISSING']) :?>
        <a class="item__plus js__product-action"
           data-product="<?=$arResult['ID']?>"
           data-action="increase"
           data-no-swup
           data-is-goal="click"
           data-base-goal-name="korzina"
           href="#"
        ></a>
    <?php endif?>
</div>