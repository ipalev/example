<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
  die();
}

$arAddData = array();
foreach ($arResult["ITEMS"] as $arItem) {
  if ($arItem["PROPERTIES"]["TYPE_PHOTO"]["VALUE_XML_ID"] == "xml_id_photo") {
    $arAddData["PHOTO"][] = array(
      "ALT" => $arItem["NAME"],
      "DATA-SRC" => $arItem["PROPERTIES"]["IMG_SRC"]["VALUE"],
    );
  } elseif ($arItem["PROPERTIES"]["TYPE_PHOTO"]["VALUE_XML_ID"] == "xml_id_panorama") {
    $arAddData["PANORAMA"][] = array(
      "ALT" => $arItem["NAME"],
      "DATA-SRC" => $arItem["PROPERTIES"]["IMG_SRC"]["VALUE"],
    );
  }
}
$arResult["ADD_DATA"] = $arAddData;
