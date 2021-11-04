<?php
/**
 * @var array $arResult
 */

use \Bitrix\Main\Localization\Loc;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$this->setFrameMode(true);

$cur = $arResult['CURRENT'];
?>
<div class="catalog__wrapper-sorting">
    <div class="catalog__sorting-overflow"></div>
    <?php
    $headTitle = Loc::getMessage(strtoupper(
        'ADDITIONAL_FIELDS_TEMPLATE_'.$cur['CODE'].'_'.$cur['ORDER']
    ));
    ?>
    <a class="catalog__wrapper-header-text catalog__sorting-btn" href="#" data-no-swup>
        Сортировать: <span class="font-weight-normal"><?=$headTitle?></span>
    </a>
    <div class="catalog__wrapper-sorting-dropdown">
        <?foreach($arResult['ITEMS'] as $sortItem){
            foreach (['ASC', 'DESC'] as $order) {
                $btnTitle = Loc::getMessage('ADDITIONAL_FIELDS_TEMPLATE_'.$sortItem['CODE'].'_'.$order);

                if(!$btnTitle) continue;
                ?>
                <a class="catalog__wrapper-sorting-option"
                   data-no-swup
                   onclick="window.goToPage(location.pathname + '?by=<?=$sortItem['HTML']?>&order=<?=$order?>')"
                   href="#"
                >
                    <?= $btnTitle ?>
                </a>
            <?}
        } ?>
    </div>
</div>
