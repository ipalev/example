<?php

namespace Its\CPManager\EventHandler;

use Bitrix\Main\Localization\Loc;

class Main {

    public static function OnBuildGlobalMenu (&$aGlobalMenu, &$aModuleMenu) {
        $aGlobalMenu['global_menu_its_cpmanager'] = [
            'menu_id' => 'its_cpmanager',
            'text' => Loc::getMessage('ITS_CPM_EVENTHANDLER_MAIN_GLOBALMENU_TITLE'),
            'title' => Loc::getMessage('ITS_CPM_EVENTHANDLER_MAIN_GLOBALMENU_DESCRIPTION'),
            'sort' => 500,
            'items_id' => 'global_menu_its_cpmanager',
            'items' => [],
        ];
    }

}