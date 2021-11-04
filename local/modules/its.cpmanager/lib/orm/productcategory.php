<?php

namespace Its\CPManager\ORM;

use Bitrix\Iblock\SectionTable;
use Bitrix\Main\Entity\ReferenceField;
use \Bitrix\Main\Localization\Loc;
use \Bitrix\Main\Entity\DataManager;
use \Bitrix\Main\Entity\IntegerField;
use \Bitrix\Main\Entity\StringField;
use \Bitrix\Main\ORM\Fields\Relations\OneToMany;

Loc::loadMessages(__FILE__);

class ProductCategoryTable extends DataManager{
    public static function getTableName(){
        return 'its_cpm_category';
    }

    public static function getUfId(){
        return strtoupper(self::getTableName());
    }

    public static function getMap(){
        return [
            'ID' => new IntegerField('ID', [
                'autocomplete' => true,
                'primary' => true,
                'title' => Loc::getMessage('ITS_CPM_ORM_CATEGORY_ID'),
            ]),
            'SORT' => new IntegerField('SORT', [
                'default_value' => 1,
                'title' => Loc::getMessage('ITS_CPM_ORM_CATEGORY_SORT'),
            ]),
            'IBLOCK_SECTION_ID' => new IntegerField('IBLOCK_SECTION_ID', [
                'required' => true,
                'unique' => true,
                'title' => Loc::getMessage('ITS_CPM_ORM_CATEGORY_IBLOCK_SECTION_ID'),
            ]),
            'NAME' => new StringField('NAME', [
                'title' => Loc::getMessage('ITS_CPM_ORM_CATEGORY_NAME'),
            ]),
            'DESCRIPTION' => new StringField( 'DESCRIPTION', [
                'default_value' => '',
                'title' => Loc::getMessage('ITS_CPM_ORM_CATEGORY_DESCRIPTION')
            ]),
            'SECTION' => new ReferenceField(
                'SECTION',
                SectionTable::class,
                array('=this.IBLOCK_SECTION_ID' => 'ref.ID')
            ),

            'PRODUCTS' => (new OneToMany(
                'PRODUCTS',
                ProductTable::class,
                'CATEGORY')
            )
        ];
    }
}
