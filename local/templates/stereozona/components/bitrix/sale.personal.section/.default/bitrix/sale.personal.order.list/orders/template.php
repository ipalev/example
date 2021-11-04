<?php

use Bitrix\Main\Localization\Loc;
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


$renderOrder = function(array $order) use ($arResult) {
    $statusLetter = $order['ORDER']['STATUS_ID'];
    $canceled = $order['ORDER']['CANCELED'] === 'Y';
    $status = [
        'letter' => $statusLetter,
        'title' => $canceled ? Loc::getMessage('STPOL_CANCELED') : $arResult["INFO"]["STATUS"][$statusLetter]["NAME"],
        'color' => $statusColor = SaleHelper::getStatusColor($canceled ? '' : $statusLetter),
    ];
    $orderTitle = sprintf('Заказ № %s от %s',
        $order['ORDER']['ACCOUNT_NUMBER'],
        $order['ORDER']['DATE_INSERT_FORMATED']
    );

    ob_start();
    include('include/order.template.php');
    return ob_get_clean();
};
?>
<div class="row">
    <div class="col-xl-8 col-lg-11 offset-lg-1">
        <?php if(!empty($arResult['ORDERS'])) {?>
            <div class="profile__orders-header">
                <div class="select">
                    <select class="select__input" data-placeholder="Сортировка">
                        <option onclick="goToPage('?by=DATE_INSERT');">
                            По дате
                        </option>
                        <option onclick="goToPage('?by=STATUS');">
                            По статусу
                        </option>
                    </select>
                </div>
            </div>
			<?php foreach($arResult['ORDERS'] as $order) {
			    if(array_key_exists($order['ORDER']['ID'], $arResult["ARCHIVED_ORDERS"])) {
			        continue;
                }

			    echo $renderOrder($order);
			}

			if(!empty($arResult["ARCHIVED_ORDERS"])) {
			    echo '<h4 class="profile__content-heading">Архив</h4>';

                foreach ($arResult['ARCHIVED_ORDERS'] as $order) {
                    echo $renderOrder($order);
                }
            }
        }?>
    </div>
</div>