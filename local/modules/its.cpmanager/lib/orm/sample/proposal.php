<?php

namespace Its\CPManager\ORM\Sample;

use \Bitrix\Main\Entity\ReferenceField;
use \Bitrix\Main\Localization\Loc;
use \Bitrix\Main\Entity\DataManager;
use \Bitrix\Main\Entity\IntegerField;
use \Bitrix\Main\Entity\StringField;
use \Bitrix\Main\ORM\Event;
use \Bitrix\Main\UserTable;

Loc::loadMessages(__FILE__);

class ProposalTable extends DataManager{
    public static function getTableName(){
        return 'its_cpm_smp_proposal';
    }

    public static function getUfId(){
        return strtoupper(self::getTableName());
    }

    public static function getMap(){
        return [
            'ID' => new IntegerField('ID', [
                'autocomplete' => true,
                'primary' => true,
                'title' => Loc::getMessage('ITS_CPM_ORM_SMP_PROPOSAL_ID'),
            ]),
            'USER_ID' => new IntegerField('USER_ID', [
                'title' => Loc::getMessage('ITS_CPM_ORM_SMP_PROPOSAL_USER_ID'),
            ]),
            'NAME' => new StringField('NAME', [
                'title' => Loc::getMessage('ITS_CPM_ORM_SMP_PROPOSAL_NAME'),
            ]),
            'DESCRIPTION' => new StringField( 'DESCRIPTION', [
                'default_value' => '',
                'title' => Loc::getMessage('ITS_CPM_ORM_SMP_PROPOSAL_DESCRIPTION')
            ]),

            'USER' => (new ReferenceField(
                'USER',
                UserTable::class,
                array('=this.USER_ID' => 'ref.ID')
            ))
                ->configureJoinType('inner'),

        ];
    }

    public static function onBeforeUpdate(Event $event){
        $updateResult = new \Bitrix\Main\ORM\EventResult;
        $updateResult->unsetFields(['USER_ID']);

        $event->addResult($updateResult);
    }
}
