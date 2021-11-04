<?php

namespace Sprint\Migration;


use Bitrix\Iblock\Model\PropertyFeature;
use Bitrix\Iblock\PropertyTable;
use Bitrix\Iblock\SectionPropertyTable;
use Bitrix\Main\ORM\Objectify\Collection;
use Bitrix\Main\ORM\Objectify\EntityObject;

class CatalogSetFilteableProps20201030153106 extends Version
{
    protected $description = "";

    protected $moduleVersion = "3.12.17";

    public function up()
    {
        $helper = $this->getHelperManager();
        $iblockId = $helper->Iblock()->getIblockIdIfExists('catalog', 'catalog');

        $codes = [
            'VOSPROIZVEDENIE_CD',
            'VOSPROIZVEDENIE_USB',
            'VSTROENNIJ_PREDUSILITEL',
            'VSTROENNIJ_USILITEL_NAUSH',
            'WI_FI',
            'XLR',
            'XLR_VIHOD',
            'YARKOST',
            'ANALOGOVYE_VKHODY',
            'TSIFROVYE_VKHODY',
            'WIDTH',
            'DEPTH',
            'HEIGHT',
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
            'DIAGONAL',
            'DIAMETR_KOLONKI',
            'DLA_PROEKTORA',
            'DLINA',
            'DLINA_TONARMA',
            'DSD',
            'EFFEKTIVNAJA_MASSA',
            'FONOKORRECTOR',
            'FORMAT_KARTINKI',
            'FULLHD',
            'GOLOVKA',
            'GOTOVIE',
            'IMPEDANCE',
            'INTERNET',
            'KOLICHESTVO_KANALOV',
            'KOLONKI_KOMPLEKT',
            'KONTRASTNOCT',
            'MAX_NAGRUZKA',
            'MAXIMUM_DISCRETIZATCIA',
            'MAXIMUM_FREQUENCY',
            'MAXIMUM_RAZRIADNOST',
            'MINIMUM_FREQUENCY',
            'MNOGOKANALNIJ_VIHOD',
            'MONTAJ_GLUBINA',
            'MOZHNOST_NA_KANAL',
            'MOZHNOST_NA_KANAL_4OM',
            'NASTROJKA_PARAMETROV',
            'PITANIE',
            'PLEER_TRANSPORT',
            'PODDERGKA_KART',
            'PODDERJKA_SACD',
            'POLKI',
            'PRIVOD',
            'PROEKTOR_EKRAN',
            'RAZ',
            'RAZEM',
            'RECIVER_PROCESSOR',
            'SDVIG_LINZ',
            'SECHENIE',
            'SENSITIVITY',
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
            'VES_GOLOVKI',
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
        ];

        $sectionProperties = SectionPropertyTable::query()
            ->setSelect(['CODE' => 'PROPERTY.CODE'])
            ->whereIn('PROPERTY.CODE', $codes)
            ->whereNot('SECTION_ID')
            ->fetchCollection();

        $properties = PropertyTable::query()
            ->setSelect(['CODE', 'ID'])
            ->where('IBLOCK_ID', $iblockId)
            ->whereIn('CODE', $codes)
            ->fetchAll();

        foreach($properties as $property) {
            $helper->Iblock()->saveProperty($iblockId, array (
                'CODE' => $property['CODE'],
                'FILTRABLE' => 'Y',
            ));
        }

        $sectionPropertyUpdated = [];
        /** @var EntityObject $sectionProperty */
        foreach ($sectionProperties as $sectionProperty) {
            $sectionProperty->delete();
        }
    }


    public function down()
    {
        //your code ...
    }
}