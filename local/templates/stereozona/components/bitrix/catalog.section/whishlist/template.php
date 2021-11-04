<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/**
 * @var array $arResult
 * @var CAllMain $APPLICATION
 *
 */
?>
<div class="profile__favorite-list" data-container-pagination-id="<?=$arResult['PAGEN_MANAGER']->getPaginationCode()?>">
    <?php
    $arResult['PAGEN_MANAGER']->beginContent();
    foreach ($arResult['ITEMS'] as $arItem) {
        $APPLICATION->IncludeComponent(
            'bitrix:catalog.item',
            'catalog',
            [
                'RESULT' => $arItem,
                'VIEW_PARAMS' => $arParams['VIEW_PARAMS']
            ],
            false
        );
    }
    $arResult['PAGEN_MANAGER']->endContent();
    ?>
</div>
<?php
$arResult['PAGEN_MANAGER']->beginPagination();
echo $arResult['NAV_STRING'];
$arResult['PAGEN_MANAGER']->endPagination();
?>