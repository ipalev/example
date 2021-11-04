<?php

namespace Sprint\Migration;


class CatalogBrandPropertyUpdate20201112175130 extends Version
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
        $iblockId = $helper->Iblock()->getIblockIdIfExists('catalog', 'catalog');
        $helper->Iblock()->saveProperty($iblockId, array (
          'NAME' => 'Производитель',
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
          'FILTRABLE' => 'Y',
          'IS_REQUIRED' => 'N',
          'VERSION' => '2',
          'USER_TYPE' => NULL,
          'USER_TYPE_SETTINGS' => NULL,
          'HINT' => '',
          'VALUES' => [],
        ));

    }

    public function down()
    {
        //your code ...
    }
}
