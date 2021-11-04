<?php

namespace Its\CPManager\EventHandler;

use \Bitrix\Main;
use Its\CPManager\Controller\Proposal as Controller;
use Its\CPManager\ORM\ProductTable;
use Its\CPManager\ORM\ProposalTable;

class Proposal {

    public static function OnProposalDelete (\Bitrix\Main\Event $event) {
        $params = $event->getParameters();

        $deletedObject = ProposalTable::getByPrimary($params['primary'])->fetchObject();

        if($deletedObject) {

            $deletedObject->fill(['PRODUCTS']);

            $productController = new \Its\CPManager\Controller\Product(
                Main\Application::getInstance()->getContext()->getRequest()
            );

            foreach($deletedObject->getProducts() as $product) {
                $productController->deleteAction( $product->getId() );
            }
        }
    }

}