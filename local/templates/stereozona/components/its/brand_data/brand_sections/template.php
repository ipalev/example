<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$res = CIBlockSection::GetByID($arElement["IBLOCK_SECTION_ID"]);
?>

<?foreach ($arResult['sections'] as $arSection) :?>
    <a class="catalog-section" href="<?=$arSection['SECTION_PAGE_URL']?>filter/brend-is-<?=$arResult['BRAND_DATA']['CODE']?>/apply/">
        <span class="catalog-section__icon">
            <img src="<?=$arSection['PICTURE']?>" alt>
        </span>
        <p class="catalog-section__title"><?=$arSection['NAME']?></p>
    </a>
<?endforeach?>