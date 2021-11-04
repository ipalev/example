<?php
namespace Its\CPManager\Controller;

use \Bitrix\Iblock\ElementTable;
use \Bitrix\Main;
use \Bitrix\Main\Engine\Controller;
use \Bitrix\Catalog\ProductTable as CatalogProductTable;

use \Bitrix\Main\ORM\Event;
use Bitrix\Main\ORM\Fields\FieldTypeMask;
use \Bitrix\Main\ORM\Objectify\EntityObject;
use Bitrix\Main\ORM\Objectify\Values;
use Its\CPManager\ORM\ProductTable;
use \Its\CPManager\ORM\ProposalCategoryTable;
use \Its\CPManager\ORM\ProductCategoryTable;
use \Its\CPManager\ORM\ProposalTable;
use \Its\CPManager\Utils;
use \Its\CPManager\ORM\ProductTable as CPMProductTable;
use \Its\CPManager\Controller\Permission\ActionFilter;
use \Its\CPManager\Controller\Permission\Permission;

class Product extends Controller {

    static $eventType = [
        'CATEGORY_CHANGED' => 'categoryChanged',
        'BEFORE_ADD' => 'beforeAdd',
    ];

    public function configureActions(){
        $writePermission = new ActionFilter\CheckPermission(Permission::T_OWNER_WRITE);

        return [
            'add' => [
                'prefilters' => [$writePermission]
            ],

            'delete' => [
                'prefilters' => [$writePermission]
            ],

            'deleteByProduct' => [
                'prefilters' => [$writePermission]
            ],

            'update' => [
                'prefilters' => [$writePermission]
            ],

            'getList' => [
                'prefilters' => [new ActionFilter\CheckPermission(Permission::T_OWNER_READ)]
            ],

            'updateMultiple' => [
                'prefilters' => [$writePermission]
            ],
        ];
    }


    /**
     * @param array $productFields
     * @return int|null
     * @throws Main\ArgumentException
     * @throws Main\LoaderException
     * @throws Main\ObjectPropertyException
     * @throws Main\SystemException
     */
    public function addAction(array $productFields): ?int {
        global $USER;

        if($productFields['PRODUCT_ID'] > 0) {

            $draftCPId = Proposal::getDraftCP($USER->GetID());

            if(!$draftCPId) {
                $proposalController = new Proposal(Main\Application::getInstance()->getContext()->getRequest());
                $draftCPId = $proposalController->createDraftAction($USER->GetID());

                if(!$draftCPId) {
                    $this->errorCollection = $proposalController->errorCollection;
                    return null;
                }
            }

            if(!Main\Loader::includeModule('catalog')) {
                $this->errorCollection[] = new Main\Error('Failed to load \'Catalog\' module');
                return null;
            }

            // Does Bitrix have such a product?
            if( CatalogProductTable::getByPrimary($productFields['PRODUCT_ID'])->fetch() ) {

                $cpmProduct = CPMProductTable::query()
                    ->setSelect(['ID', 'QUANTITY'])
                    ->where('PROPOSAL_ID', $draftCPId)
                    ->where('PRODUCT_ID', $productFields['PRODUCT_ID'])
                    ->fetchObject();

                $cpmProductIsNew = !$cpmProduct;

                if($cpmProductIsNew) $cpmProduct = CPMProductTable::createObject();

                if( !array_key_exists('QUANTITY', $productFields) || $productFields['QUANTITY'] < 1) {
                    $productFields['QUANTITY'] = 1;
                }

                if(!$cpmProductIsNew)
                    $productFields['QUANTITY'] += $cpmProduct->getQuantity();

                foreach (CPMProductTable::getEntity()->getFields() as $field) {
                    if (array_key_exists($field->getName(), $productFields) && Utils::isAllowedToSet($field)) {

                        $cpmProduct->set($field->getName(), $productFields[$field->getName()]);
                    }
                }

                $eventResult = new \Bitrix\Main\ORM\Data\Result;

                if($cpmProductIsNew) {
                    $event = new Event(
                        CPMProductTable::getEntity(),
                        self::$eventType['BEFORE_ADD'],
                        [
                            'productFields' => $productFields,
                            'object' => $cpmProduct
                        ],
                        true
                    );

                    $event->send();
                    $event->getErrors($eventResult);
                    $event->mergeObjectFields($cpmProduct);
                }

                if( !$eventResult->isSuccess() ) {
                    $this->errorCollection = $eventResult->getErrorCollection();
                    return null;
                }

                if(!$cpmProductIsNew) $cpmProduct->unsetCategoryId();
                $cpmProduct->setProposalId($draftCPId);

                $result = $cpmProduct->save();

                if (!$result->isSuccess()) {
                    $this->errorCollection = $result->getErrorCollection();
                    return null;
                }

                return $result->getId();

            } else {
                $this->errorCollection[] = new Main\Error('Bitrix doesn\'t have such a product');
            }
        } else {
            $this->errorCollection[] = new Main\Error('Invalid product id');
        }

        return null;
    }

