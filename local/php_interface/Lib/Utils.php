<?

namespace Its\Lib;

use Bitrix\Highloadblock\HighloadBlockTable;
use Bitrix\Iblock\ElementTable;
use Bitrix\Iblock\PropertyEnumerationTable;
use Bitrix\Iblock\SectionTable;
use Bitrix\Iblock\PropertyTable;
use Bitrix\Main\Application;
use Bitrix\Main\IO\File;
use Bitrix\Main\Loader;
use Bitrix\Main\ORM\Objectify\EntityObject;
use Bitrix\Main\UrlRewriter;
use Bitrix\Main\UserTable;

class Utils
{

    public static function getHLClass($hlBlockID)
    {
        if ($hlBlockID == 0 && strlen($hlBlockID) <= 0) {
            return false;
        }

        Loader::includeModule("highloadblock");

        $hlblock = HighloadBlockTable::query()->setSelect(['*'])->where(
            intval($hlBlockID) > 0 ? 'ID' : 'NAME',
            $hlBlockID
        )->fetch();
        $entity = HighloadBlockTable::compileEntity($hlblock);
        return $entity->getDataClass();
    }

    public static function firstLetterUp(string $string): string
    {
        if (!strlen($string)) {
            return $string;
        }

        $letters = str_split($string);
        $letters[0] = strtoupper($letters[0]);
        return implode('', $letters);
    }

    /**
     * Убирает из номера лишние символы и теги, которые могут мешать в href-конструкции "tel:"
     * @param $phone
     * @return string
     */
    static function preparePhoneNumber($phone)
    {
        return str_replace([' ', '(', ')', '-'], '', strip_tags($phone));
    }

    public static $propertyEnumValues = [];

    public static function getEnumValues(int $iblockId, string $propertyCode): ?array
    {
        if (!array_key_exists($propertyCode, self::$propertyEnumValues[$iblockId])) {
            self::$propertyEnumValues[$iblockId][$propertyCode] = self::loadEnumValues($iblockId, $propertyCode);
        }

        return self::$propertyEnumValues[$iblockId][$propertyCode];
    }

    public static function loadEnumValues(int $iblockId, string $propertyCode): ?array
    {
        Loader::includeModule('iblock');

        $result = PropertyEnumerationTable::query()->setSelect(
            ['ID', 'XML_ID', 'VALUE', 'PROP_ID' => 'PROPERTY.ID',]
        )->where('PROPERTY.IBLOCK_ID', $iblockId)->where('PROPERTY.CODE', $propertyCode)->fetchAll();

        return $result ?: null;
    }

    /**
     * Метод получает и собирает в массив данные по enum-значению свойства, включая данные самого свойства, а также
     * SEF-урл фильтра, получая на вход XML_ID значения свойства
     * @param int $iblockId
     * @param string $enumXmlId
     * @param string $sefTemplate
     * @return array
     * @throws \Bitrix\Main\SystemException
     * @throws \Bitrix\Main\ArgumentException
     */
    public static function getSEFUrlByPropEnum(int $iblockId, string $enumXmlId, string $sefTemplate): array
    {
        $result = [];

        if (strlen($enumXmlId) > 0) {
            $prop = PropertyEnumerationTable::query()->setSelect(
                [
                    'PROP_ID' => 'PROPERTY.ID',
                    'PROP_CODE' => 'PROPERTY.CODE',
                    'PROP_NAME' => 'PROPERTY.NAME',
                    'PROP_PROPERTY_TYPE' => 'PROPERTY.PROPERTY_TYPE',
                    'ENUM_ID' => 'ID',
                    'ENUM_XML_ID' => 'XML_ID'
                ]
            )->where('PROPERTY.IBLOCK_ID', $iblockId)->where('XML_ID', $enumXmlId)->fetch();

            if ($prop) {
                \CBitrixComponent::includeComponentClass("bitrix:catalog.smart.filter");
                $obSmartFilter = new \CBitrixCatalogSmartFilter;
                $obSmartFilter->arResult['ITEMS'][$prop['PROP_ID']] = [
                    'ID' => $prop['PROP_ID'],
                    'CODE' => $prop['PROP_CODE'],
                    'NAME' => $prop['PROP_NAME'],
                    'PROPERTY_TYPE' => $prop['PROP_PROPERTY_TYPE'],
                ];

                $obSmartFilter->arResult['ITEMS'][$prop['PROP_ID']]['VALUES'] = [
                    [
                        'CHECKED' => true,
                        'URL_ID' => $prop['ENUM_XML_ID']
                    ]
                ];
                $prop['FILTER_URL'] = $obSmartFilter->makeSmartUrl($sefTemplate, true);
            }

            $result = is_array($prop) ? $prop : [];
        }

        return $result;
    }

