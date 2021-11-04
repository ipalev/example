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
$this->setFrameMode(true);
?>
<div class="help__menu">
    <?php foreach ($arResult['ITEMS'] as $arItem) :?>
        <a
            class="help__menu-item <?=($arItem['CODE'] == $arParams['ACTIVE_PAGE_CODE']) ? 'help__menu-item--active' : ''?>"
            href="<?=$arItem['DETAIL_PAGE_URL']?>"
        >
            <?=$arItem['NAME']?>
        </a>
    <?php endforeach?>
</div>
