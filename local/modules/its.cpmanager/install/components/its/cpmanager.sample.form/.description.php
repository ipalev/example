<?
use \Bitrix\Main\Localization\Loc;
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => Loc::getMessage('ITS_CPM_COMPONENT_SAMPLE_FORM_NAME'),
	"DESCRIPTION" => Loc::getMessage('ITS_CPM_COMPONENT_SAMPLE_FORM_DESCRIPTION'),
	"PATH" => array(
		"ID" => "utility",
		"CHILD" => array(
			"ID" => "cpmanager.sample.form",
			"NAME" => Loc::getMessage('ITS_CPM_COMPONENT_SAMPLE_FORM_NAME')
		)
	),
);
