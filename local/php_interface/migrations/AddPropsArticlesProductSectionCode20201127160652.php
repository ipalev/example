<?php

namespace Sprint\Migration;


class AddPropsArticlesProductSectionCode20201127160652 extends Version
{
    protected $description = "Добавил свойство \"раздел привязанного элемента \" для упрощения запросов.";

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
  'NAME' => 'Код раздела привязанного товара(автоматическое)',
  'ACTIVE' => 'Y',
  'SORT' => '600',
  'CODE' => 'PRODUCT_SECTION_CODE',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'S',
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
