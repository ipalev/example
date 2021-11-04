<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Type;
\Bitrix\Main\Loader::includeModule('its.partner');

global $USER;

$result = [];

if (!$USER->isAdmin()) {
    $result = [
        'success' => false,
        'errorCode' => 1,
        'errorText' => 'Access denied, only amdin'
    ];

    echo json_encode($result);
    die();
}

$summ = (int)$_POST['summ'];
$partnerId = (int)$_POST['partnerId'];
$month = (int)$_POST['month'];
$year = (int)$_POST['year'];
$dateTime = new Type\DateTime();

$data = [$summ, $partnerId, $month, $year, $dateTime];

$result = Its\Partner\PaymentTable::add([
    'UF_PAYED_SUMM' => $summ,
    'UF_PARTNER_ID' => $partnerId,
    'UF_PAYED_DATE' => $dateTime,
    'UF_MONTH' => $month,
    'UF_YEAR' => $year
]);

echo json_encode($result);
