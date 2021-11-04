<?php
use Bitrix\Main\Grid\Declension;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CAllMain $APPLICATION
 * @var CBitrixComponent $component
 * @var array $arParams
 * @var array $arResult
 */

$decl = new Declension('товар', 'товара', 'товаров');
$productCount = count($arResult['RES_MOD']['ITEMS']);
?>
<?php if(!empty($arResult['ERRORS'])) {?>
    <div class="col-md-6">
        <?php foreach($arResult['ERRORS'] as $errors){?>
            <p><?=implode('<br>', $errors)?></p>
        <?php }?>
    </div>
<?php } else {?>
    <h2 class="modal__title">№ <?=$arResult['ACCOUNT_NUMBER']?></h2>
    <div class="modal__order-info__heading">
        <h2><?printf('Заказ от %s', $arResult['DATE_INSERT_FORMATED']);?></h2>
    </div>
    <div class="modal__order-info__dscr">
        <p class="font-weight-medium mb-0">Условия доставки</p>
        <p>
            <?=$arResult["DELIVERY"]["NAME"]?>
            <br>
            <?=$arResult["RES_MOD"]["ORDER_PROPS"]["DELIVERY_ADDR"]["VALUE"]?>
        </p>
    </div>
    <div class="modal__order-info-payment">
        <div class="modal__order-info-payment-item">
            <p class="font-weight-medium mb-0">Способ оплаты</p>
            <p><?=$arResult['PAY_SYSTEM']['PSA_NAME']?></p>
        </div>
        <div class="modal__order-info-payment-item">
            <?php if($arResult['PAY_SYSTEM']['IS_CASH'] === 'A') {
                if(($payment = array_pop($arResult["PAYMENT"])) && $arResult['PAYED'] === 'N') {
                    echo $payment["BUFFERED_OUTPUT"];
                }
            } ?>
        </div>
    </div>
    <div class="modal__order-info-cart">
        <div class="modal__order-info-table-header"><?= $productCount . ' ' . $decl->get($productCount)?></div>
        <div class="modal__order-info-content">
            <?php
            foreach ($arResult['RES_MOD']['ITEMS'] as $item) {?>
                <div class="cart-item">
                    <a class="cart-item__picture" href="#">
                        <img src="<?=$item['IMAGE']['PATH']?>" alt="<?=$item['NAME']?>">
                    </a>
                    <div class="cart-item__info">
                        <p class="mb-0 cart-item__title"><?=$item['NAME']?></p>
                        <div class="cart-item__price">
                            <p class="mb-0"><?=$item['PRICE_FORMATED']?></p>
                        </div>
                    </div>
                    <div class="cart-item__break"></div>
                    <div class="cart-item__final-amount"><?=$item['QUANTITY']?></div>
                    <p class="mb-0 cart-item__final-price">
                        <?=CurrencyFormat($item['PRICE'] * $item['QUANTITY'], $item['CURRENCY'])?>
                    </p>
                </div>
            <?php }?>
        </div>
    </div>
    <div class="modal__order-info-footer">
        <div class="modal__order-info-overall">
            <p>Итого</p>
            <div class="modal__order-info-overall-price"><?=$arResult['PRICE_FORMATED']?></div>
        </div>
        <a class="btn btn-primary" href="#" onclick="window.Basket.repeatOrder(<?=$arResult['ID']?>)">Повторить заказ</a>
    </div>
<?php }
