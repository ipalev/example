<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

use Its\Lib\AjaxApiController\Basket;

header('Content-Type: application/json');

define("NO_KEEP_STATISTIC", true);

$context = Bitrix\Main\Context::getCurrent();
$basketController = new Basket($context);

$result = json_encode(
    $basketController->run(
        (string) $context->getRequest()->getPost('action')
));

ob_end_clean();

echo $result;
