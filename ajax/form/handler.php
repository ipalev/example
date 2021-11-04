<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

use Bitrix\Main\Application;

/** @var CAllMain $APPLICATION */

define("NO_KEEP_STATISTIC", true);

$request = Application::getInstance()->getContext()->getRequest();
$fileProps = explode(',', $request->getPost('EVENT_FILE_PROPS'));
$fileProps = is_array($fileProps) ? $fileProps : [];

$APPLICATION->IncludeComponent(
    "its:iblock.form",
    "",
    array(
        "IBLOCK_TYPE" => htmlspecialchars(trim($request->getPost('IBLOCK_TYPE'))),
        "FORM_CODE" => htmlspecialchars(trim($request->getPost('FORM_CODE'))),
        "TYPE_CODE" => htmlspecialchars(trim($request->getPost('TYPE_CODE'))),
        "EVENT_FILE_PROPS" => $fileProps,
        "CACHE_TIME" => 3600,
        "RESP_SUCCESS_MSG_FIELD" => "",
        "RESP_DEFAULT_ERROR_MSG_FIELD" => ""
    ),
    false
);
require($_SERVER['DOCUMENT_ROOT'] . BX_ROOT . '/modules/main/include/epilog_after.php');