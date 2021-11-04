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
<h2 class="mb-10 mb-md-25 its-fade js-observe">Статьи и обзоры</h2>
<div class="d-flex tag__container--wide mb-50 mb-md-80 its-fade js-observe">
    <?php foreach ($arResult['SECTIONS'] as $arSection) :?>
        <?php if ($arSection['CODE'] != 'obzori') :?>
            <a class="tag" href="/articles/<?=$arSection['CODE']?>/">
                <?=$arSection['NAME']?>
            </a>
        <?php endif?>
    <?php endforeach?>
    <a
        class="tag tag--menu"
        href="/articles/obzori/"
        data-fancybox
        data-no-swup
        data-src="#modalArticles"
        data-animation-effect="false"
        data-touch="false"
        data-modal="true"
    >
        обзоры
    </a>
</div>
<?php if ($arParams['PRODUCT_SECTION_NAME']) :?>
    <h3 class="mb-10 mb-md-25 its-fade js-observe"><?=$arParams['PRODUCT_SECTION_NAME']?>. Обзоры</h3>
<?php endif?>
<div data-container-pagination-id="<?=$arResult['PAGEN_MANAGER']->getPaginationCode()?>">
    <?php
    $arResult['PAGEN_MANAGER']->beginContent();
    foreach ($arResult["ITEMS"] as $indexRow => $arRow) :?>
        <?php if ($indexRow == 0) :?>
            <div class="row mb-0 mb-lg-30 its-fade js-observe">
                <div class="col-lg-6">
                    <div class="row">
                        <?php foreach ($arRow as $index => $arItem) :?>
                            <?php if ($arResult['DIV_MAP'][$indexRow][$index] == 'card') :?>
                                <div class="col-lg-6 mb-15 mb-sm-20 mb-lg-30">
                                    <a class="card" href="<?=$arItem['DETAIL_PAGE_URL']?>">
                                        <div class="card__picture" style="background-image: url(<?=$arItem['FIELDS']['PREVIEW_PICTURE']['SRC']?>);"></div>
                                        <div class="card__content">
                                            <?php if ($arItem['IBLOCK_SECTION_ID'] == $arResult['OBZORI_SECTION_CODE']) :?>
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
                <?php if ($arResult['DIV_MAP'][$indexRow][$index] != 'card') :?>
                    <div class="col-lg-6 mb-15 mb-sm-20 mb-lg-30">
                        <a class="card card--big" href="<?=$arItem['DETAIL_PAGE_URL']?>">
                            <div class="card__picture" style="background-image: url(<?=$arItem['FIELDS']['PREVIEW_PICTURE']['SRC']?>);"></div>
                            <div class="card__content">
                                <?php if ($arItem['IBLOCK_SECTION_ID'] == $arResult['OBZORI_SECTION_CODE']) :?>
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
        <?php else :?>
            <div class="row its-fade js-observe">
                <?php if (current($arResult['DIV_MAP'][$indexRow]) != 'card') :?>
                    <?php $arItem = current($arRow);?>
                    <div class="col-lg-6 mb-15 mb-sm-20 mb-lg-30">
                        <a class="card card--big" href="<?=$arItem['DETAIL_PAGE_URL']?>">
                            <div class="card__picture" style="background-image: url(<?=$arItem['FIELDS']['PREVIEW_PICTURE']['SRC']?>);"></div>
                            <div class="card__content">
                                <?php if ($arItem['IBLOCK_SECTION_ID'] == $arResult['OBZORI_SECTION_CODE']) :?>
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
                <div class="col-lg-6">
                    <div class="row">
                        <?php foreach ($arRow as $index => $arItem) :?>
                            <?php if ($arResult['DIV_MAP'][$indexRow][$index] == 'card') :?>
                                <div class="col-lg-6 mb-15 mb-sm-20 mb-lg-30">
                                    <a class="card" href="<?=$arItem['DETAIL_PAGE_URL']?>">
                                        <div class="card__picture" style="background-image: url(<?=$arItem['FIELDS']['PREVIEW_PICTURE']['SRC']?>);"></div>
                                        <div class="card__content">
                                            <?php if ($arItem['IBLOCK_SECTION_ID'] == $arResult['OBZORI_SECTION_CODE']) :?>
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
            </div>
        <?php endif?>
    <?php
    endforeach;
    $arResult['PAGEN_MANAGER']->endContent();
    ?>
</div>
<?php
$arResult['PAGEN_MANAGER']->beginPagination();
echo $arResult['NAV_STRING'];
$arResult['PAGEN_MANAGER']->endPagination();

$templateData['PRODUCT_SECTIONS'] = $arResult['PRODUCT_SECTIONS'];
?>
