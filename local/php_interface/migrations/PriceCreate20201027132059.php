<?php

namespace Sprint\Migration;

use Bitrix\Catalog\GroupTable;
use Bitrix\Main\Loader;

class PriceCreate20201027132059 extends Version
{
    protected $description = "";

    protected $moduleVersion = "3.12.17";

    public function up()
    {
        Loader::includeModule('catalog');

        $prices = GroupTable::query()
            ->setSelect(['ID', 'NAME'])
            ->fetch();

        if(!$prices) {
            $price = \CCatalogGroup::Add([
                'NAME' => 'REGULAR',
                'XML_ID' => 'REGULAR',
                'BASE' => 'Y',
                'SORT' => '100',
                "USER_LANG" => [
                    "ru" => "Цена",
                    "en" => "Price"
                ],
                "USER_GROUP_BUY" => [2],
                "USER_GROUP" => [2]
            ]);
        }
    }

    public function down()
    {
        Loader::includeModule('catalog');

        $price = GroupTable::query()
            ->setSelect(['ID', 'NAME'])
            ->where('NAME', REGULAR)
            ->fetch();

        if($price && $price['ID'] > 0) {
            \CCatalogGroup::Delete($price['ID']);
        }
    }
}