    public function getListAction(array $params): ?array{
        $proposalId = intval($params['PROPOSAL_ID']);
        if($proposalId <= 0) {
            $this->errorCollection[] = new Main\Error('Proposal id was not provided or it is incorrect');
            return null;
        }

        $proposal = ProposalTable::query()
            ->setSelect(['*', 'UF_*'])
            ->where('ID', $proposalId)
            ->fetchObject();

        if(!$proposal) {
            $this->errorCollection[] = new Main\Error('Proposal with specified ID ['.$proposalId.'] does not exist');
            return null;
        }

        $permissions = new Permission();
        if( !$permissions->canDoAs(Permission::T_OWNER_READ, intval(Proposal::getCPUser($proposalId))) ) {
            $permissions->setErrorStatus();

            $this->errorCollection[] = $permissions->createError(Permission::T_OWNER_READ);
            return null;
        }

        Main\Loader::includeModule('iblock');
        Main\Loader::includeModule('catalog');

        $userFields = [];
        foreach (ProductTable::getEntity()->getFields() as $field) {
            if(! ($field->getTypeMask()&FieldTypeMask::USERTYPE) ) continue;

            $userFields[] = $field->getName();
        }

        if(!empty($userFields)) {
            $ufSettings = \Bitrix\Main\UserFieldLangTable::query()
                ->setSelect([
                    'ID' => 'USER_FIELD.ID',
                    'USER_TYPE_ID' => 'USER_FIELD.USER_TYPE_ID',
                    'FIELD_NAME' => 'USER_FIELD.FIELD_NAME',
                    'SETTINGS' => 'USER_FIELD.SETTINGS',
                    'TITLE' => 'EDIT_FORM_LABEL'
                ])
                ->where('USER_TYPE_ID', 'enumeration')
                ->whereIn('USER_FIELD.FIELD_NAME', $userFields)
                ->whereIn('USER_FIELD.ENTITY_ID', ProductTable::getUfId())
                ->fetchAll();
            $ufSettings = array_column($ufSettings, null, 'FIELD_NAME');
            $ufSettingsIds = array_column($ufSettings, null, 'ID');

            $rsEnumValues = \CUserFieldEnum::GetList([], ['USER_FIELD_ID' => array_keys($ufSettingsIds)]);
            $arEnumValues = [];
            while ($arValue = $rsEnumValues->Fetch()) {
                if (array_key_exists($arValue['USER_FIELD_ID'], $ufSettingsIds)) {
                    $ufSettings[$ufSettingsIds[$arValue['USER_FIELD_ID']]['FIELD_NAME']]['VALUES'][] = $arValue;
                }
            }
        }

        /** @var Main\ORM\Objectify\Collection $colProducts */
        $productsQuery = ProductTable::query()
            ->setSelect(['*', 'UF_*'])
            ->where('PROPOSAL_ID', $proposalId)
            ->setOrder('SORT');

        if ($productSort = $proposal->getSortField()) {
            $arrayField = explode('.', $productSort);
            if (Utils::checkReferences(ProductTable::getEntity(), $arrayField)) {
                $order = $proposal->getSortOrder();
                $order = in_array($order, ['ASC', 'DESC']) ? $order : 'ASC';

                $productsQuery->setOrder([$productSort => $order]);
            }
        }

        $colProducts = $productsQuery->fetchCollection();

        $data = [];

        if($colProducts->count() > 0) {
            $elements = \Its\CPManager\Utils::getProductData($colProducts);

            $elementDefaultFields = [
                'NAME',
                'PREVIEW_PICTURE' => function($value){return \CFile::GetPath($value);},
                'DETAIL_PICTURE' => function($value){return \CFile::GetPath($value);},
                'DETAIL_PAGE_URL'
            ];

            $params['PROPERTIES'] = array_key_exists('PROPERTIES', $params) && is_array($params['PROPERTIES']) ?
                $params['PROPERTIES'] : false;

            foreach($colProducts as $product) {
                $data[$product->getId()] = $product->collectValues(Values::ALL, FieldTypeMask::FLAT|FieldTypeMask::USERTYPE);

                foreach ($ufSettings as $userFieldName => $userFieldSettings) {
                    if(array_key_exists($userFieldName, $data[$product->getId()])) {
                        $data[$product->getId()][$userFieldName] = [
                            'META' => $userFieldSettings,
                            'VALUE' => $data[$product->getId()][$userFieldName]
                        ];
                    }
                }

                $catProduct = $product->getProduct();

                $iblockElementId =
                    intval($catProduct->getType()) === \Bitrix\Catalog\ProductTable::TYPE_OFFER ?
                        $elements[$catProduct->getId()]['PROPERTIES']['CML2_LINK']['VALUE'] :
                        $catProduct->getId();

                $iblockElementId =
                    array_key_exists($iblockElementId, $elements) ? $iblockElementId : false;

                if($iblockElementId) {
                    $iblockElement = $elements[$iblockElementId];

                    foreach($elementDefaultFields as $fieldName => $modifier) {
                        if(!is_callable($modifier)) {
                            $fieldName = $modifier;

                            $value = $iblockElement[$fieldName];
                        } else {
                            $value = $modifier($iblockElement[$fieldName]);
                        }

                        $data[$product->getId()]['ELEMENT.'.$fieldName] = ['VALUE' => HTMLToTxt($value)];
                    }

                    if($params['PROPERTIES']) {
                        foreach($params['PROPERTIES'] as $propName) {

                            $data[$product->getId()]['ELEMENT.'.$propName] = [
                                'VALUE' => $iblockElement['PROPERTIES'][$propName]['VALUE'],
                                'VALUE_XML_ID' => $iblockElement['PROPERTIES'][$propName]['VALUE_XML_ID'],
                                'VALUE_ID' => $iblockElement['PROPERTIES'][$propName]['VALUE_ENUM_ID'],
                            ];
                        }
                    }
                }
            }

        }

        if ($proposal->getSortField() == 'CATEGORY') {
            $categoryIds = [];
            foreach ($data as $item) {
                $categoryIds[$item['ID']] = $item['CATEGORY_ID'];
            }
            $res = ProductCategoryTable::query()
                ->setSelect(['ID', 'SORT'])
                ->whereIn('ID', $categoryIds)
                ->fetchAll();
            $categorySort = [];
            foreach ($res as $sort) {
                $categorySort[$sort['ID']] = $sort['SORT'];
            }
            foreach ($data as &$item) {
                $item['CATEGORY_SORT'] = $categorySort[$item['CATEGORY_ID']];
            }
            unset($item);
            $sortField = 'CATEGORY_SORT';
        } else {
            $sortField = $proposal->getSortField();
        }
        $sortOrder = $proposal->getSortOrder();
        if (!$sortField && !$sortOrder) {
            $sortField = 'PRICE';
            $sortOrder = 'ASC';
        }
        $arSort = [];
        foreach ($data as $key => $arItem) {
            $arSort[$key] = $arItem[$sortField];
        }
        if ($sortOrder == 'DESC') {
            arsort($arSort);
        } else {
            asort($arSort);
        }
        $dataSort = [];
        foreach ($arSort as $key => $item) {
            $dataSort[$key] = $data[$key];
        }

        return array_values($dataSort) ?: [];
    }

