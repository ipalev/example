<?
namespace Its\CPManager\Component;

use \Bitrix\Main\Engine\CurrentUser;
use \Bitrix\Main\Loader;
use \Bitrix\Main\Entity\ExpressionField;
use \Bitrix\Main\Localization\Loc;

use Bitrix\Main\ORM\Fields\FieldTypeMask;
use \Its\CPManager\Controller\Permission\Permission;
use \Its\CPManager\ORM\ProductTable;
use Its\CPManager\ORM\Sample\ProposalTable;
use Its\CPManager\Utils;

class CPMSampleForm extends \CBitrixComponent{

    public function onPrepareComponentParams($arParams){
        if(!array_key_exists('USER_ID', $arParams) || !is_numeric($arParams['USER_ID']))
            $arParams['USER_ID'] = intval(CurrentUser::get()->getId());

        $this->arResult['ERRORS'] = [];

        if( !Loader::includeModule('its.cpmanager') ) $this->arResult['ERRORS'][] = Loc::getMessage('ITS_CPM_COMPONENT_SAMPLE_FORM_ERROR_NOT_INSTALLED');
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
            'FIELDS' => [],
        ];

        $permissions = new Permission();
        if( $permissions->canDoAs( Permission::T_OWNER_READ, $this->arParams['USER_ID'] ) ) {

            $smpProposalController = new \Its\CPManager\Controller\Sample\Proposal;

            $smpObject = $smpProposalController->returnSampleObjectAction($this->arParams['USER_ID']);

            if(!$smpObject) {
                $error = current($smpProposalController->getErrors());
                $errorMessage = $error ? $error->getMessage() : Loc::getMessage('ITS_CPM_COMPONENT_SAMPLE_FORM_ERROR_UNABLE_TO_RETURN_SAMPLE');

                $this->arResult['ERRORS'][] = $errorMessage;
                return false;
            }

            $this->arParams['ID'] = $smpObject->getId();

            //todo отвязать компонент от конкретного контроллера (передавать код сущности в параметры компонента или типа того)

            $fields = [];
            $userFields = [];
            foreach(ProposalTable::getEntity()->getFields() as $field) {
                if(!Utils::isAllowedToSet($field)) continue;

                $fields[$field->getName()] = $field;

                if(strpos($field->getName(), 'UF_') === 0) {
                    $userFields[] = $field->getName();
                }
            }

            $ufSettings = [];
            if(!empty($userFields)) {
                $ufSettings = \Bitrix\Main\UserFieldLangTable::query()
                    ->setSelect(['FIELD_NAME' => 'USER_FIELD.FIELD_NAME', 'SETTINGS' => 'USER_FIELD.SETTINGS', 'EDIT_FORM_LABEL'])
                    ->whereIn('USER_FIELD.FIELD_NAME', $userFields)
                    ->whereIn('USER_FIELD.ENTITY_ID', ProposalTable::getUfId())
                    ->fetchAll();
                $ufSettings = array_column($ufSettings, null, 'FIELD_NAME');
            }

            $columns = [];
            foreach($fields as $field){
                $columns[$field->getName()] = [
                    'CODE' => $field->getName(),
                    'NAME' => $field->getTitle(),
                    'VALUE' => ''
                ];

                if(array_key_exists($field->getName(), $ufSettings)) {
                    $columns[$field->getName()]['NAME'] = $ufSettings[$field->getName()]['EDIT_FORM_LABEL'];
                    $columns[$field->getName()]['SETTINGS'] = $ufSettings[$field->getName()]['SETTINGS'];
                }
            }

            $smpObject->fill(FieldTypeMask::FLAT|FieldTypeMask::USERTYPE);

            foreach ($fields as $fieldCode => $field) {
                if(array_key_exists($fieldCode, $columns)) {
                    $columns[$fieldCode]['VALUE'] = $smpObject->get($fieldCode);
                }
            }

            $this->arResult['FIELDS'] = $columns;

        } else {
            $permissions->setErrorStatus();
            $this->arResult['ERRORS'][] = $permissions->getErrorMsg(Permission::T_OWNER_READ);
        }

        $this->includeComponentTemplate();
    }

}