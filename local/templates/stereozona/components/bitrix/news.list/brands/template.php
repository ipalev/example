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

<?php
    $this->SetViewTarget('first_brand_data');
    $APPLICATION->IncludeComponent(
        'its:brand_data',
        'brand_aside',
        [
            'IBLOCK_CODE' => 'catalog',
            'GET_SECTIONS' => 'Y',
            'BRAND' => current(current($arResult['BRANDS']))['CODE'],
            'filter' => [
                '!IBLOCK_SECTION_ID' => false,
                'PROPERTY_BREND' => current(current($arResult['BRANDS']))['ID']
            ],
        ]
    );
    $this->EndViewTarget();
?>

<form class="brands__form" action="#">
    <input class="input brands__form-input form-control" type="text" placeholder="Найти бренд">
    <div class="row">
        <div class="col-6 col-xl-3">
            <div class="select select--brands js-select-category">
                <?
                $APPLICATION->IncludeComponent(
                    'its:brand_data',
                    'brands_categories',
                    [
                        'IBLOCK_CODE' => 'catalog',
                        'GET_CATEGORIES' => 'Y',
                        'filter' => [
                            '!IBLOCK_SECTION_ID' => false,
                            '!PROPERTY_BREND' => false
                        ]
                    ]
                );
                ?>
            </div>
        </div>
        <div class="col-6 col-xl-3">
            <div class="select select--brands js-select-country">
                <select class="select__input without-reload" data-placeholder="Страна">
                    <option data-brandignore="">Страна не указана</option>
                    <?foreach ($arResult['COUNTRIES'] as $arCountry) :?>
                        <option value="<?=$arCountry['UF_XML_ID']?>"><?=$arCountry['UF_NAME']?></option>
                    <?endforeach?>
                </select>
            </div>
        </div>
    </div>
</form>
<div class="row brands__row">
    <?foreach ($arResult['BRANDS'] as $key => $arFirstChar):?>
        <div class="col-sm-6 col-xl-3">
            <div class="brand-letter">
                <div class="brand-letter__header"><?=$key?></div>
                <div class="brand-letter__content">
                    <?foreach ($arFirstChar as $arBrand):?>
                        <a
                            class="brand-letter__item"
                            href="<?=$arBrand['LINK']?>"
                            data-no-swup=""
                            data-brandcode="<?=$arBrand['CODE']?>"
                            data-brandid="<?=$arBrand['ID']?>"
                            data-brandcountry="<?=$arBrand['COUNTRY_CODE']?>"
                        >
                            <?=$arBrand['NAME']?>
                        </a>
                    <?endforeach?>
                </div>
            </div>
        </div>
    <?endforeach?>
</div>
