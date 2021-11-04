<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Its\Lib\Sizes;


if(!empty($arResult['SECTIONS'])) {?>
    <div class="catalog-page__sections-list">
        <?foreach($arResult['SECTIONS'] as $section){?>
            <a class="catalog-section" href="<?=$section['SECTION_PAGE_URL']?>">
                <span class="catalog-section__icon">
                    <img src="<?= Sizes::resize((int)$section['UF_BAR_ICON'], Sizes::CATALOG_SECTION_BAR)?>" alt="<?=$section['NAME']?>">
                </span>
                <p class="catalog-section__title"><?=$section['NAME']?></p>
            </a>
        <?}?>
    </div>
<?}
