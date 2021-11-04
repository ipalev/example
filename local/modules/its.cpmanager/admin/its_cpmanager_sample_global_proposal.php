<?php
define('ADMIN_MODULE_NAME', 'its.cpmanager');
define('ITS_SMP_PROPOSAL_GRID_ID', 'its_cpm_smp');

use Bitrix\Main\Grid\Editor\Types;
use \Bitrix\Main\Loader;
use \Bitrix\Main\Localization\Loc;
use \Bitrix\Main\ORM\Fields\FieldTypeMask;

use \Bitrix\Main\ORM\Fields\UserTypeField;
use \Its\CPManager\Utils;
use \Its\CPManager\ORM\Sample\ProposalTable;
use \Its\CPManager\Controller\Permission\Permission;
use \Its\CPManager\Controller\Sample\Proposal as Controller;

require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_admin_before.php');

Loader::includeModule('its.cpmanager');
Loc::loadMessages(__DIR__.'/menu.php');
$APPLICATION->SetTitle(Loc::getMessage('ITS_CPM_ADMIN_MENU_SAMPLES_PROPOSAL'));

if($APPLICATION->GetGroupRight("its.cpmanager") < Permission::T_ADMIN_READ) {
    $APPLICATION->AuthForm(Loc::getMessage('ADMIN_TOOLS_ACCESS_DENIED'));
}

$context = \Bitrix\Main\Application::getInstance()->getContext();
$req = $context->getRequest();


if( $req->isPost() && check_bitrix_sessid() && $req->getPost('action_button_'.ITS_SMP_PROPOSAL_GRID_ID) ) {
//    if($req->getPost('action_button_'.ITS_SMP_PROPOSAL_GRID_ID) == 'delete' && $id = $req->getPost('ID')) {
//        if(is_array($id)) {
//            foreach ($_POST["ID"] as $ID) {
//                Delete($ID);
//            }
//        }
//    }

    if($req->getPost('action_button_'.ITS_SMP_PROPOSAL_GRID_ID) == 'edit' && $elements = $req->getPost('FIELDS')) {
        if(is_array($elements)) {
            $smpProposalController = new Controller($req);
            foreach ($elements as $id => $arFields) {
                $smpProposalController->updateAction($id, $arFields);
            }

            unset($smpProposalController);
        }
   }
}

require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_admin_after.php');


//todo обернуть код ниже в компонент its:cpmanager.sample.form

$fields = [];
$userFields = [];
foreach(ProposalTable::getEntity()->getFields() as $field) {
    if(!Utils::isAllowedToSet($field)) continue;

    $fields[$field->getName()] = $field;

    if(strpos($field->getName(), 'UF_') === 0) {
        $userFields[] = $field->getName();
    }
}

if(!empty($userFields)) {
    $ufSettings = \Bitrix\Main\UserFieldLangTable::query()
        ->setSelect([
            'FIELD_NAME' => 'USER_FIELD.FIELD_NAME',
            'SETTINGS' => 'USER_FIELD.SETTINGS',
            'EDIT_FORM_LABEL'
        ])
        ->whereIn('USER_FIELD.FIELD_NAME', $userFields)
        ->whereIn('USER_FIELD.ENTITY_ID', ProposalTable::getUfId())
        ->fetchAll();
    $ufSettings = array_column($ufSettings, null, 'FIELD_NAME');
}

$columns = [];
foreach($fields as $field){
    $editable = null;

    if(!in_array($field->getName(), ['ID', 'USER_ID'])) {
        if(
            $field instanceof UserTypeField &&
            array_key_exists($field->getName(), $ufSettings) &&
            $ufSettings[$field->getName()]['SETTINGS']['ROWS'] > 1
        ) {
            $editable = [
                "TYPE" => Types::TEXTAREA
            ];
        } else {
            $editable = true;
        }
    }

    $columns[] = [
        'id' => $field->getName(),
        'name' => array_key_exists($field->getName(), $ufSettings) ?
            $ufSettings[$field->getName()]['EDIT_FORM_LABEL'] : $field->getTitle(),
        'sort' => $field->getName(),
        'default' => true,
        'editable' => $editable
    ];
}

$rows = [];

$smpProposalController = new Controller($req);
$globalProposalSample = $smpProposalController->returnSampleObjectAction(0);

if($globalProposalSample) {
    $globalProposalSample->fill(FieldTypeMask::FLAT|FieldTypeMask::USERTYPE);

    $data = [];
    foreach ($fields as $fieldCode => $field) {
        $data[$fieldCode] = $globalProposalSample->get($fieldCode);
    }

    $rows[] = [
        'data' => $data,
        'columns' => [
            'USER_ID' => $globalProposalSample->getUserId() > 0 ?
                $globalProposalSample->getUserId() : Loc::getMessage('ITS_CPM_ADMIN_UI_HEAD_NO_USER_TITLE')
        ],
        'editable' => true
    ];
}

$snippets = new \Bitrix\Main\Grid\Panel\Snippet();
$snippetItems = [];

if(true) {
    $snippetItems[] = $snippets->getEditButton();
}

$APPLICATION->IncludeComponent(
    'bitrix:main.ui.grid',
    '',
    array(
        'GRID_ID' => ITS_SMP_PROPOSAL_GRID_ID,
        'COLUMNS' => $columns,
        'ROWS' => $rows,
        'NAV_STRING' => $arResult['GRID_NAVIGATION'][$iblockId]['NAV_STRING'],
        'TOTAL_ROWS_COUNT' => 1,
        'AJAX_MODE' => 'Y',
        'AJAX_ID' => CAjax::getComponentID('bitrix:main.ui.grid', '.default', ''),
        'ENABLE_NEXT_PAGE' => true,
        'PAGE_SIZES' => [
            ['NAME' => "5", 'VALUE' => '5'],
            ['NAME' => '10', 'VALUE' => '10'],
            ['NAME' => '20', 'VALUE' => '20'],
            ['NAME' => '50', 'VALUE' => '50'],
            ['NAME' => '100', 'VALUE' => '100']
        ],
        'ACTION_PANEL' => [
            'GROUPS' => [
                'TYPE' => [
                    'ITEMS' => $snippetItems,
                ]
            ],
        ],
        'SHOW_CHECK_ALL_CHECKBOXES' => true,
        'SHOW_ROW_CHECKBOXES' => true,
        'SHOW_ROW_ACTIONS_MENU' => true,
        'SHOW_GRID_SETTINGS_MENU' => true,
        'SHOW_NAVIGATION_PANEL' => true,
        'SHOW_PAGINATION' => true,
        'SHOW_SELECTED_COUNTER' => true,
        'SHOW_TOTAL_COUNTER' => true,
        'SHOW_PAGESIZE' => true,
        'SHOW_ACTION_PANEL' => true,
        'ALLOW_COLUMNS_SORT' => true,
        'ALLOW_COLUMNS_RESIZE' => true,
        'EDITABLE' => true,
        'ALLOW_HORIZONTAL_SCROLL' => true,
        'ALLOW_SORT' => true,
        'ALLOW_PIN_HEADER' => true,
        'AJAX_OPTION_JUMP' => 'N',
        "AJAX_OPTION_HISTORY" => "N"
    )
);

require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/epilog_admin.php');