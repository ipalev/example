<?php

namespace Its\CPManager\Controller\Permission;

use \Bitrix\Main;
use \Bitrix\Main\Context;
use \Bitrix\Main\Localization\Loc;

class Permission {

	const T_DENY            = 'D';
	const T_OWNER_READ      = 'P';
	const T_OWNER_WRITE     = 'U';
	const T_ADMIN_READ      = 'V';
	const T_ADMIN_WRITE     = 'W';

	const OP_READ           = 'op_cpm_read';
	const OP_ADMIN_READ     = 'op_cpm_admin_read';
	const OP_WRITE          = 'op_cpm_write';
	const OP_ADMIN_WRITE    = 'op_cpm_admin_write';

	const ERROR_ACCESS_DENIED_CODE = 'access_denied';

	/** @var Main\Engine\CurrentUser $user */
    private $user;
    /** @var string */
    private $permission;

    function __construct() {
        $this->user = Main\Engine\CurrentUser::get();
        $this->permission = $this->user->getId() ?
            \CMain::GetUserRight('its.cpmanager') : Permission::T_DENY;
    }

    /**
     * @param string $permission
     * @param int $userId
     * @return bool
     */
    function canDoAs(string $permission, int $userId): bool {
        return $this->isSatisfy($permission) && $userId == $this->user->getId()
            ||
            $this->isSatisfy(self::getHigherThan($permission));
    }

    /**
     * @param string $permission
     * @return string
     */
    private static function getHigherThan(string $permission): string {
        $tree = [
            Permission::T_ADMIN_READ => [
                Permission::T_OWNER_READ
            ],
            Permission::T_ADMIN_WRITE => [
                Permission::T_OWNER_WRITE
            ]
        ];

        foreach($tree as $highestPermission => $subPermissions){
            if(in_array($permission, $subPermissions)) return $highestPermission;
        }

        return Permission::T_ADMIN_WRITE;
    }

    /**
     * @param string $letter
     * @return bool
     */
    public function isSatisfy(string $letter): bool {
        return $this->permission >= $letter;
    }

    /**
     * @throws Main\ArgumentNullException
     * @throws Main\ArgumentOutOfRangeException
     */
    public static function setErrorStatus(): void {
        Context::getCurrent()->getResponse()->setStatus(401);
    }

    /**
     * @param string $permission
     * @return Main\Error
     */
    public function createError(string $permission): Main\Error{
        return new Main\Error($this->getErrorMsg($permission), Permission::ERROR_ACCESS_DENIED_CODE);
    }

    /**
     * @param string $permission
     * @return string
     */
    public function getErrorMsg(string $permission) {
        return Loc::getMessage('ITS_CPM_PERMISSION_ERROR_ACCESS_'.$permission);
    }
}
