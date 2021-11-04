<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
use Bitrix\Main;
Main\Loader::includeModule('iblock');
Main\Localization\Loc::loadMessages(__DIR__.'/class.php');

$catalogInstalled = Main\Loader::includeModule('catalog');

$rsBlocks = \Bitrix\Iblock\IblockTable::getList();
$iblocks = [];
while($arBlock = $rsBlocks->fetch()){
    $iblocks[$arBlock['ID']] = $arBlock['NAME'];
}

if( $arCurrentValues['PRICE_INCLUDE'] == 'Y' && $catalogInstalled ) {
    $rsPrices = \Bitrix\Catalog\GroupTable::getList();
    $prices = [];
    while ($arPrice = $rsPrices->fetch()) {
        $prices[$arPrice['ID']] = $arPrice['NAME'];
    }
}

$addFields = ['created', 'shows', 'name'];
$addFieldsParams = [];
foreach($addFields as $field) $addFieldsParams[$field] = Main\Localization\Loc::getMessage('SORTING_ADD_FIELD_'.strtoupper($field));

$arComponentParameters = array(
    "PARAMETERS" => array(

        "IBLOCK_ID" => array(
            "PARENT" => "BASE",
            "NAME" => "Инфоблок-каталог",
            "TYPE" => "LIST",
            "REFRESH" => "Y",
            "VALUES" => $iblocks,
        ),

        "SORT_COOKIENAME" => array(
            "PARENT" => "BASE",
            "NAME" => "Имя куки города",
            "TYPE" => "STRING",
            "VALUE" => 'my_city',
        ),

        "ADDITIONAL_FIELDS" => array(
            "PARENT" => "BASE",
            "NAME" => "Дополниетельные поля, которые выводить в списке",
            "TYPE" => "LIST",
            "REFRESH" => "N",
            "MULTIPLE" => 'Y',
            "VALUES" => $addFieldsParams,
        ),

//        "#" => array(
//            "PARENT" => "BASE",
//            "NAME" => "#",
//            "TYPE" => "STRING",
//            "VALUE" => '',
//        ),

        "CACHE_TIME"  =>  array("DEFAULT"=>36000000),
    )
);

if($catalogInstalled) {
    $arComponentParameters['PARAMETERS']['PRICE_INCLUDE'] = array(
        "PARENT" => "BASE",
        "NAME" => "Включать в список вариантов сортировки цену",
        "TYPE" => "CHECKBOX",
        "REFRESH" => "Y",
        "DEFAULT" => 'Y',
    );
    if ($arCurrentValues['PRICE_INCLUDE'] == 'Y') {

        $arComponentParameters['PARAMETERS']['PRICE_ID'] = array(
            "PARENT" => "BASE",
            "NAME" => "Тип цены, которую выводить в списке",
            "TYPE" => "LIST",
            "REFRESH" => "Y",
            "VALUES" => $prices,
        );
    }
}