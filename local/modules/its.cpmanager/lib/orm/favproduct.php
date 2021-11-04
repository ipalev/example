<?php

namespace Its\CPManager\ORM;

use \Bitrix\Main\Entity\ReferenceField;
use \Bitrix\Main\Localization\Loc;
use \Bitrix\Main\Entity\DataManager;
use \Bitrix\Main\Entity\IntegerField;
use \Bitrix\Main\Entity\FloatField;
use \Bitrix\Main\Entity\StringField;
use \Bitrix\Main\ORM\Query\Join;
use \Bitrix\Main\ORM\Event;

Loc::loadMessages(__FILE__);

class FavProductTable extends DataManager{
    public static function getTableName(){
        return 'b_sale_basket';
    }

    public static function getUfId(){
        return strtoupper(self::getTableName());
    }

    public static function getMap(){
        return [
            'ID' => new IntegerField('ID', [
                'autocomplete' => true,
                'primary' => true,
                'title' => Loc::getMessage('ITS_CPM_ORM_PRODUCT_ID'),
            ]),
            'FUSER_ID' => new IntegerField('FUSER_ID', [
                'required' => true,
                'title' => Loc::getMessage('ITS_CPM_ORM_PRODUCT_PRODUCT_ID'),
            ]),
            'PRODUCT_ID' => new IntegerField('PRODUCT_ID', [
                'required' => true,
                'title' => Loc::getMessage('ITS_CPM_ORM_PRODUCT_PRODUCT_ID'),
            ]),
            'SORT' => new IntegerField('SORT', [
                'default_value' => 1,
                'title' => Loc::getMessage('ITS_CPM_ORM_PRODUCT_SORT'),
            ]),
            'NAME' => new StringField('NAME', [
                'default_value' => '',
                'title' => Loc::getMessage('ITS_CPM_ORM_PRODUCT_NAME'),
            ]),
            'QUANTITY' => new IntegerField( 'QUANTITY', [
                'required' => true,
                'default_value' => 1,
                'title' => Loc::getMessage('ITS_CPM_ORM_PRODUCT_QUANTITY'),
            ]),
            'PRICE' => new FloatField( 'PRICE', [
                'default_value' => null,
                'title' => Loc::getMessage('ITS_CPM_ORM_PRODUCT_PRICE'),
            ]),
            'CURRENCY' => new StringField( 'CURRENCY', [
                'default_value' => '',
                'title' => Loc::getMessage('ITS_CPM_ORM_PRODUCT_CURRENCY'),
            ]),
            'PROPOSAL_ID' => new IntegerField('PRODUCT_PRICE_ID', [
                'default_value' => 120,
                'required' => true,
                'title' => Loc::getMessage('ITS_CPM_ORM_PRODUCT_PROPOSAL_ID'),
            ]),
            'CATEGORY_ID' => new IntegerField('PRODUCT_PRICE_ID', [
                'default_value' => 19,
                'title' => Loc::getMessage('ITS_CPM_ORM_PRODUCT_CATEGORY_ID'),
            ]),
            'PRODUCT' => (new ReferenceField(
                'PRODUCT',
                \Bitrix\Catalog\ProductTable::class,
                Join::on('this.PRODUCT_ID', 'ref.ID')
            ))
                ->configureJoinType('inner'),
            'PROPOSAL' => (new ReferenceField(
                'PROPOSAL',
                ProposalTable::class,
                Join::on('this.PROPOSAL_ID', 'ref.ID')
            ))
                ->configureJoinType('inner'),
            'CATEGORY' => (new ReferenceField(
                'CATEGORY',
                ProductCategoryTable::class,
                Join::on('this.CATEGORY_ID', 'ref.ID')
            ))
                ->configureJoinType('inner'),
        ];
    }

    public static function onBeforeUpdate(Event $event){
        $updateResult = new \Bitrix\Main\ORM\EventResult;
        $updateResult->unsetFields(['PROPOSAL_ID', 'PRODUCT_ID']);

        $event->addResult($updateResult);
    }
}
