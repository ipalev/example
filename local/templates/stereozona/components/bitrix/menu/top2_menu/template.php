<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

/**
 * @var CAllUser user
 * @var CAllMain $APPLICATION
 * @var CBitrixComponent $component
 * @var array $arParams
 * @var array $arResult
 */

foreach($arResult as $arItem) {
  $attributes = '';
  foreach ($arItem['PARAMS'] as $key => $param) {
    if ($key!="add_class"){
      $attributes .= $key . '="' . $param . '" ';
    }
    
  }
  ?>
    <a class="menu__link <?echo $arItem['PARAMS']['add_class']?>" href="<?=$arItem['LINK']?>" <?=$attributes?> ><?=$arItem['TEXT']?></a>
<?php
}
