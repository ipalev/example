<?
namespace Its\CPManager;

use \Bitrix\Main\ORM\Entity;
use \Bitrix\Main\ORM\Fields\Relations\Relation;
use \Bitrix\Main\ORM\Fields;
use \Bitrix\Main\ORM\Objectify\Collection;
use \Bitrix\Catalog\ProductTable;
use \Bitrix\Main\ORM\Fields\FieldTypeMask;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

class Utils {

    /**
     * @param Fields\Field $field
     * @return bool
     */
    public static function isAllowedToSet(Fields\Field $field):bool {
        $allowedFieldTypes = Fields\FieldTypeMask::SCALAR | Fields\FieldTypeMask::USERTYPE;
        return !!( $allowedFieldTypes & $field->getTypeMask() );
    }

    /**
     * Проверяет у цепочки вида [ENTITY_FIELD, SUBENTITY_FIELD, FIELD] достоверность, пробегая по сущностям
     *
     * @param Entity $entity
     * @param array $fieldsChain
     * @return bool
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Bitrix\Main\SystemException
     */
    public static function checkReferences (Entity $entity, array $fieldsChain): bool {
        $fieldName = array_shift($fieldsChain);

        if($entity->hasField($fieldName)) {
            $field = $entity->getField($fieldName);

            if(count($fieldsChain) == 0 && $field->getTypeMask()&(FieldTypeMask::FLAT|FieldTypeMask::USERTYPE) ) return true;

            if($field instanceof Relation) {
                $refEntity = $field->getRefEntity();
                return self::checkReferences($refEntity, $fieldsChain);
            }
        }

        return false;
    }

    /**
     * @param Collection $colProducts
     * @return array
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Bitrix\Main\SystemException
     */
    public static function getProductData(Collection $colProducts): array {
        $result = [];

        if( $colProducts->count() ) {
            $colProducts->fill(Fields\FieldTypeMask::USERTYPE);
            $colProducts->fill(['PRODUCT']);

            $elements = [];
            $offers = [];

            foreach($colProducts as $product) {
                $bxProduct = $product->getProduct();

                if($bxProduct) {
                    $elements[] = $bxProduct->getId();

                    if( intval($bxProduct->getType()) === ProductTable::TYPE_OFFER ) {
                        $offers[] = $bxProduct->getId();
                    }
                }
            }

            $arrayFlatElements = [];

            $arrayElements = [];
            $rsElements = \CIBlockElement::GetList([], ['ID' => $elements], false, false, ['*']);
            while($arrayElement = $rsElements->GetNext()) {
                $arrayElement['PROPERTIES'] = [];
                $arrayElements[$arrayElement['IBLOCK_ID']][$arrayElement['ID']] = $arrayElement;

                $arrayFlatElements[$arrayElement['ID']] =
                    &$arrayElements[$arrayElement['IBLOCK_ID']][$arrayElement['ID']];
            }

            /* now get another elements (product offers) */
            $elements = [];
            if(!empty($offers)) {

                $arrayOffers = \CCatalogSku::getProductList($offers);

                if(is_array($arrayOffers)) {
                    foreach ($arrayOffers as $arrayProduct) {
                        if( array_key_exists($arrayProduct['ID'], $arrayElements[$arrayProduct['IBLOCK_ID']]) ) continue;

                        $arrayElements[$arrayProduct['IBLOCK_ID']][$arrayProduct['ID']] = [];
                        $elements[$arrayProduct['ID']] = &$arrayElements[$arrayProduct['IBLOCK_ID']][$arrayProduct['ID']];
                    }
                }

                if(!empty($elements)) {
                    $rsElements = \CIBlockElement::GetList([], ['ID' => array_keys($elements)], false, false, ['*']);
                    while($arrayElement = $rsElements->GetNext()) {
                        $arrayElement['PROPERTIES'] = [];
                        $elements[$arrayElement['ID']] = $arrayElement;

                        $arrayFlatElements[$arrayElement['ID']] =
                            &$elements[$arrayElement['ID']];
                    }
                    unset($elements);
                }
            }

            /* getting all elements properties */
            foreach($arrayElements as $iblockId => &$iblockElements) {
                \CIBlockElement::GetPropertyValuesArray(
                    $iblockElements,
                    $iblockId,
                    [
                        'ID' => array_keys($iblockElements)
                    ]
                );
            }
            
            if(isset($arrayOffers) && is_array($arrayOffers)) {
                foreach($arrayOffers as $offerId => $productData){
                    if(
                        array_key_exists($productData['ID'], $arrayFlatElements)
                        && array_key_exists($offerId, $arrayFlatElements)
                    ) {
                        
                        $arrayFlatElements[$offerId]['PROPERTIES'] = array_merge(
                            $arrayFlatElements[$offerId]['PROPERTIES'],
                            is_array($arrayFlatElements[$productData['ID']]['PROPERTIES']) ? $arrayFlatElements[$productData['ID']]['PROPERTIES'] : []
                        );
                    }
                }
            }

            $result = $arrayFlatElements;

            unset($iblockElements);
            unset($arrayFlatElements);
        }

        return $result;
    }
}