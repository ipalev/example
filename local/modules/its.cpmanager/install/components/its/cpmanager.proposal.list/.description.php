<?
use \Bitrix\Main\Localization\Loc;
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => Loc::getMessage('ITS_CPM_COMPONENT_PROPOSAL_LIST_NAME'),
	"DESCRIPTION" => Loc::getMessage('ITS_CPM_COMPONENT_PROPOSAL_LIST_DESCRIPTION'),
	"PATH" => array(
		"ID" => "utility",
		"CHILD" => array(
			"ID" => "cpmanager.proposal.list",
			"NAME" => Loc::getMessage('ITS_CPM_COMPONENT_PROPOSAL_LIST_NAME')
		)
	),
);
