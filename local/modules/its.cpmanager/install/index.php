<?php

use \Bitrix\Main\Loader;
use \Bitrix\Main\Application;
use \Bitrix\Main\EventManager;
use \Bitrix\Main\ModuleManager;
use \Bitrix\Main\Localization\Loc;
use \Bitrix\Main\Entity\DataManager;

use \Its\CPManager\ORM;

use \Its\CPManager\Controller\Permission\Permission;
use \Its\CPManager\CustomUF\UserFieldHelper as UFHelper;
use \Its\CPManager\Project\UserFieldScope as ProjectScope;

Loc::loadMessages(__FILE__);

class its_cpmanager extends CModule {

    static $userFields = [

    ];

    public function __construct() {
        $arModuleVersion = array();
        
        include __DIR__ . '/version.php';

        if (is_array($arModuleVersion) && array_key_exists('VERSION', $arModuleVersion)) {
            $this->MODULE_VERSION = $arModuleVersion['VERSION'];
            $this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];
        }
        
        $this->MODULE_ID = 'its.cpmanager';
        $this->MODULE_NAME = Loc::getMessage('ITS_CPM_MODULE_NAME');
        $this->MODULE_DESCRIPTION = Loc::getMessage('ITS_CPM_MODULE_DESCRIPTION');
        $this->MODULE_GROUP_RIGHTS = 'Y';
        $this->PARTNER_NAME = Loc::getMessage('ITS_CPM_MODULE_PARTNER_NAME');
    }

    public function doInstall(){
        global $USER;
        ModuleManager::registerModule($this->MODULE_ID);
        if ($USER->IsAdmin() && Loader::includeModule($this->MODULE_ID)) {

            if ($this->InstallDB()) {
                $this->InstallEvents();
                $this->createUserFields();
                $this->installFiles();
                $this->InstallTasks();
            }
        } else {
            return false;
        }
    }

    public function doUninstall(){
        global $USER, $APPLICATION, $step, $DOCUMENT_ROOT;
        if ($USER->IsAdmin() && Loader::includeModule($this->MODULE_ID)) {
            $step = IntVal($step);
            if ($step < 2) {
                $APPLICATION->IncludeAdminFile(Loc::getMessage('ITS_CPM_STEP1_TITLE'), $DOCUMENT_ROOT."/local/modules/".$this->MODULE_ID."/install/unstep1.php");
            } elseif ($step == 2) {
                if ( !isset($_REQUEST['save_tables']) ) {
                    $this->UninstallDB();
                    $this->removeUserFields();
                }
                $this->UnInstallTasks();
                $this->uninstallFiles();
                $this->UnInstallEvents();
                if ( !isset($_REQUEST['save_options']) ) $this->ClearOptions();
                ModuleManager::unRegisterModule($this->MODULE_ID);
            }
        }
    }

    public function InstallDB(){
        $connection = \Bitrix\Main\Application::getConnection();

        foreach($this->getTables() as $tableClass){
            if( !$connection->isTableExists($tableClass::getTableName()) ) {
                $tableClass::getEntity()->createDbTable();
            }
        }

        return true;
    }

    public function UninstallDB(){
        $connection = Application::getInstance()->getConnection();

        foreach($this->getTables() as $tableClass){
            if( $connection->isTableExists($tableClass::getTableName()) ) {
                $connection->dropTable($tableClass::getTableName());
            }
        }

        return true;
    }

    /**
     * @return DataManager[]
     */
    private function getTables():array {
        return [
            ORM\ProposalTable::class,
            ORM\ProductTable::class,
            ORM\ProductCategoryTable::class,
            ORM\ProposalCategoryTable::class,

            ORM\Sample\ProposalTable::class,
        ];
    }

    public function createUserFields(): void {
        UFHelper::createUserFieldScope(ProjectScope::$proposal, ProjectScope::$enumValues);
        UFHelper::createUserFieldScope(ProjectScope::$product, ProjectScope::$enumValues);
        UFHelper::createUserFieldScope(ProjectScope::$proposalCategory, ProjectScope::$enumValues);

        UFHelper::createUserFieldScope(ProjectScope::$smpProposal, ProjectScope::$enumValues);
    }

    public function removeUserFields(): void {
        UFHelper::removeUserFields(ProjectScope::$proposal);
        UFHelper::removeUserFields(ProjectScope::$product);
        UFHelper::removeUserFields(ProjectScope::$proposalCategory);

        UFHelper::removeUserFields(ProjectScope::$smpProposal);
    }

    /**
     * @return array[]
     */
    private function getEventHandlers ():array {

        return [
            [
                'from' => 'main',
                'event' => 'OnUserTypeBuildList',
                'to' => $this->MODULE_ID,
                'class' => '\Its\CPManager\CustomUF\Proposal',
                'method' => 'GetUserTypeDescription'
            ],
            [
                'from' => 'catalog',
                'event' => 'Bitrix\Catalog\Model\Product::OnAfterDelete',
                'to' => $this->MODULE_ID,
                'class' => '\Its\CPManager\EventHandler\Catalog',
                'method' => 'OnAfterProductDelete'
            ],
            [
                'from' => 'iblock',
                'event' => 'OnAfterIBlockSectionDelete',
                'to' => $this->MODULE_ID,
                'class' => '\Its\CPManager\EventHandler\Catalog',
                'method' => 'OnAfterSectionDelete'
            ],
            [
                'from' => $this->MODULE_ID,
                'event' => '\Its\CPManager\ORM\Product::OnAfterAdd',
                'to' => $this->MODULE_ID,
                'class' => '\Its\CPManager\EventHandler\Product',
                'method' => 'OnAfterProductAdd'
            ],
            [
                'from' => $this->MODULE_ID,
                'event' => '\Its\CPManager\ORM\Product::OnDelete',
                'to' => $this->MODULE_ID,
                'class' => '\Its\CPManager\EventHandler\Product',
                'method' => 'OnProductDelete'
            ],
            [
                'from' => $this->MODULE_ID,
                'event' => '\Its\CPManager\ORM\Product::categoryChanged',
                'to' => $this->MODULE_ID,
                'class' => '\Its\CPManager\EventHandler\Product',
                'method' => 'OnCategoryChanged'
            ],
            [
                'from' => $this->MODULE_ID,
                'event' => '\Its\CPManager\ORM\ProductCategory::OnDelete',
                'to' => $this->MODULE_ID,
                'class' => '\Its\CPManager\EventHandler\ProductCategory',
                'method' => 'OnCategoryDelete'
            ],
            [
                'from' => $this->MODULE_ID,
                'event' => '\Its\CPManager\ORM\Proposal::OnDelete',
                'to' => $this->MODULE_ID,
                'class' => '\Its\CPManager\EventHandler\Proposal',
                'method' => 'OnProposalDelete'
            ],
            [
                'from' => 'main',
                'event' => 'OnBuildGlobalMenu',
                'to' => $this->MODULE_ID,
                'class' => '\Its\CPManager\EventHandler\Main',
                'method' => 'OnBuildGlobalMenu'
            ],
        ];
    }

    public function InstallEvents(): void {
        $eventManager = EventManager::getInstance();

        foreach($this->getEventHandlers() as $eventHandler) {
            $eventManager->registerEventHandler(
                $eventHandler['from'],
                $eventHandler['event'],
                $eventHandler['to'],
                $eventHandler['class'],
                $eventHandler['method']
            );
        }

    }

    public function UnInstallEvents(): void {
        $eventManager = EventManager::getInstance();

        foreach($this->getEventHandlers() as $eventHandler) {
            $eventManager->unRegisterEventHandler(
                $eventHandler['from'],
                $eventHandler['event'],
                $eventHandler['to'],
                $eventHandler['class'],
                $eventHandler['method']
            );
        }
    }

    public function installFiles(): void {
        CopyDirFiles(
            $_SERVER["DOCUMENT_ROOT"]."/local/modules/".$this->MODULE_ID."/install/admin/",
            $_SERVER["DOCUMENT_ROOT"]."/bitrix/admin",
            true, true
        );
        CopyDirFiles(
            $_SERVER["DOCUMENT_ROOT"]."/local/modules/".$this->MODULE_ID."/install/components/",
            $_SERVER["DOCUMENT_ROOT"]."/local/components",
            true, true
        );
    }

    public function uninstallFiles(): void {
        DeleteDirFiles(
            $_SERVER['DOCUMENT_ROOT'].'/local/modules/'.$this->MODULE_ID.'/install/admin',
            $_SERVER['DOCUMENT_ROOT'].'/bitrix/admin'

        );
        DeleteDirFiles(
            $_SERVER['DOCUMENT_ROOT'].'/local/modules/'.$this->MODULE_ID.'/install/components/its',
            $_SERVER['DOCUMENT_ROOT'].'/local/components/its'

        );
    }

    public function GetModuleTasks(){
        return [
            'tsk_cpmanager_deny' => [
                'LETTER' => Permission::T_DENY,
                'BINDING' => 'module',
                'OPERATIONS' => [],

            ],
            'tsk_cpmanager_owner_read' => [
                'LETTER' => Permission::T_OWNER_READ,
                'BINDING' => 'module',
                'OPERATIONS' => [
                    Permission::OP_READ,
                ],
            ],
            'tsk_cpmanager_all_read' => [
                'LETTER' => Permission::T_ADMIN_READ,
                'BINDING' => 'module',
                'OPERATIONS' => [
                    Permission::OP_READ,
                    Permission::OP_ADMIN_READ,
                ],
            ],
            'tsk_cpmanager_owner_write' => [
                'LETTER' => Permission::T_OWNER_WRITE,
                'BINDING' => 'module',
                'OPERATIONS' => [
                    Permission::OP_READ,
                    Permission::OP_WRITE,
                ],
            ],
            'tsk_cpmanager_all_write' => [
                'LETTER' => Permission::T_ADMIN_WRITE,
                'BINDING' => 'module',
                'OPERATIONS' => [
                    Permission::OP_READ,
                    Permission::OP_ADMIN_READ,
                    Permission::OP_WRITE,
                    Permission::OP_ADMIN_WRITE,
                ],
            ],
        ];
    }


    public function ClearOptions(): void {
        \Bitrix\Main\Config\Option::delete($this->MODULE_ID);
    }
}
