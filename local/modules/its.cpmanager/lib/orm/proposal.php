<?php

namespace Its\CPManager\ORM;

use \Bitrix\Main\Localization\Loc;
use \Bitrix\Main\ORM\Event;
use \Bitrix\Main\UserTable;
use \Bitrix\Main\Entity\ReferenceField;
use \Bitrix\Main\Entity\DataManager;
use \Bitrix\Main\Entity\IntegerField;
use \Bitrix\Main\Entity\StringField;
use \Bitrix\Main\Entity\DatetimeField;
use \Bitrix\Main\Entity\BooleanField;
use \Bitrix\Main\ORM\Fields\Relations\OneToMany;

Loc::loadMessages(__FILE__);

class ProposalTable extends DataManager{
    public static function getTableName(){
        return 'its_cpm_proposal';
    }

    public static function getUfId(){
        return strtoupper(self::getTableName());
    }

    public static function getMap(){
        return [
            'ID' => new IntegerField('ID', [
                'autocomplete' => true,
                'primary' => true,
                'title' => Loc::getMessage('ITS_CPM_ORM_PROPOSAL_ID'),
            ]),
            'SORT_FIELD' => new StringField('SORT_FIELD', [
                'default_value' => '',
                'title' => Loc::getMessage('ITS_CPM_ORM_PROPOSAL_SORT_FIELD'),
            ]),
            'SORT_ORDER' => new StringField('SORT_ORDER', [
                'default_value' => '',
                'title' => Loc::getMessage('ITS_CPM_ORM_PROPOSAL_SORT_ORDER'),
            ]),
            'DRAFT' => new BooleanField('DRAFT', [
                'default_value' => '',
                'values' => ['N', 'Y'],
                'title' => Loc::getMessage('ITS_CPM_ORM_PROPOSAL_DRAFT'),
            ]),
            'CREATED' => new DatetimeField('CREATED', [
                'default_value' => function() {
                    return new \Bitrix\Main\Type\DateTime();
                },
                'title' => Loc::getMessage('ITS_CPM_ORM_PROPOSAL_CREATED'),
            ]),
            'SAVED' => new DatetimeField('SAVED', [
                'default_value' => null,
                'title' => Loc::getMessage('ITS_CPM_ORM_PROPOSAL_SAVED'),
            ]),
            'NAME' => new StringField('NAME', [
                'title' => Loc::getMessage('ITS_CPM_ORM_PROPOSAL_NAME'),
            ]),
            'DESCRIPTION' => new StringField( 'DESCRIPTION', [
                'default_value' => '',
                'title' => Loc::getMessage('ITS_CPM_ORM_PROPOSAL_DESCRIPTION')
            ]),
            'USER_ID' => new IntegerField('USER_ID', [
                'title' => Loc::getMessage('ITS_CPM_ORM_PROPOSAL_USER_ID'),
            ]),
            'USER' => new ReferenceField(
                'USER',
                UserTable::class,
                array('=this.USER_ID' => 'ref.ID')
            ),

            'PROPOSAL_CATEGORIES' => (new OneToMany(
                'PROPOSAL_CATEGORIES',
                ProposalCategoryTable::class,
                'PROPOSAL')
            ),
            'PRODUCTS' => (new OneToMany(
                'PRODUCTS',
                ProductTable::class,
                'PROPOSAL')
            )
        ];
    }

    public static function onBeforeUpdate(Event $event){
        $updateResult = new \Bitrix\Main\ORM\EventResult;
        $updateResult->unsetFields(['CREATED', 'USER_ID']);

        $event->addResult($updateResult);
    }
}