    /**
     * @param int $id
     * @param array $productFields
     * @return bool
     * @throws Main\ArgumentException
     * @throws Main\ObjectPropertyException
     * @throws Main\SystemException
     */
    public function updateAction(int $id, array $productFields): bool {
        $permissions = new Permission();
        if( !$permissions->canDoAs(Permission::T_OWNER_WRITE, intval(self::getProductOwner($id))) ) {
            $permissions->setErrorStatus();

            $this->errorCollection[] = $permissions->createError(Permission::T_OWNER_WRITE);
            return false;
        }


        $updateFields = [];
        $categoryChanged = false;

        foreach (CPMProductTable::getEntity()->getFields() as $field) {
            if( array_key_exists($field->getName(), $productFields) && Utils::isAllowedToSet($field) ) {

                $updateFields[ $field->getName() ] = $productFields[$field->getName()];
            }
        }

        if( array_key_exists('CATEGORY_ID', $updateFields) ) {
            $currentObject = CPMProductTable::getByPrimary($id, [
                'select' => ['ID', 'CATEGORY_ID']
            ])->fetchObject();

            $categoryChanged = $currentObject && $currentObject->getCategoryId() != $updateFields['CATEGORY_ID'];
        }

        $result = CPMProductTable::update($id, $updateFields);

        if( !$result->isSuccess() ) {
            $this->errorCollection = $result->getErrorCollection();
            return false;
        }

        if($categoryChanged) {
            $event = new Event(
                CPMProductTable::getEntity(),
                self::$eventType['CATEGORY_CHANGED'],
                [
                    'id' => $id,
                    'primary' => $id,
                    'old_category' => $currentObject->getCategoryId(),
                    'new_category' => $updateFields['CATEGORY_ID'],
                    'object' => $currentObject
                ],
                true
            );

            $event->send();
        }

        return true;
    }


