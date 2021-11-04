<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
use Bitrix\Main\Localization\Loc;

\Bitrix\Main\Loader::includeModule('fileman');

$params = [];
$collections = \CMedialib::GetCollectionTree()['Collections'];

$arCollections = [];
if( is_array($collections) ) {
    $arCollections = array_combine(
        array_column($collections, 'ID'),
        array_column($collections, 'NAME')
    );
}

$arComponentParameters = array(
    "PARAMETERS" => array(

        "COLLECTIONS" => array(
            "PARENT" => "BASE",
            "NAME" => Loc::getMessage('ITS_COMPONENT_MEDIA_LIST_COLLECTION_ID'),
            "TYPE" => "LIST",
            "MULTIPLE" => "Y",
            "REFRESH" => "N",
            "VALUES" => $arCollections,
        ),

        "CACHE_TIME"  =>  array("DEFAULT" => 3600),
    )
);