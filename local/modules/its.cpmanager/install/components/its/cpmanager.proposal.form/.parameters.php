<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
use \Bitrix\Main\Localization\Loc;

$arComponentParameters = array(
    "PARAMETERS" => array(

        "ELEMENTS" => array(
            'PARENT' => 'BASE',
            'NAME' => Loc::getMessage('ITS_CPM_COMPONENT_PROPOSAL_FORM_PARAM_ELEMENTS'),
            'TYPE' => 'LIST',
            'DEFAULT' => 'Y',
            'VALUES' => ['N', 'Y']
        ),
    )
);