<?php

namespace Sprint\Migration;


use Bitrix\Iblock\PropertyFeatureTable;
use Bitrix\Iblock\PropertyTable;
use Bitrix\Main\Loader;
use Bitrix\Main\ORM\Objectify\Collection;
use Bitrix\Main\ORM\Objectify\EntityObject;

class CatalogPropertyDisplayed20201103214718 extends Version
{
    protected $description = "";

    protected $moduleVersion = "3.12.17";

    public function up()
    {
        Loader::includeModule('iblock');

        $codes = [
            'P_3D',
            'P_4K',
            'ACOUSTIC_OFORMLENIE',
            'ADCIN',
            'AKSESSUAR',
            'ANALOGOVIE_VHODI',
            'ANALOGOVIE_VIHODI',
            'AUDIO_VIDEO_STRIMING',
            'BI_WIRING',
            'BLUETOOTH',
            'BREND',
            'CABELL',
            'CABLE_WIRWLESS',
            'CIFROVIE_VHODI',
            'CIFROVIE_VIHODI',
            'COLOUR',
            'DLA_PROEKTORA',
            'DLINA_TONARMA',
            'DSD',
            'EFFEKTIVNAJA_MASSA',
            'FONOKORRECTOR',
            'FULLHD',
            'GOLOVKA',
            'GOTOVIE',
            'IMPEDANCE',
            'INTERNET',
            'KOLONKI_KOMPLEKT',
            'KONTRASTNOCT',
            'MNOGOKANALNIJ_VIHOD',
            'PITANIE',
            'PLEER_TRANSPORT',
            'PODDERGKA_KART',
            'PODDERJKA_SACD',
            'POLKI',
            'PRIVOD',
            'PROEKTOR_EKRAN',
            'RAZEM',
            'RECIVER_PROCESSOR',
            'SDVIG_LINZ',
            'SECHENIE',
            'SENSORNIJ',
            'SPEED',
            'STEREO_VIHOD',
            'STOIKA',
            'TIP_EKRANA',
            'TIP_GOLOVKI',
            'TIP_KABELIA',
            'TIP_KORREKTORA',
            'TIP_KRONSHTEINA',
            'TIP_NAUSHNIKOV',
            'TIP_PROEKTORA',
            'TIP_RAZEMA',
            'TIP_TOVARA',
            'TIP_USTROJSTVA',
            'TONARM_KOMPLEKT',
            'TSAP',
            'TYPE_ACOUSTIC_SYSTEM',
            'TYPE_IZLUCHATELI',
            'USILITEL_TYPE',
            'VHODI_FONOKORREKTORA',
            'VHODI_HDMI',
            'VID_AKSESSUARA',
            'VID_KORREKTORA',
            'VID_MULTIROOM_USRTOJSTVA',
            'VID_NAUSHNIKI',
            'VID_TONARMA',
            'VID_USILITEL',
            'VIHOD_NA_NAUSHNIKI',
            'VIHOD_PREDUSILITELYA',
            'VIHODI_FONOKORREKTORA',
            'VIHODI_HDMI',
            'VIHODI_NA_SUBWOOFER',
            'VIHODNOE',
            'VOSPROIZVEDENIE_CD',
            'VOSPROIZVEDENIE_USB',
            'VSTROENNIJ_PREDUSILITEL',
            'VSTROENNIJ_USILITEL_NAUSH',
            'WI_FI',
            'XLR',
            'XLR_VIHOD',
            'YARKOST',
            'AVTOMATICHESKIOE_VKLYUCHENIE_VYKLYUCHENIE',
            'ANALOGOVYE_VKHODY',
            'VCH_DINAMIK',
            'VCH_SCH_DINAMIK',
            'VYKHOD_NA_SABVUFER',
            'DIAMETR_MONTAZHNOGO_OTVERSTIYA_MM',
            'KROSSOVER',
            'LINEYNYE_VKHODY',
            'MATERIAL_IGLODERZHATELYA',
            'MATERIAL_KATUSHKI',
            'MATERIAL_OTDELKI',
            'MOSHCHNOST',
            'MOSHCHNOST_NA_KANAL_6_OM_VT',
            'MOSHCHNOST_NOMINALNAYA_MAKSIMALNAYA',
            'MOSHCHNOST_USILITELYA',
            'NCH_DINAMIK',
            'PRIZHIMNAYA_SILA_G',
            'PULT_DU',
            'RAZMER_DRAYVEROV',
            'REGULIROVKA_FAZY',
            'REKOMENDUEMAYA_MOSHCHNOST_USILITELYA',
            'SCH_DINAMIK',
            'TVITER',
            'UROVEN_ZVUKOVOGO_DAVLENIYA',
            'CHASTOTA_RAZDELA_KROSSOVERA_GTS_KGTS',
            'CHASTOTNYY_DIAPAZON',
            'SREZ_KROSSOVERA',
            'NCH_SCH_DINAMIK',
            'DIAGONAL',
            'DIAMETR_KOLONKI',
            'DLINA',
            'KOLICHESTVO_KANALOV',
            'MAX_NAGRUZKA',
            'MAXIMUM_DISCRETIZATCIA',
            'MAXIMUM_FREQUENCY',
            'MAXIMUM_RAZRIADNOST',
            'MINIMUM_FREQUENCY',
            'MONTAJ_GLUBINA',
            'MOZHNOST_NA_KANAL',
            'MOZHNOST_NA_KANAL_4OM',
            'SENSITIVITY',
            'VES_GOLOVKI',
            'VARIANTY_OTDELKI',
            'VES_KG',
            'VNESHNIY_DIAMETR_MM',
            'VNESHNIY_RAZMER_MM',
            'VOSPROIZVODYASHCHAYA_IGLA',
            'VREMYA_AVTONOMNOY_RABOTY',
            'DINAMICHESKAYA_PODATLIVOST',
            'IMPEDANS_GOLOVKI',
            'RAZMERY_SHKHVKHG',
            'WIDTH',
            'DEPTH',
            'HEIGHT',
            'AKSESSUARY',
            'VKHODY_VYKHODY',
            'DOPOLNITELNYE_AKSESSUARY',
            'DRAYVERY',
            'KOLICHESTVO_POLOS',
            'MNOGOKANALNOE_OKRUZHAYUSHCHEE_ZVUCHANIE',
            'RAZMERY_MONTAZHNOGO_OTVERSTIYA',
            'SETEVYE_VOZMOZHNOSTI',
            'FUNKTSII_HDMI',
            'FUNKTSII_ULUCHSHENIYA_ZVUCHANIYA',
            'TSIFROVYE_VKHODY',
            'SCH_NCH_DINAMIK',
        ];

        $properties = PropertyTable::query()
            ->setSelect(['ID', 'CODE'])
            ->whereIn('CODE', $codes)
            ->where('IBLOCK.CODE', 'catalog')
            ->fetchCollection();

        $existingFeatures = PropertyFeatureTable::query()
            ->setSelect(['ID', 'PROPERTY_ID'])
            ->whereIn('PROPERTY_ID', $properties->getIdList())
            ->where('FEATURE_ID', 'DETAIL_PAGE_SHOW')
            ->fetchCollection();

        $nonExistent = array_diff(
            array_filter($properties->getIdList()),
            array_filter($existingFeatures->getPropertyIdList())
        );

        /** @var Collection $existingFeatures */
        foreach ($nonExistent as $propertyId) {
            $existingFeatures->add(
                PropertyFeatureTable::createObject()
                    ->setPropertyId($propertyId)
                    ->setFeatureId('DETAIL_PAGE_SHOW')
                    ->setModuleId('iblock')
                    ->setIsEnabled(true)
            );
        }

        foreach($existingFeatures as $property) {
            $property->setIsEnabled(true);
        }

        $existingFeatures->save();

    }

    public function down()
    {
        //your code ...
    }
}
