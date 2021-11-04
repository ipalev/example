<?namespace Its\CPManager\Component;

use \Bitrix\Main\Engine\CurrentUser;
use \Bitrix\Main\Loader;
use \Bitrix\Main\Localization\Loc;
use Bitrix\Main\ORM\Fields\FieldTypeMask;
use Bitrix\Sale\Internals\EntityCollection;
use \Its\CPManager\Controller\Permission\Permission;
use \Its\CPManager\ORM\ProposalTable;

class CPMList extends \CBitrixComponent{

    public function onPrepareComponentParams($arParams){
        if(!isset($arParams['FILTER']) || !($arParams['FILTER'] instanceof \Bitrix\Main\ORM\Query\Filter\ConditionTree))
            $arParams['FILTER'] = false;

        if( !Loader::includeModule('its.cpmanager') )
            $this->arResult['ERRORS'][] = Loc::getMessage('ITS_CPM_COMPONENT_PROPOSAL_LIST_ERROR_NOT_INSTALLED');

        if( isset($arParams['SORT_BY']) ) {
            $isValidSort = false;
            foreach (ProposalTable::getEntity()->getScalarFields() as $field) {
                if ($arParams['SORT_BY'] == $field->getName() || $arParams['SORT_BY'] == $field->getColumnName()) {
                    $arParams['SORT_BY'] = $field->getName();
                    $isValidSort = true;
                    break;
                }
            }

            if(!$isValidSort) unset($arParams['SORT_BY']);
        }

        if( isset($arParams['SORT_BY']) ) {
            $arParams['SORT_ORDER'] = isset($arParams['SORT_ORDER']) && in_array($arParams['SORT_ORDER'], ['ASC', 'DESC']) ?
                $arParams['SORT_ORDER'] : 'DESC';
        }

        $arParams['USER_ID'] = intval($arParams['USER_ID']);
        if(!$arParams['USER_ID']) $arParams['USER_ID'] = intval(CurrentUser::get()->getId());

        $this->arResult['ERRORS'] = [];

        return $arParams;
    }

    public function executeComponent(){

        if(!Loader::includeModule('its.cpmanager')) {
            ShowError( Loc::getMessage('ITS_CPM_COMPONENT_PROPOSAL_LIST_ERROR_NOT_INSTALLED') );
            return false;
        }

        if(!empty($this->arResult['ERRORS'])) {
            foreach($this->arResult['ERRORS'] as $error){
                ShowError($error);
            }

            return false;
        }

        $permissions = new Permission();
        if( $permissions->canDoAs(Permission::T_OWNER_READ, $this->arParams['USER_ID'] ) ) {


            $this->arResult['ITEMS'] = [];

            $userProposalsQuery = ProposalTable::query()
                ->setSelect(['*'])
                ->where('USER_ID', $this->arParams['USER_ID']);

            if ($this->arParams['FILTER']) {
                $userProposalsQuery
                    ->where($this->arParams['FILTER']);
            }

            if (array_key_exists('SORT_BY', $this->arParams)) {
                $userProposalsQuery
                    ->setOrder([$this->arParams['SORT_BY'] => $this->arParams['SORT_ORDER']]);
            }

            /** @var EntityCollection $proposalCollection */
            $proposalCollection = $userProposalsQuery->fetchCollection();

            $proposalCollection->fill(FieldTypeMask::USERTYPE);

            foreach($proposalCollection as $object){
                $this->arResult['ITEMS'][] = $object->collectValues();
            }

            if (!empty($userProposals)) $this->arResult['ITEMS'] = $userProposals;

        } else {

            $permissions->setErrorStatus();
            $this->arResult['ERRORS'][] = $permissions->getErrorMsg(Permission::T_OWNER_READ);
        }
        $this->includeComponentTemplate();
    }


}