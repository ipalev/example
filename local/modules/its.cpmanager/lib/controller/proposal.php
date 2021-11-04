<?php
namespace Its\CPManager\Controller;

use \Bitrix\Main;
use \Bitrix\Main\Engine\Controller;
use \Bitrix\Main\Entity\ExpressionField;
use \Bitrix\Main\ORM\Objectify\Collection;

use \Its\CPManager\ORM\ProposalTable;
use \Its\CPManager\Utils;
use \Its\CPManager\Controller\Permission\ActionFilter;
use \Its\CPManager\Controller\Permission\Permission;

class Proposal extends Controller {

    public function configureActions(){
        $writePermission = new ActionFilter\CheckPermission(Permission::T_OWNER_WRITE);
        $readPermission = new ActionFilter\CheckPermission(Permission::T_OWNER_READ);

        return [
            'add' => [
                'prefilters' => [
                    new ActionFilter\CheckArgument('fields', ['USER_ID']),
                    $writePermission
                ]
            ],

            'createDraft' => [
                'prefilters' => [$writePermission]
            ],

            'getDraft' => [
                'prefilters' => [$readPermission]
            ],

            'get' => [
                'prefilters' => [$readPermission]
            ],

            'clearProducts' => [
                'prefilters' => [$writePermission]
            ],

            'delete' => [
                'prefilters' => [$writePermission]
            ],

            'update' => [
                'prefilters' => [$writePermission]
            ],

            'complete' => [
                'prefilters' => [$writePermission]
            ],

            'toDraft' => [
                'prefilters' => [$writePermission]
            ],
        ];
    }


    /**
     * @param array $fields
     * @return int|null
     * @throws Main\ArgumentException
     * @throws Main\SystemException
     */
    public function addAction(array $fields): ?int {
        $permissions = new Permission();
        if( !$permissions->canDoAs(Permission::T_OWNER_WRITE, intval($fields['USER_ID'])) ) {
            $permissions->setErrorStatus();

            $this->errorCollection[] = $permissions->createError(Permission::T_OWNER_WRITE);
            return null;
        }

        $newProposal = ProposalTable::createObject();

        foreach (ProposalTable::getEntity()->getFields() as $field) {
            if( array_key_exists($field->getName(), $fields) && Utils::isAllowedToSet($field) ) {

                $newProposal->set($field->getName(), $fields[$field->getName()]);
            }
        }

        $result = $newProposal->save();

        if(!$result->isSuccess()) {
            $this->errorCollection = $result->getErrorCollection();
            return null;
        }

        return $result->getId();
    }

    /**
     * @param int $proposalId
     * @throws Main\ArgumentException
     * @throws Main\ObjectPropertyException
     * @throws Main\SystemException
     */
    public function deleteAction(int $proposalId): void {
        $proposal = ProposalTable::query()
            ->setSelect(['ID', 'USER_ID'])
            ->where('ID', $proposalId)
            ->fetchObject();

        if(!$proposal) {
            $this->errorCollection[] = new Main\Error('Could not find the proposal with ID ' . $proposalId);
            return;
        }

        $permissions = new Permission();
        if( !$permissions->canDoAs(Permission::T_OWNER_WRITE, $proposal->getUserId()) ) {
            $permissions->setErrorStatus();

            $this->errorCollection[] = $permissions->createError(Permission::T_OWNER_WRITE);
            return;
        }

        $result = $proposal->delete();

        if(!$result->isSuccess()) {
            $this->errorCollection = $result->getErrorCollection();
        }
    }

