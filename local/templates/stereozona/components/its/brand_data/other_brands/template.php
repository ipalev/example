<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<h3>Другие бренды</h3>
<div class="drag">
    <?foreach ($arResult['slides'] as $arSlide) :?>
        <a
            class="other"
            ondragstart="return false;"
            draggable="false"
            href="<?=$arSlide['DETAIL_PAGE_URL']?>"
            style="background-image: url(<?=$arSlide['img']?>)"
        ></a>
    <?endforeach?>
</div>