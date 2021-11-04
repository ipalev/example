<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => "Осуществляет выборку изображений указанных коллекций медиабиблиотеки",
	"DESCRIPTION" => "",
	"ICON" => "/images/menu.gif",
	"PATH" => array(
		"ID" => "utility",
		"CHILD" => array(
			"ID" => "media.list",
			"NAME" => "Вывод изображений медиабиблиотеки"
		)
	),
);
