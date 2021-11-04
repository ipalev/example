<?php

namespace Sprint\Migration;


class AddPropsArticles20201123131406 extends Version
{
    protected $description = "Добавлено свойство привязки к товару ";

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
  'NAME' => 'Привязка к товару',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'PRODUCT',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'E',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
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
  'HINT' => 'Для вывода свойств в блоке "Паспорт"',
));

    }

    public function down()
    {
        //your code ...
    }
}
