<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

return [
    'TSK_CPMANAGER_DENY' => [
        'title' => Loc::getMessage('ITS_CPM_SEC_TSK_DENY'),
    ],
    'TSK_CPMANAGER_OWNER_READ' => [
        'title' => Loc::getMessage('ITS_CPM_SEC_TSK_OWNER_READ'),
    ],
    'TSK_CPMANAGER_ALL_READ' => [
        'title' => Loc::getMessage('ITS_CPM_SEC_TSK_ALL_READ'),
    ],
    'TSK_CPMANAGER_OWNER_WRITE' => [
        'title' => Loc::getMessage('ITS_CPM_SEC_TSK_OWNER_WRITE'),
    ],
    'TSK_CPMANAGER_ALL_WRITE' => [
        'title' => Loc::getMessage('ITS_CPM_SEC_TSK_ALL_WRITE'),
    ],
];