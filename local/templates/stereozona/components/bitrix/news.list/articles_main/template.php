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
<?php if ($arResult["ITEMS"]) :?>
    <div class="section__header its-fade js-observe">
        <h1 class="mb-0"><a class="text-dark" href="#">Статьи и обзоры</a></h1>
    </div>
    <div class="row mb-0 mb-lg-30 its-fade js-observe">
        <div class="col-lg-6">
            <div class="row">
                <?php foreach ($arResult["ITEMS"] as $index => $arItem) :?>
                    <?php if ($arResult['DIV_MAP'][$index] == 'card') :?>
                        <div class="col-lg-6 mb-15 mb-sm-20 mb-lg-30">
                            <a class="card" href="<?=$arItem['DETAIL_PAGE_URL']?>">
                                <div class="card__picture" style="background-image: url(<?=$arItem['FIELDS']['PREVIEW_PICTURE']['SRC']?>);"></div>
                                <div class="card__content">
                                    <?php if ($arItem['IBLOCK_SECTION_ID'] == $arResult['OBZORI_SEC_CODE']) :?>
                                        <div class="card__overview">Обзор</div>
                                    <?php endif?>
                                    <div class="card__title">
                                        <span class="font-weight-medium"><?=$arItem['NAME']?></span>
                                        <?=$arItem['PREVIEW_TEXT']?>
                                    </div>
                                    <p class="xs mb-0"><?=$arItem['ACTIVE_FROM']?></p>
                                </div>
                            </a>
                        </div>
                    <?php endif?>
                <?php endforeach?>
            </div>
        </div>
        <?php if ($arResult['DIV_MAP'][$index] == 'card--big') :?>
            <div class="col-lg-6 mb-15 mb-sm-20 mb-lg-30">
                <a class="card card--big" data-no-swup target="_blank" href="<?=$arItem['DETAIL_PAGE_URL']?>">
                    <div class="card__picture" style="background-image: url(<?=$arItem['FIELDS']['PREVIEW_PICTURE']['SRC']?>);"></div>
                    <div class="card__content">
                        <?php if ($arItem['IBLOCK_SECTION_ID'] == $arResult['OBZORI_SEC_CODE']) :?>
                            <div class="card__overview">Обзор</div>
                        <?php endif?>
                        <div class="card__title">
                            <span class="font-weight-medium"><?=$arItem['NAME']?></span>
                            <?=$arItem['PREVIEW_TEXT']?>
                        </div>
                        <p class="xs mb-0"><?=$arItem['ACTIVE_FROM']?></p>
                    </div>
                </a>
            </div>
        <?php endif?>
    </div>
<?php endif?>
