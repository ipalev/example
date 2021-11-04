<?php

namespace Sprint\Migration;


class CatalogSectionIcon20201029112947 extends Version
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
  'FIELD_NAME' => 'UF_BAR_ICON',
  'USER_TYPE_ID' => 'file',
  'XML_ID' => '',
  'SORT' => '100',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'SIZE' => 20,
    'LIST_WIDTH' => 200,
    'LIST_HEIGHT' => 200,
    'MAX_SHOW_SIZE' => 0,
    'MAX_ALLOWED_SIZE' => 0,
    'EXTENSIONS' => 
    array (
      'jpg' => true,
      'gif' => true,
      'bmp' => true,
      'png' => true,
      'jpeg' => true,
      'svg' => true,
    ),
    'TARGET_BLANK' => 'Y',
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'en' => 'Section page icon',
    'ru' => 'Иконка для страницы раздела',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'en' => 'Section page icon',
    'ru' => 'Иконка для страницы раздела',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'en' => 'Section page icon',
    'ru' => 'Иконка для страницы раздела',
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
