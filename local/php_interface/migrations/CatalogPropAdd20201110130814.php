<?php

namespace Sprint\Migration;


class CatalogPropAdd20201110130814 extends Version
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
        $iblockId = $helper->Iblock()->getIblockIdIfExists('catalog', 'catalog');
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'Новинка',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'NEW_PRODUCT',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'C',
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
      'VALUE' => 'Y',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => '301740b12f5daab24a13a2f1efa6514d',
    ),
  ),
));

    }

    public function down()
    {
        //your code ...
    }
}
