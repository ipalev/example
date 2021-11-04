<?php

namespace Sprint\Migration;


class ArticlesProductSectionsProperty20201127201717 extends Version
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
        $iblockId = $helper->Iblock()->getIblockIdIfExists('articles', 'info');
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'ID раздела привязанного товара(автоматическое)',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'PRODUCT_SECTION',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'G',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'Y',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => 'catalog:catalog',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '2',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
));

    }

    public function down()
    {
        //your code ...
    }
}
