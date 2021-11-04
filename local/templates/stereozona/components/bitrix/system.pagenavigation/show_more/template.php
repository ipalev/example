<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/**
 * @var array $arResult
 */

if($arResult["NavPageCount"] > 1) {

    if ($arResult["NavPageNomer"] + 1 <= $arResult["nEndPage"]) {

        $plus = $arResult["NavPageNomer"] + 1;
        $url = $arResult["sUrlPathParams"] . "PAGEN_".$arResult["NavNum"]."=".$plus;
        ?>
        <div class="row mt-30 mt-md-80 mb-65 mb-md-100 js__pagination"
             data-pagination-id="<?=$arResult['NavTitle']?>"
             data-url="<?=$url?>"
        >
            <div class="col-lg-4 mx-auto">
                <a class="more" href="#">Показать больше</a>
            </div>
        </div>
<?php }

}
