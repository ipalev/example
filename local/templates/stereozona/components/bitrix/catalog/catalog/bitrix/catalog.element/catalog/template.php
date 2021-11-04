<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/**
 * @var array $arParams
 * @var array $arResult
 */
define('SPECS_COUNT', 6);

//todo блок "обзор товара" пока отложен на неопределённое время (свойство "OVERVIEW" не создано)
$overview = false; // !empty($arResult['PROPERTIES']['OVERVIEW']['VALUE'])

$tabDescription = !empty($arResult['DETAIL_TEXT']);
$tabBrand = !empty($arResult['BRAND_INFO']);
$tabSpecs = count($arResult['RES_MOD']['PROP_LIST']);

if($overview) {
    $this->SetViewTarget('catalog_element: modal_overview_content'); ?>
    <div class="modal__content">
        <div class="modal__overview">
            <div class="modal__overview-media">
                <img src="/assets/img/overview-media.jpg" alt>
            </div>
            <div class="modal__overview-content">
                <h3>Обзор T+A SDV 3100 HV</h3>
                <p>
                    В SDV 3100 HV встроен цифро-аналоговый преобразователь, который является еще более сложным, чем все предыдущие преобразователи, что позволяет удваивать предыдущие уровни разрешения до 32-бит / 768 кГц для PCM и DSD 1024 для данных битового потока. Это улучшение потребовало тщательной доработки предыдущих преобразователей и разработки совершенно нового USB-приемника. SDV 3100 HV и SD 3100 HV идентичны по своей механической и электронной конструкции, за исключением секции предварительного усилителя, которая дополнительно оснащен SDV 3100 HV. Управлять SDV 3100 HV, а также полной системой HV можно с помощью пульта дистанционного управления F 3100 или одного из приложений T + A.
                </p>
                <a class="modal__overview-read-more" href="#" data-no-swup>
                    Читать полностью
                </a>
            </div>
        </div>
    </div>
    <?php
    $this->EndViewTarget();
}
?>
<div class="product" data-product-page data-product-id="<?=$arResult['ID']?>">
    <div class="container-fluid its-fade js-observe">
        <div class="product__top">
            <div class="product__top-left">
                <a class="product__logo" href="<?=$arResult['BRAND_INFO']['DETAIL_PAGE_URL']?>">
                    <img src="<?=$arResult['BRAND_INFO']['PREVIEW_PICTURE']?>" alt>
                </a>
                <div class="gallery">
                    <div class="gallery__slider">
                        <? foreach($arResult['RES_MOD']['IMAGES'] as $image){?>
                            <div class="gallery__slider-item">
                                <img src="<?=$image['PATH']?>" alt="<?=$arResult['NAME']?>">
                            </div>
                        <?} ?>
                    </div>
                    <div class="gallery__nav-container">
                        <?if($overview) {?>
                            <a class="gallery__overview"
                               href="#overview"
                               data-fancybox
                               data-no-swup
                               data-src="#modalOverview"
                               data-animation-effect="false"
                               data-touch="false"
                               data-modal="true"
                            >
                                обзор
                            </a>
                        <?}?>
                        <div class="gallery__nav">
                            <? foreach($arResult['RES_MOD']['IMAGES'] as $image){?>
                                <a class="gallery__nav-item">
                                    <img src="<?=$image['PATH_THUMB']?>" alt="<?=$arResult['NAME']?>">
                                </a>
                            <?} ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="product__top-right">
                <div class="product__top-mobile">
                    <?php foreach ($arResult['BADGES'] as $badge) :?>
                        <div class="product__badge product__badge--new"><?=$badge?></div>
                    <?php endforeach?>
                    <h1 class="mb-10 mb-sm-20 product__title"><?=$arResult['NAME']?></h1>
                    <?php
                    $price = current($arResult['ITEM_PRICES']);

                    if($price && $price['PRICE'] > 0) {?>
                        <div class="product__price">
                            <?php

                            printf('<div class="product__price-current h3">%s</div>', $price['PRINT_PRICE']);

                            if($price['PRICE'] < $price['BASE_PRICE']) {
                                printf('<div class="product__price-old h3">%s</div>', $price['PRINT_BASE_PRICE']);
                            }

                            ?>
                            <a class="product__price-discount-btn"
                               href="#"
                               data-fancybox
                               data-no-swup
                               data-src="#modalDiscount"
                               data-animation-effect="false"
                               data-touch="false"
                               data-modal="true"
                               data-is-goal="click"
                               data-base-goal-name="low_price_click"
                            >
                                Хочу дешевле
                            </a>
                        </div>
                    <?}?>
                </div>
                <div class="product__controls">
                    <?php if($price && $price['PRICE'] > 0) :?>
                        <a class="btn btn-primary js__product-action"
                           id="popupCart"
                           data-no-swup
                           href="#"
                           data-product="<?=$arResult['ID']?>"
                           data-action="increase"
                           data-is-goal="click"
                           data-base-goal-name="korzina"
                        >
                            В корзину
                        </a>
                        <a class="btn btn-secondary"
                           href="#"
                           data-fancybox
                           data-no-swup
                           data-src="#modalClick"
                           data-animation-effect="false"
                           data-touch="false"
                           data-modal="true"
                           data-is-goal="click"
                           data-base-goal-name="oneclick_click"
                        >
                            Купить в 1 клик
                        </a>
                    <?php else:?>
                        <a class="btn btn-secondary product__controls-unordered-btn"
                           href="#"
                           data-fancybox
                           data-no-swup
                           data-src="#modalReportReceiptProduct"
                           data-animation-effect="false"
                           data-touch="false"
                           data-modal="true"
                           data-is-goal="click"
                           data-base-goal-name="nalichie_click"
                        >
                            Сообщить о поступлении
                        </a>
                    <?php endif?>
                    <a
                        class="product__controls-btn js__compare"
                        id="popupCompare"
                        data-no-swup
                        data-product-id="<?=$arResult['ID']?>"
                        data-is-goal="click"
                        data-base-goal-name="sravn_click"
                    >
                        <img src="/assets/img/icon-items.svg" alt>
                    </a>
                    <a
                        class="product__controls-btn js__favorite"
                        id="popupFavorite"
                        data-no-swup
                        data-product-id="<?=$arResult['ID']?>"
                        data-is-goal="click"
                        data-base-goal-name="izbran_click"
                    >
                        <img src="/assets/img/icon-fav.svg" alt>
                    </a>
                </div>
                <?if($arResult['PREVIEW_TEXT']){?>
                    <div class="dropdown dropdown--info">
                        <a class="dropdown__header" href="#" data-no-swup>Описание</a>
                        <div class="dropdown__content">
                            <p>
                                <?=$arResult['PREVIEW_TEXT']?>
                            </p>
                            <a class="btn btn-secondary btn-sm"
                               href="#"
                               data-no-swup
                               data-product-tab="#product-about"
                            >
                                Смотреть все
                            </a>
                        </div>
                    </div>
                <?}

                if(!empty($arResult['RES_MOD']['PROP_LIST'])) {?>
                    <div class="dropdown dropdown--info">
                        <a class="dropdown__header" href="#" data-no-swup>Характеристики</a>
                        <div class="dropdown__content">
                            <div class="dropdown__table">
                                <?php

                                $idx = 0;
                                foreach ($arResult['RES_MOD']['PROP_LIST'] as $propertyName => $propertyValue) {
                                    if($idx >= SPECS_COUNT) break;
                                    if(is_array($propertyValue)) $propertyValue = implode(' / ', $propertyValue);
                                    ?>
                                    <div class="dropdown__table-item">
                                        <div class="dropdown__table-item-left"><?=$propertyName?></div>
                                        <div class="dropdown__table-item-right"><?=$propertyValue?></div>
                                    </div>
                                    <?php

                                    $idx++;
                                }?>
                            </div>
                            <?if($tabSpecs > SPECS_COUNT) {?>
                                <a class="btn btn-secondary btn-sm"
                                   href="#"
                                   data-no-swup
                                   data-product-tab="#product-info"
                                >
                                    Смотреть все
                                </a>
                            <?}?>
                        </div>
                    </div>
                <?}?>
                <div class="dropdown dropdown--info">
                    <a class="dropdown__header"
                       href="#"
                       data-no-swup
                    >
                        О производителе
                    </a>
                    <div class="dropdown__content">
                        <p>
                            <span class="font-weight-medium"><?=$arResult['BRAND_INFO']['NAME']?></span>
                        </p>
                        <p>
                            <?=$arResult['BRAND_INFO']['PREVIEW_TEXT']?>
                        </p>
                        <a class="btn btn-secondary btn-sm"
                           href="#"
                           data-no-swup
                           data-product-tab="#product-brand"
                        >
                            Подробнее
                        </a>
                    </div>
                </div>
                <div class="dropdown dropdown--info">
                    <a class="dropdown__header" href="#" data-no-swup>Доставка и оплата</a>
                    <div class="dropdown__content">
                        <ul>
                            <?php foreach ($arResult['DELIVERIES'] as $name => $description) { ?>
                                <li>
                                    <?=$name?>
                                    <span class="tooltip">
                                        <a class="tooltip__trigger"
                                           href="#"
                                           data-no-swup
                                           data-container="body"
                                           data-toggle="popover"
                                           data-content="<?=$description?>"
                                        ></a>
                                    </span>
                                </li>
                            <?php
                            }?>
                            <li>Наличный и безналичный расчет</li>
                        </ul>
                        <div class="d-flex flex-wrap pt-10 pt-md-15">
                            <span class="payment"><img src="/assets/img/icon-visa.svg" alt></span>
                            <span class="payment"><img src="/assets/img/icon-mastercard.svg" alt></span>
                            <span class="payment"><img src="/assets/img/icon-mir.svg" alt></span>
                        </div>
                    </div>
                </div>
                <div class="dropdown dropdown--info">
                    <a class="dropdown__header" href="#" data-no-swup>Сервис и возврат</a>
                    <div class="dropdown__content">
                      <p>Возврат товара осуществляется в полном соответствии с законодательством РФ, включая Закон о Правах Потребителя.</p>
                      <p>Обратите внимание, что комплектующие изделия (динамики, радиодетали и прочее) не подлежат возврату или обмену, за исключением случаев производственного брака.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="product__tabs its-fade js-observe">
        <div class="product__tabs-top">
            <div class="container-fluid">
                <ul class="nav nav-tabs" role="tablist">
                    <?if($tabDescription) {?>
                        <li class="nav-item">
                            <a class="nav-link" href="#product-about" data-toggle="tab">Описание</a>
                        </li>
                    <?}

                    if($tabSpecs) {?>
                        <li class="nav-item">
                            <a class="nav-link" href="#product-info" data-toggle="tab">Характеристики</a>
                        </li>
                    <?}

                    if($tabBrand) {?>
                        <li class="nav-item">
                            <a class="nav-link" href="#product-brand" data-toggle="tab">О производителе</a>
                        </li>
                    <?}?>
                </ul>
            </div>
        </div>
        <div class="container-fluid">
            <div class="tab-content tab-content--content">
                <?if($tabDescription) {
                    $acousticType = $arResult['PROPERTIES']['TYPE_ACOUSTIC_SYSTEM']['VALUE'] ?: '';
                    $acousticType = is_array($acousticType) ? current($acousticType) : $acousticType;

                    $descTitle = $acousticType . ' ' . $arResult['NAME'];
                    ?>
                    <div class="tab-pane fade" id="product-about" role="tabpanel">
                        <div class="row">
                            <div class="col-md-7"><h2><?=$descTitle?></h2></div>
                            <div class="col-md-5 product-text"><?=$arResult['DETAIL_TEXT']?></div>
                        </div>
                    </div>
                <?}

                if($tabSpecs) {?>
                    <div class="tab-pane fade" id="product-info" role="tabpanel">
                        <div class="row">
                            <div class="col-md-7"><h2>Характеристики</h2></div>
                            <div class="col-md-5">
                                <?php
                                foreach ($arResult['RES_MOD']['PROP_LIST'] as $propertyName => $propertyValue) {
                                    if(is_array($propertyValue)) $propertyValue = implode(' / ', $propertyValue);
                                    ?>
                                    <div class="dropdown__table-item">
                                        <div class="dropdown__table-item-left"><?=$propertyName?></div>
                                        <div class="dropdown__table-item-right"><?=$propertyValue?></div>
                                    </div>
                                <?php }?>
                            </div>
                        </div>
                    </div>
                <?}

                if($tabBrand) {?>
                    <div class="tab-pane fade" id="product-brand" role="tabpanel">
                        <div class="row">
                            <div class="col-md-7"><h2><?=$arResult['BRAND_INFO']['NAME']?></h2></div>
                            <div class="col-md-5">
                                <?=$arResult['BRAND_INFO']['DETAIL_TEXT']?>
                                <a class="btn btn-secondary btn-sm to-brand-page-link"
                                         href="<?=$arResult['BRAND_INFO']['DETAIL_PAGE_URL']?>"
                                >
                                    На страницу бренда
                                </a>
                            </div>
                        </div>
                    </div>
                <?}?>
            </div>
        </div>
    </div>
</div>
