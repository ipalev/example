<?php

namespace Its\CPManager\EventHandler;

use Its\CPManager\ORM\ProductCategoryTable;
use Its\CPManager\ORM\ProductTable;

class Catalog {

    /**
     * @param \Bitrix\Main\Event $event
     * @throws \Exception
     */
    public static function OnAfterProductDelete (\Bitrix\Main\Event $event) {
        $params = $event->getParameters();

        if($params['success'] && $params['id'] > 0) {
            ProductTable::delete($params['id']);
        }
    }

    /**
     * @param array $fields
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Bitrix\Main\ObjectPropertyException
     * @throws \Bitrix\Main\SystemException
     */
    public static function OnAfterSectionDelete (array $fields) {

        $cpmCategory = ProductCategoryTable::query()
            ->setSelect(['ID'])
            ->where('IBLOCK_SECTION_ID', $fields['ID'])
            ->fetchObject();

        if($cpmCategory) {
            ProductCategoryTable::delete($cpmCategory->getId());
        }
    }
}