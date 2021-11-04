<?php
use \Bitrix\Main\Localization\Loc;
use \Its\CPManager\Controller\Permission\Permission;

if (!\Bitrix\Main\Loader::includeModule('its.cpmanager')) return false;

// check rights
if($APPLICATION->GetGroupRight("its.cpmanager") <= Permission::T_DENY) return false;

$smpMenuItems = [];

if($APPLICATION->GetGroupRight("its.cpmanager") >= Permission::T_ADMIN_READ) {
    $smpMenuItems[] = [
        'section' => 'its_cpm_smp_global_proposal',
        'sort' => 1000,
        'text' => Loc::getMessage('ITS_CPM_ADMIN_MENU_SAMPLES_PROPOSAL'),
        'url' => 'its_cpmanager_sample_global_proposal.php?lang=' . LANGUAGE_ID,
        'icon' => 'iblock_menu_icon_iblocks',
        'more_url' => [],
        'items_id' => 'menu_its_cpm_smp_global_proposal',
    ];
}

// menu
return array(
    'parent_menu' => 'global_menu_its_cpmanager',
    'section' => 'its_cpm',
    'sort' => 1,
    'text' => Loc::getMessage('ITS_CPM_ADMIN_MENU_MAIN'),
    'items_id' => 'menu_its_cpm',
    'items' => [
        [
            'section' => 'its_cpm_smp',
            'sort' => 10,
            'text' => Loc::getMessage('ITS_CPM_ADMIN_MENU_SAMPLES_TITLE'),
            'icon' => 'iblock_menu_icon_settings',
            'items_id' => 'menu_its_cpm_smp',
            'items' => [
                [
                    'section' => 'its_cpm_smp_global',
                    'sort' => 100,
                    'text' => Loc::getMessage('ITS_CPM_ADMIN_MENU_SAMPLES_GLOBAL'),
                    'items_id' => 'menu_its_cpm_smp_global',
                    'items' => $smpMenuItems
                ]
            ]
        ]
    ]
);