<?php

namespace Sprint\Migration;


class CatalogQuickFilterBar20201102010950 extends Version
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
        $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'IBLOCK_catalog:catalog_SECTION',
  'FIELD_NAME' => 'UF_QUICK_BAR_FILTERS',
  'USER_TYPE_ID' => 'prop',
  'XML_ID' => '',
  'SORT' => '100',
  'MULTIPLE' => 'Y',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => NULL,
  'EDIT_FORM_LABEL' => 
  array (
    'en' => 'Show this properties in side section filter',
    'ru' => 'Отображать следующие свойства в боковом фильтре раздела',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'en' => 'Show this properties in side section filter',
    'ru' => 'Отображать следующие свойства в боковом фильтре раздела',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'en' => 'Show this properties in side section filter',
    'ru' => 'Отображать следующие свойства в боковом фильтре раздела',
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
