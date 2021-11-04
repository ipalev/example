<?php

namespace Sprint\Migration;

use Bitrix\Iblock\Model\PropertyFeature;
use Bitrix\Iblock\PropertyTable;

class CatalogPropertyGalleryUpdate20201029111948 extends Version
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
  'NAME' => 'Изображения',
  'ACTIVE' => 'Y',
  'SORT' => '1',
  'CODE' => 'GALLERY',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'F',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'Y',
  'XML_ID' => NULL,
  'FILE_TYPE' => 'jpg, gif, bmp, png, jpeg, svg',
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

        $property = PropertyTable::query()
            ->setSelect(['ID'])
            ->where('CODE', 'GALLERY')
            ->fetch();

        if($property['ID']) {
            PropertyFeature::setFeatures($property['ID'],
                [
                    [
                        'MODULE_ID' => 'iblock',
                        'FEATURE_ID' => PropertyFeature::FEATURE_ID_LIST_PAGE_SHOW,
                        'IS_ENABLED' => 'Y'
                    ],
                    [
                        'MODULE_ID' => 'iblock',
                        'FEATURE_ID' => PropertyFeature::FEATURE_ID_DETAIL_PAGE_SHOW,
                        'IS_ENABLED' => 'Y'
                    ]
                ]
            );
        }
    }

    public function down()
    {
        //your code ...
    }
}
