<?php

namespace Sprint\Migration;


class addPropSpeed20210226154938 extends Version
{
    protected $description = "добавление свойства скорости вращения 33,45,78";

    protected $moduleVersion = "3.23.4";

    /**
     * @throws Exceptions\HelperException
     * @return bool|void
     */
    public function up()
    {
        $helper = $this->getHelperManager();
        $iblockId = $helper->Iblock()->getIblockIdIfExists('catalog', 'catalog');
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'Скорость вращения',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'ROTATION_SPEED',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'C',
  'MULTIPLE' => 'Y',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'Y',
  'FILTRABLE' => 'Y',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
  'VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => '33',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'est33',
    ),
    1 => 
    array (
      'VALUE' => '45',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'est45',
    ),
    2 => 
    array (
      'VALUE' => '78',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'est78',
    ),
  ),
));

    }

    public function down()
    {
        //your code ...
    }
}
