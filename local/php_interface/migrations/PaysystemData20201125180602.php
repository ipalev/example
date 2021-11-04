<?php

namespace Sprint\Migration;


class PaysystemData20201125180602 extends Version
{
    protected $description = "";

    protected $moduleVersion = "3.22.3";

    /**
     * @throws Exceptions\HelperException
     * @return bool|void
     */
    public function up()
    {
        $helper = $this->getHelperManager();
        $hlblockId = $helper->Hlblock()->saveHlblock(array (
  'NAME' => 'PaysystemData',
  'TABLE_NAME' => 'b_hlbd_paysystem_data',
  'LANG' => 
  array (
    'ru' => 
    array (
      'NAME' => 'Данные платёжных систем',
    ),
    'en' => 
    array (
      'NAME' => 'Paysystem Data',
    ),
  ),
));
    $helper->Hlblock()->saveGroupPermissions($hlblockId, array (
  'everyone' => 'R',
));
        $helper->Hlblock()->saveField($hlblockId, array (
  'FIELD_NAME' => 'UF_PS_CODE',
  'USER_TYPE_ID' => 'string',
  'XML_ID' => '',
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
    'en' => 'Paysystem code',
    'ru' => 'Код платёжной системы',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'en' => 'Paysystem code',
    'ru' => 'Код платёжной системы',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'en' => 'Paysystem code',
    'ru' => 'Код платёжной системы',
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
        $helper->Hlblock()->saveField($hlblockId, array (
  'FIELD_NAME' => 'UF_IMAGE',
  'USER_TYPE_ID' => 'file',
  'XML_ID' => '',
  'SORT' => '100',
  'MULTIPLE' => 'Y',
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
    'TARGET_BLANK' => 'N',
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'en' => 'Images',
    'ru' => 'Изображения',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'en' => 'Images',
    'ru' => 'Изображения',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'en' => 'Images',
    'ru' => 'Изображения',
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
