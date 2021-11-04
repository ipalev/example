<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Its\Lib\Sizes;

if(!empty($arResult['RES_MOD']['SECTIONS'])) {?>
    <div class="catalog-list catalog-list--mobile d-block d-md-none">
        <?foreach($arResult['RES_MOD']['SECTIONS'] as $sectionChunk){?>
            <div class="catalog-list__slide">
                <?foreach($sectionChunk as $section){?>
                    <a class="catalog-section catalog-section--main" href="<?=$section['SECTION_PAGE_URL']?>">
                        <span class="catalog-section__icon">
                            <img src="<?= Sizes::resize((int)$section['UF_BAR_ICON'], Sizes::CATALOG_SECTION_BAR)?>" alt="<?=$section['NAME']?>">
                        </span>
                        <p class="catalog-section__title"><?=$section['NAME']?></p>
                    </a>
                <?}?>
            </div>
        <?}?>
    </div>
<?}