    /**
     * @param array $elements
     * @return bool
     * @throws Main\ArgumentException
     * @throws Main\ObjectPropertyException
     * @throws Main\SystemException
     */
    public function updateMultipleAction(array $elements): bool {
        foreach($elements as $element) {
            if(
                array_key_exists('id', $element) && is_int($element['id'])
                &&
                array_key_exists('productFields', $element) && is_array($element['productFields'])
            ) {

                $this->updateAction($element['id'], $element['productFields']);
            }
        }

        if( !$this->errorCollection->isEmpty() ) return false;

        return true;
    }


    /**
     * @param int $proposalId
     * @param int $productId
     * @return bool
     * @throws Main\ArgumentException
     * @throws Main\ObjectPropertyException
     * @throws Main\SystemException
     */
    public function deleteByProductAction(int $proposalId, int $productId): bool {
        $cpmProduct = CPMProductTable::query()
            ->setSelect(['ID', 'PROPOSAL.USER_ID'])
            ->where('PRODUCT_ID', $productId)
            ->where('PROPOSAL_ID', $proposalId)
            ->fetchObject();

        if($cpmProduct) {
            $permissions = new Permission();
            if( !$permissions->canDoAs(Permission::T_OWNER_WRITE,  $cpmProduct->getProposal()->getUserId() ) ) {
                $permissions->setErrorStatus();

                $this->errorCollection[] = $permissions->createError(Permission::T_OWNER_WRITE);
                return false;
            }

            $result = CPMProductTable::delete($cpmProduct->getId());
            return $result->isSuccess();
        }

        return true;
    }

    /**
     * @param int $id
     * @return bool
     * @throws \Exception
     */
    public function deleteAction(int $id): bool {
        $cpmProduct = CPMProductTable::query()
            ->setSelect(['ID', 'PROPOSAL.USER_ID'])
            ->where('ID', $id)
            ->fetchObject();

        if($cpmProduct) {
            $permissions = new Permission();
            if( !$permissions->canDoAs(Permission::T_OWNER_WRITE,  $cpmProduct->getProposal()->getUserId() ) ) {
                $permissions->setErrorStatus();

                $this->errorCollection[] = $permissions->createError(Permission::T_OWNER_WRITE);
                return false;
            }

            $result = CPMProductTable::delete($id);
            return $result->isSuccess();
        }

        return true;
    }

