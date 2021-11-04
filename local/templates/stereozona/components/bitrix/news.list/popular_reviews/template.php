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
<?php if ($arResult['ITEMS']) :?>
    <div class="article__aside article__aside--right d-none d-xl-block">
        <div class="article__sticky">
            <div class="article__sticky-content">
                <div class="addition">
                    <div class="addition__title">Популярные обзоры</div>
                    <?php foreach ($arResult['ITEMS'] as $arItem) :?>
                        <a class="card card--short" href="<?=$arItem['DETAIL_PAGE_URL']?>">
                            <div class="card__picture" style="background-image: url(<?=$arItem['PREVIEW_PICTURE']['SRC']?>);"></div>
                            <div class="card__content">
                                <div class="card__title">
                                    <span class="font-weight-medium"><?=$arItem['NAME']?></span>
                                    <?=$arItem['PREVIEW_TEXT']?>
                                </div>
                            </div>
                        </a>
                    <?php endforeach?>
                </div>
            </div>
        </div>
    </div>
<?php endif?>
