<?php
namespace Its\CPManager\Controller\Permission\ActionFilter;

use \Bitrix\Main;

use \Its\CPManager\Controller\Permission\Permission;


class CheckPermission extends Main\Engine\ActionFilter\Base{
	/**
	 * @var string
	 */
	private $checkLevel;
	private $asUserId;

    /**
     * Permission constructor.
     *
     * @param string $checkLevel Level checking for.
     * @param int $asUserId
     */
	public function __construct($checkLevel = Permission::T_OWNER_READ, $asUserId = 0){
		$this->checkLevel = $checkLevel;
		$this->asUserId = $asUserId;

		parent::__construct();
	}

	/**
	 * Performs permissions checking.
	 *
	 * @param Main\Event $event Event object.
	 *
	 * @return Main\EventResult|null
	 */
	public function onBeforeAction(Main\Event $event){
        $permission = new Permission();

        if( !$permission->isSatisfy($this->checkLevel) ) {

            $permission::setErrorStatus();
            $this->errorCollection[] = $permission->createError($this->checkLevel);

			return new Main\EventResult(Main\EventResult::ERROR, null, null, $this);
		}

		return null;
	}
}