<?php use Its\Lib\SubscribeHelper;

require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

/**
 * @var CAllMain $APPLICATION
 * @var CBitrixComponent $component
 * @var array $arParams
 * @var array $arResult
 */

header("Content-Type: application/json");

$request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();
$status = [
    'success' => false,
    'error' => '',
    'message' => '',
    'data' => '',
];

if ( !$request->isPost() ) {
    $status['error'] = 'Некорректный запрос';
}

if(empty($status['error'])) {

    $result = SubscribeHelper::AddSubscriber((string) $request->get('SENDER_SUBSCRIBE_EMAIL'));

    if(!$result->isSuccess()) {
        $status['error'] = implode("\n", $result->getErrorMessages());
    } else {
        $status['success'] = true;
        $status['message'] = $result->getData()['message'] ?? 'Ok!';
    }

}

if (!$status['success'] && empty($status['error'])) $status['error'] = 'Неизвестная ошибка';

CMain::FinalActions(json_encode($status));
