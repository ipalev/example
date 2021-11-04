<?
use \Bitrix\Main\Localization\Loc;
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => Loc::getMessage('ITS_CPM_COMPONENT_PROPOSAL_COUNT_NAME'),
	"DESCRIPTION" => Loc::getMessage('ITS_CPM_COMPONENT_PROPOSAL_COUNT_DESCRIPTION'),
	"PATH" => array(
		"ID" => "utility",
		"CHILD" => array(
			"ID" => "cpmanager.proposal.count",
			"NAME" => Loc::getMessage('ITS_CPM_COMPONENT_PROPOSAL_COUNT_NAME')
		)
	),
);