    /**
     * @param int $id
     * @param array $fields
     * @return bool
     * @throws Main\ArgumentException
     * @throws Main\SystemException
     */
    public function updateAction(int $id, array $fields): bool {

        $permissions = new Permission();
        if( !$permissions->canDoAs(Permission::T_OWNER_WRITE, self::getCPUser($id)) ) {
            $permissions->setErrorStatus();

            $this->errorCollection[] = $permissions->createError(Permission::T_OWNER_WRITE);
            return false;
        }

        $updateFields = [];

        foreach (ProposalTable::getEntity()->getFields() as $field) {
            if( array_key_exists($field->getName(), $fields) && Utils::isAllowedToSet($field) ) {

                $updateFields[ $field->getName() ] = $fields[$field->getName()];
            }
        }

        unset($updateFields['DRAFT']);

        $result = ProposalTable::update($id, $updateFields);

        if( !$result->isSuccess() ) {
            $this->errorCollection = $result->getErrorCollection();
            return false;
        }

        return true;
    }

    public function clearProductsAction(int $proposalId): bool {
        if(!$proposalId) {
            $this->errorCollection[] = new Main\Error('Not provided a valid proposalId');
            return false;
        }

        $permissions = new Permission();
        if( !$permissions->canDoAs(Permission::T_OWNER_WRITE, intval(Proposal::getCPUser($proposalId)) ) ) {
            $permissions->setErrorStatus();

            $this->errorCollection[] = $permissions->createError(Permission::T_OWNER_WRITE);
            return false;
        }

        $proposalObject = ProposalTable::query()
            ->setSelect(['PRODUCTS'])
            ->where('ID', $proposalId)
            ->fetchObject();

        /** @var Main\ORM\Objectify\EntityObject $productObject */
        foreach($proposalObject->getProducts() as $productObject){
            $result = $productObject->delete();

            if(!$result->isSuccess()) {
                $this->errorCollection = $result->getErrorCollection();
                return false;
            }
        }

        return true;
    }

    /**
     * @param int $proposalId
     * @return bool
     * @throws Main\ArgumentException
     * @throws Main\ObjectPropertyException
     * @throws Main\SystemException
     */
    public function completeAction (int $proposalId): bool{
        if(!$proposalId) {
            $this->errorCollection[] = new Main\Error('Not provided a valid proposalId');
            return false;
        }

        $draftProposal = ProposalTable::query()
            ->setSelect(['ID', 'SAVED', 'USER_ID'])
            ->whereColumn('SAVED', 'NULLDATE')
            ->registerRuntimeField(
                'NULLDATE', new ExpressionField('NULLDATE', 'TIMESTAMP(0)')
            )
            ->where('ID', $proposalId)
            ->fetchObject();


        if($draftProposal) {
            $permissions = new Permission();
            if( !$permissions->canDoAs(Permission::T_OWNER_WRITE, $draftProposal->getUserId()) ) {
                $permissions->setErrorStatus();

                $this->errorCollection[] = $permissions->createError(Permission::T_OWNER_WRITE);
                return false;
            }

            $draftProposal->setDraft(false);
            $draftProposal->setSaved(new \Bitrix\Main\Type\DateTime());

            $result = $draftProposal->save();

            if(!$result->isSuccess()) {
                $this->errorCollection = $result->getErrorCollection();
                return false;
            }

        } else {
            $this->errorCollection[] = new Main\Error('Unable to find draft of the Proposal with ID = ' . $proposalId);
            return false;
        }

        return true;
    }

    public function toDraftAction(int $proposalId): bool {

        $toDraftProposal = ProposalTable::query()
            ->setSelect(['ID', 'SAVED', 'USER_ID'])
            ->where('ID', $proposalId)
            ->fetchObject();

        if($toDraftProposal) {
            $permissions = new Permission();
            if( !$permissions->canDoAs(Permission::T_OWNER_WRITE, $toDraftProposal->getUserId()) ) {
                $permissions->setErrorStatus();

                $this->errorCollection[] = $permissions->createError(Permission::T_OWNER_WRITE);
                return false;
            }


            // first remove draft-sign from other proposals

            /** @var Collection $colOtherDraftsProposal */
            $colOtherDraftsProposal = ProposalTable::query()
                ->setSelect(['ID'])
                ->whereNot('ID', $proposalId)
                ->where('DRAFT', true)
                ->fetchCollection();

            if($colOtherDraftsProposal->count() > 0) {
                foreach($colOtherDraftsProposal as $proposal) {
                    $proposal->setDraft(false);
                    $result = $proposal->save();

                    if(!$result->isSuccess()) {
                        $this->errorCollection = $result->getErrorCollection();
                        return false;
                    }
                }
            }

            $toDraftProposal->setSaved(null);
            $toDraftProposal->setDraft(true);

            $result = $toDraftProposal->save();

            if(!$result->isSuccess()) {
                $this->errorCollection = $result->getErrorCollection();
                return false;
            }

        } else {
            $this->errorCollection[] = new Main\Error('Unable to find the Proposal with ID = ' . $proposalId);
            return false;
        }

        return true;
    }

