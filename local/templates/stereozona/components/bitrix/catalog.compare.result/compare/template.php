<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
?>

<?php
    $this->SetViewTarget('compare: items');
?>
<div class="compare__items-row">
    <?php foreach ($arResult['ITEMS'] as $arItem) :?>
        <div class="item item--compare">
            <div class="item__controls-wrapper">
                <a class="item__remove" data-no-swup href="<?=$arItem['~DELETE_URL']?>"></a>
            </div>
            <a class="item__content" href="<?=$arItem['DETAIL_PAGE_URL']?>">
                <p class="item__title"><?=$arItem['NAME']?></p>
                <div class="item__picture">
                    <img src="<?=$arItem['PICTURE_SRC']?>" alt>
                </div>
                <div class="item__price"><?=$arItem['PRICE']?></div>
            </a>
            <a
                class="item__plus js__product-action"
                data-product="<?=$arItem['ID']?>"
                data-action="increase"
                data-no-swup
                href="#"
            ></a>
        </div>
    <?php endforeach?>
</div>
<?php
    $this->EndViewTarget();
?>

<?php
    $this->SetViewTarget('compare: select section & switch different');
?>
<div class="select">
    <select
        class="select__input"
        data-placeholder="<?=$arResult['SECTIONS'][$arParams['SECTION_ID']]['NAME'] ? $arResult['SECTIONS'][$arParams['SECTION_ID']]['NAME'] : ''?>"
    >
        <option value="0">Без раздела</option>
        <?php foreach ($arResult['SECTIONS'] as $section) :?>
            <option
                value="<?=$section['ID']?>"
                <?=$arParams['SECTION_ID'] == $section['ID'] ? 'selected' : ''?>
            >
                <?=$section['NAME']?>
            </option>
        <?php endforeach?>
    </select>
</div>
<div class="switch">
    <div class="custom-control custom-checkbox">
        <input class="custom-control-input" id="switch1" type="checkbox" <?=$arResult['DIFFERENT'] ? 'checked' : ''?>>
        <label class="custom-control-label" for="switch1">
            <a href="<?=$arResult['COMPARE_URL_TEMPLATE'].'DIFFERENT=N'?>" class="switch__item">Все параметры</a>
            <a href="<?=$arResult['COMPARE_URL_TEMPLATE'].'DIFFERENT=Y'?>" class="switch__item">Только различия</a>
        </label>
    </div>
</div>
<?php
    $this->EndViewTarget();
?>

<div class="compare__specs">
    <div class="compare__specs-left">
        <?php foreach ($arResult['ALL_PROPERTIES'] as $arProperty) :?>
            <div class="compare__specs-item compare__specs-item--header">
                <?=$arProperty['NAME']?>
                <?php if ($arProperty['HINT']) :?>
                    <span class="tooltip">
                        <a
                            class="tooltip__trigger"
                            href="#"
                            data-no-swup
                            data-container="body"
                            data-toggle="popover"
                            data-content="<?=$arProperty['HINT']?>"
                        ></a>
                    </span>
                <?endif?>
            </div>
        <?php endforeach?>
    </div>
    <div class="compare__specs-right">
        <?php foreach ($arResult['ITEMS'] as $arItem) :?>
            <div class="compare__specs-row-wrap">
                <?php foreach ($arItem['DISPLAY_PROPERTIES'] as $index => $arProperty) :?>
                    <div class="compare__specs-row" data-index="<?=$index?>">
                        <div class="compare__specs-item compare__specs-item--header"><?=$arProperty['NAME']?></div>
                        <div class="compare__specs-item"><?=$arProperty['VALUE']?></div>
                    </div>
                <?php endforeach?>
            </div>
        <?php endforeach?>
    </div>
</div>