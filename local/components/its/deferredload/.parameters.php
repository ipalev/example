<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentParameters = array(
    "PARAMETERS" => array(
        "DEFERRED_BLOCK_CODE" => array(
            "PARENT" => "BASE",
            "NAME" => "Код блока для идентификации",
            "TYPE" => "STRING",
            "VALUE" => '',
        ),
        "DISPATCH_EVENT" => array(
            "PARENT" => "BASE",
            "NAME" => "Вызывать событие после вставки контента",
            "TYPE" => "CHECKBOX",
            "DEFAULT" => "Y"
        ),
    )
);