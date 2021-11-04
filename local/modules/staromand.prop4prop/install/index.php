<?
use Bitrix\Main\Loader;
use Bitrix\Main\ModuleManager;
use Bitrix\Main\EventManager;
use Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);


if (class_exists("staromand_prop4prop")) return;

Class staromand_prop4prop extends CModule
{
	var $MODULE_ID = "staromand.prop4prop";
	var $MODULE_VERSION;
	var $MODULE_VERSION_DATE;
	var $MODULE_NAME;
	var $MODULE_DESCRIPTION;

	public function __construct() {
        $arModuleVersion = array();

        $path = str_replace("\\", "/", __FILE__);
        $path = substr($path, 0, strlen($path) - strlen("/index.php"));
        include($path."/version.php");

        $this->MODULE_VERSION = $arModuleVersion["VERSION"];
        $this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];

        $this->MODULE_NAME = Loc::getMessage("STAROMAND_PROP4PROP_MODULE_NAME");
        $this->MODULE_DESCRIPTION = Loc::getMessage("STAROMAND_PROP4PROP_MODULE_DESCRIPTION");
        $this->MODULE_GROUP_RIGHTS = 'N';
        $this->PARTNER_NAME = Loc::getMessage("STAROMAND_PROP4PROP_PARTNER_NAME");
        $this->PARTNER_URI = "#";
	}
	
	function doInstall()
	{
        Bitrix\Main\ModuleManager::registerModule($this->MODULE_ID);
        if (Bitrix\Main\Loader::includeModule($this->MODULE_ID)) {
            $eventManager = EventManager::getInstance();

            $eventManager->registerEventHandler(
                'iblock', 'OnIBlockPropertyBuildList', $this->MODULE_ID,
                '\\Staromand\\Prop4Prop\\IblockProperty', 'GetUserTypeDescription'
            );
            $eventManager->registerEventHandler(
                'main', 'OnUserTypeBuildList', $this->MODULE_ID,
                '\\Staromand\\Prop4Prop\\UserType', 'GetUserTypeDescription'
            );
            return true;
        }
        return false;
	}
	
	function doUninstall()
	{
        if (Loader::includeModule($this->MODULE_ID)) {

            $eventManager = EventManager::getInstance();
            $eventManager->unRegisterEventHandler('iblock', 'OnIBlockPropertyBuildList', $this->MODULE_ID);
            $eventManager->unRegisterEventHandler('main', 'OnUserTypeBuildList', $this->MODULE_ID);
            ModuleManager::unRegisterModule($this->MODULE_ID);

            return true;
        }
        return false;
	}
}
