<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
use Bitrix\Main;
Main\Loader::includeModule('iblock');
Main\Localization\Loc::loadMessages(__DIR__.'/class.php');

$rsTypes = \Bitrix\Iblock\TypeTable::query()
    ->setSelect(['NAME' => 'LANG.NAME', 'ID'])
    ->where('LANG.LANGUAGE_ID', LANGUAGE_ID)
    ->registerRuntimeField('LANG', [
        'data_type' => '\\Bitrix\\Iblock\\TypeLanguageTable',
        'reference' => [
            '=this.ID' => 'ref.IBLOCK_TYPE_ID'
        ]
    ])->exec();

$arTypes = [];
while($type = $rsTypes->fetch()){
    $arTypes[$type['ID']] = $type['NAME'];
}

$iblocks = [];
$iblockMap = [];
if($arCurrentValues['IBLOCK_TYPE']) {
    $rsBlocks = \Bitrix\Iblock\IblockTable::query()
        ->setSelect(['CODE', 'ID', 'NAME'])
        ->where('IBLOCK_TYPE_ID', $arCurrentValues['IBLOCK_TYPE'])
        ->exec();

    while ($arBlock = $rsBlocks->fetch()) {
        $iblockMap[$arBlock['CODE']] = $arBlock['ID'];
        $iblocks[$arBlock['CODE']] = $arBlock['NAME'];
    }
}

$iblockExists = ( !empty($arCurrentValues['FORM_CODE']) && strlen($arCurrentValues['FORM_CODE']) );

$arComponentParameters = array(
    "PARAMETERS" => array(

        "IBLOCK_TYPE" => array(
            "PARENT" => "BASE",
            "NAME" => "Тип инфоблока",
            "TYPE" => "LIST",
            "REFRESH" => "Y",
            "VALUES" => $arTypes,
        ),

        "FORM_CODE" => array(
            "PARENT" => "BASE",
            "NAME" => "Код формы (инфоблока)",
            "TYPE" => "LIST",
            "REFRESH" => "Y",
            "VALUES" => $iblocks,
        ),

        "CACHE_TIME"  =>  array("DEFAULT"=>3600),
    )
);

if(strlen($arCurrentValues['FORM_CODE']) > 0) {
    $rsSections = \Bitrix\Iblock\SectionTable::query()
        ->setSelect(['CODE', 'NAME', 'IBLOCKID' => 'IBLOCK.ID'])
        ->where('IBLOCK.CODE', $arCurrentValues['FORM_CODE'])
        ->registerRuntimeField('IBLOCK', [
            'data_type' => '\\Bitrix\\Iblock\\IblockTable',
            'reference' => [
                '=this.IBLOCK_ID' => 'ref.ID'
            ]
        ])
        ->exec();
    $arSections = [];
    $arSectionIblockMap = [];
    while($sect = $rsSections->fetch()) {
        $arSectionIblockMap[$sect['CODE']] = $sect['IBLOCKID'];
        $arSections[$sect['CODE']] = $sect['NAME'];
    }

    $arMsgFields = [];
    $rsMsgFields =
        CUserTypeEntity::GetList([], ['ENTITY_ID' => 'IBLOCK_'.$arSectionIblockMap[$arCurrentValues['TYPE_CODE']].'_SECTION', 'LANG' => LANGUAGE_ID]);
    while($field = $rsMsgFields->Fetch()) $arMsgFields[$field['FIELD_NAME']] = $field['EDIT_FORM_LABEL'];

    $arComponentParameters['PARAMETERS'] = array_merge(
        $arComponentParameters['PARAMETERS'],
        [
            "TYPE_CODE" => array(
                "PARENT" => "BASE",
                "NAME" => "Код типа формы (Символьный код раздела ИБ)",
                "TYPE" => "LIST",
                "DEFAULT" => current(array_keys($arSections)),
                "VALUES" => $arSections,
            ),

            "RESP_SUCCESS_MSG_FIELD" => array(
                "PARENT" => "BASE",
                "NAME" => "Поле сообщения об успешной отправке",
                "TYPE" => "LIST",
                "VALUES" => $arMsgFields,
            ),

            "RESP_DEFAULT_ERROR_MSG_FIELD" => array(
                "PARENT" => "BASE",
                "NAME" => "Поле сообщения о неудачной отправке",
                "TYPE" => "LIST",
                "VALUES" => $arMsgFields,
            ),
        ]
    );
}

if ($iblockExists) {
    if ($iblockMap[$arCurrentValues['FORM_CODE']]) {
        $properties = \Bitrix\Iblock\PropertyTable::getList(array(
            'select' => array('NAME', 'CODE'),
            'filter' => array(
                '=IBLOCK_ID' => $iblockMap[$arCurrentValues['FORM_CODE']],
            '=ACTIVE' => 'Y',
            '=PROPERTY_TYPE' => \Bitrix\Iblock\PropertyTable::TYPE_FILE
        ),
            'order' => array('SORT' => 'ASC', 'NAME' => 'ASC')
        ))->fetchAll();
        $properties = array_combine(array_column($properties, 'CODE'), array_column($properties, 'NAME'));

        $arComponentParameters['PARAMETERS']['EVENT_FILE_PROPS'] = [
            "PARENT" => "BASE",
            "NAME" => "Отправлять по E-Mail файлы из следующих свойств",
            "TYPE" => "LIST",
            "MULTIPLE" => "Y",
            "DEFAULT" => [],
            "VALUES" => $properties,
        ];
    }
}