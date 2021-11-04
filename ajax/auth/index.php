<?php

/**
 * @var CAllMain $APPLICATION
 */

require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

use Its\Lib\AjaxApiController\Auth;

header('Content-Type: application/json');

define("NO_KEEP_STATISTIC", true);

$context = Bitrix\Main\Context::getCurrent();
$authController = new Auth($context);

$result = json_encode($authController->run(
    (string) $context->getRequest()->get('action')
));

ob_end_clean();

echo $result;
