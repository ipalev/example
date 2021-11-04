<?php
namespace Its\CPManager\Controller\Sample;

use \Bitrix\Main;
use \Bitrix\Main\Engine\Controller;
use \Bitrix\Main\Localization\Loc;
use \Bitrix\Main\ORM\Objectify\EntityObject;

use \Its\CPManager\ORM\Sample\ProposalTable;
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
            'saveUserSample' => [
                'prefilters' => [
                    $writePermission
                ]
            ],
            'update' => [
                'prefilters' => [
                    $writePermission
                ]
            ],
            'returnSample' => [
                'prefilters' => [
                    $readPermission
                ]
            ],
        ];
    }

    /**
     * @param array $fields
     * @return int|null
     * @throws Main\ArgumentException
     * @throws Main\ArgumentNullException
     * @throws Main\ArgumentOutOfRangeException
     * @throws Main\SystemException
     */
    public function addAction(array $fields): ?int {
        $permissions = new Permission();
        if( !$permissions->canDoAs(Permission::T_OWNER_WRITE, intval($fields['USER_ID'])) ) {
            $permissions->setErrorStatus();

            $this->errorCollection[] = $permissions->createError(Permission::T_OWNER_WRITE);
            return null;
        }

        $userSample = self::getUserSampleObject($fields['USER_ID']);

        $isNotExists = !$userSample->getId();

        if(!$isNotExists) {
            $this->errorCollection[] = new Main\Error(
                Loc::getMessage('ITS_CPM_CONTROLLER_SAMPLE_PROPOSAL_ALREADY_EXISTS', ['USER_ID' => $fields['USER_ID']])
            );
            return $userSample->getId();
        }

        $newSample = ProposalTable::createObject();

        foreach (ProposalTable::getEntity()->getFields() as $field) {
            if( array_key_exists($field->getName(), $fields) && Utils::isAllowedToSet($field) ) {

                $newSample->set($field->getName(), $fields[$field->getName()]);
            }
        }

        $result = $newSample->save();

        if(!$result->isSuccess()) {
            $this->errorCollection = $result->getErrorCollection();
            return null;
        }

        return $result->getId();
    }

    /**
     * @param array $fields
     * @return int|null
     * @throws Main\ArgumentException
     * @throws Main\ArgumentNullException
     * @throws Main\ArgumentOutOfRangeException
     * @throws Main\ObjectPropertyException
     * @throws Main\SystemException
     */
    public function saveUserSampleAction (array $fields): ?int {
        if(!array_key_exists('USER_ID', $fields) || !is_numeric($fields['USER_ID'])) {
            $fields['USER_ID'] = Main\Engine\CurrentUser::get()->getId();
        }

        $permissions = new Permission();
        if( !$permissions->canDoAs(Permission::T_OWNER_WRITE, intval($fields['USER_ID'])) ) {
            $permissions->setErrorStatus();

            $this->errorCollection[] = $permissions->createError(Permission::T_OWNER_WRITE);
            return null;
        }

        if(array_key_exists('ID', $fields) && is_numeric($fields['ID'])) {
            $smpObject = ProposalTable::getByPrimary($fields['ID'])->fetchObject();
        } else {
            $smpObject = self::getUserSampleObject($fields['USER_ID']);
        }

        if( $smpObject && ($smpId = $smpObject->getId()) ) {
            $success = $this->updateAction($smpId, $fields);
            if(!$success) {
                return null;
            }
        } else {
            $smpId = $this->addAction($fields);
        }

        return $smpId;
    }

    /**
     * @param int $id
     * @param array $fields
     * @return bool
     * @throws Main\ArgumentException
     * @throws Main\ArgumentNullException
     * @throws Main\ArgumentOutOfRangeException
     * @throws Main\ObjectPropertyException
     * @throws Main\SystemException
     */
    public function updateAction(int $id, array $fields): bool {
        $smpObject = ProposalTable::query()
            ->setSelect(['ID', 'USER_ID'])
            ->where('ID', $id)
            ->fetchObject();

        if($smpObject) {
            $permissions = new Permission();
            if( !$permissions->canDoAs(Permission::T_OWNER_WRITE, $smpObject->getUserId()) ) {
                $permissions->setErrorStatus();

                $this->errorCollection[] = $permissions->createError(Permission::T_OWNER_WRITE);
                return false;
            }

            $updateFields = [];

            foreach (ProposalTable::getEntity()->getFields() as $field) {
                if (array_key_exists($field->getName(), $fields) && Utils::isAllowedToSet($field)) {

                    $updateFields[$field->getName()] = $fields[$field->getName()];
                }
            }

            $result = ProposalTable::update($id, $updateFields);

            if (!$result->isSuccess()) {
                $this->errorCollection = $result->getErrorCollection();
                return false;
            }

            return true;

        } else {
            $this->errorCollection[] = new Main\Error(
                Loc::getMessage('ITS_CPM_CONTROLLER_SAMPLE_PROPOSAL_UNKNOWN', ['ID' => $id])
            );

            return false;
        }
    }

    /**
     * @param int|null $userId
     * @return EntityObject|null
     * @throws Main\ArgumentException
     * @throws Main\ObjectPropertyException
     * @throws Main\SystemException
     */
    public function returnSampleObjectAction(int $userId = null): ?EntityObject {
        if($userId === null) {
            $userId = Main\Engine\CurrentUser::get()->getId();
        }
        $toCheckUserId = $userId === 0 ? Main\Engine\CurrentUser::get()->getId() : $userId;

        $permissions = new Permission();
        if( !$permissions->canDoAs(Permission::T_OWNER_READ, intval($toCheckUserId)) ) {
            $permissions->setErrorStatus();

            $this->errorCollection[] = $permissions->createError(Permission::T_OWNER_READ);
            return null;
        }

        $object = self::getUserSampleObject($userId);

        if(!$object->getId()) {
            if( !$permissions->canDoAs(Permission::T_OWNER_WRITE, intval($toCheckUserId)) ) {
                $permissions->setErrorStatus();

                $this->errorCollection[] = $permissions->createError(Permission::T_OWNER_WRITE);
                return null;
            }

            $object->setUserId($userId);
            $result = $object->save();

            if(!$result->isSuccess()) {
                $this->errorCollection = $result->getErrorCollection();
                return null;
            }
        }

        return $object;
    }

    public function returnSampleAction (int $userId = null): array {
        $object = $this->returnSampleObjectAction($userId);
        if(!$object) {
            return [];
        }

        $object->fill(
            Main\ORM\Fields\FieldTypeMask::FLAT|Main\ORM\Fields\FieldTypeMask::USERTYPE
        );

        return $object->collectValues();
    }

    /**
     * @param int|null $userId
     * @return EntityObject
     * @throws Main\ArgumentException
     * @throws Main\ObjectPropertyException
     * @throws Main\SystemException
     */
    public static function getUserSampleObject(int $userId = null): EntityObject {
        if($userId === null) {
            $userId = Main\Engine\CurrentUser::get()->getId();
        }

        /** @var EntityObject $smpObject */
        $smpObject = ProposalTable::query()
            ->setSelect(['*'])
            ->where('USER_ID', $userId)
            ->fetchObject();

        if(!$smpObject)
            $smpObject = ProposalTable::createObject();

        return $smpObject;
    }

    /**
     * @return EntityObject
     * @throws Main\ArgumentException
     * @throws Main\ObjectPropertyException
     * @throws Main\SystemException
     */
    public static function getGlobalSampleObject(): EntityObject {
        return self::getUserSampleObject(0);
    }
}
