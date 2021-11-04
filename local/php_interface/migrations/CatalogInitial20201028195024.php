<?php

namespace Sprint\Migration;


class CatalogInitial20201028195024 extends Version
{
    protected $description = "";

    protected $moduleVersion = "3.12.17";

    /**
     * @throws Exceptions\HelperException
     * @return bool|void
     */
    public function up()
    {
        $helper = $this->getHelperManager();
        $helper->Iblock()->saveIblockType(array (
  'ID' => 'catalog',
  'SECTIONS' => 'Y',
  'EDIT_FILE_BEFORE' => '',
  'EDIT_FILE_AFTER' => '',
  'IN_RSS' => 'N',
  'SORT' => '500',
  'LANG' => 
  array (
    'ru' => 
    array (
      'NAME' => 'Каталог',
      'SECTION_NAME' => '',
      'ELEMENT_NAME' => '',
    ),
    'en' => 
    array (
      'NAME' => 'Catalog',
      'SECTION_NAME' => '',
      'ELEMENT_NAME' => '',
    ),
  ),
));
        $iblockId = $helper->Iblock()->saveIblock(array (
  'IBLOCK_TYPE_ID' => 'catalog',
  'LID' => 
  array (
    0 => 's1',
  ),
  'CODE' => 'catalog',
  'API_CODE' => 'catalog',
  'NAME' => 'Каталог',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'LIST_PAGE_URL' => '',
  'DETAIL_PAGE_URL' => '#SITE_DIR#/product/#ELEMENT_CODE#/',
  'SECTION_PAGE_URL' => '#SITE_DIR#/catalog/#SECTION_CODE_PATH#/',
  'CANONICAL_PAGE_URL' => 'https://#SERVER_NAME#/#SITE_DIR#/product/#ELEMENT_CODE#/',
  'PICTURE' => NULL,
  'DESCRIPTION' => '',
  'DESCRIPTION_TYPE' => 'text',
  'RSS_TTL' => '24',
  'RSS_ACTIVE' => 'Y',
  'RSS_FILE_ACTIVE' => 'N',
  'RSS_FILE_LIMIT' => NULL,
  'RSS_FILE_DAYS' => NULL,
  'RSS_YANDEX_ACTIVE' => 'N',
  'XML_ID' => NULL,
  'INDEX_ELEMENT' => 'Y',
  'INDEX_SECTION' => 'Y',
  'WORKFLOW' => 'N',
  'BIZPROC' => 'N',
  'SECTION_CHOOSER' => 'L',
  'LIST_MODE' => 'C',
  'RIGHTS_MODE' => 'S',
  'SECTION_PROPERTY' => 'N',
  'PROPERTY_INDEX' => 'N',
  'VERSION' => '2',
  'LAST_CONV_ELEMENT' => '0',
  'SOCNET_GROUP_ID' => NULL,
  'EDIT_FILE_BEFORE' => '',
  'EDIT_FILE_AFTER' => '',
  'SECTIONS_NAME' => 'Разделы',
  'SECTION_NAME' => 'Раздел',
  'ELEMENTS_NAME' => 'Товары',
  'ELEMENT_NAME' => 'Товар',
  'EXTERNAL_ID' => NULL,
  'LANG_DIR' => '/',
  'SERVER_NAME' => 'dev.stereozona.ru',
  'ELEMENT_ADD' => 'Добавить товар',
  'ELEMENT_EDIT' => 'Изменить товар',
  'ELEMENT_DELETE' => 'Удалить товар',
  'SECTION_ADD' => 'Добавить раздел',
  'SECTION_EDIT' => 'Изменить раздел',
  'SECTION_DELETE' => 'Удалить раздел',
));
        $helper->Iblock()->saveIblockFields($iblockId, array (
  'IBLOCK_SECTION' => 
  array (
    'NAME' => 'Привязка к разделам',
    'IS_REQUIRED' => 'N',
    'DEFAULT_VALUE' => 
    array (
      'KEEP_IBLOCK_SECTION_ID' => 'N',
    ),
  ),
  'ACTIVE' => 
  array (
    'NAME' => 'Активность',
    'IS_REQUIRED' => 'Y',
    'DEFAULT_VALUE' => 'Y',
  ),
  'ACTIVE_FROM' => 
  array (
    'NAME' => 'Начало активности',
    'IS_REQUIRED' => 'N',
    'DEFAULT_VALUE' => '',
  ),
  'ACTIVE_TO' => 
  array (
    'NAME' => 'Окончание активности',
    'IS_REQUIRED' => 'N',
    'DEFAULT_VALUE' => '',
  ),
  'SORT' => 
  array (
    'NAME' => 'Сортировка',
    'IS_REQUIRED' => 'N',
    'DEFAULT_VALUE' => '0',
  ),
  'NAME' => 
  array (
    'NAME' => 'Название',
    'IS_REQUIRED' => 'Y',
    'DEFAULT_VALUE' => '',
  ),
  'PREVIEW_PICTURE' => 
  array (
    'NAME' => 'Картинка для анонса',
    'IS_REQUIRED' => 'N',
    'DEFAULT_VALUE' => 
    array (
      'FROM_DETAIL' => 'N',
      'SCALE' => 'N',
      'WIDTH' => '',
      'HEIGHT' => '',
      'IGNORE_ERRORS' => 'N',
      'METHOD' => 'resample',
      'COMPRESSION' => 95,
      'DELETE_WITH_DETAIL' => 'N',
      'UPDATE_WITH_DETAIL' => 'N',
      'USE_WATERMARK_TEXT' => 'N',
      'WATERMARK_TEXT' => '',
      'WATERMARK_TEXT_FONT' => '',
      'WATERMARK_TEXT_COLOR' => '',
      'WATERMARK_TEXT_SIZE' => '',
      'WATERMARK_TEXT_POSITION' => 'tl',
      'USE_WATERMARK_FILE' => 'N',
      'WATERMARK_FILE' => '',
      'WATERMARK_FILE_ALPHA' => '',
      'WATERMARK_FILE_POSITION' => 'tl',
      'WATERMARK_FILE_ORDER' => NULL,
    ),
  ),
  'PREVIEW_TEXT_TYPE' => 
  array (
    'NAME' => 'Тип описания для анонса',
    'IS_REQUIRED' => 'Y',
    'DEFAULT_VALUE' => 'text',
  ),
  'PREVIEW_TEXT' => 
  array (
    'NAME' => 'Описание для анонса',
    'IS_REQUIRED' => 'N',
    'DEFAULT_VALUE' => '',
  ),
  'DETAIL_PICTURE' => 
  array (
    'NAME' => 'Детальная картинка',
    'IS_REQUIRED' => 'N',
    'DEFAULT_VALUE' => 
    array (
      'SCALE' => 'N',
      'WIDTH' => '',
      'HEIGHT' => '',
      'IGNORE_ERRORS' => 'N',
      'METHOD' => 'resample',
      'COMPRESSION' => 95,
      'USE_WATERMARK_TEXT' => 'N',
      'WATERMARK_TEXT' => '',
      'WATERMARK_TEXT_FONT' => '',
      'WATERMARK_TEXT_COLOR' => '',
      'WATERMARK_TEXT_SIZE' => '',
      'WATERMARK_TEXT_POSITION' => 'tl',
      'USE_WATERMARK_FILE' => 'N',
      'WATERMARK_FILE' => '',
      'WATERMARK_FILE_ALPHA' => '',
      'WATERMARK_FILE_POSITION' => 'tl',
      'WATERMARK_FILE_ORDER' => NULL,
    ),
  ),
  'DETAIL_TEXT_TYPE' => 
  array (
    'NAME' => 'Тип детального описания',
    'IS_REQUIRED' => 'Y',
    'DEFAULT_VALUE' => 'text',
  ),
  'DETAIL_TEXT' => 
  array (
    'NAME' => 'Детальное описание',
    'IS_REQUIRED' => 'N',
    'DEFAULT_VALUE' => '',
  ),
  'XML_ID' => 
  array (
    'NAME' => 'Внешний код',
    'IS_REQUIRED' => 'Y',
    'DEFAULT_VALUE' => '',
  ),
  'CODE' => 
  array (
    'NAME' => 'Символьный код',
    'IS_REQUIRED' => 'Y',
    'DEFAULT_VALUE' => 
    array (
      'UNIQUE' => 'Y',
      'TRANSLITERATION' => 'Y',
      'TRANS_LEN' => 100,
      'TRANS_CASE' => 'L',
      'TRANS_SPACE' => '-',
      'TRANS_OTHER' => '-',
      'TRANS_EAT' => 'Y',
      'USE_GOOGLE' => 'N',
    ),
  ),
  'TAGS' => 
  array (
    'NAME' => 'Теги',
    'IS_REQUIRED' => 'N',
    'DEFAULT_VALUE' => '',
  ),
  'SECTION_NAME' => 
  array (
    'NAME' => 'Название',
    'IS_REQUIRED' => 'Y',
    'DEFAULT_VALUE' => '',
  ),
  'SECTION_PICTURE' => 
  array (
    'NAME' => 'Картинка для анонса',
    'IS_REQUIRED' => 'N',
    'DEFAULT_VALUE' => 
    array (
      'FROM_DETAIL' => 'N',
      'SCALE' => 'N',
      'WIDTH' => '',
      'HEIGHT' => '',
      'IGNORE_ERRORS' => 'N',
      'METHOD' => 'resample',
      'COMPRESSION' => 95,
      'DELETE_WITH_DETAIL' => 'N',
      'UPDATE_WITH_DETAIL' => 'N',
      'USE_WATERMARK_TEXT' => 'N',
      'WATERMARK_TEXT' => '',
      'WATERMARK_TEXT_FONT' => '',
      'WATERMARK_TEXT_COLOR' => '',
      'WATERMARK_TEXT_SIZE' => '',
      'WATERMARK_TEXT_POSITION' => 'tl',
      'USE_WATERMARK_FILE' => 'N',
      'WATERMARK_FILE' => '',
      'WATERMARK_FILE_ALPHA' => '',
      'WATERMARK_FILE_POSITION' => 'tl',
      'WATERMARK_FILE_ORDER' => NULL,
    ),
  ),
  'SECTION_DESCRIPTION_TYPE' => 
  array (
    'NAME' => 'Тип описания',
    'IS_REQUIRED' => 'Y',
    'DEFAULT_VALUE' => 'text',
  ),
  'SECTION_DESCRIPTION' => 
  array (
    'NAME' => 'Описание',
    'IS_REQUIRED' => 'N',
    'DEFAULT_VALUE' => '',
  ),
  'SECTION_DETAIL_PICTURE' => 
  array (
    'NAME' => 'Детальная картинка',
    'IS_REQUIRED' => 'N',
    'DEFAULT_VALUE' => 
    array (
      'SCALE' => 'N',
      'WIDTH' => '',
      'HEIGHT' => '',
      'IGNORE_ERRORS' => 'N',
      'METHOD' => 'resample',
      'COMPRESSION' => 95,
      'USE_WATERMARK_TEXT' => 'N',
      'WATERMARK_TEXT' => '',
      'WATERMARK_TEXT_FONT' => '',
      'WATERMARK_TEXT_COLOR' => '',
      'WATERMARK_TEXT_SIZE' => '',
      'WATERMARK_TEXT_POSITION' => 'tl',
      'USE_WATERMARK_FILE' => 'N',
      'WATERMARK_FILE' => '',
      'WATERMARK_FILE_ALPHA' => '',
      'WATERMARK_FILE_POSITION' => 'tl',
      'WATERMARK_FILE_ORDER' => NULL,
    ),
  ),
  'SECTION_XML_ID' => 
  array (
    'NAME' => 'Внешний код',
    'IS_REQUIRED' => 'N',
    'DEFAULT_VALUE' => '',
  ),
  'SECTION_CODE' => 
  array (
    'NAME' => 'Символьный код',
    'IS_REQUIRED' => 'Y',
    'DEFAULT_VALUE' => 
    array (
      'UNIQUE' => 'Y',
      'TRANSLITERATION' => 'Y',
      'TRANS_LEN' => 100,
      'TRANS_CASE' => 'L',
      'TRANS_SPACE' => '-',
      'TRANS_OTHER' => '-',
      'TRANS_EAT' => 'Y',
      'USE_GOOGLE' => 'N',
    ),
  ),
));
    $helper->Iblock()->saveGroupPermissions($iblockId, array (
  'administrators' => 'X',
  'everyone' => 'R',
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'Изображения',
  'ACTIVE' => 'Y',
  'SORT' => '1',
  'CODE' => 'GALLERY',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'F',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'Y',
  'XML_ID' => NULL,
  'FILE_TYPE' => 'jpg, gif, bmp, png, jpeg, svg',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'vosproizvedenie-cd',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'VOSPROIZVEDENIE_CD',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => 'Есть',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'est',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'vosproizvedenie-usb',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'VOSPROIZVEDENIE_USB',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => 'Есть',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'est',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'vstroennij-predusilitel',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'VSTROENNIJ_PREDUSILITEL',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => 'Есть',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'est',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'vstroennij-usilitel-naush',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'VSTROENNIJ_USILITEL_NAUSH',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => 'Есть',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'est',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'wi-fi',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'WI_FI',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => 'Есть',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'est',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'xlr',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'XLR',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => 'Есть',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'est',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'xlr-vihod',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'XLR_VIHOD',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => 'Есть',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'est',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'yarkost',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'YARKOST',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => '1500',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1500',
    ),
    1 => 
    array (
      'VALUE' => '1800',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1800',
    ),
    2 => 
    array (
      'VALUE' => '1900',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1900',
    ),
    3 => 
    array (
      'VALUE' => '2000',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '2000',
    ),
    4 => 
    array (
      'VALUE' => '2200',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '2200',
    ),
    5 => 
    array (
      'VALUE' => '3000',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '3000',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'Автоматическиое включение/выключение',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'AVTOMATICHESKIOE_VKLYUCHENIE_VYKLYUCHENIE',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => 'Есть',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'est',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'Аксессуары',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'AKSESSUARY',
  'DEFAULT_VALUE' => 
  array (
    'TYPE' => 'HTML',
    'TEXT' => '',
  ),
  'PROPERTY_TYPE' => 'S',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => 'HTML',
  'USER_TYPE_SETTINGS' => 
  array (
    'height' => 200,
  ),
  'HINT' => '',
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'Аналоговые входы',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'ANALOGOVYE_VKHODY',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => '2 x RCA
2 x XLR',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '2_x_rca_2_x_xlr',
    ),
    1 => 
    array (
      'VALUE' => 'Есть RCA',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'est_rca',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'ВЧ-динамик',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'VCH_DINAMIK',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => '1 x AMT-1',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_x_amt_1',
    ),
    1 => 
    array (
      'VALUE' => '1 x LDR 2642 Mk II Ribbon',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_x_ldr_2642_mk_ii_ribbon',
    ),
    2 => 
    array (
      'VALUE' => '1 x LDR 2642 MKII ribbon',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_x_ldr_2642_mkii_ribbon',
    ),
    3 => 
    array (
      'VALUE' => '2 x 21 mm Soft Textile Dome',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '2_x_21_mm_soft_textile_dome',
    ),
    4 => 
    array (
      'VALUE' => '2 x 25 mm Soft Textile Dome',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '2_x_25_mm_soft_textile_dome',
    ),
    5 => 
    array (
      'VALUE' => '2 х 25 mm',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '2_kh_25_mm',
    ),
    6 => 
    array (
      'VALUE' => '20 mm Soft Textile Dome',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '20_mm_soft_textile_dome',
    ),
    7 => 
    array (
      'VALUE' => '25 mm',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '25_mm',
    ),
    8 => 
    array (
      'VALUE' => '25 mm Soft Textile Dome',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '25_mm_soft_textile_dome',
    ),
    9 => 
    array (
      'VALUE' => '25 мм, TNV Al/Mg с инвертированным куполом',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '25_mm_tnv_al_mg_s_invertirovannym_kupolom',
    ),
    10 => 
    array (
      'VALUE' => 'C111 coaxial ribbon',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'c111_coaxial_ribbon',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'ВЧ/СЧ',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'VCH_SCH',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => '1 x C1 Coaxial ribbon twitter',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_x_c1_coaxial_ribbon_twitter',
    ),
    1 => 
    array (
      'VALUE' => '1 x C2 Coaxial ribbon twitter',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_x_c2_coaxial_ribbon_twitter',
    ),
    2 => 
    array (
      'VALUE' => '1 x C211 Coaxial ribbon',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_x_c211_coaxial_ribbon',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'ВЧ/СЧ-динамик',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'VCH_SCH_DINAMIK',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => '1 x C1 Coaxial Ribbon',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_x_c1_coaxial_ribbon',
    ),
    1 => 
    array (
      'VALUE' => '4 x Line Source Drivers 111',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '4_x_line_source_drivers_111',
    ),
    2 => 
    array (
      'VALUE' => '4 x LSD Line Sourсe Driver',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '4_x_lsd_line_sourse_driver',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'ВЧ/СЧ-динамики',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'VCH_SCH_DINAMIKI',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'S',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'Варианты отделки',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'VARIANTY_OTDELKI',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'S',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'Вес (грамм)',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'VES_GRAMM',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'S',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'Вес (кг)',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'VES_KG',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'S',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'Внешний диаметр (мм)',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'VNESHNIY_DIAMETR_MM',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'S',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'Внешний размер (мм)',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'VNESHNIY_RAZMER_MM',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'S',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'Возможная модернизация',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'VOZMOZHNAYA_MODERNIZATSIYA',
  'DEFAULT_VALUE' => 
  array (
    'TEXT' => '',
    'TYPE' => 'HTML',
  ),
  'PROPERTY_TYPE' => 'S',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => 'HTML',
  'USER_TYPE_SETTINGS' => 
  array (
    'height' => 200,
  ),
  'HINT' => '',
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'Воспроизводящая игла',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'VOSPROIZVODYASHCHAYA_IGLA',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'S',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'Время автономной работы',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'VREMYA_AVTONOMNOY_RABOTY',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'S',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'Входы',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'VKHODY',
  'DEFAULT_VALUE' => 
  array (
    'TEXT' => '',
    'TYPE' => 'HTML',
  ),
  'PROPERTY_TYPE' => 'S',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => 'HTML',
  'USER_TYPE_SETTINGS' => 
  array (
    'height' => 200,
  ),
  'HINT' => '',
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'Входы/выходы',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'VKHODY_VYKHODY',
  'DEFAULT_VALUE' => 
  array (
    'TEXT' => '',
    'TYPE' => 'HTML',
  ),
  'PROPERTY_TYPE' => 'S',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => 'HTML',
  'USER_TYPE_SETTINGS' => 
  array (
    'height' => 200,
  ),
  'HINT' => '',
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'Выход на сабвуфер',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'VYKHOD_NA_SABVUFER',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => 'Есть',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'est',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'Диаметр монтажного отверстия (мм)',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'DIAMETR_MONTAZHNOGO_OTVERSTIYA_MM',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => '195 мм',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '195_mm',
    ),
    1 => 
    array (
      'VALUE' => '210 мм',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '210_mm',
    ),
    2 => 
    array (
      'VALUE' => '210,8 мм',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '210_8_mm',
    ),
    3 => 
    array (
      'VALUE' => '210,82 мм',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '210_82_mm',
    ),
    4 => 
    array (
      'VALUE' => '241 мм',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '241_mm',
    ),
    5 => 
    array (
      'VALUE' => '246 мм',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '246_mm',
    ),
    6 => 
    array (
      'VALUE' => '246,38 мм',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '246_38_mm',
    ),
    7 => 
    array (
      'VALUE' => '301',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '301',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'Динамическая податливость',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'DINAMICHESKAYA_PODATLIVOST',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'S',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'Доп. возможности',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'DOP_VOZMOZHNOSTI',
  'DEFAULT_VALUE' => 
  array (
    'TEXT' => '',
    'TYPE' => 'HTML',
  ),
  'PROPERTY_TYPE' => 'S',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => 'HTML',
  'USER_TYPE_SETTINGS' => 
  array (
    'height' => 200,
  ),
  'HINT' => '',
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'Доп. особенности',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'DOP_OSOBENNOSTI',
  'DEFAULT_VALUE' => 
  array (
    'TEXT' => '',
    'TYPE' => 'HTML',
  ),
  'PROPERTY_TYPE' => 'S',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => 'HTML',
  'USER_TYPE_SETTINGS' => 
  array (
    'height' => 200,
  ),
  'HINT' => '',
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'Дополнительно',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'DOPOLNITELNO',
  'DEFAULT_VALUE' => 
  array (
    'TEXT' => '',
    'TYPE' => 'HTML',
  ),
  'PROPERTY_TYPE' => 'S',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => 'HTML',
  'USER_TYPE_SETTINGS' => 
  array (
    'height' => 200,
  ),
  'HINT' => '',
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'Дополнительные аксессуары',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'DOPOLNITELNYE_AKSESSUARY',
  'DEFAULT_VALUE' => 
  array (
    'TEXT' => '',
    'TYPE' => 'HTML',
  ),
  'PROPERTY_TYPE' => 'S',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => 'HTML',
  'USER_TYPE_SETTINGS' => 
  array (
    'height' => 200,
  ),
  'HINT' => '',
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'Дополнительные аксессуары (опционально)',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'DOPOLNITELNYE_AKSESSUARY_OPTSIONALNO',
  'DEFAULT_VALUE' => 
  array (
    'TEXT' => '',
    'TYPE' => 'HTML',
  ),
  'PROPERTY_TYPE' => 'S',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => 'HTML',
  'USER_TYPE_SETTINGS' => 
  array (
    'height' => 200,
  ),
  'HINT' => '',
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'Дополнительные опции',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'DOPOLNITELNYE_OPTSII',
  'DEFAULT_VALUE' => 
  array (
    'TEXT' => '',
    'TYPE' => 'HTML',
  ),
  'PROPERTY_TYPE' => 'S',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => 'HTML',
  'USER_TYPE_SETTINGS' => 
  array (
    'height' => 200,
  ),
  'HINT' => '',
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'Дополнительные особенности',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'DOPOLNITELNYE_OSOBENNOSTI',
  'DEFAULT_VALUE' => 
  array (
    'TEXT' => '',
    'TYPE' => 'HTML',
  ),
  'PROPERTY_TYPE' => 'S',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => 'HTML',
  'USER_TYPE_SETTINGS' => 
  array (
    'height' => 200,
  ),
  'HINT' => '',
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'Дополнительные характеристики',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'DOPOLNITELNYE_KHARAKTERISTIKI',
  'DEFAULT_VALUE' => 
  array (
    'TEXT' => '',
    'TYPE' => 'HTML',
  ),
  'PROPERTY_TYPE' => 'S',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => 'HTML',
  'USER_TYPE_SETTINGS' => 
  array (
    'height' => 200,
  ),
  'HINT' => '',
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'Драйверы',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'DRAYVERY',
  'DEFAULT_VALUE' => 
  array (
    'TEXT' => '',
    'TYPE' => 'HTML',
  ),
  'PROPERTY_TYPE' => 'S',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => 'HTML',
  'USER_TYPE_SETTINGS' => 
  array (
    'height' => 200,
  ),
  'HINT' => '',
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'Импеданс головки',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'IMPEDANS_GOLOVKI',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'S',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'Количество полос',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'KOLICHESTVO_POLOS',
  'DEFAULT_VALUE' => 
  array (
    'TEXT' => '',
    'TYPE' => 'HTML',
  ),
  'PROPERTY_TYPE' => 'S',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => 'HTML',
  'USER_TYPE_SETTINGS' => 
  array (
    'height' => 200,
  ),
  'HINT' => '',
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'Комплектация',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'KOMPLEKTATSIYA',
  'DEFAULT_VALUE' => 
  array (
    'TEXT' => '',
    'TYPE' => 'HTML',
  ),
  'PROPERTY_TYPE' => 'S',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => 'HTML',
  'USER_TYPE_SETTINGS' => 
  array (
    'height' => 200,
  ),
  'HINT' => '',
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'Кроссовер',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'KROSSOVER',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => '110 Гц нерегулируемый',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '110_gts_nereguliruemyy',
    ),
    1 => 
    array (
      'VALUE' => '2800 Гц',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '2800_gts',
    ),
    2 => 
    array (
      'VALUE' => '2900 Гц',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '2900_gts',
    ),
    3 => 
    array (
      'VALUE' => '3.500 Гц',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '3_500_gts',
    ),
    4 => 
    array (
      'VALUE' => '3.600 Гц
Высококачественный кроссовер с 3-кратной регулировкой уровня для высоких частот',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '3_600_gts_vysokokachestvennyy_krossover_s_3_kratnoy_regulirovkoy_urovnya_dlya_vysokikh_chastot',
    ),
    5 => 
    array (
      'VALUE' => '3.600 Гц',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '3_600_gts',
    ),
    6 => 
    array (
      'VALUE' => '3.800 Гц',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '3_800_gts',
    ),
    7 => 
    array (
      'VALUE' => '3000 Гц',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '3000_gts',
    ),
    8 => 
    array (
      'VALUE' => '3300 Гц',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '3300_gts',
    ),
    9 => 
    array (
      'VALUE' => '38 – 110 Гц (регулируемый)',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '38_110_gts_reguliruemyy',
    ),
    10 => 
    array (
      'VALUE' => '40...120 Гц регулируемый',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '40_120_gts_reguliruemyy',
    ),
    11 => 
    array (
      'VALUE' => '400 / 3.500 Гц',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '400_3_500_gts',
    ),
    12 => 
    array (
      'VALUE' => '4000 Гц',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '4000_gts',
    ),
    13 => 
    array (
      'VALUE' => '45...120 Гц регулируемый',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '45_120_gts_reguliruemyy',
    ),
    14 => 
    array (
      'VALUE' => '45...200 Гц регулируемый',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '45_200_gts_reguliruemyy',
    ),
    15 => 
    array (
      'VALUE' => '50 - 150 Гц регулируемый',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '50_150_gts_reguliruemyy',
    ),
    16 => 
    array (
      'VALUE' => '50 ... 200 Гц (регулируемый)',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'ef42c048052115d5948e9086415138d5',
    ),
    17 => 
    array (
      'VALUE' => '50...200 Гц регулируемый',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '50_200_gts_reguliruemyy',
    ),
    18 => 
    array (
      'VALUE' => '55 ... 200 Гц (регулируемый)',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '55_200_gts_reguliruemyy',
    ),
    19 => 
    array (
      'VALUE' => '55...200 Гц регулируемый',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '81f6f4ed6998a7d63095b795b4727aac',
    ),
    20 => 
    array (
      'VALUE' => 'Регулируемый от 50 до 200 Гц',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'reguliruemyy_ot_50_do_200_gts',
    ),
    21 => 
    array (
      'VALUE' => 'Регулируемый от 55 до 200 Гц',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'reguliruemyy_ot_55_do_200_gts',
    ),
    22 => 
    array (
      'VALUE' => 'Регулируемый от 80 до 200 Гц',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'reguliruemyy_ot_80_do_200_gts',
    ),
    23 => 
    array (
      'VALUE' => 'ФНЧ 40 - 160 Гц, 12 дБ/окт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'fnch_40_160_gts_12_db_okt',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'Линейные входы',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'LINEYNYE_VKHODY',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => 'Стерео/моно (LFE)',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'stereo_mono_lfe',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'Материал иглодержателя',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'MATERIAL_IGLODERZHATELYA',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => 'алюминиевый',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'alyuminievyy',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'Материал катушки',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'MATERIAL_KATUSHKI',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => 'медная (6N)',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'mednaya_6n',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'Материал отделки',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'MATERIAL_OTDELKI',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => 'Винил',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'vinil',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'Многоканальное окружающее звучание',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'MNOGOKANALNOE_OKRUZHAYUSHCHEE_ZVUCHANIE',
  'DEFAULT_VALUE' => 
  array (
    'TEXT' => '',
    'TYPE' => 'HTML',
  ),
  'PROPERTY_TYPE' => 'S',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => 'HTML',
  'USER_TYPE_SETTINGS' => 
  array (
    'height' => 200,
  ),
  'HINT' => '',
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'Мощность',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'MOSHCHNOST',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => '100 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '100_vt',
    ),
    1 => 
    array (
      'VALUE' => '125 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '125_vt',
    ),
    2 => 
    array (
      'VALUE' => '150 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '150_vt',
    ),
    3 => 
    array (
      'VALUE' => '175 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '175_vt',
    ),
    4 => 
    array (
      'VALUE' => '200 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '200_vt',
    ),
    5 => 
    array (
      'VALUE' => '200 Вт RMS при 8 Ом',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '200_vt_rms_pri_8_om',
    ),
    6 => 
    array (
      'VALUE' => '200 Вт. Два усилителя в классе A/B с линейным блоком питания мощностью 2×50 Вт в каждой колонке (2×100 Вт)',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '200_vt_dva_usilitelya_v_klasse_a_b_s_lineynym_blokom_pitaniya_moshchnostyu_2_50_vt_v_kazhdoy_kolonke',
    ),
    7 => 
    array (
      'VALUE' => '300 Вт RMS при 8 Ом',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '300_vt_rms_pri_8_om',
    ),
    8 => 
    array (
      'VALUE' => '40 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '40_vt',
    ),
    9 => 
    array (
      'VALUE' => '65 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '65_vt',
    ),
    10 => 
    array (
      'VALUE' => '75 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '75_vt',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'Мощность (номинальная/музыкальная)',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'MOSHCHNOST_NOMINALNAYA_MUZYKALNAYA',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => '100/180 Ватт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '100_180_vatt',
    ),
    1 => 
    array (
      'VALUE' => '120/200 Ватт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '120_200_vatt',
    ),
    2 => 
    array (
      'VALUE' => '2 x 60 / 110 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '2_x_60_110_vt',
    ),
    3 => 
    array (
      'VALUE' => '2 x 60 / 120 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '2_x_60_120_vt',
    ),
    4 => 
    array (
      'VALUE' => '50 / 100 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '50_100_vt',
    ),
    5 => 
    array (
      'VALUE' => '50/100 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'db988c059fd0b1e643fc9c02da285684',
    ),
    6 => 
    array (
      'VALUE' => '60 / 110 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '60_110_vt',
    ),
    7 => 
    array (
      'VALUE' => '60 / 120 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '60_120_vt',
    ),
    8 => 
    array (
      'VALUE' => '60/120 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'fc2faeeca97f73ef95240a86164c939d',
    ),
    9 => 
    array (
      'VALUE' => '70/140 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '70_140_vt',
    ),
    10 => 
    array (
      'VALUE' => '80 / 150 Ватт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '80_150_vatt',
    ),
    11 => 
    array (
      'VALUE' => '80/130 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '80_130_vt',
    ),
    12 => 
    array (
      'VALUE' => '90 / 140 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '90_140_vt',
    ),
    13 => 
    array (
      'VALUE' => '90 / 160 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '90_160_vt',
    ),
    14 => 
    array (
      'VALUE' => '90/140 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1d1a72fdb156bdf0b6999b8faff27d5d',
    ),
    15 => 
    array (
      'VALUE' => '90/160 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'ff4c478a09e51af3e7637b419344d998',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'Мощность встроенного усилителя (ном./макс.)',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'MOSHCHNOST_VSTROENNOGO_USILITELYA_NOM_MAKS_',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => '200/250 Ватт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '200_250_vatt',
    ),
    1 => 
    array (
      'VALUE' => '300 / 450 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '300_450_vt',
    ),
    2 => 
    array (
      'VALUE' => '500/750 Ватт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '500_750_vatt',
    ),
    3 => 
    array (
      'VALUE' => '60/120 Ватт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '60_120_vatt',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'Мощность на канал (6 Ом) Вт',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'MOSHCHNOST_NA_KANAL_6_OM_VT',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => '120',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '120',
    ),
    1 => 
    array (
      'VALUE' => '125',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '125',
    ),
    2 => 
    array (
      'VALUE' => '135',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '135',
    ),
    3 => 
    array (
      'VALUE' => '140',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '140',
    ),
    4 => 
    array (
      'VALUE' => '145',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '145',
    ),
    5 => 
    array (
      'VALUE' => '150',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '150',
    ),
    6 => 
    array (
      'VALUE' => '165',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '165',
    ),
    7 => 
    array (
      'VALUE' => '180',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '180',
    ),
    8 => 
    array (
      'VALUE' => '185',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '185',
    ),
    9 => 
    array (
      'VALUE' => '85',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '85',
    ),
    10 => 
    array (
      'VALUE' => '90',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '90',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'Мощность номинальная/максимальная',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'MOSHCHNOST_NOMINALNAYA_MAKSIMALNAYA',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => '100/160 Ватт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '100_160_vatt',
    ),
    1 => 
    array (
      'VALUE' => '145 / 265 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '145_265_vt',
    ),
    2 => 
    array (
      'VALUE' => '160/280 Ватт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '160_280_vatt',
    ),
    3 => 
    array (
      'VALUE' => '170 / 300 Ватт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '170_300_vatt',
    ),
    4 => 
    array (
      'VALUE' => '200/300 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '200_300_vt',
    ),
    5 => 
    array (
      'VALUE' => '40 / 100 Ватт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '40_100_vatt',
    ),
    6 => 
    array (
      'VALUE' => '65 / 110 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '65_110_vt',
    ),
    7 => 
    array (
      'VALUE' => '70 / 120 Ватт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '70_120_vatt',
    ),
    8 => 
    array (
      'VALUE' => '80/150 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '80_150_vt',
    ),
    9 => 
    array (
      'VALUE' => '85 / 150 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '85_150_vt',
    ),
    10 => 
    array (
      'VALUE' => '90/150 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '90_150_vt',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'Мощность номинальная/музыкальная',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'MOSHCHNOST_NOMINALNAYA_MUZYKALNAYA1',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => '100 / 160 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '100_160_vt',
    ),
    1 => 
    array (
      'VALUE' => '100 / 200 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '100_200_vt',
    ),
    2 => 
    array (
      'VALUE' => '100 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '100_vt',
    ),
    3 => 
    array (
      'VALUE' => '100 Вт /150 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '100_vt_150_vt',
    ),
    4 => 
    array (
      'VALUE' => '110 / 160 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '110_160_vt',
    ),
    5 => 
    array (
      'VALUE' => '110 / 170 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '110_170_vt',
    ),
    6 => 
    array (
      'VALUE' => '110 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '110_vt',
    ),
    7 => 
    array (
      'VALUE' => '110/150 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '110_150_vt',
    ),
    8 => 
    array (
      'VALUE' => '120 / 180 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '120_180_vt',
    ),
    9 => 
    array (
      'VALUE' => '120 / 220 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '120_220_vt',
    ),
    10 => 
    array (
      'VALUE' => '120 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '120_vt',
    ),
    11 => 
    array (
      'VALUE' => '125 / 250 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '125_250_vt',
    ),
    12 => 
    array (
      'VALUE' => '130 / 200 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '130_200_vt',
    ),
    13 => 
    array (
      'VALUE' => '135 Вт /200 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '135_vt_200_vt',
    ),
    14 => 
    array (
      'VALUE' => '140 / 200 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '140_200_vt',
    ),
    15 => 
    array (
      'VALUE' => '150 / 200 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '150_200_vt',
    ),
    16 => 
    array (
      'VALUE' => '150 / 320 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '150_320_vt',
    ),
    17 => 
    array (
      'VALUE' => '150 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '150_vt',
    ),
    18 => 
    array (
      'VALUE' => '150 Вт максимальная',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '150_vt_maksimalnaya',
    ),
    19 => 
    array (
      'VALUE' => '150/250 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '150_250_vt',
    ),
    20 => 
    array (
      'VALUE' => '150/300 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '150_300_vt',
    ),
    21 => 
    array (
      'VALUE' => '160 / 320 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '160_320_vt',
    ),
    22 => 
    array (
      'VALUE' => '170 / 220 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '170_220_vt',
    ),
    23 => 
    array (
      'VALUE' => '170 / 320 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '170_320_vt',
    ),
    24 => 
    array (
      'VALUE' => '180 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '180_vt',
    ),
    25 => 
    array (
      'VALUE' => '2 x 125 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '2_x_125_vt',
    ),
    26 => 
    array (
      'VALUE' => '2 x 20 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '2_x_20_vt',
    ),
    27 => 
    array (
      'VALUE' => '2 x 25 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '2_x_25_vt',
    ),
    28 => 
    array (
      'VALUE' => '2 x 40 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '2_x_40_vt',
    ),
    29 => 
    array (
      'VALUE' => '2 x 40 Вт (твитеры)
2 x 40 Вт (СЧ-динамики)
1 x 80 Вт (НЧ-драйвер)',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '2_x_40_vt_tvitery_2_x_40_vt_sch_dinamiki_1_x_80_vt_nch_drayver',
    ),
    30 => 
    array (
      'VALUE' => '2 x 40 Вт/ 2 x 80 Вт максимальная',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '2_x_40_vt_2_x_80_vt_maksimalnaya',
    ),
    31 => 
    array (
      'VALUE' => '2 x 50 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '2_x_50_vt',
    ),
    32 => 
    array (
      'VALUE' => '2 х 30 Вт + 1 х 60 Вт (сабвуфер)',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '2_kh_30_vt_1_kh_60_vt_sabvufer',
    ),
    33 => 
    array (
      'VALUE' => '200 / 250 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '200_250_vt',
    ),
    34 => 
    array (
      'VALUE' => '200 / 280 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '200_280_vt',
    ),
    35 => 
    array (
      'VALUE' => '200 / 330 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '200_330_vt',
    ),
    36 => 
    array (
      'VALUE' => '200 / 350 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '200_350_vt',
    ),
    37 => 
    array (
      'VALUE' => '200 / 380 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '200_380_vt',
    ),
    38 => 
    array (
      'VALUE' => '200 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '200_vt',
    ),
    39 => 
    array (
      'VALUE' => '200 Вт максимальная',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '200_vt_maksimalnaya',
    ),
    40 => 
    array (
      'VALUE' => '200/280 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '4ffba2a11b2813e133c67ac1f47e8ffe',
    ),
    41 => 
    array (
      'VALUE' => '200/350 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '9db7b531b123d10d578bbd5d550c26b3',
    ),
    42 => 
    array (
      'VALUE' => '200/400 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '200_400_vt',
    ),
    43 => 
    array (
      'VALUE' => '215/450 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '215_450_vt',
    ),
    44 => 
    array (
      'VALUE' => '220 / 350 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '220_350_vt',
    ),
    45 => 
    array (
      'VALUE' => '230 / 380 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '230_380_vt',
    ),
    46 => 
    array (
      'VALUE' => '250 / 400 Ватт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '250_400_vatt',
    ),
    47 => 
    array (
      'VALUE' => '250 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '250_vt',
    ),
    48 => 
    array (
      'VALUE' => '250 Вт максимальная',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '250_vt_maksimalnaya',
    ),
    49 => 
    array (
      'VALUE' => '3 x 40 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '3_x_40_vt',
    ),
    50 => 
    array (
      'VALUE' => '3 канала по 75 Вт / 300 Вт (пиковая)',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '3_kanala_po_75_vt_300_vt_pikovaya',
    ),
    51 => 
    array (
      'VALUE' => '300 / 500 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '300_500_vt',
    ),
    52 => 
    array (
      'VALUE' => '300 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '300_vt',
    ),
    53 => 
    array (
      'VALUE' => '300/450 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '300_450_vt',
    ),
    54 => 
    array (
      'VALUE' => '300/500 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'd71f37f1e014abebf4cfda1edb4b61a5',
    ),
    55 => 
    array (
      'VALUE' => '320 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '320_vt',
    ),
    56 => 
    array (
      'VALUE' => '4 x 25 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '4_x_25_vt',
    ),
    57 => 
    array (
      'VALUE' => '400 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '400_vt',
    ),
    58 => 
    array (
      'VALUE' => '400/800 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '400_800_vt',
    ),
    59 => 
    array (
      'VALUE' => '400/850 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '400_850_vt',
    ),
    60 => 
    array (
      'VALUE' => '45 / 100 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '45_100_vt',
    ),
    61 => 
    array (
      'VALUE' => '450 / 500 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '450_500_vt',
    ),
    62 => 
    array (
      'VALUE' => '450 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '450_vt',
    ),
    63 => 
    array (
      'VALUE' => '5 x 50 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '5_x_50_vt',
    ),
    64 => 
    array (
      'VALUE' => '50 / 100 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '3d0fd6b88c0d18f78aaa52d3f01d02fc',
    ),
    65 => 
    array (
      'VALUE' => '50 / 120 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '50_120_vt',
    ),
    66 => 
    array (
      'VALUE' => '50/100 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '50_100_vt',
    ),
    67 => 
    array (
      'VALUE' => '50/150 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '50_150_vt',
    ),
    68 => 
    array (
      'VALUE' => '500 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '500_vt',
    ),
    69 => 
    array (
      'VALUE' => '500 Вт максимальная',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '500_vt_maksimalnaya',
    ),
    70 => 
    array (
      'VALUE' => '500/750 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '500_750_vt',
    ),
    71 => 
    array (
      'VALUE' => '56 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '56_vt',
    ),
    72 => 
    array (
      'VALUE' => '6 x 50 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '6_x_50_vt',
    ),
    73 => 
    array (
      'VALUE' => '60 / 100 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '60_100_vt',
    ),
    74 => 
    array (
      'VALUE' => '60 / 110 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '60_110_vt',
    ),
    75 => 
    array (
      'VALUE' => '60 / 120 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '60_120_vt',
    ),
    76 => 
    array (
      'VALUE' => '60 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '60_vt',
    ),
    77 => 
    array (
      'VALUE' => '60 Вт /120 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '60_vt_120_vt',
    ),
    78 => 
    array (
      'VALUE' => '65 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '65_vt',
    ),
    79 => 
    array (
      'VALUE' => '70 / 130 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '70_130_vt',
    ),
    80 => 
    array (
      'VALUE' => '70 / 140 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '70_140_vt',
    ),
    81 => 
    array (
      'VALUE' => '70/150 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '70_150_vt',
    ),
    82 => 
    array (
      'VALUE' => '80 / 140 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '80_140_vt',
    ),
    83 => 
    array (
      'VALUE' => '85 / 140 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '85_140_vt',
    ),
    84 => 
    array (
      'VALUE' => '90 / 140 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '90_140_vt',
    ),
    85 => 
    array (
      'VALUE' => '90 / 150 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '90_150_vt',
    ),
    86 => 
    array (
      'VALUE' => 'Сателлиты: 100 Вт максимальная
Сабвуфер: 100 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'satellity_100_vt_maksimalnaya_sabvufer_100_vt',
    ),
    87 => 
    array (
      'VALUE' => 'Сателлиты: 200 Вт максимальная
Сабвуфер: 200 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'satellity_200_vt_maksimalnaya_sabvufer_200_vt',
    ),
    88 => 
    array (
      'VALUE' => 'Фронт: 100 Вт
Центр: 100 Вт
Тыл: 100 Вт
Сабвуфер: 100 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'front_100_vt_tsentr_100_vt_tyl_100_vt_sabvufer_100_vt',
    ),
    89 => 
    array (
      'VALUE' => 'Фронт: 100 Вт
Центр: 100 Вт
Тыл: 100 Вт
Сабвуфер: 120 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'front_100_vt_tsentr_100_vt_tyl_100_vt_sabvufer_120_vt',
    ),
    90 => 
    array (
      'VALUE' => 'Фронт: 120 Вт
Центр: 120 Вт
Тыл: 120 Вт
Сабвуфер: 120 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'front_120_vt_tsentr_120_vt_tyl_120_vt_sabvufer_120_vt',
    ),
    91 => 
    array (
      'VALUE' => 'Фронт: 200 Вт максимальная
Центр и тыл: 200 Вт максимальная
Сабвуфер: 200 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'front_200_vt_maksimalnaya_tsentr_i_tyl_200_vt_maksimalnaya_sabvufer_200_vt',
    ),
    92 => 
    array (
      'VALUE' => 'Фронт: 25-120 Вт рекомендованная
Центр: 25-100 Вт рекомендованная
Тыл: 20-60 Вт рекомендованная',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'front_25_120_vt_rekomendovannaya_tsentr_25_100_vt_rekomendovannaya_tyl_20_60_vt_rekomendovannaya',
    ),
    93 => 
    array (
      'VALUE' => 'Фронт: 50 / 100 Вт
Центр: 60 / 120 Вт
Тыл: 50 / 100 Вт
Сабвуфер: 60 / 120 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'front_50_100_vt_tsentr_60_120_vt_tyl_50_100_vt_sabvufer_60_120_vt',
    ),
    94 => 
    array (
      'VALUE' => 'Фронт: 70 / 120 Вт
Центр: 50 / 100 Вт
Сателлиты: 45 / 100 Вт
Сабвуфер: 120 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'front_70_120_vt_tsentr_50_100_vt_satellity_45_100_vt_sabvufer_120_vt',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'Мощность усилителя',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'MOSHCHNOST_USILITELYA',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => '2 x 13.5 Вт (Класс D)',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '2_x_13_5_vt_klass_d',
    ),
    1 => 
    array (
      'VALUE' => '2 x 8.5 Вт (Класс D)',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '2_x_8_5_vt_klass_d',
    ),
    2 => 
    array (
      'VALUE' => '2x 6.5 Вт (Класс D)',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '2x_6_5_vt_klass_d',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'НЧ-динамик',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'NCH_DINAMIK1',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => '1 x 10" диффузор из углеволокна ( активный )
2 x 10" диффузор из углеволокна ( пассивные )',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_x_10_diffuzor_iz_uglevolokna_aktivnyy_2_x_10_diffuzor_iz_uglevolokna_passivnye_',
    ),
    1 => 
    array (
      'VALUE' => '1 x 10" диффузор из углеволокна ( активный )',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_x_10_diffuzor_iz_uglevolokna_aktivnyy_',
    ),
    2 => 
    array (
      'VALUE' => '1 x 110 mm, Aluminium',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_x_110_mm_aluminium',
    ),
    3 => 
    array (
      'VALUE' => '1 x 12" диффузор из алюминия',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_x_12_diffuzor_iz_alyuminiya',
    ),
    4 => 
    array (
      'VALUE' => '1 x 14" диффузор из алюминия',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_x_14_diffuzor_iz_alyuminiya',
    ),
    5 => 
    array (
      'VALUE' => '1 x 160 mm (6\'\'), Aluminum (Wave surround)',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_x_160_mm_6_aluminum_wave_surround',
    ),
    6 => 
    array (
      'VALUE' => '1 x 160 mm UHQD',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_x_160_mm_uhqd',
    ),
    7 => 
    array (
      'VALUE' => '1 x 165 мм.
2 x 190 мм. (пассивные)',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_x_165_mm_2_x_190_mm_passivnye',
    ),
    8 => 
    array (
      'VALUE' => '1 x 180 mm (7\'\'), Aluminum (Wave surround)',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_x_180_mm_7_aluminum_wave_surround',
    ),
    9 => 
    array (
      'VALUE' => '1 x 200 мм + 1 x 200 мм пассивный',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_x_200_mm_1_x_200_mm_passivnyy',
    ),
    10 => 
    array (
      'VALUE' => '1 x 200 мм.',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_x_200_mm',
    ),
    11 => 
    array (
      'VALUE' => '1 x 203 мм.',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_x_203_mm',
    ),
    12 => 
    array (
      'VALUE' => '1 x 220 mm (8.7\'\'), Aluminum',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_x_220_mm_8_7_aluminum',
    ),
    13 => 
    array (
      'VALUE' => '1 x 220 mm (8.7\'\'), Aluminum (Wave surround)
1 x 220 mm (8.7\'\'), Aluminum (пассивный радиатор в пол)',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_x_220_mm_8_7_aluminum_wave_surround_1_x_220_mm_8_7_aluminum_passivnyy_radiator_v_pol',
    ),
    14 => 
    array (
      'VALUE' => '1 x 220 mm (8.7\'\'), Cellulose/graphite',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_x_220_mm_8_7_cellulose_graphite',
    ),
    15 => 
    array (
      'VALUE' => '1 x 220 мм, алюминий',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_x_220_mm_alyuminiy',
    ),
    16 => 
    array (
      'VALUE' => '1 x 250 мм + 1 x 250 мм пассивный',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_x_250_mm_1_x_250_mm_passivnyy',
    ),
    17 => 
    array (
      'VALUE' => '1 x 250 мм.',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_x_250_mm',
    ),
    18 => 
    array (
      'VALUE' => '1 x 254 мм.',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_x_254_mm',
    ),
    19 => 
    array (
      'VALUE' => '1 x 300 мм',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'c0330a4bd9c4e4c5da05ac4020d142d7',
    ),
    20 => 
    array (
      'VALUE' => '1 x 300 мм.',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_x_300_mm',
    ),
    21 => 
    array (
      'VALUE' => '1 x 310 mm (12.2\'\'), Aluminum (Wave surround)',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_x_310_mm_12_2_aluminum_wave_surround',
    ),
    22 => 
    array (
      'VALUE' => '1 x 310 мм, титан (активный)
1 x 310 мм, титан (пассивный)',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_x_310_mm_titan_aktivnyy_1_x_310_mm_titan_passivnyy',
    ),
    23 => 
    array (
      'VALUE' => '1 x 380 мм.',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_x_380_mm',
    ),
    24 => 
    array (
      'VALUE' => '1 x 8" диффузор из волокнистой бумаги',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_x_8_diffuzor_iz_voloknistoy_bumagi',
    ),
    25 => 
    array (
      'VALUE' => '1 x 9" диффузор из алюминия',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_x_9_diffuzor_iz_alyuminiya',
    ),
    26 => 
    array (
      'VALUE' => '1 х 27 см (11") с диффузором Polyglass',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_kh_27_sm_11_s_diffuzorom_polyglass',
    ),
    27 => 
    array (
      'VALUE' => '100 мм бумажный',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '100_mm_bumazhnyy',
    ),
    28 => 
    array (
      'VALUE' => '110 мм',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '110_mm',
    ),
    29 => 
    array (
      'VALUE' => '120-мм',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '120_mm',
    ),
    30 => 
    array (
      'VALUE' => '130 мм спрессованных сэндвич-драйвер из керамики и алюминия',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '130_mm_spressovannykh_sendvich_drayver_iz_keramiki_i_alyuminiya',
    ),
    31 => 
    array (
      'VALUE' => '130 мм, Polyglass (целлюлозная пульпа с покрытием микро-шариками стекла)',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '130_mm_polyglass_tsellyuloznaya_pulpa_s_pokrytiem_mikro_sharikami_stekla',
    ),
    32 => 
    array (
      'VALUE' => '170-мм',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '170_mm',
    ),
    33 => 
    array (
      'VALUE' => '180 мм',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '180_mm',
    ),
    34 => 
    array (
      'VALUE' => '2 x 100 mm (4\'\')',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '2_x_100_mm_4_',
    ),
    35 => 
    array (
      'VALUE' => '2 x 100 mm (4\'\'), активные
2 x 100 mm (4\'\'), пассивные радиаторы',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '2_x_100_mm_4_aktivnye_2_x_100_mm_4_passivnye_radiatory',
    ),
    36 => 
    array (
      'VALUE' => '2 x 110 mm, Aluminium',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '2_x_110_mm_aluminium',
    ),
    37 => 
    array (
      'VALUE' => '2 x 160 mm (6\'\'), Aluminum (Wave surround)',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '2_x_160_mm_6_aluminum_wave_surround',
    ),
    38 => 
    array (
      'VALUE' => '2 x 160 mm UHQD
2 x 160 mm UHQD passive',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '2_x_160_mm_uhqd_2_x_160_mm_uhqd_passive',
    ),
    39 => 
    array (
      'VALUE' => '2 x 170-мм',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '2_x_170_mm',
    ),
    40 => 
    array (
      'VALUE' => '2 x 170-мм НЧ-динамики',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '2_x_170_mm_nch_dinamiki',
    ),
    41 => 
    array (
      'VALUE' => '2 x 18 cm UHQD basses
2 x 18 cm UHQD passive radiators',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '2_x_18_cm_uhqd_basses_2_x_18_cm_uhqd_passive_radiators',
    ),
    42 => 
    array (
      'VALUE' => '2 x 180 mm (7\'\'), Aluminum (Wave surround)',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '2_x_180_mm_7_aluminum_wave_surround',
    ),
    43 => 
    array (
      'VALUE' => '2 x 200 mm (7\'\'), Aluminum (Wave surround)',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '2_x_200_mm_7_aluminum_wave_surround',
    ),
    44 => 
    array (
      'VALUE' => '2 x 200 mm (8\'\'), Aluminum (Wave surround)',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '2_x_200_mm_8_aluminum_wave_surround',
    ),
    45 => 
    array (
      'VALUE' => '2 x 200 mm НЧ-динамики',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '2_x_200_mm_nch_dinamiki',
    ),
    46 => 
    array (
      'VALUE' => '2 x 220 mm (9\'\'), Aluminum (Wave surround)',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '2_x_220_mm_9_aluminum_wave_surround',
    ),
    47 => 
    array (
      'VALUE' => '2 x 220 mm UHQD
2 x 220 mm UHQD passive',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '2_x_220_mm_uhqd_2_x_220_mm_uhqd_passive',
    ),
    48 => 
    array (
      'VALUE' => '2 x 220 мм UHQD
2 x 220 мм UHQD пассивных излучателя',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '2_x_220_mm_uhqd_2_x_220_mm_uhqd_passivnykh_izluchatelya',
    ),
    49 => 
    array (
      'VALUE' => '2 x 3.5” Aluminium Cone With Cloth Cap Wave-Surround 2 x 73 x 52 mm Steel Cone (passive)',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '2_x_3_5_aluminium_cone_with_cloth_cap_wave_surround_2_x_73_x_52_mm_steel_cone_passive',
    ),
    50 => 
    array (
      'VALUE' => '2 x 5.25" диффузор из бумаги, армированной древесными волокнами',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '2_x_5_25_diffuzor_iz_bumagi_armirovannoy_drevesnymi_voloknami',
    ),
    51 => 
    array (
      'VALUE' => '2 x 80 mm (3\'\'), aluminum',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '2_x_80_mm_3_aluminum',
    ),
    52 => 
    array (
      'VALUE' => '2 x 87 мм x 46 мм, металл, waveurround (пассивные)',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '2_x_87_mm_x_46_mm_metall_waveurround_passivnye',
    ),
    53 => 
    array (
      'VALUE' => '2 по 61/2" (16.5cm) Polyglass',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '2_po_61_2_16_5cm_polyglass',
    ),
    54 => 
    array (
      'VALUE' => '2 х 22 см MDS®',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '2_kh_22_sm_mds',
    ),
    55 => 
    array (
      'VALUE' => '2 х 22 см MOM®',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '2_kh_22_sm_mom',
    ),
    56 => 
    array (
      'VALUE' => '2 х 26 см MDS®',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '2_kh_26_sm_mds',
    ),
    57 => 
    array (
      'VALUE' => '2 х 8см',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '2_kh_8sm',
    ),
    58 => 
    array (
      'VALUE' => '2×100 мм бумажный',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '2_100_mm_bumazhnyy',
    ),
    59 => 
    array (
      'VALUE' => '200 мм',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '200_mm',
    ),
    60 => 
    array (
      'VALUE' => '200 мм + 1 x 200 мм пассивный радиатор',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '200_mm_1_x_200_mm_passivnyy_radiator',
    ),
    61 => 
    array (
      'VALUE' => '200 мм c мощной магнитной системой и длинным ходом',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '200_mm_c_moshchnoy_magnitnoy_sistemoy_i_dlinnym_khodom',
    ),
    62 => 
    array (
      'VALUE' => '200 х 80 мм. 2 шт.',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '200_kh_80_mm_2_sht',
    ),
    63 => 
    array (
      'VALUE' => '210 мм',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '210_mm',
    ),
    64 => 
    array (
      'VALUE' => '220 мм',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '220_mm',
    ),
    65 => 
    array (
      'VALUE' => '260 мм',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '260_mm',
    ),
    66 => 
    array (
      'VALUE' => '2x130 мм, конус прессованный из сплава алюминия',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '2x130_mm_konus_pressovannyy_iz_splava_alyuminiya',
    ),
    67 => 
    array (
      'VALUE' => '2х260 мм',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '2kh260_mm',
    ),
    68 => 
    array (
      'VALUE' => '3 x 125 mm НЧ-динамики',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '3_x_125_mm_nch_dinamiki',
    ),
    69 => 
    array (
      'VALUE' => '300 мм',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '300_mm',
    ),
    70 => 
    array (
      'VALUE' => '300 мм + 1 x 300 мм пассивный радиатор',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '300_mm_1_x_300_mm_passivnyy_radiator',
    ),
    71 => 
    array (
      'VALUE' => '4 x 100 mm (4\'\')',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '4_x_100_mm_4_',
    ),
    72 => 
    array (
      'VALUE' => '4 x 110 mm (4.3"), Aluminium (Wave-Surround)',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '4_x_110_mm_4_3_aluminium_wave_surround',
    ),
    73 => 
    array (
      'VALUE' => '4”',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '4',
    ),
    74 => 
    array (
      'VALUE' => '5 х 220 мм MOM®',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '5_kh_220_mm_mom',
    ),
    75 => 
    array (
      'VALUE' => '5.25" диффузор из бумаги, армированной древесными волокнами',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '5_25_diffuzor_iz_bumagi_armirovannoy_drevesnymi_voloknami',
    ),
    76 => 
    array (
      'VALUE' => '5”',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '5',
    ),
    77 => 
    array (
      'VALUE' => '61/2" (16.5cm) Polyglass',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '61_2_16_5cm_polyglass',
    ),
    78 => 
    array (
      'VALUE' => '75 mm',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '75_mm',
    ),
    79 => 
    array (
      'VALUE' => 'Subwoofer: 1 x 220 mm (9\'\')',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'subwoofer_1_x_220_mm_9_',
    ),
    80 => 
    array (
      'VALUE' => 'Алюминиевые 2 х 20см',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'alyuminievye_2_kh_20sm',
    ),
    81 => 
    array (
      'VALUE' => 'Алюминиевый 1 x 220 mm (8.7\'\'), (Wave surround)
1 x 220 мм, пассивный излучатель',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'alyuminievyy_1_x_220_mm_8_7_wave_surround_1_x_220_mm_passivnyy_izluchatel',
    ),
    82 => 
    array (
      'VALUE' => 'Алюминиевый 1 x 220 mm (8.7\'\'), (Wave surround)',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'alyuminievyy_1_x_220_mm_8_7_wave_surround',
    ),
    83 => 
    array (
      'VALUE' => 'алюминиевый 1 x 260 mm (10.2\'\'), (Wave surround)
1 х 260 мм, пассивный излучатель',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'alyuminievyy_1_x_260_mm_10_2_wave_surround_1_kh_260_mm_passivnyy_izluchatel',
    ),
    84 => 
    array (
      'VALUE' => 'алюминиевый 1 x 260 mm (10.2\'\'), (Wave surround)',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'alyuminievyy_1_x_260_mm_10_2_wave_surround',
    ),
    85 => 
    array (
      'VALUE' => 'Алюминиевый 1 x 310 mm (12.2\'\'), (Wave surround)
Алюминиевый 1 x 310 mm (12.2\'\'), пассивный излучатель',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'alyuminievyy_1_x_310_mm_12_2_wave_surround_alyuminievyy_1_x_310_mm_12_2_passivnyy_izluchatel',
    ),
    86 => 
    array (
      'VALUE' => 'Алюминиевый НЧ динамик 20см',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'alyuminievyy_nch_dinamik_20sm',
    ),
    87 => 
    array (
      'VALUE' => 'Алюминиевый НЧ динамик 22 см. + пассивный излучатель 22 см.',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'alyuminievyy_nch_dinamik_22_sm_passivnyy_izluchatel_22_sm',
    ),
    88 => 
    array (
      'VALUE' => 'пассивный металлический 2 x 105x70 mm (4.1"x2.8") Wave-Surround (passive)',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'passivnyy_metallicheskiy_2_x_105x70_mm_4_1_x2_8_wave_surround_passive',
    ),
    89 => 
    array (
      'VALUE' => 'пассивный металлический 2 x 85 mmx35 mm (3.3" x 1.4") Wave-Surround (passive)',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'passivnyy_metallicheskiy_2_x_85_mmx35_mm_3_3_x_1_4_wave_surround_passive',
    ),
    90 => 
    array (
      'VALUE' => 'Титановые 2 х 18см',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'titanovye_2_kh_18sm',
    ),
    91 => 
    array (
      'VALUE' => 'Титановый НЧ динамик 31 см. + пассивный излучатель 31 см.',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'titanovyy_nch_dinamik_31_sm_passivnyy_izluchatel_31_sm',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'НЧ/СЧ-динамик',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'NCH_SCH_DINAMIK',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => '1 x 110 mm (4\'\'), aluminum',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_x_110_mm_4_aluminum',
    ),
    1 => 
    array (
      'VALUE' => '1 x 110 mm (4\'\'), Aluminum (Wave surround)',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_x_110_mm_4_aluminum_wave_surround',
    ),
    2 => 
    array (
      'VALUE' => '1 x 110 mm, Aluminium',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_x_110_mm_aluminium',
    ),
    3 => 
    array (
      'VALUE' => '1 x 120 мм MDS',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_x_120_mm_mds',
    ),
    4 => 
    array (
      'VALUE' => '1 x 130 mm (5\'\'), aluminum',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_x_130_mm_5_aluminum',
    ),
    5 => 
    array (
      'VALUE' => '1 x 130 mm (5\'\'), Aluminum (Wave surround)',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_x_130_mm_5_aluminum_wave_surround',
    ),
    6 => 
    array (
      'VALUE' => '1 x 133 мм диффузор из бумаги, армированной древесными волокнами',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_x_133_mm_diffuzor_iz_bumagi_armirovannoy_drevesnymi_voloknami',
    ),
    7 => 
    array (
      'VALUE' => '1 x 133 мм СЧ диффузор из бумаги, армированной древесными волокнами
1 x 305 мм НЧ диффузор из бумаги, армированной древесными волокнами',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_x_133_mm_sch_diffuzor_iz_bumagi_armirovannoy_drevesnymi_voloknami_1_x_305_mm_nch_diffuzor_iz_bumag',
    ),
    8 => 
    array (
      'VALUE' => '1 x 135 mm (5\'\'), aluminum',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_x_135_mm_5_aluminum',
    ),
    9 => 
    array (
      'VALUE' => '1 x 135 mm, ceramic',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_x_135_mm_ceramic',
    ),
    10 => 
    array (
      'VALUE' => '1 x 140 mm MDS',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_x_140_mm_mds',
    ),
    11 => 
    array (
      'VALUE' => '1 x 160 mm (6\'\'), Aluminium',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_x_160_mm_6_aluminium',
    ),
    12 => 
    array (
      'VALUE' => '1 x 160 mm (6\'\'), Aluminum',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_x_160_mm_6_aluminum',
    ),
    13 => 
    array (
      'VALUE' => '1 x 160 mm (6\'\'), Titanium (Wave surround)',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_x_160_mm_6_titanium_wave_surround',
    ),
    14 => 
    array (
      'VALUE' => '1 x 160 mm (6"), aluminium (Wavesurround)',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_x_160_mm_6_aluminium_wavesurround',
    ),
    15 => 
    array (
      'VALUE' => '1 x 165 mm (6), aluminium',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_x_165_mm_6_aluminium',
    ),
    16 => 
    array (
      'VALUE' => '1 x 165 mm, aluminium',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_x_165_mm_aluminium',
    ),
    17 => 
    array (
      'VALUE' => '1 x 165 mm, ceramic',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_x_165_mm_ceramic',
    ),
    18 => 
    array (
      'VALUE' => '1 x 165 мм диффузор из бумаги, армированной древесными волокнами',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_x_165_mm_diffuzor_iz_bumagi_armirovannoy_drevesnymi_voloknami',
    ),
    19 => 
    array (
      'VALUE' => '1 x 178 мм диффузор из бумаги, армированной древесными волокнами
пассивные излучатели 2 x 178 мм',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_x_178_mm_diffuzor_iz_bumagi_armirovannoy_drevesnymi_voloknami_passivnye_izluchateli_2_x_178_mm',
    ),
    20 => 
    array (
      'VALUE' => '1 x 180 mm (7\'\'), Aluminum',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_x_180_mm_7_aluminum',
    ),
    21 => 
    array (
      'VALUE' => '1 x 180 mm (7\'\'), Aluminum (Wave surround)',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_x_180_mm_7_aluminum_wave_surround',
    ),
    22 => 
    array (
      'VALUE' => '1 x 180 mm (7\'\'), алюминий
1 x 180 mm (7\'\'), алюминий (пассивный)',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_x_180_mm_7_alyuminiy_1_x_180_mm_7_alyuminiy_passivnyy',
    ),
    23 => 
    array (
      'VALUE' => '1 x 180 mm Aluminium',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_x_180_mm_aluminium',
    ),
    24 => 
    array (
      'VALUE' => '1 x 200 мм диффузор из бумаги, армированной древесными волокнами
1 x 255 мм диффузор из углеволокон',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_x_200_mm_diffuzor_iz_bumagi_armirovannoy_drevesnymi_voloknami_1_x_255_mm_diffuzor_iz_uglevolokon',
    ),
    25 => 
    array (
      'VALUE' => '1 x 200 мм диффузор из бумаги, армированной древесными волокнами',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_x_200_mm_diffuzor_iz_bumagi_armirovannoy_drevesnymi_voloknami',
    ),
    26 => 
    array (
      'VALUE' => '1 x 210 mm (8\'\'), ceramic',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_x_210_mm_8_ceramic',
    ),
    27 => 
    array (
      'VALUE' => '1 x 210 mm, aluminium',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_x_210_mm_aluminium',
    ),
    28 => 
    array (
      'VALUE' => '1 x 210 mm, ceramic',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_x_210_mm_ceramic',
    ),
    29 => 
    array (
      'VALUE' => '1 x 210 мм (8 \'\'), алюминий',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_x_210_mm_8_alyuminiy',
    ),
    30 => 
    array (
      'VALUE' => '1 x 5,25" полипропиленовый диффузор',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_x_5_25_polipropilenovyy_diffuzor',
    ),
    31 => 
    array (
      'VALUE' => '1 x 6.5" полипропиленовый диффузор',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_x_6_5_polipropilenovyy_diffuzor',
    ),
    32 => 
    array (
      'VALUE' => '1 x 8" полипропиленовый диффузор',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_x_8_polipropilenovyy_diffuzor',
    ),
    33 => 
    array (
      'VALUE' => '1 x 80 mm (3\'\'), aluminum',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_x_80_mm_3_aluminum',
    ),
    34 => 
    array (
      'VALUE' => '1 х 10 см MDS®',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_kh_10_sm_mds',
    ),
    35 => 
    array (
      'VALUE' => '1 х 13 см MDS®',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_kh_13_sm_mds',
    ),
    36 => 
    array (
      'VALUE' => '1 х 135 мм (5 \'\'), алюминий',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_kh_135_mm_5_alyuminiy',
    ),
    37 => 
    array (
      'VALUE' => '1 х 135 мм, алюминий',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_kh_135_mm_alyuminiy',
    ),
    38 => 
    array (
      'VALUE' => '1 х 165 мм (6 \'\') керамика',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_kh_165_mm_6_keramika',
    ),
    39 => 
    array (
      'VALUE' => '1 х 165 мм (6 \'\'), алюминий',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_kh_165_mm_6_alyuminiy',
    ),
    40 => 
    array (
      'VALUE' => '1 х 18 см MDS®',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_kh_18_sm_mds',
    ),
    41 => 
    array (
      'VALUE' => '1 х 18 см MOM®',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_kh_18_sm_mom',
    ),
    42 => 
    array (
      'VALUE' => '100 мм бумажный',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '100_mm_bumazhnyy',
    ),
    43 => 
    array (
      'VALUE' => '100 мм. Polyglass диффузор ',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '100_mm_polyglass_diffuzor_',
    ),
    44 => 
    array (
      'VALUE' => '100 мм. композитный диффузор Flax',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '100_mm_kompozitnyy_diffuzor_flax',
    ),
    45 => 
    array (
      'VALUE' => '110 мм композитный сплав',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '110_mm_kompozitnyy_splav',
    ),
    46 => 
    array (
      'VALUE' => '110 мм, конус из прессованного сплава алюминия, неодимовый магнит Underhung, двойная звуковая катушка',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '110_mm_konus_iz_pressovannogo_splava_alyuminiya_neodimovyy_magnit_underhung_dvoynaya_zvukovaya_katush',
    ),
    47 => 
    array (
      'VALUE' => '110-мм',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '110_mm',
    ),
    48 => 
    array (
      'VALUE' => '120-мм',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '120_mm',
    ),
    49 => 
    array (
      'VALUE' => '125 мм – прессованный алюминий с керамическим конусом',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '125_mm_pressovannyy_alyuminiy_s_keramicheskim_konusom',
    ),
    50 => 
    array (
      'VALUE' => '125-мм (5")',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '125_mm_5_',
    ),
    51 => 
    array (
      'VALUE' => '130 mm MDS',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '130_mm_mds',
    ),
    52 => 
    array (
      'VALUE' => '130 мм среднечастотный динамик из прессованного алюминия',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '130_mm_srednechastotnyy_dinamik_iz_pressovannogo_alyuminiya',
    ),
    53 => 
    array (
      'VALUE' => '130 мм.',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '130_mm',
    ),
    54 => 
    array (
      'VALUE' => '130 мм. Polyflex диффузор 
100 мм. Dolby Atmos',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '130_mm_polyflex_diffuzor_100_mm_dolby_atmos',
    ),
    55 => 
    array (
      'VALUE' => '130 мм. Polyflex диффузор ',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '130_mm_polyflex_diffuzor_',
    ),
    56 => 
    array (
      'VALUE' => '160 мм композитный сплав',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '160_mm_kompozitnyy_splav',
    ),
    57 => 
    array (
      'VALUE' => '160-мм',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '160_mm',
    ),
    58 => 
    array (
      'VALUE' => '165 mm MDS',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '165_mm_mds',
    ),
    59 => 
    array (
      'VALUE' => '165 мм диффузор Polyglass',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '165_mm_diffuzor_polyglass',
    ),
    60 => 
    array (
      'VALUE' => '165 мм.',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '165_mm',
    ),
    61 => 
    array (
      'VALUE' => '165 мм. Polyglass диффузор ',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '165_mm_polyglass_diffuzor_',
    ),
    62 => 
    array (
      'VALUE' => '165 мм. композитный диффузор "W"',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '165_mm_kompozitnyy_diffuzor_w',
    ),
    63 => 
    array (
      'VALUE' => '165 мм. композитный диффузор Flax',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '165_mm_kompozitnyy_diffuzor_flax',
    ),
    64 => 
    array (
      'VALUE' => '170-мм',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '170_mm',
    ),
    65 => 
    array (
      'VALUE' => '2 x 100 mm, MDS',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '2_x_100_mm_mds',
    ),
    66 => 
    array (
      'VALUE' => '2 x 100 мм MDS',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'a3c6079ad11ba9ab08ef6fba7d70d721',
    ),
    67 => 
    array (
      'VALUE' => '2 x 120 mm MDS',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '2_x_120_mm_mds',
    ),
    68 => 
    array (
      'VALUE' => '2 x 125 мм',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '2_x_125_mm',
    ),
    69 => 
    array (
      'VALUE' => '2 x 130 mm (5\'\'), Aluminum',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '2_x_130_mm_5_aluminum',
    ),
    70 => 
    array (
      'VALUE' => '2 x 130 mm (5\'\'), Aluminum (Wave surround)',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '2_x_130_mm_5_aluminum_wave_surround',
    ),
    71 => 
    array (
      'VALUE' => '2 x 130 mm (7\'\'), алюминий
2 x 130 mm (7\'\'), алюминий (пассивный)',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '2_x_130_mm_7_alyuminiy_2_x_130_mm_7_alyuminiy_passivnyy',
    ),
    72 => 
    array (
      'VALUE' => '2 x 130 mm, MDS',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '2_x_130_mm_mds',
    ),
    73 => 
    array (
      'VALUE' => '2 x 133 мм диффузор из бумаги, армированной древесными волокнами',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '2_x_133_mm_diffuzor_iz_bumagi_armirovannoy_drevesnymi_voloknami',
    ),
    74 => 
    array (
      'VALUE' => '2 x 180 mm (7\'\'), алюминий
2 x 180 mm (7\'\'), алюминий (пассивный)',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '2_x_180_mm_7_alyuminiy_2_x_180_mm_7_alyuminiy_passivnyy',
    ),
    75 => 
    array (
      'VALUE' => '2 x 200 мм диффузор из бумаги, армированной древесными волокнами
2 x 255 мм диффузор из углеволокон',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '2_x_200_mm_diffuzor_iz_bumagi_armirovannoy_drevesnymi_voloknami_2_x_255_mm_diffuzor_iz_uglevolokon',
    ),
    76 => 
    array (
      'VALUE' => '2 x 5" (13cm) Polyglass
1 х 8" (21cm) Polyglass passive radiator',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '2_x_5_13cm_polyglass_1_kh_8_21cm_polyglass_passive_radiator',
    ),
    77 => 
    array (
      'VALUE' => '2 по 61/2" (16.5cm) Polyglass',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '2_po_61_2_16_5cm_polyglass',
    ),
    78 => 
    array (
      'VALUE' => '2 х 10 см MDS®',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '2_kh_10_sm_mds',
    ),
    79 => 
    array (
      'VALUE' => '2 х 13 см MDS®',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '2_kh_13_sm_mds',
    ),
    80 => 
    array (
      'VALUE' => '2 х 130 мм СЧ/НЧ динамика из прессованного алюминия',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '2_kh_130_mm_sch_nch_dinamika_iz_pressovannogo_alyuminiya',
    ),
    81 => 
    array (
      'VALUE' => '2 х 135 мм (5 \'\'), алюминий',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '2_kh_135_mm_5_alyuminiy',
    ),
    82 => 
    array (
      'VALUE' => '2 х 16 cm UHQD® bass',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '2_kh_16_cm_uhqd_bass',
    ),
    83 => 
    array (
      'VALUE' => '2 х 18 см MDS®',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '2_kh_18_sm_mds',
    ),
    84 => 
    array (
      'VALUE' => '2 х 18 см MOM®',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '2_kh_18_sm_mom',
    ),
    85 => 
    array (
      'VALUE' => '200-мм',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '200_mm',
    ),
    86 => 
    array (
      'VALUE' => '210 мм.',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '210_mm',
    ),
    87 => 
    array (
      'VALUE' => '210 мм. композитный диффузор Flax',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '210_mm_kompozitnyy_diffuzor_flax',
    ),
    88 => 
    array (
      'VALUE' => '2x130 мм. Polyflex диффузор ',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '2x130_mm_polyflex_diffuzor_',
    ),
    89 => 
    array (
      'VALUE' => '2x5" (13cm) Polyglass',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '2x5_13cm_polyglass',
    ),
    90 => 
    array (
      'VALUE' => '2х165 мм, Polyglass (целлюлозная пульпа с покрытием микро-шариками стекла)',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '2kh165_mm_polyglass_tsellyuloznaya_pulpa_s_pokrytiem_mikro_sharikami_stekla',
    ),
    91 => 
    array (
      'VALUE' => '3 x 100 мм MDS',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '3_x_100_mm_mds',
    ),
    92 => 
    array (
      'VALUE' => '3 x 120 мм MDS',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '3_x_120_mm_mds',
    ),
    93 => 
    array (
      'VALUE' => '4 х 13 cm MDS® НЧ динамики
1 х 13 cm MDS® СЧ динамик',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '4_kh_13_cm_mds_nch_dinamiki_1_kh_13_cm_mds_sch_dinamik',
    ),
    94 => 
    array (
      'VALUE' => '5" (13cm) Polyglass',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '5_13cm_polyglass',
    ),
    95 => 
    array (
      'VALUE' => '61/2" (16,5cm) Polyglass',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '61_2_16_5cm_polyglass',
    ),
    96 => 
    array (
      'VALUE' => '61/2" (16,5cm) Polyglass двойная звуковая катушка',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '61_2_16_5cm_polyglass_dvoynaya_zvukovaya_katushka',
    ),
    97 => 
    array (
      'VALUE' => '8" (21cm) Polyglass',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '8_21cm_polyglass',
    ),
    98 => 
    array (
      'VALUE' => '8см.',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '8sm',
    ),
    99 => 
    array (
      'VALUE' => 'NEW 2 x 140 mm MDS',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'new_2_x_140_mm_mds',
    ),
    100 => 
    array (
      'VALUE' => 'керамика 2 x 135 мм (5 \'\')',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'keramika_2_x_135_mm_5_',
    ),
    101 => 
    array (
      'VALUE' => 'полипропилен 1 x 115 mm (5\'\')',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'polipropilen_1_x_115_mm_5_',
    ),
    102 => 
    array (
      'VALUE' => 'полипропилен 1 x 165 mm (6\'\')',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'polipropilen_1_x_165_mm_6_',
    ),
    103 => 
    array (
      'VALUE' => 'полипропилен 1 x 200 mm (8\'\')',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'polipropilen_1_x_200_mm_8_',
    ),
    104 => 
    array (
      'VALUE' => 'полипропилен 1 x 200 мм (8 \'\')',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'eb65fcaeee3c54305beac33cc17ca9eb',
    ),
    105 => 
    array (
      'VALUE' => 'полипропилен 1 х 115 мм (4,5 \'\')',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'polipropilen_1_kh_115_mm_4_5_',
    ),
    106 => 
    array (
      'VALUE' => 'полипропилен 2 x 115 мм (4,5 \'\')',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'polipropilen_2_x_115_mm_4_5_',
    ),
    107 => 
    array (
      'VALUE' => 'Сателлиты: 1 x 100 mm (4\'\'), Polyglass
Сабвуфер: 1 x 210 mm (8\'\'), Polyflex',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'satellity_1_x_100_mm_4_polyglass_sabvufer_1_x_210_mm_8_polyflex',
    ),
    108 => 
    array (
      'VALUE' => 'Сателлиты: 1 x 130 mm (5\'\'), Polyflex
Сабвуфер: 1 x 210 mm (8\'\'), Polyflex',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'satellity_1_x_130_mm_5_polyflex_sabvufer_1_x_210_mm_8_polyflex',
    ),
    109 => 
    array (
      'VALUE' => 'Фронт: 1 x 80 mm (3.2\'\'), Aluminum
Центр: 2 x 80 mm (3.2\'\'), Aluminum
Тыл: 1 x 80 mm (3.2\'\'), Aluminum
Сабвуфер: 1 x 200 mm (8\'\'), Aluminum',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'front_1_x_80_mm_3_2_aluminum_tsentr_2_x_80_mm_3_2_aluminum_tyl_1_x_80_mm_3_2_aluminum_sabvufer_1_x_2',
    ),
    110 => 
    array (
      'VALUE' => 'Фронт: 1 x 80 mm (3.2\'\'), Aluminum
Центр: 2 x 80 mm (3.2\'\'), Aluminum
Тыл: 1 x 80 mm (3.2\'\'), Aluminum',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'front_1_x_80_mm_3_2_aluminum_tsentr_2_x_80_mm_3_2_aluminum_tyl_1_x_80_mm_3_2_aluminum',
    ),
    111 => 
    array (
      'VALUE' => 'Фронт: 1 x 80 mm (3.2\'\'), Aluminum finish
Центр: 2 x 80 mm (3.2\'\'), Aluminum finish
Тыл: 1 x 80 mm (3.2\'\'), Aluminum finish
Сабвуфер: 1 x 200 mm (8\'\'), Aluminum finish',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'front_1_x_80_mm_3_2_aluminum_finish_tsentr_2_x_80_mm_3_2_aluminum_finish_tyl_1_x_80_mm_3_2_aluminum_',
    ),
    112 => 
    array (
      'VALUE' => 'Фронт: 165-мм НЧ-динамик, 125-мм кевлар CЧ-динамик
Центр: 2 x 125-мм кевлар
Тыл: 100-мм кевлар',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'front_165_mm_nch_dinamik_125_mm_kevlar_cch_dinamik_tsentr_2_x_125_mm_kevlar_tyl_100_mm_kevlar',
    ),
    113 => 
    array (
      'VALUE' => 'Фронт: 1x130mm(5\'\')+1x100mm(4\'\') Dolby Atmos
Центр и тыл: 1x130mm(5\'\'), Polyflex
Сабвуфер: 1 x 210 mm (8\'\'), Polyflex',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'front_1x130mm_5_1x100mm_4_dolby_atmos_tsentr_i_tyl_1x130mm_5_polyflex_sabvufer_1_x_210_mm_8_polyflex',
    ),
    114 => 
    array (
      'VALUE' => 'Фронт: 2 x 80 mm (3.2\'\'), Aluminum
Центр: 2 x 80 mm (3.2\'\'), Aluminum
Тыл: 2 x 80 mm (3.2\'\'), Aluminum
Сабвуфер: 1 x 200 mm (8\'\'), Aluminum',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'front_2_x_80_mm_3_2_aluminum_tsentr_2_x_80_mm_3_2_aluminum_tyl_2_x_80_mm_3_2_aluminum_sabvufer_1_x_2',
    ),
    115 => 
    array (
      'VALUE' => 'Фронт: 4 x 80 mm (3.2\'\'), aluminum
Центр: 2 x 80 mm (3.2\'\'), aluminum
Сателлиты: 1 x 80 mm (3.2\'\'), aluminum',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'front_4_x_80_mm_3_2_aluminum_tsentr_2_x_80_mm_3_2_aluminum_satellity_1_x_80_mm_3_2_aluminum',
    ),
    116 => 
    array (
      'VALUE' => 'Фронт: 75-мм НЧ-динамики
Центр: 2 x 75-мм НЧ-динамики
Тыл: 75-мм НЧ-динамики
Сабвуфер: 1 x 200 mm (8\'\')',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'front_75_mm_nch_dinamiki_tsentr_2_x_75_mm_nch_dinamiki_tyl_75_mm_nch_dinamiki_sabvufer_1_x_200_mm_8_',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'Общее',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'OBSHCHEE',
  'DEFAULT_VALUE' => 
  array (
    'TEXT' => '',
    'TYPE' => 'HTML',
  ),
  'PROPERTY_TYPE' => 'S',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => 'HTML',
  'USER_TYPE_SETTINGS' => 
  array (
    'height' => 200,
  ),
  'HINT' => '',
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'Опциональные аксессуары',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'OPTSIONALNYE_AKSESSUARY',
  'DEFAULT_VALUE' => 
  array (
    'TEXT' => '',
    'TYPE' => 'HTML',
  ),
  'PROPERTY_TYPE' => 'S',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => 'HTML',
  'USER_TYPE_SETTINGS' => 
  array (
    'height' => 200,
  ),
  'HINT' => '',
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'Особенности',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'OSOBENNOSTI',
  'DEFAULT_VALUE' => 
  array (
    'TEXT' => '',
    'TYPE' => 'HTML',
  ),
  'PROPERTY_TYPE' => 'S',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => 'HTML',
  'USER_TYPE_SETTINGS' => 
  array (
    'height' => 200,
  ),
  'HINT' => '',
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'Прижимная сила (г)',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'PRIZHIMNAYA_SILA_G',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => '1,5~2,1 г',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_5_2_1_g',
    ),
    1 => 
    array (
      'VALUE' => 'от 2,3 до 2,7',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'ot_2_3_do_2_7',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'Пульт ДУ',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'PULT_DU',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => 'Есть',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'est',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'Размер драйверов',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'RAZMER_DRAYVEROV',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => '11,5 мм',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '11_5_mm',
    ),
    1 => 
    array (
      'VALUE' => '2x11,5 мм',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '2x11_5_mm',
    ),
    2 => 
    array (
      'VALUE' => '30 мм',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '30_mm',
    ),
    3 => 
    array (
      'VALUE' => '40 мм',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '40_mm',
    ),
    4 => 
    array (
      'VALUE' => '50 мм',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '50_mm',
    ),
    5 => 
    array (
      'VALUE' => '9 мм',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '9_mm',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'Размеры (ШхВхГ)',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'RAZMERY_SHKHVKHG',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'S',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'Размеры монтажного отверстия',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'RAZMERY_MONTAZHNOGO_OTVERSTIYA',
  'DEFAULT_VALUE' => 
  array (
    'TEXT' => '',
    'TYPE' => 'HTML',
  ),
  'PROPERTY_TYPE' => 'S',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => 'HTML',
  'USER_TYPE_SETTINGS' => 
  array (
    'height' => 200,
  ),
  'HINT' => '',
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'Размеры сабвуфера',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'RAZMERY_SABVUFERA',
  'DEFAULT_VALUE' => 
  array (
    'TEXT' => '',
    'TYPE' => 'HTML',
  ),
  'PROPERTY_TYPE' => 'S',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => 'HTML',
  'USER_TYPE_SETTINGS' => 
  array (
    'height' => 200,
  ),
  'HINT' => '',
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'Регулировка фазы',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'REGULIROVKA_FAZY',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => '0/180',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '0_180',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'Рекомендуемая мощность усилителя',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'REKOMENDUEMAYA_MOSHCHNOST_USILITELYA',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => '15-100',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '15_100',
    ),
    1 => 
    array (
      'VALUE' => '15-100 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '15_100_vt',
    ),
    2 => 
    array (
      'VALUE' => '20 - 100 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '20_100_vt',
    ),
    3 => 
    array (
      'VALUE' => '20 - 110 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '20_110_vt',
    ),
    4 => 
    array (
      'VALUE' => '20 - 120 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '20_120_vt',
    ),
    5 => 
    array (
      'VALUE' => '20 - 140 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '20_140_vt',
    ),
    6 => 
    array (
      'VALUE' => '20 - 150 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '20_150_vt',
    ),
    7 => 
    array (
      'VALUE' => '20 - 160 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '20_160_vt',
    ),
    8 => 
    array (
      'VALUE' => '25 - 120',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '25_120',
    ),
    9 => 
    array (
      'VALUE' => '25 - 120 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '25_120_vt',
    ),
    10 => 
    array (
      'VALUE' => '25-100',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '25_100',
    ),
    11 => 
    array (
      'VALUE' => '25-100 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '25_100_vt',
    ),
    12 => 
    array (
      'VALUE' => '25-120',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '5b16414f4547c7cfa36ca2486d1567f9',
    ),
    13 => 
    array (
      'VALUE' => '25-120 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'c2316cd3ac1f1612a1fbd632066c7bd4',
    ),
    14 => 
    array (
      'VALUE' => '25-150',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '25_150',
    ),
    15 => 
    array (
      'VALUE' => '25-150 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '25_150_vt',
    ),
    16 => 
    array (
      'VALUE' => '30 - 120 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '30_120_vt',
    ),
    17 => 
    array (
      'VALUE' => '30 - 140 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '30_140_vt',
    ),
    18 => 
    array (
      'VALUE' => '30 - 150 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '30_150_vt',
    ),
    19 => 
    array (
      'VALUE' => '30 - 160 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '30_160_vt',
    ),
    20 => 
    array (
      'VALUE' => '30 - 180 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '30_180_vt',
    ),
    21 => 
    array (
      'VALUE' => '30 - 200 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '30_200_vt',
    ),
    22 => 
    array (
      'VALUE' => '30 - 265 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '30_265_vt',
    ),
    23 => 
    array (
      'VALUE' => '30 - 280 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '30_280_vt',
    ),
    24 => 
    array (
      'VALUE' => '30 - 300 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '30_300_vt',
    ),
    25 => 
    array (
      'VALUE' => '30 - 380 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '30_380_vt',
    ),
    26 => 
    array (
      'VALUE' => '40 - 120 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '40_120_vt',
    ),
    27 => 
    array (
      'VALUE' => '40 - 200 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '40_200_vt',
    ),
    28 => 
    array (
      'VALUE' => '40 - 400 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '40_400_vt',
    ),
    29 => 
    array (
      'VALUE' => '50 - 400 Вт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '50_400_vt',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'СЧ-динамик',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'SCH_DINAMIK1',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => '1 x 110 mm, Aluminium',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_x_110_mm_aluminium',
    ),
    1 => 
    array (
      'VALUE' => '1 x 160 mm (6\'\'), Aluminum (Wave surround)',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_x_160_mm_6_aluminum_wave_surround',
    ),
    2 => 
    array (
      'VALUE' => '1 x 180 mm (7\'\'), Aluminum (Wave surround)',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_x_180_mm_7_aluminum_wave_surround',
    ),
    3 => 
    array (
      'VALUE' => '100 мм бумажный',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '100_mm_bumazhnyy',
    ),
    4 => 
    array (
      'VALUE' => '110 мм, с магнитно алюминиевым конусом',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '110_mm_s_magnitno_alyuminievym_konusom',
    ),
    5 => 
    array (
      'VALUE' => '125 mm СЧ-динамики',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '125_mm_sch_dinamiki',
    ),
    6 => 
    array (
      'VALUE' => '130 мм спрессованных сэндвич-драйвер из керамики и алюминия',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '130_mm_spressovannykh_sendvich_drayver_iz_keramiki_i_alyuminiya',
    ),
    7 => 
    array (
      'VALUE' => '130 мм, Polyglass (целлюлозная пульпа с покрытием микро-шариками стекла)',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '130_mm_polyglass_tsellyuloznaya_pulpa_s_pokrytiem_mikro_sharikami_stekla',
    ),
    8 => 
    array (
      'VALUE' => '165мм',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '165mm',
    ),
    9 => 
    array (
      'VALUE' => '170 mm СЧ-динамики',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '170_mm_sch_dinamiki',
    ),
    10 => 
    array (
      'VALUE' => '2 x 110 mm (4.3"), Aluminium',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '2_x_110_mm_4_3_aluminium',
    ),
    11 => 
    array (
      'VALUE' => '2 x 110 mm, Aluminium',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '2_x_110_mm_aluminium',
    ),
    12 => 
    array (
      'VALUE' => '2 x 50 mm (2\'\')',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '2_x_50_mm_2_',
    ),
    13 => 
    array (
      'VALUE' => '2 x 80 mm (3\'\'), aluminum',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '2_x_80_mm_3_aluminum',
    ),
    14 => 
    array (
      'VALUE' => '2 x 8см',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '2_x_8sm',
    ),
    15 => 
    array (
      'VALUE' => '4 x 50 (2") mm',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '4_x_50_2_mm',
    ),
    16 => 
    array (
      'VALUE' => '4 x 50 mm (2\'\')',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '4_x_50_mm_2_',
    ),
    17 => 
    array (
      'VALUE' => '4 x 51 мм широкополосные',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '4_x_51_mm_shirokopolosnye',
    ),
    18 => 
    array (
      'VALUE' => '61/2" (16.5cm) Polyglass',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '61_2_16_5cm_polyglass',
    ),
    19 => 
    array (
      'VALUE' => 'Алюминиевый 1 х 18см',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'alyuminievyy_1_kh_18sm',
    ),
    20 => 
    array (
      'VALUE' => 'Титановый 1 х 18см',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'titanovyy_1_kh_18sm',
    ),
    21 => 
    array (
      'VALUE' => 'целлюлоза 2 x 40 mm (1.6")',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'tsellyuloza_2_x_40_mm_1_6_',
    ),
    22 => 
    array (
      'VALUE' => 'целлюлоза 2 x 70 mm (2.8")',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'tsellyuloza_2_x_70_mm_2_8_',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'Сетевые возможности',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'SETEVYE_VOZMOZHNOSTI',
  'DEFAULT_VALUE' => 
  array (
    'TEXT' => '',
    'TYPE' => 'HTML',
  ),
  'PROPERTY_TYPE' => 'S',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => 'HTML',
  'USER_TYPE_SETTINGS' => 
  array (
    'height' => 200,
  ),
  'HINT' => '',
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'Спецификации',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'SPETSIFIKATSII',
  'DEFAULT_VALUE' => 
  array (
    'TEXT' => '',
    'TYPE' => 'HTML',
  ),
  'PROPERTY_TYPE' => 'S',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => 'HTML',
  'USER_TYPE_SETTINGS' => 
  array (
    'height' => 200,
  ),
  'HINT' => '',
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'Срез кроссовера',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'SREZ_KROSSOVERA',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => '150 Гц',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '150_gts',
    ),
    1 => 
    array (
      'VALUE' => '170 / 3.000 Гц',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '170_3_000_gts',
    ),
    2 => 
    array (
      'VALUE' => '180 Гц / 3.000 Гц',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '180_gts_3_000_gts',
    ),
    3 => 
    array (
      'VALUE' => '2.600
Фазо амплитудно оптимизированный кроссовер с защитой от перегрузок',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '2_600_fazo_amplitudno_optimizirovannyy_krossover_s_zashchitoy_ot_peregruzok',
    ),
    4 => 
    array (
      'VALUE' => '350 Hz, 2.600 Hz
Фазо амплитудно оптимизированный кроссовер с защитой от перегрузок',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '350_hz_2_600_hz_fazo_amplitudno_optimizirovannyy_krossover_s_zashchitoy_ot_peregruzok',
    ),
    5 => 
    array (
      'VALUE' => '400 / 3.300 Гц',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '400_3_300_gts',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'Твитер',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'TVITER',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => '1 x 15 mm (1\'\'), aluminum',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_x_15_mm_1_aluminum',
    ),
    1 => 
    array (
      'VALUE' => '1 x 25 mm',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_x_25_mm',
    ),
    2 => 
    array (
      'VALUE' => '1 x 25 mm (1\'\')',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_x_25_mm_1_',
    ),
    3 => 
    array (
      'VALUE' => '1 x 25 mm (1\'\'), aluminum',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_x_25_mm_1_aluminum',
    ),
    4 => 
    array (
      'VALUE' => '1 x 25 mm (1\'\'), aluminum-manganese',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_x_25_mm_1_aluminum_manganese',
    ),
    5 => 
    array (
      'VALUE' => '1 x 25 mm (1\'\'), ceramic',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_x_25_mm_1_ceramic',
    ),
    6 => 
    array (
      'VALUE' => '1 x 25 mm (1\'\'), алюминий',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_x_25_mm_1_alyuminiy',
    ),
    7 => 
    array (
      'VALUE' => '1 x 25 mm (1\'\'), алюминий-марганец',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_x_25_mm_1_alyuminiy_marganets',
    ),
    8 => 
    array (
      'VALUE' => '1 x 25 mm (1\'\'), керамический',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_x_25_mm_1_keramicheskiy',
    ),
    9 => 
    array (
      'VALUE' => '1 x 25 mm (1"), aluminium',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_x_25_mm_1_aluminium',
    ),
    10 => 
    array (
      'VALUE' => '1 x 25 mm, aluminium',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_x_25_mm_aluminium',
    ),
    11 => 
    array (
      'VALUE' => '1 x 25 mm, ceramic',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_x_25_mm_ceramic',
    ),
    12 => 
    array (
      'VALUE' => '1 x 25 мм (1 \'\') керамика',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_x_25_mm_1_keramika',
    ),
    13 => 
    array (
      'VALUE' => '1 x 26 мм LDS Dome',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_x_26_mm_lds_dome',
    ),
    14 => 
    array (
      'VALUE' => '1 x 28 mm мягкий тканевый купол
17 x 45 mm ленточный излучатель ',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_x_28_mm_myagkiy_tkanevyy_kupol_17_x_45_mm_lentochnyy_izluchatel_',
    ),
    15 => 
    array (
      'VALUE' => '1 x 28 mm мягкий тканевый купол',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_x_28_mm_myagkiy_tkanevyy_kupol',
    ),
    16 => 
    array (
      'VALUE' => '1 x AMT-1',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_x_amt_1',
    ),
    17 => 
    array (
      'VALUE' => '1 x LDR',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_x_ldr',
    ),
    18 => 
    array (
      'VALUE' => '1 x LDR 2642 MKII',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_x_ldr_2642_mkii',
    ),
    19 => 
    array (
      'VALUE' => '1 x LDR 2642 MKII ribbon',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_x_ldr_2642_mkii_ribbon',
    ),
    20 => 
    array (
      'VALUE' => '1 x LDR 3056 Ribbon',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_x_ldr_3056_ribbon',
    ),
    21 => 
    array (
      'VALUE' => '1 x LDR ленточный излучатель',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_x_ldr_lentochnyy_izluchatel',
    ),
    22 => 
    array (
      'VALUE' => '1 х 25 мм (1 \'\'), алюминий',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_kh_25_mm_1_alyuminiy',
    ),
    23 => 
    array (
      'VALUE' => '1 х 25 мм, алюминий',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_kh_25_mm_alyuminiy',
    ),
    24 => 
    array (
      'VALUE' => '1" (25mm) TNV Al/Mg с инвертированным твитером',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_25mm_tnv_al_mg_s_invertirovannym_tviterom',
    ),
    25 => 
    array (
      'VALUE' => '1" (25mm) вогнутый алюминиевый купол ',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_25mm_vognutyy_alyuminievyy_kupol_',
    ),
    26 => 
    array (
      'VALUE' => '13 мм шёлк',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '13_mm_shyelk',
    ),
    27 => 
    array (
      'VALUE' => '19 мм mylar dome ',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '19_mm_mylar_dome_',
    ),
    28 => 
    array (
      'VALUE' => '19 мм soft dome ',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '19_mm_soft_dome_',
    ),
    29 => 
    array (
      'VALUE' => '2 x 1" (25mm) вогнутый алюминиевый купол ',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '2_x_1_25mm_vognutyy_alyuminievyy_kupol_',
    ),
    30 => 
    array (
      'VALUE' => '2 x 19-мм ВЧ-динамики',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '2_x_19_mm_vch_dinamiki',
    ),
    31 => 
    array (
      'VALUE' => '2 x 20 mm (1), aluminium',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '2_x_20_mm_1_aluminium',
    ),
    32 => 
    array (
      'VALUE' => '2 x 25 mm (1"), Aluminium',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '2_x_25_mm_1_aluminium',
    ),
    33 => 
    array (
      'VALUE' => '2 x 25-мм (1")',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '2_x_25_mm_1_',
    ),
    34 => 
    array (
      'VALUE' => '20 мм шёлк',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '20_mm_shyelk',
    ),
    35 => 
    array (
      'VALUE' => '20 мм, тканевый купол',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '20_mm_tkanevyy_kupol',
    ),
    36 => 
    array (
      'VALUE' => '20-мм ВЧ-динамики',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '20_mm_vch_dinamiki',
    ),
    37 => 
    array (
      'VALUE' => '21 мм, тканевый купол',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '21_mm_tkanevyy_kupol',
    ),
    38 => 
    array (
      'VALUE' => '25 мм алюминиевый купольный твиттер в волноводе',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '25_mm_alyuminievyy_kupolnyy_tvitter_v_volnovode',
    ),
    39 => 
    array (
      'VALUE' => '25 мм вогнутый алюминиево-магниевый купол ',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '25_mm_vognutyy_alyuminievo_magnievyy_kupol_',
    ),
    40 => 
    array (
      'VALUE' => '25 мм вогнутый алюминиево-магниевый купол TNC',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '25_mm_vognutyy_alyuminievo_magnievyy_kupol_tnc',
    ),
    41 => 
    array (
      'VALUE' => '25 мм вогнутый алюминиевый купол ',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '25_mm_vognutyy_alyuminievyy_kupol_',
    ),
    42 => 
    array (
      'VALUE' => '25 мм кольцевая мембрана Vifa Ring Radiator с неодимовой магнитной системой, DXT lens',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '25_mm_koltsevaya_membrana_vifa_ring_radiator_s_neodimovoy_magnitnoy_sistemoy_dxt_lens',
    ),
    43 => 
    array (
      'VALUE' => '25 мм металлический купол',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '25_mm_metallicheskiy_kupol',
    ),
    44 => 
    array (
      'VALUE' => '25 мм, TNV Al/Mg с инвертированным куполом',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '25_mm_tnv_al_mg_s_invertirovannym_kupolom',
    ),
    45 => 
    array (
      'VALUE' => '25 мм, тканевый купол',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '25_mm_tkanevyy_kupol',
    ),
    46 => 
    array (
      'VALUE' => '25 мм, тканевый купол с неодимовым магнитом и ферромагнитным охлаждением звуковой катушки',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '25_mm_tkanevyy_kupol_s_neodimovym_magnitom_i_ferromagnitnym_okhlazhdeniem_zvukovoy_katushki',
    ),
    47 => 
    array (
      'VALUE' => '25 мм, тканевый купол с неодимовым магнитом и феррофлюидным охлаждением звуковой катушки',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '25_mm_tkanevyy_kupol_s_neodimovym_magnitom_i_ferroflyuidnym_okhlazhdeniem_zvukovoy_katushki',
    ),
    48 => 
    array (
      'VALUE' => '25-мм (1")',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '25_mm_1_',
    ),
    49 => 
    array (
      'VALUE' => '25-мм (1") ВЧ-динамики',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '25_mm_1_vch_dinamiki',
    ),
    50 => 
    array (
      'VALUE' => '25-мм ВЧ-динамики',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '25_mm_vch_dinamiki',
    ),
    51 => 
    array (
      'VALUE' => '25мм',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '25mm',
    ),
    52 => 
    array (
      'VALUE' => '26 mm LDS dome',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '26_mm_lds_dome',
    ),
    53 => 
    array (
      'VALUE' => '27 мм – высококачественный алюминиевый твитер собственной разработки: купол твитера помещен в фирменный волновод WDT (Wide Dispersion Technology) с дисперсией 130 на 120 градусов',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '27_mm_vysokokachestvennyy_alyuminievyy_tviter_sobstvennoy_razrabotki_kupol_tvitera_pomeshchen_v_firm',
    ),
    54 => 
    array (
      'VALUE' => '28 мм алюминиевый купольный твиттер',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '28_mm_alyuminievyy_kupolnyy_tvitter',
    ),
    55 => 
    array (
      'VALUE' => '28 мм алюминиевый купольный твиттер в волноводе WDT',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '28_mm_alyuminievyy_kupolnyy_tvitter_v_volnovode_wdt',
    ),
    56 => 
    array (
      'VALUE' => '28 мм тканевый купольный твитер',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '28_mm_tkanevyy_kupolnyy_tviter',
    ),
    57 => 
    array (
      'VALUE' => '28 мм шелковый купольный твиттер',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '28_mm_shelkovyy_kupolnyy_tvitter',
    ),
    58 => 
    array (
      'VALUE' => '28 мм, тканевый купол',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '0f596320f2cbc660aa537ba013f509db',
    ),
    59 => 
    array (
      'VALUE' => '28 мм. тканевый купол',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '28_mm_tkanevyy_kupol',
    ),
    60 => 
    array (
      'VALUE' => '28-мм',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '28_mm',
    ),
    61 => 
    array (
      'VALUE' => '28-мм ВЧ-динамики',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '28_mm_vch_dinamiki',
    ),
    62 => 
    array (
      'VALUE' => '29 мм, тканевый купол',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '29_mm_tkanevyy_kupol',
    ),
    63 => 
    array (
      'VALUE' => '2x25 мм вогнутый алюминиево-магниевый купол ',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '2x25_mm_vognutyy_alyuminievo_magnievyy_kupol_',
    ),
    64 => 
    array (
      'VALUE' => '32 мм, с кольцевым радиатором и фирменной линзой DXT',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '32_mm_s_koltsevym_radiatorom_i_firmennoy_linzoy_dxt',
    ),
    65 => 
    array (
      'VALUE' => '90 х 12 мм, ленточный',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '90_kh_12_mm_lentochnyy',
    ),
    66 => 
    array (
      'VALUE' => 'TNV2 25 мм вогнутый алюминиево-магниевый купол',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'tnv2_25_mm_vognutyy_alyuminievo_magnievyy_kupol',
    ),
    67 => 
    array (
      'VALUE' => 'ВЧ динамик 1.5см',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'vch_dinamik_1_5sm',
    ),
    68 => 
    array (
      'VALUE' => 'керамика 1 x 25 мм (1 \'\')',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'keramika_1_x_25_mm_1_',
    ),
    69 => 
    array (
      'VALUE' => 'Сателлиты: 1 x 19 mm soft dome',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'satellity_1_x_19_mm_soft_dome',
    ),
    70 => 
    array (
      'VALUE' => 'Сателлиты: 1 x 25 mm Al/Mg',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'satellity_1_x_25_mm_al_mg',
    ),
    71 => 
    array (
      'VALUE' => 'тканевый 1 x 25 mm (1\'\')',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'tkanevyy_1_x_25_mm_1_',
    ),
    72 => 
    array (
      'VALUE' => 'тканевый 1 x 25 мм (1 \'\')',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '274c4f8ae46c9f44362bf92a3ec8c3b8',
    ),
    73 => 
    array (
      'VALUE' => 'Тканевый 2 x 19 mm (1\'\')',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'tkanevyy_2_x_19_mm_1_',
    ),
    74 => 
    array (
      'VALUE' => 'тканевый 2 x 19 mm (7.5")',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'tkanevyy_2_x_19_mm_7_5_',
    ),
    75 => 
    array (
      'VALUE' => 'тканевый 2 x 20 mm (1\'\')',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'tkanevyy_2_x_20_mm_1_',
    ),
    76 => 
    array (
      'VALUE' => 'Тканевый 25 мм',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'tkanevyy_25_mm',
    ),
    77 => 
    array (
      'VALUE' => 'Фронт: 1 x 15 mm (1), Aluminium
Центр: 1 x 15 mm (1), Aluminium
Сателлиты: 1 x 15 mm (1), Aluminium',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'front_1_x_15_mm_1_aluminium_tsentr_1_x_15_mm_1_aluminium_satellity_1_x_15_mm_1_aluminium',
    ),
    78 => 
    array (
      'VALUE' => 'Фронт: 1 x 15 mm (1), Aluminium
Центр: 1 x 15 mm (1), Aluminium
Тыл: 1 x 15 mm (1), Aluminium',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'front_1_x_15_mm_1_aluminium_tsentr_1_x_15_mm_1_aluminium_tyl_1_x_15_mm_1_aluminium',
    ),
    79 => 
    array (
      'VALUE' => 'Фронт: 20-мм ВЧ-динамики
Центр: 20-мм ВЧ-динамики
Тыл: 20-мм ВЧ-динамики',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'front_20_mm_vch_dinamiki_tsentr_20_mm_vch_dinamiki_tyl_20_mm_vch_dinamiki',
    ),
    80 => 
    array (
      'VALUE' => 'Фронт: 25-мм мягкий купол
Центр: 25-мм мягкий купол
Тыл: 25-мм мягкий купол',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'front_25_mm_myagkiy_kupol_tsentr_25_mm_myagkiy_kupol_tyl_25_mm_myagkiy_kupol',
    ),
    81 => 
    array (
      'VALUE' => 'широкополосные электростатические мембраны',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'shirokopolosnye_elektrostaticheskie_membrany',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'Уровень звукового давления',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'UROVEN_ZVUKOVOGO_DAVLENIYA',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => '103 дБ',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '103_db',
    ),
    1 => 
    array (
      'VALUE' => '2 x 103 дБ',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '2_x_103_db',
    ),
    2 => 
    array (
      'VALUE' => '90 дБ',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '90_db',
    ),
    3 => 
    array (
      'VALUE' => '95 дБ',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '95_db',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'Функции HDMI',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'FUNKTSII_HDMI',
  'DEFAULT_VALUE' => 
  array (
    'TEXT' => '',
    'TYPE' => 'HTML',
  ),
  'PROPERTY_TYPE' => 'S',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => 'HTML',
  'USER_TYPE_SETTINGS' => 
  array (
    'height' => 200,
  ),
  'HINT' => '',
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'Функции улучшения звучания',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'FUNKTSII_ULUCHSHENIYA_ZVUCHANIYA',
  'DEFAULT_VALUE' => 
  array (
    'TEXT' => '',
    'TYPE' => 'HTML',
  ),
  'PROPERTY_TYPE' => 'S',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => 'HTML',
  'USER_TYPE_SETTINGS' => 
  array (
    'height' => 200,
  ),
  'HINT' => '',
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'Характеристики',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'KHARAKTERISTIKI',
  'DEFAULT_VALUE' => 
  array (
    'TEXT' => '',
    'TYPE' => 'HTML',
  ),
  'PROPERTY_TYPE' => 'S',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => 'HTML',
  'USER_TYPE_SETTINGS' => 
  array (
    'height' => 200,
  ),
  'HINT' => '',
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'Цифровые входы',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'TSIFROVYE_VKHODY',
  'DEFAULT_VALUE' => 
  array (
    'TEXT' => '',
    'TYPE' => 'HTML',
  ),
  'PROPERTY_TYPE' => 'S',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => 'HTML',
  'USER_TYPE_SETTINGS' => 
  array (
    'height' => 200,
  ),
  'HINT' => '',
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'Частота раздела кроссовера, Гц/кГц',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'CHASTOTA_RAZDELA_KROSSOVERA_GTS_KGTS',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => '170 / 3.000 Гц',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '170_3_000_gts',
    ),
    1 => 
    array (
      'VALUE' => '2.500 Гц',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '2_500_gts',
    ),
    2 => 
    array (
      'VALUE' => '2.700 Гц',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '2_700_gts',
    ),
    3 => 
    array (
      'VALUE' => '260 Hz, 3.300 Hz',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '260_hz_3_300_hz',
    ),
    4 => 
    array (
      'VALUE' => '290 Hz, 3.300 Hz',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '290_hz_3_300_hz',
    ),
    5 => 
    array (
      'VALUE' => '3',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '3',
    ),
    6 => 
    array (
      'VALUE' => '3 000 Гц',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '3_000_gts',
    ),
    7 => 
    array (
      'VALUE' => '3 200 Гц',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '3_200_gts',
    ),
    8 => 
    array (
      'VALUE' => '3 900 Гц',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '3_900_gts',
    ),
    9 => 
    array (
      'VALUE' => '3.000 Гц',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '9c22d41d0abbf83771ee9199d1cdc5d9',
    ),
    10 => 
    array (
      'VALUE' => '3.300 Гц',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '3_300_gts',
    ),
    11 => 
    array (
      'VALUE' => '300 / 3.000 Гц',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '300_3_000_gts',
    ),
    12 => 
    array (
      'VALUE' => '300 / 3.200 Гц',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '300_3_200_gts',
    ),
    13 => 
    array (
      'VALUE' => '300 / 3.500 Гц',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '300_3_500_gts',
    ),
    14 => 
    array (
      'VALUE' => '300 Гц / 3 000 Гц',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '300_gts_3_000_gts',
    ),
    15 => 
    array (
      'VALUE' => '3000 Гц',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '3000_gts',
    ),
    16 => 
    array (
      'VALUE' => '350 / 3.000 Гц',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '350_3_000_gts',
    ),
    17 => 
    array (
      'VALUE' => '4.500 Гц',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '4_500_gts',
    ),
    18 => 
    array (
      'VALUE' => '400 / 3.000 Гц',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '400_3_000_gts',
    ),
    19 => 
    array (
      'VALUE' => '400 / 3.500 Гц',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '400_3_500_gts',
    ),
    20 => 
    array (
      'VALUE' => 'Сателлиты: 2500 Гц
Сабвуфер: 50...200 Гц (регулируемый)',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'satellity_2500_gts_sabvufer_50_200_gts_reguliruemyy',
    ),
    21 => 
    array (
      'VALUE' => 'Сателлиты: 3500 Гц
Сабвуфер: 50...150 Гц (регулируемый)',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'satellity_3500_gts_sabvufer_50_150_gts_reguliruemyy',
    ),
    22 => 
    array (
      'VALUE' => 'Фронт: 3.500 Гц
Центр: 3.900 Гц
Сателлиты: 3.900 Гц
Сабвуфер: 80...140 Гц (регулируемый)',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'front_3_500_gts_tsentr_3_900_gts_satellity_3_900_gts_sabvufer_80_140_gts_reguliruemyy',
    ),
    23 => 
    array (
      'VALUE' => 'Фронт: 5.000 Гц
Центр: 5.000 Гц
Сателлиты: 5.000 Гц
Сабвуфер: 80...140 Гц (регулируемый)',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'front_5_000_gts_tsentr_5_000_gts_satellity_5_000_gts_sabvufer_80_140_gts_reguliruemyy',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'Частотный диапазон',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'CHASTOTNYY_DIAPAZON',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => 'от 20 Гц до 45 кГц',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'ot_20_gts_do_45_kgts',
    ),
    1 => 
    array (
      'VALUE' => 'Сателлиты: 70...25000 Гц
Сабвуфер: 35...150 Гц​',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'satellity_70_25000_gts_sabvufer_35_150_gts',
    ),
    2 => 
    array (
      'VALUE' => 'Сателлиты: 80...28000 Гц
Сабвуфер: 42...200 Гц​',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'satellity_80_28000_gts_sabvufer_42_200_gts',
    ),
    3 => 
    array (
      'VALUE' => 'Фронт: 120...25.000 Гц
Центр: 120...25.000 Гц
Тыл: 120...25.000 Гц
Сабвуфер: 33...140 Гц​',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'front_120_25_000_gts_tsentr_120_25_000_gts_tyl_120_25_000_gts_sabvufer_33_140_gts',
    ),
    4 => 
    array (
      'VALUE' => 'Фронт: 120...25.000 Гц
Центр: 120...25.000 Гц
Тыл: 120...25.000 Гц
Сабвуфер: 38...140 Гц​',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'front_120_25_000_gts_tsentr_120_25_000_gts_tyl_120_25_000_gts_sabvufer_38_140_gts',
    ),
    5 => 
    array (
      'VALUE' => 'Фронт: 50 - 20000 Гц
Центр: 70 - 20000 Гц
Тыл: 75 - 20000 Гц',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'front_50_20000_gts_tsentr_70_20000_gts_tyl_75_20000_gts',
    ),
    6 => 
    array (
      'VALUE' => 'Фронт: 50...25.000 Гц
Центр: 60...25.000 Гц
Сателлиты: 80...25.000 Гц
Сабвуфер: 33...140 Гц​',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'front_50_25_000_gts_tsentr_60_25_000_gts_satellity_80_25_000_gts_sabvufer_33_140_gts',
    ),
    7 => 
    array (
      'VALUE' => 'Фронт: 65...25000 Гц
Центр и тыл: 70...25000 Гц
Сабвуфер: 35...150 Гц​',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'front_65_25000_gts_tsentr_i_tyl_70_25000_gts_sabvufer_35_150_gts',
    ),
    8 => 
    array (
      'VALUE' => 'Фронт: 80 - 34.000 Гц
Центр: 80 - 34.000 Гц
Тыл: 80 - 34.000 Гц
Сабвуфер: 28-200 Гц​',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'front_80_34_000_gts_tsentr_80_34_000_gts_tyl_80_34_000_gts_sabvufer_28_200_gts',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'Ширина (мм)',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'WIDTH',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'S',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'Глубина (мм)',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'DEPTH',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'S',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'Высота (мм)',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'HEIGHT',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'S',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => '3d',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'P_3D',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => 'Есть',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'est',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => '4k',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'P_4K',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => 'Есть',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'est',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'acoustic-oformlenie',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'ACOUSTIC_OFORMLENIE',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'Y',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => 'Другое',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'drugoe',
    ),
    1 => 
    array (
      'VALUE' => 'Закрытый корпус',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'zakrytyy_korpus',
    ),
    2 => 
    array (
      'VALUE' => 'Изобарическое',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'izobaricheskoe',
    ),
    3 => 
    array (
      'VALUE' => 'Открытое',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'otkrytoe',
    ),
    4 => 
    array (
      'VALUE' => 'Пассивный излучатель',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'passivnyy_izluchatel',
    ),
    5 => 
    array (
      'VALUE' => 'Пассивный радиатор',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'passivnyy_radiator',
    ),
    6 => 
    array (
      'VALUE' => 'Рупор',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'rupor',
    ),
    7 => 
    array (
      'VALUE' => 'Трансмиссионная линия (лабиринт)',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'transmissionnaya_liniya_labirint',
    ),
    8 => 
    array (
      'VALUE' => 'Фазоинвертор',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'fazoinvertor',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'adcin',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'ADCIN',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => 'Есть Bluetooth',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'est_bluetooth',
    ),
    1 => 
    array (
      'VALUE' => 'Есть USB',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'est_usb',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'aksessuar',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'AKSESSUAR',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => 'Bluetooth аксессуар',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'bluetooth_aksessuar',
    ),
    1 => 
    array (
      'VALUE' => 'HDMI аксессуары',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'hdmi_aksessuary',
    ),
    2 => 
    array (
      'VALUE' => 'Перемычки',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'peremychki',
    ),
    3 => 
    array (
      'VALUE' => 'Переходники',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'perekhodniki',
    ),
    4 => 
    array (
      'VALUE' => 'Прочее',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'prochee',
    ),
    5 => 
    array (
      'VALUE' => 'Удлинитель для наушников',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'udlinitel_dlya_naushnikov',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'analogovie-vhodi',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'ANALOGOVIE_VHODI',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'Y',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => 'DIN',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'din',
    ),
    1 => 
    array (
      'VALUE' => 'RCA',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'rca',
    ),
    2 => 
    array (
      'VALUE' => 'XLR',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'xlr',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'analogovie-vihodi',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'ANALOGOVIE_VIHODI',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'Y',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => 'DIN',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'din',
    ),
    1 => 
    array (
      'VALUE' => 'RCA',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'rca',
    ),
    2 => 
    array (
      'VALUE' => 'XLR',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'xlr',
    ),
    3 => 
    array (
      'VALUE' => 'Другой',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'drugoy',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'audio-video-striming',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'AUDIO_VIDEO_STRIMING',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'Y',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => 'Аудио',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'audio',
    ),
    1 => 
    array (
      'VALUE' => 'Видео',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'video',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'bi-wiring',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'BI_WIRING',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => 'Есть',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'est',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'bluetooth',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'BLUETOOTH',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => 'Есть',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'est',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'brend',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'BREND',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => 'Accustic Arts',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'accustic_arts',
    ),
    1 => 
    array (
      'VALUE' => 'Acoustic Energy',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'acoustic_energy',
    ),
    2 => 
    array (
      'VALUE' => 'Astell&amp;Kern',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'astell_amp_kern',
    ),
    3 => 
    array (
      'VALUE' => 'Atlas',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'atlas',
    ),
    4 => 
    array (
      'VALUE' => 'Audeze',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'audeze',
    ),
    5 => 
    array (
      'VALUE' => 'Audia Flight',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'audia_flight',
    ),
    6 => 
    array (
      'VALUE' => 'Audio Physic',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'audio_physic',
    ),
    7 => 
    array (
      'VALUE' => 'Audio Pro',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'audio_pro',
    ),
    8 => 
    array (
      'VALUE' => 'Audio-Technica',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'audio_technica',
    ),
    9 => 
    array (
      'VALUE' => 'AURALiC',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'auralic',
    ),
    10 => 
    array (
      'VALUE' => 'Bello',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'bello',
    ),
    11 => 
    array (
      'VALUE' => 'Bowers &amp; Wilkins',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'bowers_amp_wilkins',
    ),
    12 => 
    array (
      'VALUE' => 'Bryston',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'bryston',
    ),
    13 => 
    array (
      'VALUE' => 'Cambridge Audio',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'cambridge_audio',
    ),
    14 => 
    array (
      'VALUE' => 'Campfire Audio',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'campfire_audio',
    ),
    15 => 
    array (
      'VALUE' => 'Canton',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'canton',
    ),
    16 => 
    array (
      'VALUE' => 'Chario',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'chario',
    ),
    17 => 
    array (
      'VALUE' => 'Copland',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'copland',
    ),
    18 => 
    array (
      'VALUE' => 'Creek',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'creek',
    ),
    19 => 
    array (
      'VALUE' => 'Dali',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'dali',
    ),
    20 => 
    array (
      'VALUE' => 'Davis Acoustics',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'davis_acoustics',
    ),
    21 => 
    array (
      'VALUE' => 'Definitive Technology',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'definitive_technology',
    ),
    22 => 
    array (
      'VALUE' => 'DENON',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'denon',
    ),
    23 => 
    array (
      'VALUE' => 'Densen',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'densen',
    ),
    24 => 
    array (
      'VALUE' => 'Diapason',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'diapason',
    ),
    25 => 
    array (
      'VALUE' => 'DLS',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'dls',
    ),
    26 => 
    array (
      'VALUE' => 'Dual',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'dual',
    ),
    27 => 
    array (
      'VALUE' => 'Dune',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'dune',
    ),
    28 => 
    array (
      'VALUE' => 'Dunu',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'dunu',
    ),
    29 => 
    array (
      'VALUE' => 'Dynaudio',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'dynaudio',
    ),
    30 => 
    array (
      'VALUE' => 'Elipson',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'elipson',
    ),
    31 => 
    array (
      'VALUE' => 'Emotiva',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'emotiva',
    ),
    32 => 
    array (
      'VALUE' => 'Episode',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'episode',
    ),
    33 => 
    array (
      'VALUE' => 'Epos',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'epos',
    ),
    34 => 
    array (
      'VALUE' => 'Estelon',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'estelon',
    ),
    35 => 
    array (
      'VALUE' => 'Etymotic',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'etymotic',
    ),
    36 => 
    array (
      'VALUE' => 'Fiio',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'fiio',
    ),
    37 => 
    array (
      'VALUE' => 'FOCAL',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'focal',
    ),
    38 => 
    array (
      'VALUE' => 'Fostex',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'fostex',
    ),
    39 => 
    array (
      'VALUE' => 'Fyne Audio',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'fyne_audio',
    ),
    40 => 
    array (
      'VALUE' => 'HECO',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'heco',
    ),
    41 => 
    array (
      'VALUE' => 'HiFiMAN',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'hifiman',
    ),
    42 => 
    array (
      'VALUE' => 'Inakustik',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'inakustik',
    ),
    43 => 
    array (
      'VALUE' => 'ISOL-8',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'isol_8',
    ),
    44 => 
    array (
      'VALUE' => 'Jamo',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'jamo',
    ),
    45 => 
    array (
      'VALUE' => 'JBL',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'jbl',
    ),
    46 => 
    array (
      'VALUE' => 'JL Audio',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'jl_audio',
    ),
    47 => 
    array (
      'VALUE' => 'JVC',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'jvc',
    ),
    48 => 
    array (
      'VALUE' => 'Kauber',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'kauber',
    ),
    49 => 
    array (
      'VALUE' => 'KEF',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'kef',
    ),
    50 => 
    array (
      'VALUE' => 'Klipsch',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'klipsch',
    ),
    51 => 
    array (
      'VALUE' => 'Little Lab',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'little_lab',
    ),
    52 => 
    array (
      'VALUE' => 'M&amp;K Sound',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'm_amp_k_sound',
    ),
    53 => 
    array (
      'VALUE' => 'Magnat',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'magnat',
    ),
    54 => 
    array (
      'VALUE' => 'Marantz',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'marantz',
    ),
    55 => 
    array (
      'VALUE' => 'Martin Logan',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'martin_logan',
    ),
    56 => 
    array (
      'VALUE' => 'Melco',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'melco',
    ),
    57 => 
    array (
      'VALUE' => 'Meze',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'meze',
    ),
    58 => 
    array (
      'VALUE' => 'Mission',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'mission',
    ),
    59 => 
    array (
      'VALUE' => 'MJ Acoustics',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'mj_acoustics',
    ),
    60 => 
    array (
      'VALUE' => 'Monitor Audio',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'monitor_audio',
    ),
    61 => 
    array (
      'VALUE' => 'Morel',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'morel',
    ),
    62 => 
    array (
      'VALUE' => 'Music Hall',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'music_hall',
    ),
    63 => 
    array (
      'VALUE' => 'Naim',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'naim',
    ),
    64 => 
    array (
      'VALUE' => 'Neat Acoustics',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'neat_acoustics',
    ),
    65 => 
    array (
      'VALUE' => 'Opera',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'opera',
    ),
    66 => 
    array (
      'VALUE' => 'OPPO',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'oppo',
    ),
    67 => 
    array (
      'VALUE' => 'Parasound',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'parasound',
    ),
    68 => 
    array (
      'VALUE' => 'Piega',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'piega',
    ),
    69 => 
    array (
      'VALUE' => 'PMC',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'pmc',
    ),
    70 => 
    array (
      'VALUE' => 'Polk Audio',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'polk_audio',
    ),
    71 => 
    array (
      'VALUE' => 'Proficient',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'proficient',
    ),
    72 => 
    array (
      'VALUE' => 'PSB',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'psb',
    ),
    73 => 
    array (
      'VALUE' => 'Purist Audio Design',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'purist_audio_design',
    ),
    74 => 
    array (
      'VALUE' => 'Quad',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'quad',
    ),
    75 => 
    array (
      'VALUE' => 'Rega',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'rega',
    ),
    76 => 
    array (
      'VALUE' => 'REL',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'rel',
    ),
    77 => 
    array (
      'VALUE' => 'Ruark Audio',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'ruark_audio',
    ),
    78 => 
    array (
      'VALUE' => 'Sennheiser',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'sennheiser',
    ),
    79 => 
    array (
      'VALUE' => 'Shanling',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'shanling',
    ),
    80 => 
    array (
      'VALUE' => 'Shure',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'shure',
    ),
    81 => 
    array (
      'VALUE' => 'Sonance',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'sonance',
    ),
    82 => 
    array (
      'VALUE' => 'Sonus Faber',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'sonus_faber',
    ),
    83 => 
    array (
      'VALUE' => 'Sony',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'sony',
    ),
    84 => 
    array (
      'VALUE' => 'SpeakerCraft',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'speakercraft',
    ),
    85 => 
    array (
      'VALUE' => 'Stax',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'stax',
    ),
    86 => 
    array (
      'VALUE' => 'Supravox',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'supravox',
    ),
    87 => 
    array (
      'VALUE' => 'SVS',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'svs',
    ),
    88 => 
    array (
      'VALUE' => 'T.A.C.',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 't_a_c',
    ),
    89 => 
    array (
      'VALUE' => 'T+A',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 't_a',
    ),
    90 => 
    array (
      'VALUE' => 'Tannoy',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'tannoy',
    ),
    91 => 
    array (
      'VALUE' => 'Totem Acoustic',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'totem_acoustic',
    ),
    92 => 
    array (
      'VALUE' => 'Trafomatic Audio',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'trafomatic_audio',
    ),
    93 => 
    array (
      'VALUE' => 'TruAudio',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'truaudio',
    ),
    94 => 
    array (
      'VALUE' => 'Unison Research',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'unison_research',
    ),
    95 => 
    array (
      'VALUE' => 'Van Den Hul',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'van_den_hul',
    ),
    96 => 
    array (
      'VALUE' => 'Velodyne',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'velodyne',
    ),
    97 => 
    array (
      'VALUE' => 'Vincent',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'vincent',
    ),
    98 => 
    array (
      'VALUE' => 'VPI',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'vpi',
    ),
    99 => 
    array (
      'VALUE' => 'Westone',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'westone',
    ),
    100 => 
    array (
      'VALUE' => 'Wharfedale',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'wharfedale',
    ),
    101 => 
    array (
      'VALUE' => 'Zappiti',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'zappiti',
    ),
    102 => 
    array (
      'VALUE' => 'Zu Audio',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'zu_audio',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'cabell',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'CABELL',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => 'Да',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'da',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'cable-wirwless',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'CABLE_WIRWLESS',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'Y',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => 'Беспроводные',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'besprovodnye',
    ),
    1 => 
    array (
      'VALUE' => 'Проводные',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'provodnye',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'cifrovie-vhodi',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'CIFROVIE_VHODI',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'Y',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => 'AES/EBU',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'aes_ebu',
    ),
    1 => 
    array (
      'VALUE' => 'BNC',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'bnc',
    ),
    2 => 
    array (
      'VALUE' => 'HDMI',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'hdmi',
    ),
    3 => 
    array (
      'VALUE' => 'LAN (сеть)',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'lan_set',
    ),
    4 => 
    array (
      'VALUE' => 'USB',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'usb',
    ),
    5 => 
    array (
      'VALUE' => 'Коаксиальный S/PDIF',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'koaksialnyy_s_pdif',
    ),
    6 => 
    array (
      'VALUE' => 'Оптический (Toslink)',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'opticheskiy_toslink',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'cifrovie-vihodi',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'CIFROVIE_VIHODI',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'Y',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => 'AES/EBU',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'aes_ebu',
    ),
    1 => 
    array (
      'VALUE' => 'BNC',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'bnc',
    ),
    2 => 
    array (
      'VALUE' => 'HDMI',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'hdmi',
    ),
    3 => 
    array (
      'VALUE' => 'LAN',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'lan',
    ),
    4 => 
    array (
      'VALUE' => 'USB',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'usb',
    ),
    5 => 
    array (
      'VALUE' => 'Коаксиальный S/PDIF',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'koaksialnyy_s_pdif',
    ),
    6 => 
    array (
      'VALUE' => 'Оптический (Toslink)',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'opticheskiy_toslink',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'colour',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'COLOUR',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'Y',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => 'Алюминий',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'alyuminiy',
    ),
    1 => 
    array (
      'VALUE' => 'Белый',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'belyy',
    ),
    2 => 
    array (
      'VALUE' => 'Другой',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'drugoy',
    ),
    3 => 
    array (
      'VALUE' => 'Коричневый',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'korichnevyy',
    ),
    4 => 
    array (
      'VALUE' => 'Светлое дерево',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'svetloe_derevo',
    ),
    5 => 
    array (
      'VALUE' => 'Серебро',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'serebro',
    ),
    6 => 
    array (
      'VALUE' => 'Серый',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'seryy',
    ),
    7 => 
    array (
      'VALUE' => 'Тёмное дерево',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'tyemnoe_derevo',
    ),
    8 => 
    array (
      'VALUE' => 'Цветные',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'tsvetnye',
    ),
    9 => 
    array (
      'VALUE' => 'Чёрный',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'chyernyy',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'diagonal',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'DIAGONAL',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'N',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'Y',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'diametr-kolonki',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'DIAMETR_KOLONKI',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'N',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'dla-proektora',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'DLA_PROEKTORA',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => 'Лампы',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'lampy',
    ),
    1 => 
    array (
      'VALUE' => 'Очки',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'ochki',
    ),
    2 => 
    array (
      'VALUE' => 'Прочее',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'prochee',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'dlina',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'DLINA',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'N',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'Y',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'dlina-tonarma',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'DLINA_TONARMA',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => '10',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '10',
    ),
    1 => 
    array (
      'VALUE' => '12',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '12',
    ),
    2 => 
    array (
      'VALUE' => '9',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '9',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'dsd',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'DSD',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'Y',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => 'DSD128 (5.6мГц)',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'dsd128_5_6mgts',
    ),
    1 => 
    array (
      'VALUE' => 'DSD256 (11.2мГц)',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'dsd256_11_2mgts',
    ),
    2 => 
    array (
      'VALUE' => 'DSD512 (22.5мГц)',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'dsd512_22_5mgts',
    ),
    3 => 
    array (
      'VALUE' => 'DSD64 (2.8мГц)',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'dsd64_2_8mgts',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'effektivnaja-massa',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'EFFEKTIVNAJA_MASSA',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => '10.2',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '10_2',
    ),
    1 => 
    array (
      'VALUE' => '10.5',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '10_5',
    ),
    2 => 
    array (
      'VALUE' => '11',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '11',
    ),
    3 => 
    array (
      'VALUE' => '9',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '9',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'fonokorrector',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'FONOKORRECTOR',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'Y',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => 'Есть',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'est',
    ),
    1 => 
    array (
      'VALUE' => 'Есть MM',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'est_mm',
    ),
    2 => 
    array (
      'VALUE' => 'Есть МС',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'est_ms',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'format-kartinki',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'FORMAT_KARTINKI',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => '16:9',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '16_9',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'fullhd',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'FULLHD',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => 'Есть',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'est',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'golovka',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'GOLOVKA',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => 'Есть',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'est',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'gotovie',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'GOTOVIE',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => 'Бухта',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'bukhta',
    ),
    1 => 
    array (
      'VALUE' => 'В нарезку',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'v_narezku',
    ),
    2 => 
    array (
      'VALUE' => 'Готовые комплекты',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'gotovye_komplekty',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'impedance',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'IMPEDANCE',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => '10',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '10',
    ),
    1 => 
    array (
      'VALUE' => '10000',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '10000',
    ),
    2 => 
    array (
      'VALUE' => '110',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '110',
    ),
    3 => 
    array (
      'VALUE' => '12',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '12',
    ),
    4 => 
    array (
      'VALUE' => '12.8',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '12_8',
    ),
    5 => 
    array (
      'VALUE' => '13',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '13',
    ),
    6 => 
    array (
      'VALUE' => '14',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '14',
    ),
    7 => 
    array (
      'VALUE' => '145000',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '145000',
    ),
    8 => 
    array (
      'VALUE' => '15',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '15',
    ),
    9 => 
    array (
      'VALUE' => '150',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '150',
    ),
    10 => 
    array (
      'VALUE' => '16',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '16',
    ),
    11 => 
    array (
      'VALUE' => '17',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '17',
    ),
    12 => 
    array (
      'VALUE' => '170000',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '170000',
    ),
    13 => 
    array (
      'VALUE' => '18',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '18',
    ),
    14 => 
    array (
      'VALUE' => '19',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '19',
    ),
    15 => 
    array (
      'VALUE' => '2 х 8',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '2_kh_8',
    ),
    16 => 
    array (
      'VALUE' => '20',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '20',
    ),
    17 => 
    array (
      'VALUE' => '21',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '21',
    ),
    18 => 
    array (
      'VALUE' => '22',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '22',
    ),
    19 => 
    array (
      'VALUE' => '23',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '23',
    ),
    20 => 
    array (
      'VALUE' => '24',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '24',
    ),
    21 => 
    array (
      'VALUE' => '25',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '25',
    ),
    22 => 
    array (
      'VALUE' => '26',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '26',
    ),
    23 => 
    array (
      'VALUE' => '27',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '27',
    ),
    24 => 
    array (
      'VALUE' => '28',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '28',
    ),
    25 => 
    array (
      'VALUE' => '30',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '30',
    ),
    26 => 
    array (
      'VALUE' => '300',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '300',
    ),
    27 => 
    array (
      'VALUE' => '31',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '31',
    ),
    28 => 
    array (
      'VALUE' => '32',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '32',
    ),
    29 => 
    array (
      'VALUE' => '33',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '33',
    ),
    30 => 
    array (
      'VALUE' => '35',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '35',
    ),
    31 => 
    array (
      'VALUE' => '36',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '36',
    ),
    32 => 
    array (
      'VALUE' => '37',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '37',
    ),
    33 => 
    array (
      'VALUE' => '38',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '38',
    ),
    34 => 
    array (
      'VALUE' => '39',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '39',
    ),
    35 => 
    array (
      'VALUE' => '4',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '4',
    ),
    36 => 
    array (
      'VALUE' => '4-8',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '4_8',
    ),
    37 => 
    array (
      'VALUE' => '4.5',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '4_5',
    ),
    38 => 
    array (
      'VALUE' => '4|8',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'b99efe6f3ffc2f7140f2dd2d62dbc04b',
    ),
    39 => 
    array (
      'VALUE' => '40',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '40',
    ),
    40 => 
    array (
      'VALUE' => '42',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '42',
    ),
    41 => 
    array (
      'VALUE' => '420',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '420',
    ),
    42 => 
    array (
      'VALUE' => '43',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '43',
    ),
    43 => 
    array (
      'VALUE' => '44',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '44',
    ),
    44 => 
    array (
      'VALUE' => '45',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '45',
    ),
    45 => 
    array (
      'VALUE' => '46',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '46',
    ),
    46 => 
    array (
      'VALUE' => '470',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '470',
    ),
    47 => 
    array (
      'VALUE' => '48',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '48',
    ),
    48 => 
    array (
      'VALUE' => '5',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '5',
    ),
    49 => 
    array (
      'VALUE' => '50',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '50',
    ),
    50 => 
    array (
      'VALUE' => '56',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '56',
    ),
    51 => 
    array (
      'VALUE' => '6',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '6',
    ),
    52 => 
    array (
      'VALUE' => '60',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '60',
    ),
    53 => 
    array (
      'VALUE' => '64',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '64',
    ),
    54 => 
    array (
      'VALUE' => '65',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '65',
    ),
    55 => 
    array (
      'VALUE' => '70',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '70',
    ),
    56 => 
    array (
      'VALUE' => '8',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '8',
    ),
    57 => 
    array (
      'VALUE' => '9',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '9',
    ),
    58 => 
    array (
      'VALUE' => 'нет данных',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'net_dannykh',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'internet',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'INTERNET',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => 'Есть',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'est',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'kolichestvo-kanalov',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'KOLICHESTVO_KANALOV',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'N',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'kolonki-komplekt',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'KOLONKI_KOMPLEKT',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => 'Внешние',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'vneshnie',
    ),
    1 => 
    array (
      'VALUE' => 'Встроенные',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'vstroennye',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'kontrastnoct',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'KONTRASTNOCT',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => '∞',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '532cfe72ed6030c49b962913a2a91979',
    ),
    1 => 
    array (
      'VALUE' => '100000',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '100000',
    ),
    2 => 
    array (
      'VALUE' => '1000000',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1000000',
    ),
    3 => 
    array (
      'VALUE' => '120000',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '120000',
    ),
    4 => 
    array (
      'VALUE' => '1300000',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1300000',
    ),
    5 => 
    array (
      'VALUE' => '250000',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '250000',
    ),
    6 => 
    array (
      'VALUE' => '350000',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '350000',
    ),
    7 => 
    array (
      'VALUE' => '400000',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '400000',
    ),
    8 => 
    array (
      'VALUE' => '800000',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '800000',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'max-nagruzka',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'MAX_NAGRUZKA',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'N',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'maximum-discretizatcia',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'MAXIMUM_DISCRETIZATCIA',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'N',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'maximum-frequency',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'MAXIMUM_FREQUENCY',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'N',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'maximum-razriadnost',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'MAXIMUM_RAZRIADNOST',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'N',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'minimum-frequency',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'MINIMUM_FREQUENCY',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'N',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'mnogokanalnij-vihod',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'MNOGOKANALNIJ_VIHOD',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => 'Есть',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'est',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'montaj-glubina',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'MONTAJ_GLUBINA',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'N',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'mozhnost-na-kanal',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'MOZHNOST_NA_KANAL',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'N',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'mozhnost-na-kanal-4om',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'MOZHNOST_NA_KANAL_4OM',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'N',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'nastrojka-parametrov',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'NASTROJKA_PARAMETROV',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => 'Есть',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'est',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'pitanie',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'PITANIE',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'Y',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => 'Блок питания',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'blok_pitaniya',
    ),
    1 => 
    array (
      'VALUE' => 'Колодка/удлинитель',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'kolodka_udlinitel',
    ),
    2 => 
    array (
      'VALUE' => 'Фильтр',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'filtr',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'pleer-transport',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'PLEER_TRANSPORT',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => 'CD-проигрыватель',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'cd_proigryvatel',
    ),
    1 => 
    array (
      'VALUE' => 'CD-транспорт',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'cd_transport',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'poddergka-kart',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'PODDERGKA_KART',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'Y',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => 'MicroSDHC',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'microsdhc',
    ),
    1 => 
    array (
      'VALUE' => 'SD',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'sd',
    ),
    2 => 
    array (
      'VALUE' => 'SDHC',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'sdhc',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'podderjka-sacd',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'PODDERJKA_SACD',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => 'Есть',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'est',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'polki',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'POLKI',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => '1',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1',
    ),
    1 => 
    array (
      'VALUE' => '2',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '2',
    ),
    2 => 
    array (
      'VALUE' => '3',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '3',
    ),
    3 => 
    array (
      'VALUE' => '4',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '4',
    ),
    4 => 
    array (
      'VALUE' => '5',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '5',
    ),
    5 => 
    array (
      'VALUE' => '6',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '6',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'privod',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'PRIVOD',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => 'Моторизованный',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'motorizovannyy',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'proektor-ekran',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'PROEKTOR_EKRAN',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => 'Аксессуары для проекторов',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'aksessuary_dlya_proektorov',
    ),
    1 => 
    array (
      'VALUE' => 'Проекторы',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'proektory',
    ),
    2 => 
    array (
      'VALUE' => 'Экраны',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'ekrany',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'raz',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'RAZ',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'Y',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => 'Jack 3.5 мм',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'jack_3_5_mm',
    ),
    1 => 
    array (
      'VALUE' => 'Jack 3.5мм + переходник на 6.3мм',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'jack_3_5mm_perekhodnik_na_6_3mm',
    ),
    2 => 
    array (
      'VALUE' => 'Jack 6.3 мм',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'jack_6_3_mm',
    ),
    3 => 
    array (
      'VALUE' => 'Jack 6.3мм + переходник на 3.5мм',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'jack_6_3mm_perekhodnik_na_3_5mm',
    ),
    4 => 
    array (
      'VALUE' => 'Балансный',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'balansnyy',
    ),
    5 => 
    array (
      'VALUE' => 'Другой',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'drugoy',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'razem',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'RAZEM',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => 'Banana (банан)',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'banana_banan',
    ),
    1 => 
    array (
      'VALUE' => 'Jack 2.5',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'jack_2_5',
    ),
    2 => 
    array (
      'VALUE' => 'Jack 3.5',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'jack_3_5',
    ),
    3 => 
    array (
      'VALUE' => 'Jack 6.3',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'jack_6_3',
    ),
    4 => 
    array (
      'VALUE' => 'RCA',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'rca',
    ),
    5 => 
    array (
      'VALUE' => 'Spade (лопатка)',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'spade_lopatka',
    ),
    6 => 
    array (
      'VALUE' => 'XLR (F)',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'xlr_f',
    ),
    7 => 
    array (
      'VALUE' => 'XLR (M)',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'xlr_m',
    ),
    8 => 
    array (
      'VALUE' => 'Силовой (на кабель)',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'silovoy_na_kabel',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'reciver-processor',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'RECIVER_PROCESSOR',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => 'AV-процессоры',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'av_protsessory',
    ),
    1 => 
    array (
      'VALUE' => 'AV-ресиверы',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'av_resivery',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'sdvig-linz',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'SDVIG_LINZ',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => 'Есть',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'est',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'sechenie',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'SECHENIE',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'Y',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => '0.75',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '0_75',
    ),
    1 => 
    array (
      'VALUE' => '1.1',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_1',
    ),
    2 => 
    array (
      'VALUE' => '1.2',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_2',
    ),
    3 => 
    array (
      'VALUE' => '1.25',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_25',
    ),
    4 => 
    array (
      'VALUE' => '1.5',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_5',
    ),
    5 => 
    array (
      'VALUE' => '10.55',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '10_55',
    ),
    6 => 
    array (
      'VALUE' => '2',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '2',
    ),
    7 => 
    array (
      'VALUE' => '2.2',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '2_2',
    ),
    8 => 
    array (
      'VALUE' => '2.5',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '2_5',
    ),
    9 => 
    array (
      'VALUE' => '2.97',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '2_97',
    ),
    10 => 
    array (
      'VALUE' => '3',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '3',
    ),
    11 => 
    array (
      'VALUE' => '3.3',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '3_3',
    ),
    12 => 
    array (
      'VALUE' => '3.5',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '3_5',
    ),
    13 => 
    array (
      'VALUE' => '4',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '4',
    ),
    14 => 
    array (
      'VALUE' => '5',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '5',
    ),
    15 => 
    array (
      'VALUE' => '5.3',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '5_3',
    ),
    16 => 
    array (
      'VALUE' => '5.5',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '5_5',
    ),
    17 => 
    array (
      'VALUE' => '6',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '6',
    ),
    18 => 
    array (
      'VALUE' => '8.36',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '8_36',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'sensitivity',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'SENSITIVITY',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'N',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'sensornij',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'SENSORNIJ',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => 'Сенсорный',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'sensornyy',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'speed',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'SPEED',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => 'Есть',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'est',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'stereo-vihod',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'STEREO_VIHOD',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'Y',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => 'RCA',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'rca',
    ),
    1 => 
    array (
      'VALUE' => 'XLR',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'xlr',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'stoika',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'STOIKA',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => 'Для колонок',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'dlya_kolonok',
    ),
    1 => 
    array (
      'VALUE' => 'Под аппаратуру',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'pod_apparaturu',
    ),
    2 => 
    array (
      'VALUE' => 'Под аппаратуру и ТВ',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'pod_apparaturu_i_tv',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'tip-ekrana',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'TIP_EKRANA',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => 'Настенные/Потолочные',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'nastennye_potolochnye',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'tip-golovki',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'TIP_GOLOVKI',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'Y',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => 'MC',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'mc',
    ),
    1 => 
    array (
      'VALUE' => 'MM',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'mm',
    ),
    2 => 
    array (
      'VALUE' => 'Сменная игла для головки',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'smennaya_igla_dlya_golovki',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'tip-kabelia',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'TIP_KABELIA',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'Y',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => 'CAT (LAN; Ethernet)',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'cat_lan_ethernet',
    ),
    1 => 
    array (
      'VALUE' => 'HDMI',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'hdmi',
    ),
    2 => 
    array (
      'VALUE' => 'USB',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'usb',
    ),
    3 => 
    array (
      'VALUE' => 'Акустический кабель',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'akusticheskiy_kabel',
    ),
    4 => 
    array (
      'VALUE' => 'Антенные и видео кабели',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'antennye_i_video_kabeli',
    ),
    5 => 
    array (
      'VALUE' => 'Для сабвуфера',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'dlya_sabvufera',
    ),
    6 => 
    array (
      'VALUE' => 'Для тонарма',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'dlya_tonarma',
    ),
    7 => 
    array (
      'VALUE' => 'Кабель для наушников',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'kabel_dlya_naushnikov',
    ),
    8 => 
    array (
      'VALUE' => 'Коммутаторы, разветвители, повторители, аксессуары',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'kommutatory_razvetviteli_povtoriteli_aksessuary',
    ),
    9 => 
    array (
      'VALUE' => 'Межблочный аналоговый',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'mezhblochnyy_analogovyy',
    ),
    10 => 
    array (
      'VALUE' => 'Межблочный цифровой',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'mezhblochnyy_tsifrovoy',
    ),
    11 => 
    array (
      'VALUE' => 'Разъёмы',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'razyemy',
    ),
    12 => 
    array (
      'VALUE' => 'Силовой кабель',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'silovoy_kabel',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'tip-korrektora',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'TIP_KORREKTORA',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => 'Ламповый',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'lampovyy',
    ),
    1 => 
    array (
      'VALUE' => 'Транзисторный',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'tranzistornyy',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'tip-kronshteina',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'TIP_KRONSHTEINA',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => 'Для колонок',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'dlya_kolonok',
    ),
    1 => 
    array (
      'VALUE' => 'Для телевизора',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'dlya_televizora',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'tip-naushnikov',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'TIP_NAUSHNIKOV',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => 'Закрытые',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'zakrytye',
    ),
    1 => 
    array (
      'VALUE' => 'Открытые',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'otkrytye',
    ),
    2 => 
    array (
      'VALUE' => 'Полуоткрытые',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'poluotkrytye',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'tip-proektora',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'TIP_PROEKTORA',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => 'Для домашнего кинотеатра',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'dlya_domashnego_kinoteatra',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'tip-razema',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'TIP_RAZEMA',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'Y',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => 'Apple Lightning - USB A',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'apple_lightning_usb_a',
    ),
    1 => 
    array (
      'VALUE' => 'BNC - RCA (S/PDIF)',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'bnc_rca_s_pdif',
    ),
    2 => 
    array (
      'VALUE' => 'BNC — BNC',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'bnc_bnc',
    ),
    3 => 
    array (
      'VALUE' => 'HDMI - HDMI',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'hdmi_hdmi',
    ),
    4 => 
    array (
      'VALUE' => 'HDMI-HDMI Micro',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'hdmi_hdmi_micro',
    ),
    5 => 
    array (
      'VALUE' => 'HDMI-HDMI Mini',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'hdmi_hdmi_mini',
    ),
    6 => 
    array (
      'VALUE' => 'Jack 3.5',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'jack_3_5',
    ),
    7 => 
    array (
      'VALUE' => 'Jack 3.5 - 2Jack 3.5',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'jack_3_5_2jack_3_5',
    ),
    8 => 
    array (
      'VALUE' => 'Jack 3.5 - RCA (S/PDIF)',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'jack_3_5_rca_s_pdif',
    ),
    9 => 
    array (
      'VALUE' => 'Jack 3.5 — 2 RCA',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'jack_3_5_2_rca',
    ),
    10 => 
    array (
      'VALUE' => 'Jack 3.5 — Jack 3.5',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'jack_3_5_jack_3_5',
    ),
    11 => 
    array (
      'VALUE' => 'Jack 6.3 - 2 Jack 3.5',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'jack_6_3_2_jack_3_5',
    ),
    12 => 
    array (
      'VALUE' => 'Phono 2 RCA – 2 RCA',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'phono_2_rca_2_rca',
    ),
    13 => 
    array (
      'VALUE' => 'Phono DIN - 2 XLR',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'phono_din_2_xlr',
    ),
    14 => 
    array (
      'VALUE' => 'Phono DIN – 2 RCA',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'phono_din_2_rca',
    ),
    15 => 
    array (
      'VALUE' => 'Phono XLR - XLR',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'phono_xlr_xlr',
    ),
    16 => 
    array (
      'VALUE' => 'RCA- RCA (S/PDIF)',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'rca_rca_s_pdif',
    ),
    17 => 
    array (
      'VALUE' => 'RCA-RCA (стерео)',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'rca_rca_stereo',
    ),
    18 => 
    array (
      'VALUE' => 'RJ45 - RJ45',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'rj45_rj45',
    ),
    19 => 
    array (
      'VALUE' => 'USB A - USB B Micro',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'usb_a_usb_b_micro',
    ),
    20 => 
    array (
      'VALUE' => 'USB A - USB B Mini',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'usb_a_usb_b_mini',
    ),
    21 => 
    array (
      'VALUE' => 'USB A – USB B',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'usb_a_usb_b',
    ),
    22 => 
    array (
      'VALUE' => 'XLR',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'xlr',
    ),
    23 => 
    array (
      'VALUE' => 'XLR- XLR (AES/EBU)',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'xlr_xlr_aes_ebu',
    ),
    24 => 
    array (
      'VALUE' => 'XLR-XLR (стерео)',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'xlr_xlr_stereo',
    ),
    25 => 
    array (
      'VALUE' => 'Банан – Банан',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'banan_banan',
    ),
    26 => 
    array (
      'VALUE' => 'Без разъёмов',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'bez_razyemov',
    ),
    27 => 
    array (
      'VALUE' => 'Другой',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'drugoy',
    ),
    28 => 
    array (
      'VALUE' => 'Лопатки – Бананы',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'lopatki_banany',
    ),
    29 => 
    array (
      'VALUE' => 'Лопатки – Лопатки',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'lopatki_lopatki',
    ),
    30 => 
    array (
      'VALUE' => 'Оптический Toslink — Minitoslink',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'opticheskiy_toslink_minitoslink',
    ),
    31 => 
    array (
      'VALUE' => 'Оптический Toslink — Toslink',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'opticheskiy_toslink_toslink',
    ),
    32 => 
    array (
      'VALUE' => 'Сабвуфер RCA – 2 RCA',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'sabvufer_rca_2_rca',
    ),
    33 => 
    array (
      'VALUE' => 'Сабвуфер RCA – RCA',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'sabvufer_rca_rca',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'tip-tovara',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'TIP_TOVARA',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => 'Аксессуары для винила',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'aksessuary_dlya_vinila',
    ),
    1 => 
    array (
      'VALUE' => 'Головки и иглы',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'golovki_i_igly',
    ),
    2 => 
    array (
      'VALUE' => 'Проигрыватель пластинок',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'proigryvatel_plastinok',
    ),
    3 => 
    array (
      'VALUE' => 'Тонарм',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'tonarm',
    ),
    4 => 
    array (
      'VALUE' => 'Фонокорректор',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'fonokorrektor',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'tip-ustrojstva',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'TIP_USTROJSTVA',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'Y',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => 'Bluetooth колонка',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'bluetooth_kolonka',
    ),
    1 => 
    array (
      'VALUE' => 'Плеер',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'pleer',
    ),
    2 => 
    array (
      'VALUE' => 'Усилитель для наушников',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'usilitel_dlya_naushnikov',
    ),
    3 => 
    array (
      'VALUE' => 'Усилитель для наушников с ЦАП',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'usilitel_dlya_naushnikov_s_tsap',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'tonarm-komplekt',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'TONARM_KOMPLEKT',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => 'Есть',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'est',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'tsap',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'TSAP',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => 'Есть',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'est',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'type-acoustic-system',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'TYPE_ACOUSTIC_SYSTEM',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'Y',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => 'Акустика Dolby Atmos',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'akustika_dolby_atmos',
    ),
    1 => 
    array (
      'VALUE' => 'Всепогодная и ландшафтная акустика',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'vsepogodnaya_i_landshaftnaya_akustika',
    ),
    2 => 
    array (
      'VALUE' => 'Встраиваемые в потолок',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'vstraivaemye_v_potolok',
    ),
    3 => 
    array (
      'VALUE' => 'Встраиваемые в стену',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'vstraivaemye_v_stenu',
    ),
    4 => 
    array (
      'VALUE' => 'Комплекты акустических систем',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'komplekty_akusticheskikh_sistem',
    ),
    5 => 
    array (
      'VALUE' => 'Напольные колонки',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'napolnye_kolonki',
    ),
    6 => 
    array (
      'VALUE' => 'Настенные колонки',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'nastennye_kolonki',
    ),
    7 => 
    array (
      'VALUE' => 'Полочные колонки',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'polochnye_kolonki',
    ),
    8 => 
    array (
      'VALUE' => 'Портативные Bluetooth колонки',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'portativnye_bluetooth_kolonki',
    ),
    9 => 
    array (
      'VALUE' => 'Потолочные подвесные колонки',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'potolochnye_podvesnye_kolonki',
    ),
    10 => 
    array (
      'VALUE' => 'Сабвуфер',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'sabvufer',
    ),
    11 => 
    array (
      'VALUE' => 'Саундбары',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'saundbary',
    ),
    12 => 
    array (
      'VALUE' => 'Стационарные активные и Bluetooth колонки',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'statsionarnye_aktivnye_i_bluetooth_kolonki',
    ),
    13 => 
    array (
      'VALUE' => 'Центральный канал',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'tsentralnyy_kanal',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'type-izluchateli',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'TYPE_IZLUCHATELI',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'Y',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => 'Арматурные',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'armaturnye',
    ),
    1 => 
    array (
      'VALUE' => 'Динамические',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'dinamicheskie',
    ),
    2 => 
    array (
      'VALUE' => 'Планарные',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'planarnye',
    ),
    3 => 
    array (
      'VALUE' => 'Электростатические',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'elektrostaticheskie',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'usilitel-type',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'USILITEL_TYPE',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'Y',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => 'Гибридный',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'gibridnyy',
    ),
    1 => 
    array (
      'VALUE' => 'Ламповый',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'lampovyy',
    ),
    2 => 
    array (
      'VALUE' => 'Транзисторный',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'tranzistornyy',
    ),
    3 => 
    array (
      'VALUE' => 'Цифровой',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'tsifrovoy',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'ves-golovki',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'VES_GOLOVKI',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'N',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'vhodi-fonokorrektora',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'VHODI_FONOKORREKTORA',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'Y',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => 'RCA',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'rca',
    ),
    1 => 
    array (
      'VALUE' => 'XLR',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'xlr',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'vhodi-hdmi',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'VHODI_HDMI',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => '5',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '5',
    ),
    1 => 
    array (
      'VALUE' => '6',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '6',
    ),
    2 => 
    array (
      'VALUE' => '7',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '7',
    ),
    3 => 
    array (
      'VALUE' => '8',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '8',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'vid-aksessuara',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'VID_AKSESSUARA',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => 'База для тонарма',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'baza_dlya_tonarma',
    ),
    1 => 
    array (
      'VALUE' => 'Блоки питания и управления',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'bloki_pitaniya_i_upravleniya',
    ),
    2 => 
    array (
      'VALUE' => 'Весы, уровни и шаблоны',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'vesy_urovni_i_shablony',
    ),
    3 => 
    array (
      'VALUE' => 'Жидкости и мойки',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'zhidkosti_i_moyki',
    ),
    4 => 
    array (
      'VALUE' => 'Опоры, полки, кронштейны',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'opory_polki_kronshteyny',
    ),
    5 => 
    array (
      'VALUE' => 'Пассики',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'passiki',
    ),
    6 => 
    array (
      'VALUE' => 'Прижимы',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'prizhimy',
    ),
    7 => 
    array (
      'VALUE' => 'Прочее',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'prochee',
    ),
    8 => 
    array (
      'VALUE' => 'Щётки',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'shchyetki',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'vid-korrektora',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'VID_KORREKTORA',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'Y',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => 'MC',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'mc',
    ),
    1 => 
    array (
      'VALUE' => 'MM',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'mm',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'vid-multiroom-usrtojstva',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'VID_MULTIROOM_USRTOJSTVA',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'Y',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => 'Беспроводной адаптер',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'besprovodnoy_adapter',
    ),
    1 => 
    array (
      'VALUE' => 'ИК-оборудование',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'ik_oborudovanie',
    ),
    2 => 
    array (
      'VALUE' => 'Распределитель звука',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'raspredelitel_zvuka',
    ),
    3 => 
    array (
      'VALUE' => 'Регулятор громкости',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'regulyator_gromkosti',
    ),
    4 => 
    array (
      'VALUE' => 'Цифровой интерфейс',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'tsifrovoy_interfeys',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'vid-naushniki',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'VID_NAUSHNIKI',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'Y',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => 'Внутриканальные',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'vnutrikanalnye',
    ),
    1 => 
    array (
      'VALUE' => 'Накладные',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'nakladnye',
    ),
    2 => 
    array (
      'VALUE' => 'Полноразмерные',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'polnorazmernye',
    ),
    3 => 
    array (
      'VALUE' => 'С микрофоном',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 's_mikrofonom',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'vid-tonarma',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'VID_TONARMA',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => 'Поворотный',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'povorotnyy',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'vid-usilitel',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'VID_USILITEL',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'Y',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => 'Интегральный усилитель',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'integralnyy_usilitel',
    ),
    1 => 
    array (
      'VALUE' => 'Многоканальные усилители',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'mnogokanalnye_usiliteli',
    ),
    2 => 
    array (
      'VALUE' => 'Моно усилители мощности',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'mono_usiliteli_moshchnosti',
    ),
    3 => 
    array (
      'VALUE' => 'Предварительный усилитель',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'predvaritelnyy_usilitel',
    ),
    4 => 
    array (
      'VALUE' => 'Стерео усилители мощности',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'stereo_usiliteli_moshchnosti',
    ),
    5 => 
    array (
      'VALUE' => 'Усилители для наушников',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'usiliteli_dlya_naushnikov',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'vihod-na-naushniki',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'VIHOD_NA_NAUSHNIKI',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'Y',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => '2.5мм',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '2_5mm',
    ),
    1 => 
    array (
      'VALUE' => '3-pin XLR',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '3_pin_xlr',
    ),
    2 => 
    array (
      'VALUE' => '3.5мм',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '3_5mm',
    ),
    3 => 
    array (
      'VALUE' => '4-pin XLR',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '4_pin_xlr',
    ),
    4 => 
    array (
      'VALUE' => '6.3мм',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '6_3mm',
    ),
    5 => 
    array (
      'VALUE' => 'Pentaconn 4.4mm',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'pentaconn_4_4mm',
    ),
    6 => 
    array (
      'VALUE' => 'Stax',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'stax',
    ),
    7 => 
    array (
      'VALUE' => 'Балансный',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'balansnyy',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'vihod-predusilitelya',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'VIHOD_PREDUSILITELYA',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => 'Есть',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'est',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'vihodi-fonokorrektora',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'VIHODI_FONOKORREKTORA',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'Y',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => 'RCA',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'rca',
    ),
    1 => 
    array (
      'VALUE' => 'XLR',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'xlr',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'vihodi-hdmi',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'VIHODI_HDMI',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => '1',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1',
    ),
    1 => 
    array (
      'VALUE' => '2',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '2',
    ),
    2 => 
    array (
      'VALUE' => '3',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '3',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'vihodi-na-subwoofer',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'VIHODI_NA_SUBWOOFER',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => '1',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1',
    ),
    1 => 
    array (
      'VALUE' => '2',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '2',
    ),
  ),
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'vihodnoe',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'VIHODNOE',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => '0.25',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '0_25',
    ),
    1 => 
    array (
      'VALUE' => '0.3',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '0_3',
    ),
    2 => 
    array (
      'VALUE' => '0.32',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '0_32',
    ),
    3 => 
    array (
      'VALUE' => '0.35',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '0_35',
    ),
    4 => 
    array (
      'VALUE' => '0.4',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '0_4',
    ),
    5 => 
    array (
      'VALUE' => '1.6',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '1_6',
    ),
    6 => 
    array (
      'VALUE' => '2',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '2',
    ),
    7 => 
    array (
      'VALUE' => '2.5',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '2_5',
    ),
    8 => 
    array (
      'VALUE' => '2.7',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '2_7',
    ),
    9 => 
    array (
      'VALUE' => '3',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '3',
    ),
    10 => 
    array (
      'VALUE' => '3.5',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '3_5',
    ),
    11 => 
    array (
      'VALUE' => '4',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '4',
    ),
    12 => 
    array (
      'VALUE' => '5',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '5',
    ),
    13 => 
    array (
      'VALUE' => '5.5',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '5_5',
    ),
    14 => 
    array (
      'VALUE' => '6',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '6',
    ),
    15 => 
    array (
      'VALUE' => '7',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '7',
    ),
  ),
));
    $helper->UserOptions()->saveElementGrid($iblockId, array (
  'views' => 
  array (
    'default' => 
    array (
      'name' => NULL,
      'columns' => 
      array (
        0 => 'CATALOG_TYPE',
        1 => 'NAME',
        2 => 'ACTIVE',
        3 => 'SORT',
        4 => 'TIMESTAMP_X',
        5 => 'ID',
        6 => 'CATALOG_AVAILABLE',
      ),
      'sort_by' => NULL,
      'sort_order' => NULL,
      'page_size' => 50,
      'saved_filter' => NULL,
      'custom_names' => NULL,
      'columns_sizes' => 
      array (
        'expand' => 1,
        'columns' => 
        array (
        ),
      ),
      'sticked_columns' => 
      array (
      ),
    ),
  ),
  'filters' => 
  array (
  ),
  'current_view' => 'default',
));

    }

    public function down()
    {
        //your code ...
    }
}
