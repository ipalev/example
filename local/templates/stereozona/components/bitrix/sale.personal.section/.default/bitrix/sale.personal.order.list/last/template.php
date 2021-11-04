<?php

use Bitrix\Main\Type\Date;
use Its\Lib\SaleHelper;

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

$lastOrder = current($arResult["ORDERS"]);

if(!$lastOrder) {
    return;
}

try {
    $date = (new Date($lastOrder['ORDER']["DATE_INSERT_FORMATED"]))->format('d/m/Y');
} catch (\Bitrix\Main\ObjectException $e) {
    $date = $lastOrder['ORDER']["DATE_INSERT_FORMATED"];
}

$statusColor = SaleHelper::getStatusColor($lastOrder['ORDER']['STATUS_ID']);
$statusTitle = SaleHelper::getStatusTitle($lastOrder['ORDER']['STATUS_ID']);

?>
<div class="col-lg-6 profile__short-col">
    <h4 class="mb-15 mb-sm-25">Заказы</h4>
    <p class="mb-0">Заказ №<?=$lastOrder['ORDER']['ACCOUNT_NUMBER']?> от <?=$date?></p>
    <p class="profile__delivering <?=$statusColor ? 'profile__delivering--'.$statusColor : ''?>">
        <?=$statusTitle?>
    </p>
    <p class="font-weight-medium">
        <a href="<?=sprintf('%spersonal/orders/%u/', SITE_DIR, $lastOrder['ORDER']['ID'])?>">
            Подробнее
        </a>
    </p>
</div>