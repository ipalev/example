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
<div class="front">
    <div class="container-fluid">
        <div class="front__slider">
            <?foreach($arResult["ITEMS"] as $arItem):?>
                <a class="promo"
                    href="<?=$arItem['PROPERTIES']['LINK']['VALUE'] ? $arItem['PROPERTIES']['LINK']['VALUE'] : '#'?>"
                    <?=$arItem['PROPERTIES']['LINK']['VALUE'] ? '' : 'data-no-swup'?>
                >
                    <div class="promo__bg" style="background-image: url(<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>);"></div>
                    <div class="promo__content">
                        <h2 class="text-white mb-10"><?=$arItem["NAME"]?></h2>
                        <p class="mb-0 text-white"><?=$arItem["PREVIEW_TEXT"]?></p>
                    </div>
                </a>
            <?endforeach?>
        </div>
    </div>
</div>
