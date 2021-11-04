<?php

namespace Its\Lib;

use Bitrix\Main\Context;
use Bitrix\Main\Error;
use Bitrix\Main\Result;

class SubscribeHelper
{
    public static function AddSubscriber(string $email)
    {
        global $APPLICATION;

        $request = Context::getCurrent()->getRequest();

        $request->set('sender_subscription', 'add');
        $request->set('SENDER_SUBSCRIBE_EMAIL', $email);
        $_POST['sender_subscription'] = 'add';
        $_POST['SENDER_SUBSCRIBE_EMAIL'] = $email;

        $APPLICATION->IncludeComponent(
            "bitrix:sender.subscribe",
            "ajax",
            array(
                "USE_PERSONALIZATION" => "Y",
                "CONFIRMATION" => "N",
                "SHOW_HIDDEN" => "Y",
                "AJAX_MODE" => 'Y',
                "AJAX_OPTION_JUMP" => "N",
                "AJAX_OPTION_STYLE" => "N",
                "AJAX_OPTION_HISTORY" => "N",
                "CACHE_TYPE" => "A",
                "CACHE_TIME" => "3600",
                "SET_TITLE" => "N"
            )
        );

        $APPLICATION->RestartBuffer();

        /**
         * array (
         *     'TYPE' => 'NOTE',
         *     'CODE' => 'message_success',
         *     'TEXT' => 'Вы стали подписчиком',
         * )
         */
        $componentResult = Store\ComponentDataTransfer::getStoreData('sender_subscribe_result');

        $result = new Result();

        switch ($componentResult['MESSAGE']['CODE']) {
            case 'message_confirm':
            case 'message_success':
                $result->setData([
                    'message' => $componentResult['MESSAGE']['TEXT']
                ]);
                break;
            default:
                $msg = $componentResult['MESSAGE']['TEXT'] ?: 'Ошибка обработки запроса компонентом';
                $result->addError(new Error($msg));
                break;
        }

        return $result;
    }
}