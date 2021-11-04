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
<div class="streetview__slider streetview__slider--photo">
  <?foreach($arResult["ADD_DATA"]["PHOTO"] as $arItem):?>
    <img src="<?=$arItem["DATA-SRC"]?>" alt="<?=$arItem["NAME"]?>">
  <?endforeach;?>
</div>
<div class="streetview__slider streetview__slider--panorama streetview-panorama">
  <div style="position:relative;overflow:hidden;">
    <iframe class="streetview-panorama__frame" src="https://yandex.ru/map-widget/v1/-/CCUiYPuvgA"
      width="500"
      height="500"
      frameborder="1"
      allowfullscreen="true"
      style="position:relative;">
    </iframe>
  </div>
</div>
