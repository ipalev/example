<?php

namespace Sprint\Migration;


class CallbackEditForm20201111121719 extends Version
{
    protected $description = "";

    protected $moduleVersion = "3.22.2";

    /**
     * @throws Exceptions\HelperException
     * @return bool|void
     */
    public function up()
    {
        $helper = $this->getHelperManager();
        $iblockId = $helper->Iblock()->getIblockIdIfExists('callback-form', 'forms');
        $helper->UserOptions()->saveElementForm($iblockId, array (
  'Обращение|edit1' => 
  array (
    'DATE_CREATE' => 'Создан',
    'TIMESTAMP_X' => 'Изменен',
    'NAME' => 'Название',
    'IBLOCK_ELEMENT_PROPERTY' => 'Значения свойств',
    'IBLOCK_ELEMENT_PROP_VALUE' => 'Значения свойств',
    'PROPERTY_EMAIL' => 'Email',
    'PROPERTY_NAME' => 'Имя',
    'PROPERTY_MESSAGE' => 'Сообщение',
    'PROPERTY_PHONE' => 'Телефон',
  ),
));
    $helper->UserOptions()->saveElementGrid($iblockId, array (
  'views' => 
  array (
    'default' => 
    array (
      'columns' => 
      array (
        0 => '',
      ),
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
