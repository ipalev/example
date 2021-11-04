<?php require_once($_SERVER['DOCUMENT_ROOT']. "/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Loader;
use Its\Lib\AjaxApiController\Basket;

if (Loader::includeModule('sale')) {
    $wishList = Basket::getDeferredProducts();
    header('Content-Type: application/json');
    echo json_encode($wishList);
}
