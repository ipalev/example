<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
use \Bitrix\Main\Localization\Loc;

return [
    'OP_CPM_READ' => [
        'title' => Loc::getMessage('ITS_CPM_SEC_OP_READ'),
    ],
    'OP_CPM_WRITE' => [
        'title' => Loc::getMessage('ITS_CPM_SEC_OP_WRITE'),
    ],
    'OP_CPM_ADMIN_READ' => [
        'title' => Loc::getMessage('ITS_CPM_SEC_OP_ADMIN_READ'),
    ],
    'OP_CPM_ADMIN_WRITE' => [
        'title' => Loc::getMessage('ITS_CPM_SEC_OP_ADMIN_WRITE'),
    ],
];