<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
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

<?php
$this->SetViewTarget('brand_detail: name_detail_text');
?>
<h1><?= ($arResult["IPROPERTY_VALUES"]["ELEMENT_PAGE_TITLE"] != "") ? $arResult["IPROPERTY_VALUES"]["ELEMENT_PAGE_TITLE"] : $arResult["NAME"] ?></h1>
<div class="brand__left-text">
    <?= $arResult["DETAIL_TEXT"] ?>
</div>
<a
        class="btn btn-secondary btn-sm brand-preview__btn"
        href="#"
        data-fancybox data-no-swup data-src="#modalBrand"
        data-animation-effect="false"
        data-touch="false"
        data-modal="true"
>
    Подробнее
</a>
<?php
$this->EndViewTarget();
?>

<?php
$this->SetViewTarget('brand_detail: detail_picture');
?>
<div class="col-lg-6">
    <div class="brand__picture-wrapper">
        <img class="brand__picture" src="<?= $arResult["DETAIL_PICTURE"]["SRC"] ?>" alt>
    </div>
</div>
<?php
$this->EndViewTarget();
?>

<div class="modal modal--right modal--brand" id="modalBrand">
    <a class="modal__close" href="#" data-fancybox-close data-no-swup></a>
    <div class="container-fluid px-0">
        <div class="modal__content">
            <div class="modal__brand">
                <div class="modal__brand-top">о бренде</div>
                <div class="modal__brand-wrapper">
                    <h2><?= $arResult["NAME"] ?></h2>
                    <?= $arResult["PREVIEW_TEXT"] ?>
                    <div class="modal__brand-info">
                        <div class="modal__brand-link">
                            <a href="<?= $arResult['PROPERTIES']['BRAND_LINK']['HREF'] ?>" target="_blank">
                                <?= $arResult['PROPERTIES']['BRAND_LINK']['VALUE'] ?>
                            </a>
                        </div>
                        <div class="modal__brand-country-flag"><img src="<?= $arResult['COUNTRY']['UF_FILE'] ?>" alt>
                            <p><?= $arResult['COUNTRY']['UF_NAME'] ?></p>
                        </div>
                        <div class="modal__brand-year"><?= $arResult['PROPERTIES']['BRAND_YEAR']['VALUE'] ?></div>
                    </div>
                    <img class="modal__brand-photo" src="<?= $arResult["DETAIL_PICTURE"]["SRC"] ?>" alt>
                    <div class="modal__brand-content">
                        <div class="modal__brand-logo"><img src="<?= $arResult["PREVIEW_PICTURE"]["SRC"] ?>" alt></div>
                        <div class="modal__brand-dscr">
                            <?= $arResult["DETAIL_TEXT"] ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal__brand-other">
                <?php
                $APPLICATION->IncludeComponent(
                    'its:brand_data',
                    'other_brands',
                    [
                        'IBLOCK_CODE' => $arResult['IBLOCK_CODE'],
                        'filter' => [
                            '!PREVIEW_PICTURE' => false
                        ],
                        'arNavStartParams' => [
                            'nTopCount' => 10
                        ]
                    ]
                ); ?>
            </div>
        </div>
    </div>
</div>
