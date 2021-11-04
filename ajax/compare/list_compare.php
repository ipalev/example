<?php require_once($_SERVER['DOCUMENT_ROOT']. "/bitrix/modules/main/include/prolog_before.php");

use Its\Lib\AjaxApiController\Compare;

header('Content-Type: application/json');

define("NO_KEEP_STATISTIC", true);

$context = Bitrix\Main\Context::getCurrent();
$compareController = new Compare($context);

$result = json_encode(
    $compareController->run(
        (string) $context->getRequest()->get('action')
    ));

ob_end_clean();

echo $result;
