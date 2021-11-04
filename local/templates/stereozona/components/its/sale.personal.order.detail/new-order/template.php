<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CAllMain $APPLICATION
 * @var CBitrixComponent $component
 * @var array $arParams
 * @var array $arResult
 */

?>
<div class="row">
    <?php if(!empty($arResult['ERRORS'])) {?>
        <div class="col-md-6">
            <?php foreach($arResult['ERRORS'] as $errors){?>
                <p><?=implode('<br>', $errors)?></p>
            <?php }?>
        </div>
    <?php } else {?>
        <div class="col-md-6">
            <h3 class="modal__order-heading">Заказ №<?=$arResult['ACCOUNT_NUMBER']?> успешно оформлен</h3>
        </div>
        <div class="col-md-6">
            <div class="modal__order">
                <div class="modal__order-section">
                    <div class="modal__order-pictures-list">
                        <?php foreach ($arResult['RES_MOD']['ITEMS'] as $item) {
                            printf('<div class="modal__order-picture"><img src="%s" alt="%s"></div>',
                                $item['IMAGE']['PATH'],
                                $item['NAME']
                            );
                        }?>
                    </div>
                </div>
                <div class="modal__order-section">
                    <p class="font-weight-medium mb-10">Состав заказа</p>
                    <div class="modal__order-table">
                        <?php
                        $index = 0;
                        foreach ($arResult['RES_MOD']['ITEMS'] as $item) {?>
                            <div class="modal__order-table-item">
                                <div class="modal__order-table-number"><?=++$index?>.</div>
                                <div class="modal__order-table-title"><?=$item['NAME']?></div>
                                <div class="modal__order-table-price"><?=$item['PRICE_FORMATED']?></div>
                            </div>
                        <?php }?>
                    </div>
                </div>
                <div class="modal__order-section">
                    <p class="font-weight-medium mb-5">Личные данные</p>
                    <?php foreach ($arResult['RES_MOD']['ORDER_PROPS'] as $orderProp) {
                        if(in_array($orderProp['CODE'], [
                            'ORDER_LOCATION_COORD',
                            'DELIVERY_STREET',
                            'LOCATION',
                            'DELIVERY_HOUSE',
                            'ADDITIONAL_INFO'
                        ])) continue;

                        printf('<p class="mb-5">%s</p>',
                            $orderProp['VALUE']
                        );
                    }?>
                </div>
                <div class="modal__order-section">
                    <p class="mb-10">Форма и адрес доставки</p>
                    <p class="mb-5"><?=$arResult['DELIVERY']['NAME']?></p>
                    <?php
                    if($arResult['PICK-UP_ADDRESS']) {
                        printf('<p class="mb-0">%s</p>',
                               $arResult['PICK-UP_ADDRESS']
                        );
                    } elseif ($arResult['RES_MOD']['ORDER_PROPS']['DELIVERY_ADDR']['VALUE']) {
                        printf('<p class="mb-0">%s</p>',
                            $arResult['RES_MOD']['ORDER_PROPS']['DELIVERY_ADDR']['VALUE']
                        );
                    }
                    ?>
                </div>
                <div class="modal__order-section">
                    <p class="font-weight-medium mb-5">Примечание</p>
                    <?php
                    if($arResult['RES_MOD']['ORDER_PROPS']['ADDITIONAL_INFO']['VALUE']) {
                        printf('<p class="mb-0">%s</p>',
                            $arResult['RES_MOD']['ORDER_PROPS']['ADDITIONAL_INFO']['VALUE']
                        );
                    }
                    ?>
                </div>
                <div class="modal__order-section">
                    <p class="font-weight-medium mb-5">К оплате</p>
                    <h3 class="mb-0"><?=$arResult['PRICE_FORMATED']?></h3>
                </div>
            </div>
        </div>
    <?php }?>
</div>