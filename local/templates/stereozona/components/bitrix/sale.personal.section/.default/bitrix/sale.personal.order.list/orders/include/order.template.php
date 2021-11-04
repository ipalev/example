<?php

use Bitrix\Main\Grid\Declension;
use Bitrix\Sale\ShipmentItem;
use Its\Lib\Modal\PersonalOrderModal;

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) {
    die();
}

/**
 * @var array $arResult
 * @var array $order
 * @var array $status
 * @var string $orderTitle
 * @var bool $canceled
 */

$count = array_reduce($order['BASKET_ITEMS'], function($amount, $basketItem) {
    return $amount + $basketItem['QUANTITY'];
}, 0);

$decl = new Declension('товар', 'товара', 'товаров');

?>
<div class="order-item order-item--<?=$status['color']?>">
    <div class="order-item__header">
        <div class="order-item__left js__personal-order"
             data-modal-id="<?=PersonalOrderModal::generateModalId($order['ORDER']['ID'])?>"
             data-href="<?=$order["ORDER"]["URL_TO_DETAIL"]?>"
        >
            <p class="font-weight-medium mb-0"><?=$orderTitle?></p>
            <p class="mb-0"><?= $count . ' ' .$decl->get($count) ?></p>
        </div>
        <div class="order-item__right">
            <div class="order-item__status"><?=$status['title']?></div>
        </div>
    </div>
    <div class="order-item__content">
        <?php foreach($order['SHIPMENT'] as $shipment) {
            if(is_array($shipment['PRODUCTS'])) {
                /** @var ShipmentItem[]|array $product */
                foreach($shipment['PRODUCTS'] as $product){?>

                    <div class="cart-item">
                        <?php if($product['basket_item']['PICTURE']) {?>
                            <a class="cart-item__picture" href="#">
                                <img src="<?=$product['basket_item']['PICTURE']?>" alt="<?=$product['basket_item']['NAME']?>">
                            </a>
                        <?php }?>
                        <div class="cart-item__info">
                            <p class="mb-0 cart-item__title"><?=$product['basket_item']['NAME']?></p>
                            <div class="cart-item__price">
                                <p class="mb-0">
                                    <?=CurrencyFormat($product['basket_item']['PRICE'], $product['basket_item']['CURRENCY'])?>
                                </p>
                            </div>
                        </div>
                        <div class="cart-item__final-amount"><?=$product['shipment_item']->getQuantity()?></div>
                        <div class="cart-item__status"><span><?=$shipment['DELIVERY_STATUS_NAME']?></span>
                            <div class="cart-item__status-date">
                                Обновлено: <?=$order["ORDER"]["DATE_UPDATE"]->format('d/m/Y')?>
                            </div>
                        </div>
                        <p class="mb-0 cart-item__final-price">
                            <?=CurrencyFormat(
                                $product['basket_item']['PRICE'] * $product['shipment_item']->getQuantity(),
                                $product['basket_item']['CURRENCY']
                            )?>
                        </p>
                    </div>
                <?php }
            }
        }?>
    </div>
</div>
