<?php

namespace Sprint\Migration;


use Bitrix\Iblock\PropertyTable;

class ArticlesProductSectionsPropertyRemove20201127201748 extends Version
{
    protected $description = "";

    protected $moduleVersion = "3.22.2";

    public function up()
    {
        $helper = $this->getHelperManager();
        $iblockId = $helper->Iblock()->getIblockIdIfExists('articles', 'info');
        $helper->Iblock()->deletePropertyIfExists($iblockId, 'PRODUCT_SECTION_CODE');
    }

    public function down()
    {
        //your code ...
    }
}
