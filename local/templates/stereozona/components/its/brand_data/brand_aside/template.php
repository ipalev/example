<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();


?>
<div class="brand-preview">
    <a class="brand-preview__logo" href="#">
        <img src="<?=$arResult['BRAND_DATA']['PREVIEW_PICTURE']?>" alt>
    </a>
    <div class="brand-preview__info">
        <div class="brand-preview__country">
            <div class="brand-preview__country-flag">
                <img src="<?=$arResult['BRAND_DATA']['COUNTRY']['UF_FILE']?>" alt>
                <p class="mb-0 ml-10"><?=$arResult['BRAND_DATA']['COUNTRY']['UF_NAME']?></p>
            </div>
            <p class="mb-25"><?=$arResult['BRAND_DATA']['PREVIEW_TEXT']?></p>
            <a class="btn btn-secondary btn-sm brand-preview__btn" href="<?=$arResult['BRAND_DATA']['DETAIL_PAGE_URL']?>">
                Подробнее о бренде
            </a>
        </div>
        <div class="brand-preview__sections-list">
            <?foreach ($arResult['sections'] as $section) {
                $propertyResult = \Its\Lib\Utils::getSEFUrlByLinkedElement(
                    $section['IBLOCK_ID'],
                    $arResult['BRAND_DATA']['IBLOCK_ID'],
                    $arResult['BRAND_DATA']['ID'],
                    'BREND',
                    $section['SECTION_PAGE_URL'].'filter/#SMART_FILTER_PATH#/apply/'
                );
                ?>
                <a class="brand-preview__section" href="<?= $propertyResult['FILTER_URL'] ?>">
                    <?= $section['NAME'] ?>
                </a>
            <?}?>
        </div>
        <a class="btn btn-secondary btn-sm brand-preview__btn" href="<?=$arResult['BRAND_DATA']['DETAIL_PAGE_URL']?>#catalog">Все товары бренда</a>
    </div>
</div>