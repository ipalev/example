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
    <div class="article__next its-fade js-observe">
        <div class="container-fluid">
            <h3 class="mb-40"><?=$arParams['HEADER']?></h3>
            <div class="row article__next-row">
                <?php foreach ($arResult['ITEMS'] as $arItem) :?>
                    <div class="col-auto col-md-6 col-lg-3 pb-md-20 pb-lg-0">
                        <a class="card" href="<?=$arItem['DETAIL_PAGE_URL']?>">
                            <div class="card__picture" style="background-image: url(<?=$arItem['PREVIEW_PICTURE']['SRC']?>);"></div>
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
                <?php endforeach?>
            </div>
        </div>
    </div>
<?php endif?>
