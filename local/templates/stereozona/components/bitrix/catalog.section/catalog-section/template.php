<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Grid\Declension;
use Bitrix\Main\Localization\Loc;

/**
 * @var array $arResult
 * @var CAllMain $APPLICATION
 *
 */

$decl = new Declension(...explode(',', Loc::getMessage('ITS_CATALOG_PRODUCT_COUNT_DECLENSIONS')));
$elementsCount = intval($arResult['NAV_RESULT']->NavRecordCount);

$counterText = $elementsCount > 0 ?
    $elementsCount.' '.$decl->get($elementsCount) : Loc::getMessage('ITS_CATALOG_PRODUCT__COUNT_NOT_FOUND');

$this->SetViewTarget('catalog_section: element_count');
printf('<span class="catalog__count catalog__wrapper-header-text">%s</span>', $counterText);
$this->EndViewTarget();

if($arResult['ID']) {
    $this->SetViewTarget('header-og');
    echo \Its\Lib\Utils::makeOGMeta([
        'title' => $arResult['NAME'],
        'description' => strip_tags($arResult['DESCRIPTION']),
        'image:width' => 100,
        'image:height' => 100,
        'image' => CFile::GetPath($arResult['UF_BAR_ICON']),
    ]);
    $this->EndViewTarget();
}
?>
    <div class="catalog__items-wrapper">
        <div class="catalog__items-list" data-container-pagination-id="<?=$arResult['PAGEN_MANAGER']->getPaginationCode()?>">
            <?php
            $arResult['PAGEN_MANAGER']->beginContent();
            foreach ($arResult['ITEMS'] as $arItem) {
                $APPLICATION->IncludeComponent(
                    'bitrix:catalog.item',
                    'catalog',
                    [
                        'RESULT' => $arItem,
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
    </div>