    /**
     * @param int $productId
     * @return int
     * @throws Main\ArgumentException
     * @throws Main\ObjectPropertyException
     * @throws Main\SystemException
     */
    public static function getProductSectionId(int $productId = 0): int {
        $sectionId = 0;

        if(!Main\Loader::includeModule('catalog') || !Main\Loader::includeModule('iblock')) {
            return 0;
        }

        $catalogProduct = CatalogProductTable::query()
            ->setSelect(['TYPE'])
            ->where('ID', $productId)
            ->fetch();

        if(!$catalogProduct) return 0;

        switch($catalogProduct['TYPE']) {
            case CatalogProductTable::TYPE_OFFER:

                $productIblockId =
                    ElementTable::query()
                        ->setSelect(['IBLOCK_ID'])
                        ->where('ID', $productId)
                        ->fetch()['IBLOCK_ID'];

                //todo переписать на orm
                $sectionId = \CIBlockElement::GetList(
                    [],
                    [
                        'ID' => \CIBlockElement::SubQuery(
                            'PROPERTY_CML2_LINK',
                            ['ID' => $productId, 'IBLOCK_ID' => $productIblockId]
                        )
                    ], false, false,
                    ['IBLOCK_SECTION_ID']
                )->Fetch()['IBLOCK_SECTION_ID'];

                break;
            case CatalogProductTable::TYPE_SKU:
            case CatalogProductTable::TYPE_PRODUCT:
                $sectionId = ElementTable::query()
                    ->setSelect(['IBLOCK_SECTION_ID'])
                    ->where('ID', $productId)
                    ->fetch()['IBLOCK_SECTION_ID'];
                break;
        }

        return $sectionId ?: 0;
    }

    /**
     * @param int $productId
     * @param int $oldCategoryId
     * @throws Main\ArgumentException
     * @throws Main\ObjectPropertyException
     * @throws Main\SystemException
     */
    static function cleanProductCategory (int $productId, int $oldCategoryId) {
        $product = CPMProductTable::query()
            ->setSelect(['ID', 'CATEGORY_ID', 'PROPOSAL_ID'])
            ->where('ID', $productId)
            ->fetchObject();

        if($product) {
            $lastProposalCategory = !CPMProductTable::query()
                ->where('PROPOSAL_ID', $product->getProposalId())
                ->where('CATEGORY_ID', $oldCategoryId)
                ->whereNot('ID', $product->getId())
                ->fetch();

            if ($lastProposalCategory) {

                /** @var EntityObject $objectProposalCategory */

                $objectProposalCategory = ProposalCategoryTable::query()
                    ->setSelect(['ID'])
                    ->where('PROPOSAL_ID', $product->getProposalId())
                    ->where('CATEGORY_ID', $oldCategoryId)
                    ->fetchObject();

                if($objectProposalCategory) $objectProposalCategory->delete();

            }
        }
    }

    /**
     * @param int $id
     * @throws Main\ArgumentException
     * @throws Main\ObjectPropertyException
     * @throws Main\SystemException
     */
    static function addProductCategory (int $id) {
        $object = CPMProductTable::getByPrimary($id)->fetchObject();

        if(!$object) return;

        $sectionId = \Its\CPManager\Controller\Product::getProductSectionId( $object->getProductId() );

        if($sectionId) {
            $categoryId = ProposalCategory::getBySectionId($object->getProposalId(), $sectionId);

            if(!$categoryId) {
                $proposalCatController = new ProposalCategory(
                    Main\Application::getInstance()->getContext()->getRequest()
                );

                $categoryId = $proposalCatController->addAction(
                    $sectionId,
                    ['PROPOSAL_ID' => $object->getProposalId()]
                );
            }

            if ($categoryId) {
                $object->setCategoryId($categoryId);
                $object->save();
            }
        }
    }

    /**
     * @param int $productId
     * @return int|null
     * @throws Main\ArgumentException
     * @throws Main\ObjectPropertyException
     * @throws Main\SystemException
     */
    static function getProductOwner (int $productId): ?int {
        return ProposalTable::query()
            ->setSelect(['USER_ID'])
            ->where('PRODUCTS.ID', $productId)
            ->fetch()['USER_ID'] ?: null;
    }
}
