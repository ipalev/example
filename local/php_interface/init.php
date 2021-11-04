<?
use Bitrix\Main\EventManager;

require_once __DIR__ . '/../../bitrix/vendor/autoload.php';

$dotEnv = new \Symfony\Component\Dotenv\Dotenv();
$dotEnv->load(__DIR__ . '/../../.env');

\Bex\Monolog\MonologAdapter::loadConfiguration();

$emInstance = EventManager::getInstance();
require($_SERVER['DOCUMENT_ROOT'] . '/local/php_interface/event_handlers.php');
include_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/wsrubi.smtp/classes/general/wsrubismtp.php");