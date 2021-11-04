<?php

namespace Its\CPManager\EventHandler;

use \Bitrix\Main;
use Its\CPManager\Controller\Product as Controller;
use Its\CPManager\ORM\ProductTable;

class Product {

    /**
     * @param Main\Event $event
     * @throws Main\ArgumentException
     * @throws Main\ObjectPropertyException
     * @throws Main\SystemException
     */
    public static function OnAfterProductAdd (\Bitrix\Main\Event $event) {
        $params = $event->getParameters();

        $newId = $params['id'];

        Controller::addProductCategory($newId);
    }

    /**
     * @param Main\Event $event
     * @throws Main\ArgumentException
     * @throws Main\ObjectPropertyException
     * @throws Main\SystemException
     */
    public static function OnProductDelete (\Bitrix\Main\Event $event) {
        $params = $event->getParameters();
        $deletedObject = ProductTable::getByPrimary($params['primary'])->fetchObject();

        Controller::cleanProductCategory(
            $deletedObject->getId(),
            $deletedObject->getCategoryId()
        );
    }

    public static function OnCategoryChanged (\Bitrix\Main\Event $event) {
        $params = $event->getParameters();

        $productId = $params['id'];

        $oldCategory = intval($params['old_category']);
        $newCategory = intval($params['new_category']);

        if($oldCategory) Controller::cleanProductCategory($productId, $oldCategory);
        if($newCategory) Controller::addProductCategory($productId);
    }


}