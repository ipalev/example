<?php

namespace Sprint\Migration;


class CatalogPropsUpdate20201103152609 extends Version
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
  'NAME' => 'СЧ/НЧ-динамик',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'SCH_NCH_DINAMIK',
  'DEFAULT_VALUE' => false,
  'PROPERTY_TYPE' => 'S',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => NULL,
  'MULTIPLE_CNT' => NULL,
  'LINK_IBLOCK_ID' => NULL,
  'WITH_DESCRIPTION' => NULL,
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => 'HTML',
  'USER_TYPE_SETTINGS' => 
  array (
    'height' => 200,
  ),
  'HINT' => NULL,
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'Срез кроссовера',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'SREZ_KROSSOVERA',
  'DEFAULT_VALUE' => NULL,
  'PROPERTY_TYPE' => 'L',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => NULL,
  'MULTIPLE_CNT' => NULL,
  'LINK_IBLOCK_ID' => NULL,
  'WITH_DESCRIPTION' => NULL,
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => NULL,
  'VALUES' => 
  array (
  ),
));

    }

    public function down()
    {
        //your code ...
    }
}
