<?php

namespace Sprint\Migration;


use Bitrix\Iblock\PropertyTable;
use Bitrix\Main\Loader;

class CatalogPropsDelete20201103135150 extends Version
{
    protected $description = "";

    protected $moduleVersion = "3.12.17";

    public function up()
    {
        Loader::includeModule('iblock');

        $codes = [
            'FORMAT_KARTINKI',
            'NASTROJKA_PARAMETROV',
            'RAZ',
            'VCH_SCH',
            'VCH_SCH_DINAMIKI',
            'VES_GRAMM',
            'VOZMOZHNAYA_MODERNIZATSIYA',
            'DOP_VOZMOZHNOSTI',
            'DOP_OSOBENNOSTI',
            'DOPOLNITELNO',
            'DOPOLNITELNYE_KHARAKTERISTIKI',
            'OBSHCHEE',
            'OPTSIONALNYE_AKSESSUARY',
            'OSOBENNOSTI',
            'VKHODY',
            'DOPOLNITELNYE_AKSESSUARY_OPTSIONALNO',
            'DOPOLNITELNYE_OPTSII',
            'MOSHCHNOST_VSTROENNOGO_USILITELYA_NOM_MAKS_',
            'MOSHCHNOST_NOMINALNAYA_MUZYKALNAYA',
            'MOSHCHNOST_NOMINALNAYA_MUZYKALNAYA1',
            'NCH_DINAMIK1',
            'SCH_DINAMIK1',
            'SPETSIFIKATSII',
            'RAZMERY_SABVUFERA',
            'SREZ_KROSSOVERA',
        ];

        $properties2Delete = PropertyTable::query()
            ->setSelect(['ID'])
            ->whereIn('CODE', $codes)
            ->fetchCollection();

        foreach ($properties2Delete as $property) {
            $property->delete();
        }
    }

    public function down()
    {
        //your code ...
    }
}
