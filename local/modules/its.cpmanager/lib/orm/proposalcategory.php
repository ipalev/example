<?php

namespace Its\CPManager\ORM;

use Bitrix\Main\Entity\ReferenceField;
use \Bitrix\Main\Localization\Loc;
use \Bitrix\Main\Entity\DataManager;
use \Bitrix\Main\Entity\IntegerField;
use Bitrix\Main\ORM\Event;

Loc::loadMessages(__FILE__);

class ProposalCategoryTable extends DataManager{
    public static function getTableName(){
        return 'its_cpm_proposal_cat';
    }

    public static function getUfId(){
        return strtoupper(self::getTableName());
    }

    public static function getMap(){
        return [
            'ID' => new IntegerField('ID', [
                'primary' => true,
                'autocomplete' => true,
                'title' => Loc::getMessage('ITS_CPM_ORM_PROPOSAL_CAT_ID'),
            ]),
            'PROPOSAL_ID' => new IntegerField('PROPOSAL_ID', [
                'title' => Loc::getMessage('ITS_CPM_ORM_PROPOSAL_CAT_PROPOSAL_ID'),
            ]),
            'CATEGORY_ID' => new IntegerField('CATEGORY_ID', [
                'title' => Loc::getMessage('ITS_CPM_ORM_PROPOSAL_CAT_CAT_ID'),
            ]),
            'PROPOSAL' => new ReferenceField(
                'PROPOSAL',
                ProposalTable::class,
                array('=this.PROPOSAL_ID' => 'ref.ID')
            ),
            'CATEGORY' => new ReferenceField(
                'CATEGORY',
                ProductCategoryTable::class,
                array('=this.CATEGORY_ID' => 'ref.ID')
            )
        ];
    }

    public static function onBeforeUpdate(Event $event){
        $updateResult = new \Bitrix\Main\ORM\EventResult;
        $updateResult->unsetFields(['PROPOSAL_ID', 'CATEGORY_ID']);

        $event->addResult($updateResult);
    }
}
