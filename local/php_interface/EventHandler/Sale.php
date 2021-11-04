<?php
namespace Its\EventHandler;

use Bitrix\Main\EventResult;
use Bitrix\Main\Loader;
use Its\Lib\SaleHelper;

class Sale {

    public static function onRestrictionsBuildList(): EventResult
    {
        return new EventResult(EventResult::SUCCESS, [
            \Its\Lib\Geo\SaleRestrictions\MapPolygon::class => null
        ]);
    }

    public static function deleteReceiptFromEvotor($orderNum, $flag)
    {
        if (Loader::includeModule("pavelbabich.kassa") && $flag == 'Y') {
            $delOrder = \PKASSAModuleMain::GetExportOrder($orderNum);
            $url = "https://epsapi.akitorg.ru/api/v1/stores/".$delOrder['client_uuid']."/sales/delete";
            $response = \PKASSAModuleMain::cURL($url, 0, json_encode( [$delOrder] ));
            if(!SaleHelper::checkEvotorResponse($response)) {
                \CAdminNotify::Add(array(
                    'MESSAGE' => '<span style="color:red;">Не удалось удалить чек отмененного заказа в Эвотор. Проверьте статус чека в заказе №' . $orderNum . '</span>',
                ));
            }
        }
    }

    public static function sendReceiptInEvotor($orderNum, $flag)
    {
        if (Loader::includeModule("pavelbabich.kassa") && $flag == "Y") {
            $ExportOrder = \PKASSAModuleMain::GetExportOrder($orderNum);
            $response = \PKASSAModuleMain::ExportToEvotor($ExportOrder);
            if(!SaleHelper::checkEvotorResponse($response)) {
                \CAdminNotify::Add(array(
                    'MESSAGE' => '<span style="color:red;">Ошибка обработки запроса сервером Эвотор. Проверьте статус чека в заказе №' . $orderNum . '</span>',
                ));
            }
        }
    }

    public static function OnBeforeEventAddHandler(&$event, &$lid, &$arFields)
    {
        if ($event == "SALE_NEW_ORDER") {
            $orderId = $arFields["ORDER_REAL_ID"];
            if ($orderId > 0) {
                $orderDetail = \Bitrix\Sale\Order::load($orderId);
                $phones = "";

                //телефон из св-ва заказа
                $propertyCollection = $orderDetail->getPropertyCollection();
                $phoneProp = $propertyCollection->getPhone()->getValue();
                if ($phoneProp != "") {
                    $phones .= "тел. в заказе: " . $phoneProp;
                }

                // телефон из с-ва пользователя
                $orderUserId = $orderDetail->getUserId();
                $res = \Bitrix\Main\UserTable::getList(
                    array(
                        "select" => array("ID", "PERSONAL_PHONE"),
                        "filter" => array("ID" => $orderUserId),
                    )
                );
                while ($arUser = $res->fetch()) {
                    if ($arUser["PERSONAL_PHONE"] != "") {
                        $phones .= " ; тел.  пользователя: " . $arUser["PERSONAL_PHONE"];
                    }
                }
                $arFields["ORDER_PHONES"] = $phones;
            }
        }
    }
}