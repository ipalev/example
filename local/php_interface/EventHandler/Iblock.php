<?php

namespace Its\EventHandler;

use Bitrix\Iblock\PropertyEnumerationTable;
use Bitrix\Iblock\PropertyTable;
use Bitrix\Main\Application;
use Its\Lib\Iblock as IB;
use Its\Lib\Utils;

class Iblock
{

    public static function beforeElementEdit(&$params)
    {
        $articlesIblockId = current(IB::getInstance()->getAll('articles'));
        if ($params['IBLOCK_ID'] == $articlesIblockId) {
            $properties = PropertyTable::query()->setSelect(['CODE', 'ID'])->where(
                'IBLOCK_ID',
                $params['IBLOCK_ID']
            )->whereIn('CODE', ['PRODUCT', 'PRODUCT_SECTION'])->fetchAll();
            $property = [];
            foreach ($properties as $prop) {
                $property[$prop['CODE'] . '_ID'] = $prop['ID'];
            }
            $sections = \CIBlockElement::GetElementGroups(
                current($params['PROPERTY_VALUES'][$property['PRODUCT_ID']]),
                false,
                ['ID']
            );
            $sectionIds = [];
            while ($section = $sections->Fetch()) {
                $sectionIds[] = $section;
            }
            foreach ($sectionIds as $id) {
                $params['PROPERTY_VALUES'][$property['PRODUCT_SECTION_ID']][]['VALUE'] = $id['ID'];
            }
        }
    }

    public static function beforeElementUpdateForMS(&$params)
    {
        $catalogIblockId = current(IB::getInstance()->getAll('catalog'));

        // если в разделе соотв. опция, то товар деактивирован всегда

        if (($params['IBLOCK_ID'] == $catalogIblockId)) {
            if ($params["IBLOCK_SECTION_ID"] != "") {
                $sectionId = $params["IBLOCK_SECTION_ID"];
            } elseif (is_array($params["IBLOCK_SECTION"])) {
                $sectionId = $params["IBLOCK_SECTION"][0];
            } elseif ($params["IBLOCK_SECTION"] != "") {
                $sectionId = $params["IBLOCK_SECTION"];
            } else {
                $sectionId = \Its\Lib\Utils::getParentSectionIdForElem($params['ID']);
            }

            if ($sectionId != "") {
                if (in_array($sectionId, \Its\Lib\Utils::getHiddenSectionsForImport())) {
                    $params["ACTIVE"] = "N";
                }
            }
        }

        if (($params['IBLOCK_ID'] == $catalogIblockId) and ($_REQUEST['mode'] == 'import')) { //catalog и обмен с МС
            unset($params['NAME']);
            unset($params['PREVIEW_PICTURE']);
            unset($params['DETAIL_PICTURE']);
            unset($params['PREVIEW_TEXT']);
            unset($params['DETAIL_TEXT']);
            unset($params['IBLOCK_SECTION']); //в МС товар в одном разделе, На сайте может в нескольких разделах
        }

        //деактивирум товары с ПРЕДОПЛАТА  и доставка
        if (($params['IBLOCK_ID'] == $catalogIblockId) and ($params["NAME"] != "") 
            and (!(stripos($params["NAME"],"ПРЕДОПЛАТА") === false) or !(stripos($params["NAME"], "Доставка") === false))) {
                $params["ACTIVE"] = "N";
        }
    }

    public static function beforeSectionUpdateForMS(&$params)
    {
        $catalogIblockId = current(IB::getInstance()->getAll('catalog'));
        if (($params['IBLOCK_ID'] == $catalogIblockId) and ($_REQUEST['mode'] == 'import')) { //catalog и обмен с МС
            unset($params['NAME']);
            unset($params['DESCRIPTION']);
            unset($params['DESCRIPTION_TYPE']);
        }

        if (($params['IBLOCK_ID'] == $catalogIblockId)) {
            //если соотв опция у раздела, то деактивр всегда
            if (in_array($params["ID"], \Its\Lib\Utils::getHiddenSectionsForImport())) {
                $params["ACTIVE"] = "N";
            }
        }
    }
}
