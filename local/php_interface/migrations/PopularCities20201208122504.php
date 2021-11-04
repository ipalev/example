<?php

namespace Sprint\Migration;


class PopularCities20201208122504 extends Version
{
    protected $description = "";

    protected $moduleVersion = "3.23.4";

    /**
     * @throws Exceptions\HelperException
     * @return bool|void
     */
    public function up()
    {
        $helper = $this->getHelperManager();
        $hlblockId = $helper->Hlblock()->saveHlblock(array (
  'NAME' => 'PopularCities',
  'TABLE_NAME' => 'popular_cities',
  'LANG' => 
  array (
    'ru' => 
    array (
      'NAME' => 'Города',
    ),
    'en' => 
    array (
      'NAME' => 'Сities',
    ),
  ),
));
        $helper->Hlblock()->saveField($hlblockId, array (
  'FIELD_NAME' => 'UF_POPULAR_CITY_NAME',
  'USER_TYPE_ID' => 'string',
  'XML_ID' => 'UF_POPULAR_CITY_NAME',
  'SORT' => '100',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'Y',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'SIZE' => 20,
    'ROWS' => 1,
    'REGEXP' => '',
    'MIN_LENGTH' => 0,
    'MAX_LENGTH' => 0,
    'DEFAULT_VALUE' => '',
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'en' => 'City name',
    'ru' => 'Название города',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'en' => '',
    'ru' => '',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'en' => '',
    'ru' => '',
  ),
  'ERROR_MESSAGE' => 
  array (
    'en' => '',
    'ru' => '',
  ),
  'HELP_MESSAGE' => 
  array (
    'en' => '',
    'ru' => '',
  ),
));
    }

    public function down()
    {
        //your code ...
    }
}
