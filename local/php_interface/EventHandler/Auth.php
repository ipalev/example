<?php
namespace Its\EventHandler;

use Bitrix\Main\Context;
use Bitrix\Main\EventManager;
use Its\Lib\Store\UserStore;
use Its\Lib\SubscribeHelper;

class Auth {

    public static function beforeRegister(&$fields)
    {
        $request = Context::getCurrent()->getRequest();

        // регистрирует пользователя так, чтобы вход был возможен по email
        $fields["LOGIN"] = $fields["EMAIL"];

        // нажата галка с подпиской на рассылку при риегистрации
        if($request->get('SUBSCRIBE_EMAIL')) {
            EventManager::getInstance()->addEventHandler(
                'main',
                'OnAfterUserRegister',
                [static::class, 'subscribeUserAfterRegister']
            );
        }
    }

    public static function subscribeUserAfterRegister(&$fields)
    {
        if(strlen($fields['EMAIL']) <= 0) {
            return;
        }

        $result = SubscribeHelper::AddSubscriber((string) $fields['EMAIL']);
        UserStore::setStoreData('subscribe_result', $result);
    }

    public static function loginMailReplace($arParams)
    {
        $arUser = \CUser::GetByLogin($arParams['LOGIN'])->GetNext();
        if (strpos($arParams['LOGIN'], '@') !== false && empty($arUser)) {
            $by = ['email'];
            $order = array('sort' => 'asc');
            $login = \CUser::GetList(
                $by,
                $order,
                ['EMAIL' => $arParams['LOGIN']]
            );
            $arParams['LOGIN'] = $login->GetNext()['LOGIN'];
        }
    }
}