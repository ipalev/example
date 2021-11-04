<?
namespace Its\CPManager\Component;

use \Bitrix\Main\Engine\CurrentUser;
use \Bitrix\Main\Loader;
use \Bitrix\Main\Localization\Loc;
use \Bitrix\Main\ORM\Objectify\Collection;
use \Bitrix\Main\ORM\Entity;

use \Its\CPManager\Controller\Permission\Permission;
use \Its\CPManager\ORM\ProposalCategoryTable;
use \Its\CPManager\ORM\ProductCategoryTable;
use \Its\CPManager\ORM\ProductTable;
use \Its\CPManager\ORM\ProposalTable;
use \Its\CPManager\Utils;

class CPMList extends \CBitrixComponent{

    public function onPrepareComponentParams($arParams){
        $arParams['ID'] = is_numeric($arParams['ID']) && $arParams['ID'] > 0 ? intval($arParams['ID']) : false;

        $arParams['USER_ID'] = intval($arParams['USER_ID']);
        if(!$arParams['USER_ID']) $arParams['USER_ID'] = intval(CurrentUser::get()->getId());

        $arParams['ELEMENTS'] = $arParams['ELEMENTS'] == 'Y';

        $this->arResult['ERRORS'] = [];

        if( !Loader::includeModule('its.cpmanager') ) $this->arResult['ERRORS'][] = Loc::getMessage('ITS_CPM_COMPONENT_PROPOSAL_FORM_ERROR_NOT_INSTALLED');
        if( !Loader::includeModule('catalog') ) $this->arResult['ERRORS'][] = Loc::getMessage('ITS_CPM_COMPONENT_PROPOSAL_FORM_ERROR_CATALOG');
        if( !Loader::includeModule('iblock') ) $this->arResult['ERRORS'][] = Loc::getMessage('ITS_CPM_COMPONENT_PROPOSAL_FORM_ERROR_IBLOCK');

        return $arParams;
    }

    public function executeComponent(){
        $this->arResult['ID'] = false;

        if(!empty($this->arResult['ERRORS'])) {
            foreach($this->arResult['ERRORS'] as $error){
                ShowError($error);
            }

            return false;
        }

        $permissions = new Permission();
        if( $permissions->canDoAs( Permission::T_OWNER_READ, $this->arParams['USER_ID'] ) ) {

            $this->arResult['PROPOSAL'] = ProposalTable::createObject();

            if($this->arParams['ID']) {

                $isExists = !!ProposalTable::query()
                    ->setSelect(['ID'])
                    ->where('ID', $this->arParams['ID'])
                    ->where('USER_ID', $this->arParams['USER_ID'])
                    ->fetch();

                if($isExists) $this->arResult['ID'] = $this->arParams['ID'];

            } else {
                $this->arResult['ID'] = \Its\CPManager\Controller\Proposal::getDraftCP($this->arParams['USER_ID']) ?? false;
            }

            if($this->arResult['ID']) {
                $proposal = ProposalTable::query()
                    ->setSelect(['*', 'UF_*'])
                    ->where('ID', $this->arResult['ID'])
                    ->fetchObject();

                if ($proposal) {

                    $productList = ProductTable::query()
                        ->setSelect(['ID'])
                        ->where('PROPOSAL_ID', $proposal->getId())
                        ->fetchAll();

                    $productIdList = array_column($productList, 'ID');
                    $this->arResult['PRODUCTS'] = ProductTable::createCollection();
                    $this->arResult['PROPOSAL_CATEGORIES'] = ProposalCategoryTable::createCollection();

                    if ($productIdList) {

                        $productsQuery = ProductTable::query()
                            ->setSelect(['*', 'UF_*'])
                            ->whereIn('ID', $productIdList);

                        if ($productSort = $proposal->getSortField()) {
                            $arrayField = explode('.', $productSort);
                            if (Utils::checkReferences(ProductTable::getEntity(), $arrayField)) {
                                $order = $proposal->getSortOrder();
                                $order = in_array($order, ['ASC', 'DESC']) ? $order : 'ASC';

                                $productsQuery->setOrder([$productSort => $order]);
                            }
                        }

                        $this->arResult['PRODUCTS'] = $productsQuery->fetchCollection();

                        $this->arResult['PROPOSAL_CATEGORIES'] = ProposalCategoryTable::query()
                            ->setSelect(['*', 'CATEGORY', 'CATEGORY.SECTION'])
                            ->where('PROPOSAL_ID', $proposal->getId())
                            ->fetchCollection();

                        $this->arResult['PROPOSAL_CATEGORIES']->fill(\Bitrix\Main\ORM\Fields\FieldTypeMask::USERTYPE);


                        $colCategories = ProductCategoryTable::createCollection();
                        foreach ($this->arResult['PROPOSAL_CATEGORIES']->getCategoryList() as $objCategory) {
                            if ($objCategory) $colCategories->add($objCategory);
                        }
                        $colCategories->fill(\Bitrix\Main\ORM\Fields\FieldTypeMask::USERTYPE);


                        if ($this->arParams['ELEMENTS']) {
                            $this->arResult['ELEMENTS'] = \Its\CPManager\Utils::getProductData($this->arResult['PRODUCTS']);
                        }
                    }

                    $this->arResult['PROPOSAL'] = $proposal;

                    $entities = [
                        ProposalCategoryTable::getEntity(),
                        ProductCategoryTable::getEntity(),
                        ProductTable::getEntity(),
                        ProposalTable::getEntity()
                    ];

                    /** @var Entity $entity */
                    $arFields = [];
                    $uFieldsLink = [];

                    foreach ($entities as $entity) {
                        $rsFields =
                            \CUserTypeEntity::GetList([], ['ENTITY_ID' => $entity->getUfId(), 'LANG' => LANGUAGE_ID]);

                        while ($field = $rsFields->Fetch()) {
                            $arFields[$entity->getUfId()][$field['FIELD_NAME']] = $field;

                            if ($field['USER_TYPE_ID'] == 'enumeration')
                                $uFieldsLink[$field['ID']] = &$arFields[$entity->getUfId()][$field['FIELD_NAME']];
                        }
                    }

                    $rsEnumValues = \CUserFieldEnum::GetList(
                        [],
                        [
                            'ENTITY_ID' => array_map(function ($entity) {
                                return $entity->getUfId();
                            }, $entities)
                        ]
                    );

                    while ($arValue = $rsEnumValues->Fetch()) {
                        if (array_key_exists($arValue['USER_FIELD_ID'], $uFieldsLink)) {
                            $uFieldsLink[$arValue['USER_FIELD_ID']]['VALUES'][] = $arValue;
                        }
                    }

                    unset($uFieldsLink);

                    $this->arResult['USER_FIELDS'] = $arFields;
                }
            } else {
                if($this->arParams['ID'] !== false) {
                    $this->arResult['ERRORS'][] = Loc::getMessage(
                        'ITS_CPM_COMPONENT_PROPOSAL_FORM_ERROR_NOT_FOUND_ID',
                        ['#ID#' => $this->arParams['ID']]
                    );
                }
            }
        } else {
            $permissions->setErrorStatus();
            $this->arResult['ERRORS'][] = $permissions->getErrorMsg(Permission::T_OWNER_READ);
        }

        $this->includeComponentTemplate();
    }

}