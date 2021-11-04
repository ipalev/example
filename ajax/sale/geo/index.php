<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

use Its\Lib\AjaxApiController\Geo;

header('Content-Type: application/json');

define("NO_KEEP_STATISTIC", true);

$context = Bitrix\Main\Context::getCurrent();
$geoController = new Geo($context);

$result = json_encode(
    $geoController->run(
        (string) $context->getRequest()->get('action')
));

ob_end_clean();

echo $result;
