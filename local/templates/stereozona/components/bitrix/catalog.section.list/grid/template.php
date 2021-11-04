<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

if(!empty($arResult['SECTIONS'])) {?>

    <div class="catalog-list d-none d-md-flex">
        <?foreach($arResult['SECTIONS'] as $section){?>
            <a class="catalog-section catalog-section--main" href="<?=$section['SECTION_PAGE_URL']?>">
                <span class="catalog-section__icon">
                    <img src="<?= \CFile::GetPath($section['UF_BAR_ICON'])?>" alt="<?=$section['NAME']?>">
                </span>
                <p class="catalog-section__title"><?=$section['NAME']?></p>
            </a>
        <?}?>
    </div>
<?}
