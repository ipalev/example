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
<div id="swup-modals">
    <div class="modal modal--bottom" id="modalBrands">
        <a class="modal__close" href="#" data-fancybox-close data-no-swup></a>
        <div class="container-fluid px-md-0">
            <div class="modal__content">
                <div class="row">
                    <?php foreach ($arResult['BRANDS'] as $row) :?>
                        <div class="col-md-4">
                            <?php foreach ($row as $arBrand) :?>
                                <a
                                    class="modal__counted-link"
                                    href="/promotions/brand/filter/<?=$arBrand['CODE']?>/"
                                >
                                    <?=$arBrand['NAME']?>
                                </a>
                            <?php endforeach?>
                        </div>
                    <?php endforeach?>
                </div>
            </div>
        </div>
    </div>
</div>
<h2 class="mb-10 mb-md-25">Акции</h2>
<div class="d-flex justify-content-between mb-50 mb-md-80">
    <div class="d-flex tag__container">
        <a class="tag" href="/promotions/">Все</a>
        <?php foreach ($arResult['SECTIONS'] as $arSection) :?>
            <a class="tag" href="/promotions/<?=$arSection['CODE']?>/">
                <?=$arSection['NAME']?>
            </a>
        <?php endforeach?>
        <a
            class="tag tag--menu"
            href="#"
            data-fancybox
            data-no-swup
            data-src="#modalBrands"
            data-animation-effect="false"
            data-touch="false"
            data-modal="true"
        >
            производитель
        </a>
    </div>
    <a class="tag d-none d-lg-flex" href="/promotions/archive/">Архив</a>
</div>
<?php if ($arParams["FILTER_NAME"] == 'archiveFilter') :?>
<h3 class="mb-10 mb-md-25">Архивные акции</h3>
<?php endif?>
    <div class="row" data-container-pagination-id="<?=$arResult['PAGEN_MANAGER']->getPaginationCode()?>">
    <?php
    $arResult['PAGEN_MANAGER']->beginContent();
    foreach ($arResult['ITEMS'] as $arItem) :?>
        <div class="col-lg-6 its-fade js-observe">
            <div class="offer">
                <div class="offer__picture"><img src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt></div>
                <div class="offer__content">
                    <div class="offer__content-top">
                        <p class="sm font-weight-medium offer__date"><?=$arItem['ACTIVE_FROM']?> - <?=$arItem['ACTIVE_TO']?></p>
                        <h4 class="offer__title">
                            <span class="font-weight-bold"><?=$arItem['NAME']?></span>
                            <?=$arItem['PREVIEW_TEXT']?>
                        </h4>
                    </div>
                    <a class="btn btn-outline-primary btn-outline-primary--small btn-sm offer__btn" href="<?=$arItem['DETAIL_PAGE_URL']?>">Условия</a>
                </div>
            </div>
        </div>
    <?php
    endforeach;
    $arResult['PAGEN_MANAGER']->endContent();
    ?>
</div>
<?php
$arResult['PAGEN_MANAGER']->beginPagination();
echo $arResult['NAV_STRING'];
$arResult['PAGEN_MANAGER']->endPagination();
?>