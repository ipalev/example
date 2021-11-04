<?php
namespace Its\CPManager\Controller;

use \Bitrix\Main;
use \Bitrix\Iblock\SectionTable;
use \Bitrix\Main\Engine\Controller;

use \Its\CPManager\ORM\ProposalCategoryTable;
use \Its\CPManager\ORM\ProductCategoryTable;
use \Its\CPManager\Utils;
use \Its\CPManager\Controller\Permission\ActionFilter;
use \Its\CPManager\Controller\Permission\Permission;

class ProposalCategory extends Controller {

    public function configureActions(){
        return [
            'add' => [
                'prefilters' => [
                    new ActionFilter\CheckArgument('categoryFields', ['PROPOSAL_ID']),
                    new ActionFilter\CheckPermission(Permission::T_OWNER_WRITE)
                ]
            ],
            'update' => [
                'prefilters' => [
                    new ActionFilter\CheckPermission(Permission::T_OWNER_WRITE)
                ]
            ],
            'getList' => [
                'prefilters' => [
                    new ActionFilter\CheckPermission(Permission::T_OWNER_READ)
                ]
            ],
            'updateMultiple' => [
                'prefilters' => [
                    new ActionFilter\CheckPermission(Permission::T_OWNER_WRITE)
                ]
            ],
        ];
    }


    /**
     * Возвращает id категории из таблицы ProductCategoryTable. На момент вызова этого метода такой категории может ещё
     * не существовать. Метод проверит наличие категории по полю IBLOCK_SECTION_ID, создаст её, если необходимо, перед
     * добавлением в таблицу ProposalCategoryTable
     *
     * @param int $iblockSectionId
     * @param array $categoryFields
     * @return int|null
     * @throws Main\ArgumentException
     * @throws Main\LoaderException
     * @throws Main\ObjectPropertyException
     * @throws Main\SystemException
     */
    public function addAction(int $iblockSectionId, array $categoryFields = []): ?int {
        if(!Main\Loader::includeModule('iblock')) {
            $this->errorCollection[] = new Main\Error('Failed to load \'Iblock\' module');
            return null;
        }

        $permissions = new Permission();
        if( !$permissions->canDoAs(Permission::T_OWNER_WRITE,  Proposal::getCPUser( intval($categoryFields['PROPOSAL_ID']) ) ) ) {
            $permissions->setErrorStatus();

            $this->errorCollection[] = $permissions->createError(Permission::T_OWNER_WRITE);
            return false;
        }

        $section = SectionTable::query()
            ->setSelect(['NAME'])
            ->where('ID', $iblockSectionId)
            ->fetch();

        if($section) {
            $newProposalCategory = ProposalCategoryTable::createObject();

            foreach (ProposalCategoryTable::getEntity()->getFields() as $field) {
                if( array_key_exists($field->getName(), $categoryFields) && Utils::isAllowedToSet($field) ) {

                    $newProposalCategory->set($field->getName(), $categoryFields[$field->getName()]);
                }
            }

            $newProposalCategory->unsetCategoryId();

            $categoryId = ProductCategoryTable::query()
                ->setSelect(['ID'])
                ->where('IBLOCK_SECTION_ID', $iblockSectionId)
                ->fetch()['ID'];

            if(!$categoryId) {
                $categoryController = new ProductCategory(Main\Application::getInstance()->getContext()->getRequest());

                $categoryId = $categoryController->addAction([
                    'NAME' => $section['NAME'],
                    'IBLOCK_SECTION_ID' => $iblockSectionId,
                ]);

                if(!$categoryId) {
                    $this->errorCollection = $categoryController->errorCollection;
                    return null;
                }
            }

            $newProposalCategory->setCategoryId($categoryId);

            $result = $newProposalCategory->save();

            if(!$result->isSuccess()) {
                $this->errorCollection = $result->getErrorCollection();
                return null;
            }

            return $categoryId;
        }

        return null;
    }

    public function getListAction(int $proposalId): ?array{
        $permissions = new Permission();
        if( !$permissions->canDoAs(Permission::T_OWNER_READ, intval(Proposal::getCPUser($proposalId))) ) {
            $permissions->setErrorStatus();

            $this->errorCollection[] = $permissions->createError(Permission::T_OWNER_READ);
            return null;
        }

        $proposalCategories = ProposalCategoryTable::query()
            ->setSelect(['*', 'UF_*'])
            ->where('PROPOSAL_ID', $proposalId)
            ->fetchAll();

        $data = [];
        if(count($proposalCategories) > 0) {
            $categoryIds = array_column($proposalCategories, 'CATEGORY_ID');

            $categories = [];
            if($categoryIds) {
                $categories = ProductCategoryTable::query()
                    ->setSelect(['*', 'UF_*'])
                    ->whereIn('ID', $categoryIds)
                    ->fetchAll();
            }

            $data = [
                'proposal_categories' => $proposalCategories,
                'categories' => $categories
            ];
        }

        return $data;
    }

    /**
     * @param int $primary
     * @param array $fields
     * @return bool
     * @throws Main\ArgumentException
     * @throws Main\SystemException
     */
    public function updateAction(int $primary, array $fields): bool {
        if(!$primary) {
            $this->errorCollection[] = new Main\Error('Invalid request. Not provided a valid primary key in first argument');
            return false;
        }

        $proposalCat = ProposalCategoryTable::query()
            ->setSelect(['ID', 'PROPOSAL.USER_ID'])
            ->where('ID', $primary)
            ->fetchObject();

        if(!$proposalCat) {
            $this->errorCollection[] = new Main\Error('Unable to find the Proposal category with ID = ' . $primary);
            return false;
        }

        $permissions = new Permission();
        if( !$permissions->canDoAs(Permission::T_OWNER_WRITE,  $proposalCat->getProposal()->getUserId() ) ) {
            $permissions->setErrorStatus();

            $this->errorCollection[] = $permissions->createError(Permission::T_OWNER_WRITE);
            return false;
        }

        $updateFields = [];

        foreach (ProposalCategoryTable::getEntity()->getFields() as $field) {
            if( array_key_exists($field->getName(), $fields) && Utils::isAllowedToSet($field) ) {

                $updateFields[ $field->getName() ] = $fields[$field->getName()];
            }
        }

        $result = ProposalCategoryTable::update($primary, $updateFields);

        if(!$result->isSuccess()) {
            $this->errorCollection = $result->getErrorCollection();
            return false;
        }

        return true;
    }


    /**
     * @param array $elements
     * @return bool
     * @throws Main\ArgumentException
     * @throws Main\SystemException
     */
    public function updateMultipleAction(array $elements): bool {
        foreach($elements as $element) {
            if(
                array_key_exists('primary', $element) && intval($element['primary'])
                &&
                array_key_exists('fields', $element) && is_array($element['fields'])
            ) {

                $this->updateAction($element['primary'], $element['fields']);
            }
        }

        if( !$this->errorCollection->isEmpty() ) return false;

        return true;
    }

    /**
     * @param int $proposalId
     * @param int $iblockSectionId
     * @return int|null
     * @throws Main\ArgumentException
     * @throws Main\ObjectPropertyException
     * @throws Main\SystemException
     */
    public static function getBySectionId (int $proposalId, int $iblockSectionId): ?int {
        return intval(ProposalCategoryTable::query()
            ->setSelect(['CATEGORY_ID'])
            ->where('CATEGORY.IBLOCK_SECTION_ID', $iblockSectionId)
            ->where('PROPOSAL_ID', $proposalId)
            ->fetch()['CATEGORY_ID']);
    }
}
