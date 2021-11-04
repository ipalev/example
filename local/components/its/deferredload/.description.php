<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => "Компонент для отложенной загрузки",
	"DESCRIPTION" => "",
	"ICON" => "/images/menu.gif",
	"PATH" => array(
		"ID" => "utility",
		"CHILD" => array(
			"ID" => "deferredload",
			"NAME" => "Отложенная загрузка"
		)
	),
);
