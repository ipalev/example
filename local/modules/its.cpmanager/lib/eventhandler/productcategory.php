<?php

namespace Its\CPManager\EventHandler;

use Its\CPManager\ORM\ProductTable;
use Its\CPManager\ORM\ProposalCategoryTable;

class ProductCategory {

    /**
     * @param \Bitrix\Main\Event $event
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Bitrix\Main\ObjectPropertyException
     * @throws \Bitrix\Main\SystemException
     */
    public static function OnCategoryDelete (\Bitrix\Main\Event $event) {
        $params = $event->getParameters();

        $deletedID = $params['id']['ID'];

        if($deletedID) {
            $colProposalCategories = ProposalCategoryTable::query()
                ->setSelect(['PROPOSAL_ID', 'CATEGORY_ID'])
                ->where('CATEGORY_ID', $deletedID)
                ->fetchCollection();

            if($colProposalCategories) {
                foreach ($colProposalCategories as $object) {

                    $object->delete();
                }
            }

            $colProducts = ProductTable::query()
                ->setSelect(['ID'])
                ->where('CATEGORY_ID', $deletedID)
                ->fetchCollection();

            if($colProducts) {
                foreach ($colProducts as $object) {
                    $object->setCategoryId(0);
                    $object->save();
                }
            }

        }
    }

}