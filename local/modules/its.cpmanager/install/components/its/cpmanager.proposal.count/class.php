<?
namespace Its\CPManager\Component;

use \Bitrix\Main\Engine\CurrentUser;
use \Bitrix\Main\Loader;
use \Bitrix\Main\Entity\ExpressionField;
use \Bitrix\Main\Localization\Loc;
use \Bitrix\Main\ORM\Objectify\Collection;
use \Bitrix\Main\ORM\Entity;

use \Its\CPManager\Controller\Permission\Permission;
use \Its\CPManager\ORM\ProposalCategoryTable;
use \Its\CPManager\ORM\ProductCategoryTable;
use \Its\CPManager\ORM\ProductTable;
use \Its\CPManager\ORM\ProposalTable;
use \Its\CPManager\Utils;

class CPMCount extends \CBitrixComponent{

    public function onPrepareComponentParams($arParams){
        $arParams['USER_ID'] = intval($arParams['USER_ID']);
        if(!$arParams['USER_ID']) $arParams['USER_ID'] = intval(CurrentUser::get()->getId());

        $arParams['NAMES'] = $arParams['NAMES'] == 'Y';

        $this->arResult['ERRORS'] = [];

        if( !Loader::includeModule('its.cpmanager') ) $this->arResult['ERRORS'][] = Loc::getMessage('ITS_CPM_COMPONENT_PROPOSAL_COUNT_ERROR_NOT_INSTALLED');
        return $arParams;
    }

    public function executeComponent(){

        if(!empty($this->arResult['ERRORS'])) {
            foreach($this->arResult['ERRORS'] as $error){
                ShowError($error);
            }

            return false;
        }

        $this->arResult = [
            'PRODUCTS_COUNT' => 0,
            'PRODUCTS_SUM' => 0
        ];

        $permissions = new Permission();
        if( $permissions->canDoAs( Permission::T_OWNER_READ, $this->arParams['USER_ID'] ) ) {

            $this->arParams['ID'] = intval(\Its\CPManager\Controller\Proposal::getDraftCP($this->arParams['USER_ID']));

            if($this->arParams['ID']) {
                $query = ProductTable::query()
                    ->setSelect(['PRODUCTS_COUNT', 'PRODUCTS_SUM'])
                    ->where('PROPOSAL_ID', $this->arParams['ID'])
                    ->registerRuntimeField(
                        new ExpressionField('PRODUCTS_COUNT', 'COUNT(ID)')
                    )
                    ->registerRuntimeField(
                        new ExpressionField('PRODUCTS_SUM', 'SUM(QUANTITY)')
                    );

                $this->arResult = $query->fetch();
            }

        } else {
            $permissions->setErrorStatus();
            $this->arResult['ERRORS'][] = $permissions->getErrorMsg(Permission::T_OWNER_READ);
        }

        $this->includeComponentTemplate();
    }

}