    /**
     * Метод получает и собирает в массив данные по значения свойства привязки, включая данные самого свойства, а также
     * SEF-урл фильтра, получая на вход ID привязанного элемента
     * @param int $iblockId
     * @param int $linkedIblockId
     * @param int $linkedId
     * @param string $propertyCode
     * @param string $sefTemplate
     * @return array
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Bitrix\Main\ObjectPropertyException
     * @throws \Bitrix\Main\SystemException
     */
    public static function getSEFUrlByLinkedElement(
        int $iblockId,
        int $linkedIblockId,
        int $linkedId,
        string $propertyCode,
        string $sefTemplate
    ): array {
        $result = [];

        if ($linkedId > 0) {
            $linkedElementData = ElementTable::query()->setSelect(['ID', 'CODE'])->where(
                'IBLOCK_ID',
                $linkedIblockId
            )->where(
                'ID',
                $linkedId
            )->fetch();

            $prop = PropertyTable::query()->setSelect(['ID', 'CODE', 'NAME', 'PROPERTY_TYPE'])->where(
                'IBLOCK_ID',
                $iblockId
            )->where('CODE', $propertyCode)->fetch();


            if ($prop) {
                \CBitrixComponent::includeComponentClass("bitrix:catalog.smart.filter");
                $obSmartFilter = new \CBitrixCatalogSmartFilter;
                $obSmartFilter->arResult['ITEMS'][$prop['ID']] = $prop;

                $obSmartFilter->arResult['ITEMS'][$prop['ID']]['VALUES'] = [
                    [
                        'CHECKED' => true,
                        'URL_ID' => $linkedElementData['CODE']
                    ]
                ];
                $prop['FILTER_URL'] = $obSmartFilter->makeSmartUrl($sefTemplate, true);
            }

            $result = is_array($prop) ? $prop : [];
        }

        return $result;
    }

    /**
     * <p>Функция берёт значения указанных в параметре "properties" свойств у текущего раздела, либо, если таковых нет,
     * наследует у ближайшего раздела-предка</p>
     *
     * @param $properties - массив с именами свойств, значения которых интересуют
     * @param $chain - Сюда передать цепочку из разделов ИБ
     */
    public static function getFinalSectionProperties(array $properties, $chain)
    {
        $results = [];
        foreach ($properties as $propertyName) {
            for ($i = count($chain) - 1; $i >= 0; $i--) {
                if (!isset($results[$propertyName]) && !empty($chain[$i][$propertyName])) {
                    $results[$propertyName] = $chain[$i][$propertyName];
                }
            }
        }
        return $results;
    }

