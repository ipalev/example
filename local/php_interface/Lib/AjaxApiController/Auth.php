<?php

namespace Its\Lib\AjaxApiController;

use Bitrix\Main\Error;
use Bitrix\Main\Result;
use Its\Lib\Store\ComponentDataTransfer;
use Its\Lib\Store\UserStore;

/**
 * Class Auth
 *
 * @package Its\Lib
 */

class Auth extends AbstractController
{
    protected function authorizeAction (array $data): Result
    {
        global $APPLICATION;
        global $USER;

        if(!$USER->IsAuthorized()) {
            $result = new Result();
            $result->addError(
                new Error(
                    'Ошибка авторизации: ' .
                    (
                        $APPLICATION->arAuthResult
                        && $APPLICATION->arAuthResult["MESSAGE"] ?
                            str_replace(array("<br>", "<br />"), "\n", $APPLICATION->arAuthResult["MESSAGE"]) : ''
                    )
                )
            );

            return $result;
        }

        return new Result();
    }

    protected function registerAction(array $data): Result
    {
        global $APPLICATION;

        $APPLICATION->IncludeComponent(
            "bitrix:main.register",
            "ajax",
            Array(
                "SEF_MODE" => "N",
                "SHOW_FIELDS" => [
                    "NAME",
                    "EMAIL",
                    "PERSONAL_PHONE"
                ],
                "REQUIRED_FIELDS" => [
                    "NAME",
                    "EMAIL"
                ],
                "AUTH" => "Y",
                "USE_BACKURL" => "N",
                "SUCCESS_PAGE" => "",
                "SET_TITLE" => "Y",
                "CACHE_TYPE" => "A",
                "CACHE_TIME" => "3600"
            )
        );

        $APPLICATION->RestartBuffer();

        $result = new Result();
        $componentResult = ComponentDataTransfer::getStoreData('main_register_result');

        if(!empty($componentResult['ERRORS'])) {
            foreach($componentResult['ERRORS'] as $error){
                $result->addError(
                    new Error($error)
                );
            }

            return $result;
        }

        if(array_key_exists('USER_ID', $componentResult['VALUES']) && $componentResult['VALUES']['USER_ID'] > 0) {
            $responseData = [
                'id' => (int) $componentResult['VALUES']['USER_ID'],
                'login' => $componentResult['VALUES']['LOGIN'],
                'active' => $componentResult['VALUES']['ACTIVE'] === 'Y',
            ];

            /** @var Result $subscribeResult */
            if(
                ($subscribeResult = UserStore::getStoreData('subscribe_result'))
                && $subscribeResult instanceof Result
            ) {
                $responseData['subscription'] = [
                    'success' => $subscribeResult->isSuccess(),
                    'errors' => $subscribeResult->getErrorMessages(),
                    'message' => $subscribeResult->getData()['message'] ?? '',
                ];
            }

            $result->setData($responseData);

            return $result;
        }

        global $USER;
        if($USER->IsAuthorized()) {
            $result->addError(
                new Error('Вы уже зарегистрированы и авторизованы на сайте')
            );

            return $result;
        }

        $result->addError(
            new Error('Неизвестная ошибка. Обратитесь к администрации сайта')
        );

        return $result;
    }

    protected function changePasswordAction(array $data): Result
    {
        global $APPLICATION;

        $this->request->set('save', true);
        $_REQUEST['save'] = true;

        $APPLICATION->IncludeComponent(
            "bitrix:main.profile",
            "ajax",
            Array(
                "SET_TITLE" => 'N',
                "AJAX_MODE" => 'N',
                "SEND_INFO" => 'N',
                "CHECK_RIGHTS" => 'Y',
            ),
            false
        );

        $result = new Result;
        $componentResult = ComponentDataTransfer::getStoreData('main_profile_result');

        if($componentResult["DATA_SAVED"] !== 'Y' || $componentResult["strProfileError"]) {
            $result->addError(
                new Error($componentResult["strProfileError"] ?: 'Данные профиля не сохранены')
            );
        }

        return $result;
    }

    public static function forgotPassAction(array $data): Result
    {
        global $APPLICATION;

        $APPLICATION->IncludeComponent(
            "bitrix:main.auth.forgotpasswd",
            "ajax",
            Array()
        );

        $result = new Result;
        $componentResult = ComponentDataTransfer::getStoreData('main_forgotpass_result');

        if($componentResult['ERRORS']) {
            $result->addError(
                new Error(str_replace('<br>', '', current($componentResult['ERRORS'])))
            );
        } else {
            $result->setData(['success' => str_replace('<br>', '', $componentResult['SUCCESS'])]);
        }

        return $result;
    }

    public static function changeForgotPassAction(array $data): Result
    {
        global $APPLICATION;

        $APPLICATION->IncludeComponent(
            "bitrix:main.auth.changepasswd",
            "ajax",
            Array()
        );
        $result = new Result;
        $componentResult = ComponentDataTransfer::getStoreData('main_changepass_result');
        if($componentResult['ERRORS']) {
            $result->addError(
                new Error(str_replace('<br>', '', current($componentResult['ERRORS'])))
            );
        } else {
            $result->setData(['success' => str_replace('<br>', '', $componentResult['SUCCESS'])]);
        }
        return $result;
    }
}