    public function getDraftAction(): ?array{
        $userId = intval(Main\Engine\CurrentUser::get()->getId());

        $permissions = new Permission();
        if( !$permissions->canDoAs(Permission::T_OWNER_READ, $userId) ) {
            $permissions->setErrorStatus();

            $this->errorCollection[] = $permissions->createError(Permission::T_OWNER_READ);
            return null;
        }

        $currentDraft = self::getDraftCP($userId);

        if(!$currentDraft) {
            $proposalController = new Proposal(Main\Application::getInstance()->getContext()->getRequest());
            $currentDraft = $proposalController->createDraftAction($userId);

            if(!$currentDraft) {
                $this->errorCollection = $proposalController->errorCollection;
                return null;
            }
        }

        $proposalController = new Proposal(Main\Application::getInstance()->getContext()->getRequest());
        return $proposalController->getAction($currentDraft);
    }

    public function getAction(int $id): ?array{
        $userId = intval(Main\Engine\CurrentUser::get()->getId());
        $permissions = new Permission();
        if( !$permissions->canDoAs(Permission::T_OWNER_READ, intval(Proposal::getCPUser($id))) ) {
            $permissions->setErrorStatus();

            $this->errorCollection[] = $permissions->createError(Permission::T_OWNER_READ);
            return null;
        }

        return ProposalTable::query()
            ->setSelect(['*', 'UF_*'])
            ->where('ID', $id)
            ->fetch() ?: [];
    }

    /**
     * @param int $userId
     * @return int|null
     * @throws Main\ArgumentException
     * @throws Main\ObjectPropertyException
     * @throws Main\SystemException
     */
    public static function getDraftCP(int $userId): ?int {
        if($userId <= 0) return null;

        return ProposalTable::query()
            ->setSelect(['ID'])
            ->where('USER_ID', $userId)
            ->where('DRAFT', true)
            ->fetch()['ID'] ?: null;
    }

    /**
     * @param int $proposalId
     * @return int|null
     * @throws Main\ArgumentException
     * @throws Main\ObjectPropertyException
     * @throws Main\SystemException
     */
    public static function getCPUser(int $proposalId): ?int {
        return ProposalTable::query()
            ->setSelect(['USER_ID'])
            ->where('ID', $proposalId)
            ->fetch()['USER_ID'] ?: null;
    }

    /**
     * @param int $userId
     * @return int|null
     * @throws Main\ArgumentException
     * @throws Main\SystemException
     */
    public function createDraftAction(int $userId): ?int{
        $defaultName = Main\Localization\Loc::getMessage('ITS_CPM_CONTROLLER_PROPOSAL_DEFAULT_NAME');

        // getting user proposal sample
        $sampleObject = Sample\Proposal::getUserSampleObject($userId);
        if(!$sampleObject->getName()) {

            // getting global proposal sample
            $sampleObject = Sample\Proposal::getGlobalSampleObject();
            if($sampleObject->getName()) {
                $defaultName = $sampleObject->getName();
            }

        } else {
            $defaultName = $sampleObject->getName();
        }

        $resultId = $this->addAction([
            'NAME' => $defaultName,
            'USER_ID' => $userId,
            'DRAFT' => true
        ]);

        return $resultId ?: null;
    }
}