    /**
     * Разбивает номер на части, представляющие собой код страны, код региона и абонентский номер
     * Для раборты функции необходимо, чтобы в номере присутствовали круглые скобки, отделяющие код региона
     * @param string $phone
     * @param bool $trim
     * @return array
     *
     */
    static function phoneBreak(string $phone, bool $trim = true)
    {
        $pieces = preg_split('/(\([^\)]*?\))/', $phone, null, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
        if (!is_array($pieces)) {
            return [$phone];
        }

        if ($trim) {
            $pieces = array_map(
                function ($str) {
                    return trim($str);
                },
                $pieces
            );
        }
        return $pieces;
    }

    public static function makeOGMeta(array $object)
    {
        global $APPLICATION;

        $meta = '';

        if (!array_key_exists('type', $object)) {
            $meta .= '<meta name="og:type" content="website">';
        }
        if (!array_key_exists('url', $object)) {
            $meta .= '<meta name="og:url" content="' . $_SERVER['SERVER_NAME'] . $APPLICATION->GetCurPage() . '">';
        }

        foreach ($object as $ogName => $ogData) {
            if ($ogData) {
                $meta .= '<meta name="og:' . $ogName . '" content="' . $ogData . '">';
            }
        }

        return $meta;
    }

    /**
     * <p>Возвращает список привязанных к разделу $sectionID инфоблока $iblockID активных свойств в виде массива</p>
     *
     * @param $sectionID
     * @param $iblockID
     * @return array
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Bitrix\Main\ObjectPropertyException
     * @throws \Bitrix\Main\SystemException
     */
    public static function getLinkedSectionProperty(int $sectionID, int $iblockID): array
    {
        return \Bitrix\Iblock\PropertyTable::query()->setSelect(['CODE'])->whereColumn('ID', 'SP.PROPERTY_ID')->where(
            'SP.SECTION_ID',
            $sectionID
        )->where('IBLOCK_ID', $iblockID)->where('ACTIVE', true)->where('SP.SMART_FILTER', true)->registerRuntimeField(
            'SP',
            [
                'data_type' => '\\Bitrix\\Iblock\\SectionPropertyTable',
                'reference' => [
                    '=this.ID' => 'ref.PROPERTY_ID'
                ]
            ]
        )->exec()->fetchAll();
    }

    public static function getVarsSection($iblockId, $arResult)
    {
        $arFilter = array(
            "IBLOCK_ID" => $iblockId,
            "ACTIVE" => "Y",
            "GLOBAL_ACTIVE" => "Y",
        );

        if ((int)$arResult["VARIABLES"]["SECTION_ID"] > 0) {
            $arFilter["ID"] = (int)$arResult["VARIABLES"]["SECTION_ID"];
        } elseif ($arResult["VARIABLES"]["SECTION_CODE"] != '') {
            $arFilter["ID"] = (int)\CIBlockSection::GetList(
                [],
                ['IBLOCK_ID' => $iblockId, 'CODE' => $arResult["VARIABLES"]["SECTION_CODE"]],
                false,
                ['ID']
            )->Fetch()['ID'];
        } else {
            return [];
        }

        $obCache = new \CPHPCache();

        if ($obCache->InitCache(3600, serialize($arFilter), "/its/iblock/catalog")) {
            $arCurSection = $obCache->GetVars();
        } elseif ($obCache->StartDataCache()) {
            $arCurSection = array();
            $dbRes = \CIBlockSection::GetList(array(), $arFilter, false, array("ID"));

            if (defined("BX_COMP_MANAGED_CACHE")) {
                global $CACHE_MANAGER;
                $CACHE_MANAGER->StartTagCache("/its/iblock/catalog");
                if ($arCurSection = $dbRes->Fetch()) {
                    $CACHE_MANAGER->RegisterTag("iblock_id_" . $iblockId);
                }
                $CACHE_MANAGER->EndTagCache();
            } else {
                if (!$arCurSection = $dbRes->Fetch()) {
                    $arCurSection = array();
                }
            }
            if ($arCurSection['ID']) {
                $arSectionsChain = [];
                $navChainIDs = [];

                $rsSectionsChain = \CIBlockSection::GetNavChain($iblockId, $arCurSection['ID'], ['ID']);
                while ($iter = $rsSectionsChain->Fetch()) {
                    $arSectionsChain[] = $iter;
                    $navChainIDs[] = $iter['ID'];
                }

                $rsSections = \CIBlockSection::GetList(
                    [],
                    [
                        'ID' => $navChainIDs,
                        'IBLOCK_ID' => $iblockId
                    ],
                    false,
                    ['UF_*']
                );

                while ($arSection = $rsSections->GetNext()) {
                    $arSections[$arSection['ID']] = $arSection;
                }

                foreach ($arSectionsChain as &$member) {
                    $member = $arSections[$member['ID']];
                }
                $arCurSection['CHAIN'] = $arSectionsChain;
            }
            $obCache->EndDataCache($arCurSection);
        }

        if (!isset($arCurSection)) {
            $arCurSection = array();
        }

        return $arCurSection;
    }

    public static function getElementIdByCode(string $code, int $iblockId): ?int
    {
        $result = ElementTable::query()->setSelect(['ID'])->where('IBLOCK_ID', $iblockId)->where(
            'CODE',
            $code
        )->setLimit(
            1
        )->fetch();

        return $result ? $result['ID'] : null;
    }

    public static function getSectionIdByCode(string $code): ?int
    {
        $result = SectionTable::query()->setSelect(['ID'])->where('CODE', $code)->setLimit(1)->fetch();

        return $result ? $result['ID'] : null;
    }

    public static function getUrlVariables(): ?array
    {
        global $APPLICATION;

        $rules = UrlRewriter::getList(SITE_ID, ['QUERY' => $APPLICATION->GetCurPage()]);

        if ($rules && $rule = reset($rules)) {
            preg_match($rule['CONDITION'], $APPLICATION->GetCurUri(), $matches);

            if ($matches) {
                return $matches;
            }
        }

        return null;
    }

    public static function makeYoutubeEmbed(string $url): string
    {
        if (!preg_match('/embed/i', $url)) {
            if (preg_match('/\s*[a-zA-Z\/\/:\.]*youtu.be\/([a-zA-Z0-9\-_]+)/i', $url, $shortUrl)) {
                $url = '//www.youtube.com/embed/' . $shortUrl[1];
            } else {
                $url = preg_replace(
                    "/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i",
                    "//www.youtube.com/embed/$1",
                    $url
                );
            }
        }

        if (strpos('enablejsapi=1', $url) === false) {
            $url .= '?enablejsapi=1';
        }
        return $url;
    }

    /**
     * Возвращает массив разделов инфоблока, в которых есть активные элементы
     */
    public static function getActiveSection($iblockId)
    {
        $sectionIds = [];
        $res = \Bitrix\Iblock\ElementTable::query()->setSelect(['IBLOCK_SECTION_ID'])->where('ACTIVE', 'Y')->where(
            'IBLOCK_ID',
            $iblockId
        )->whereNotnull('IBLOCK_SECTION_ID')->fetchAll();
        foreach ($res as $section) {
            if (empty($sectionIds[$section['IBLOCK_SECTION_ID']])) {
                $sectionIds[$section['IBLOCK_SECTION_ID']] = $section['IBLOCK_SECTION_ID'];
            }
        }
        $sections = [];
        if ($sectionIds) {
            $sections = SectionTable::query()->setSelect(['ID', 'CODE', 'NAME'])->whereIn('ID', $sectionIds)->fetchAll(
            );
        }
        return $sections;
    }

    public static function getUser(int $id): ?EntityObject
    {
        /** @var EntityObject[] $users */
        static $users;

        if (!array_key_exists($id, $users)) {
            $users[$id] = UserTable::query()->setSelect(['*'])->where('ID', $id)->setCacheTtl(0)->fetchObject();
        }

        return $users[$id];
    }

    /**
     * скрывать ли раздел при обмене
     * @param $sectionId
     * @return bool
     */
    public static function getHiddenSectionsForImport()
    {
        \CModule::IncludeModule("iblock");
        static $hiddenSections = [];
        if (empty($hiddenSections)) {
            $catalogIblockId = current(Iblock::getInstance()->getAll('catalog'));
            $arFilterSections = ["IBLOCK_ID" => $catalogIblockId, "UF_HIDEONIMPORT" => 1];
            $dbRes = \CIBlockSection::GetList(
                array(),
                $arFilterSections,
                false,
                array("ID", "IBLOCK_ID", "UF_HIDEONIMPORT")
            );
            while ($arRes = $dbRes->Fetch()) {
                //сделаем доп. проверку, иначе, если св-во не задано, выбирались все разделы
                if ($arRes["UF_HIDEONIMPORT"] == 1) {
                    $hiddenSections[] = $arRes["ID"];
                }
            }
        }
        return $hiddenSections;
    }

    /** по id елем. получим id раздела-родителя
     * @param $elemId
     * @return string
     */
    public static function getParentSectionIdForElem($elemId)
    {
        $sectionId = "";
        $res = \CIBlockElement::GetByID($elemId);
        if ($elem = $res->GetNext()) {
            $sectionId = $elem["IBLOCK_SECTION_ID"];
        }

        return $sectionId;
    }
}
