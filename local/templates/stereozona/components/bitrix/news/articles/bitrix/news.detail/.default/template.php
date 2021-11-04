<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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

<?php $this->SetViewTarget('articles: name and date'); ?>
<h1 class="h2"><?=$arResult['NAME']?></h1>
    <?php if($arResult['PREVIEW_TEXT']!=""){?>
        <span class="font-weight-medium"><?=$arResult['PREVIEW_TEXT']?></span>
    <?php }?>
    <p class="xs"><?=$arResult['ACTIVE_FROM']?></p>
<?php $this->EndViewTarget(); ?>

<?php $this->SetViewTarget('articles: quote'); ?>
    <div class="article__left-bottom">
        <p><?=$arResult['PROPERTIES']['QUOTE']['VALUE']?></p>
    </div>
<?php $this->EndViewTarget(); ?>

<?php $this->SetViewTarget('articles: detail_picture'); ?>
    <div class="col-lg-6">
        <div class="article__picture-wrapper">
            <img class="article__picture" src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" alt>
        </div>
    </div>
<?php $this->EndViewTarget(); ?>

<?php $this->SetViewTarget('articles: authors'); ?>
    <?php if ($arResult['PROPERTIES']['AUTOR_TEXT']['VALUE']!=""):?>
        <p> <span class="font-weight-medium">Текст <br></span><?=$arResult['PROPERTIES']['AUTOR_TEXT']['VALUE']?></p>
    <?php endif;?>
    <?php if ($arResult['PROPERTIES']['AUTOR_TEXT']['VALUE']!=""):?>
        <p> <span class="font-weight-medium">Фотографии <br></span><?=$arResult['PROPERTIES']['AUTOR_PHOTO']['VALUE']?></p>
    <?php endif;?>

<?php $this->EndViewTarget(); ?>

<?=$arResult['DETAIL_TEXT']?>
<div class="article__content">
    <?php if ($arResult['PRODUCT_PROPERTIES']) :?>
        <h4>Паспорт</h4>
        <?php foreach ($arResult['PRODUCT_PROPERTIES'] as $key => $property) :?>
            <div class="row mb-15 mb-md-0">
                <div class="col-md-7">
                    <p class="mb-0 article__prop"><?=$key?></p>
                </div>
                <div class="col-md-5">
                    <p class="mb-0"><?=$property?></p>
                </div>
            </div>
        <?php endforeach?>
    <?php endif?>
    <div class="article__credits">
        <?if (($arResult['PROPERTIES']['AUTOR_TEXT']['VALUE']!="") or ($arResult['PROPERTIES']['AUTOR_PHOTO']['VALUE']!="")):?>
        <table>
            <?php if ($arResult['PROPERTIES']['AUTOR_TEXT']['VALUE']!=""):?>
                <tr>
                <td>
                    <p class="font-weight-medium pr-20 mb-0 mb-md-15">Текст</p>
                </td>
                <td>
                    <p class="mb-0 mb-md-15"><?=$arResult['PROPERTIES']['AUTOR_TEXT']['VALUE']?></p>
                </td>
            </tr>
            <?endif;?>
            <?php if($arResult['PROPERTIES']['AUTOR_PHOTO']['VALUE']!=""):?>
                <tr>
                    <td>
                        <p class="font-weight-medium pr-20">Фотографии</p>
                    </td>
                    <td>
                        <p><?=$arResult['PROPERTIES']['AUTOR_PHOTO']['VALUE']?></p>
                    </td>
                </tr>
            <?endif;?>
        </table>
        <?endif;?>
        <div class="socials socials--share">
            <a class="socials__item socials__item--email" href="mailto:"></a>
            <a class="socials__item socials__item--link js-copy" data-no-swup href="#"></a>
            <div class="likely socials__item socials__item--vk">
                <div class="vkontakte"></div>
            </div>
            <div class="likely socials__item socials__item--fb">
                <div class="facebook"></div>
            </div>
        </div>
    </div>
</div>