<?namespace Its\Component;
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Iblock\IblockTable;
use Bitrix\Iblock\PropertyTable;
use Bitrix\Iblock\SectionTable;
use \Bitrix\Main;
use Bitrix\Main\Application;
use Bitrix\Main\Mail\Event;
use CFile;
use CIBlock;
use CIBlockElement;
use CPHPCache;
use CSiteConfig;
use Bitrix\Main\Localization\Loc;

if (!Main\Loader::includeModule('iblock')) return false;

class IblockForm extends \CBitrixComponent
{
    public function onPrepareComponentParams($arParams){
        if(!isset($arParams["CACHE_TIME"]))
            $arParams["CACHE_TIME"] = 36000;
        $arParams["CACHE_TIME"] = intval($arParams["CACHE_TIME"]);

        $arParams['IBLOCK_TYPE'] = trim(htmlspecialchars($arParams['IBLOCK_TYPE']));
        $arParams['FORM_CODE'] = trim(htmlspecialchars($arParams['FORM_CODE']));
        $arParams['TYPE_CODE'] = trim(htmlspecialchars($arParams['TYPE_CODE']));

        $arParams['IBLOCK_ID'] = IblockTable::query()
            ->setSelect(['ID'])
            ->where('IBLOCK_TYPE_ID', $arParams['IBLOCK_TYPE'])
            ->where('CODE', $arParams['FORM_CODE'])
            ->fetch()['ID'];

        $arParams['EVENT_FILE_PROPS'] = is_array($arParams['EVENT_FILE_PROPS']) ? $arParams['EVENT_FILE_PROPS'] : [];

        $arParams['RESP_SUCCESS_MSG_FIELD'] = strlen($arParams['RESP_SUCCESS_MSG_FIELD']) ? $arParams['RESP_SUCCESS_MSG_FIELD'] : false;
        $arParams['RESP_DEFAULT_ERROR_MSG_FIELD'] = strlen($arParams['RESP_DEFAULT_ERROR_MSG_FIELD']) ? $arParams['RESP_DEFAULT_ERROR_MSG_FIELD'] : false;

        return $arParams;
    }

    public function executeComponent(){
        global $APPLICATION;

        if ($this->arParams['IBLOCK_ID'] <= 0) return false;

        $request = Application::getInstance()->getContext()->getRequest();
        $isAjaxRequest = $request->getPost('ajax_send') == 'y';

        $this->arResult = [];

        $obCache = new CPHPCache();
        if ($obCache->StartDataCache($this->arParams["CACHE_TIME"], serialize([$this->arParams['IBLOCK_ID'], $this->arParams['TYPE_CODE'], $this->getTemplateName()]), $this->GetRelativePath())) {
            $this->arResult['FIELDS'] = [];
            $this->arResult['SECTION'] = [];

            $combinedTable = \Bitrix\Iblock\Model\Section::compileEntityByIblock($this->arParams['IBLOCK_ID']);
            $dbRes = $combinedTable::query()
                ->setSelect(['*', 'UF_*'])
                ->where('IBLOCK_ID', $this->arParams['IBLOCK_ID'])
                ->where('CODE', $this->arParams['TYPE_CODE']);
            $section = $dbRes->fetch();

            if (defined("BX_COMP_MANAGED_CACHE")) {
                global $CACHE_MANAGER;
                $CACHE_MANAGER->StartTagCache($this->GetRelativePath());
                $CACHE_MANAGER->RegisterTag("iblock_id_" . $this->arParams["IBLOCK_ID"]);
            }

            $this->arResult['SECTION'] = $section;

            $this->arResult['RESP_SUCCESS_MESSAGE'] =
                $this->arParams['RESP_SUCCESS_MSG_FIELD'] && $section[$this->arParams['RESP_SUCCESS_MSG_FIELD']] ?
                    $section[$this->arParams['RESP_SUCCESS_MSG_FIELD']] : Loc::getMessage('RESP_SUCCESS_MSG');

            $this->arResult['RESP_DEFAULT_ERROR_MSG'] =
                $this->arParams['RESP_DEFAULT_ERROR_MSG_FIELD'] && $section[$this->arParams['RESP_DEFAULT_ERROR_MSG_FIELD']] ?
                    $section[$this->arParams['RESP_DEFAULT_ERROR_MSG_FIELD']] : Loc::getMessage('RESP_DEFAULT_ERROR_MSG');

            $linkedFields = \CIBlockSectionPropertyLink::GetArray($this->arParams["IBLOCK_ID"], intval($section['ID']));
            $fieldIds = array_column($linkedFields, 'PROPERTY_ID');
            if(!empty($fieldIds)) {
                $this->arResult['FIELDS'] = PropertyTable::query()
                    ->setSelect(['*',])
                    ->setOrder(['SORT' => 'ASC'])
                    ->whereIn('ID', $fieldIds)
                    ->where('ACTIVE', true)
                    ->fetchAll();

                $allTypes = array_column($this->arResult['FIELDS'], 'PROPERTY_TYPE');

                if( in_array('L', $allTypes) ) {
                    $arValuesEnum = [];
                    $rsValuesEnum = \Bitrix\Iblock\PropertyEnumerationTable::query()
                        ->setSelect(['VALUE', 'ID', 'SORT', 'PROPERTY_ID'])
                        ->setOrder(['SORT' => 'ASC'])
                        ->whereIn('PROPERTY_ID', $fieldIds)
                        ->exec();

                    while($value = $rsValuesEnum->fetch()){
                        $arValuesEnum[$value['PROPERTY_ID']][] = $value;
                    }

                    foreach($this->arResult['FIELDS'] as &$prop){
                        if($prop['PROPERTY_TYPE'] == 'L' && isset($arValuesEnum[$prop['ID']])) {
                            $prop['VALUES'] = $arValuesEnum[$prop['ID']];
                        }
                    }
                    unset($prop);
                }

                if( in_array('E', $allTypes) ) {
                    $arLinkedIblocks = [];
                    foreach($this->arResult['FIELDS'] as $prop)
                        if($prop['LINK_IBLOCK_ID']) $arLinkedIblocks[] = $prop['LINK_IBLOCK_ID'];

                    $rsValuesLinked = \Bitrix\Iblock\ElementTable::query()
                        ->setSelect(['NAME', 'ID', 'SORT', 'IBLOCK_ID'])
                        ->setOrder(['SORT' => 'ASC'])
                        ->whereIn('IBLOCK_ID', $arLinkedIblocks)
                        ->exec();

                    $arValuesLinked = [];
                    while($value = $rsValuesLinked->fetch()) $arValuesLinked[$value['IBLOCK_ID']][] = $value;

                    foreach($this->arResult['FIELDS'] as &$prop){
                        if($prop['PROPERTY_TYPE'] == 'E' && isset($arValuesLinked[$prop['LINK_IBLOCK_ID']])) {
                            $prop['VALUES'] = $arValuesLinked[$prop['LINK_IBLOCK_ID']];
                        }
                    }
                    unset($prop);
                }

                if( in_array('G', $allTypes) ) {
                    $arLinkedIblocks = [];
                    foreach($this->arResult['FIELDS'] as $prop)
                        if($prop['LINK_IBLOCK_ID']) $arLinkedIblocks[] = $prop['LINK_IBLOCK_ID'];

                    $rsValuesLinked = \Bitrix\Iblock\SectionTable::query()
                        ->setSelect(['NAME', 'ID', 'SORT', 'IBLOCK_ID'])
                        ->setOrder(['SORT' => 'ASC'])
                        ->whereIn('IBLOCK_ID', $arLinkedIblocks)
                        ->exec();

                    $arValuesLinked = [];
                    while($value = $rsValuesLinked->fetch()) $arValuesLinked[$value['IBLOCK_ID']][] = $value;

                    foreach($this->arResult['FIELDS'] as &$prop){
                        if($prop['PROPERTY_TYPE'] == 'G' && isset($arValuesLinked[$prop['LINK_IBLOCK_ID']])) {
                            $prop['VALUES'] = $arValuesLinked[$prop['LINK_IBLOCK_ID']];
                        }
                    }
                    unset($prop);
                }
            }

            if(!$isAjaxRequest) {
                $this->IncludeComponentTemplate();
                $templateCachedData = $this->GetTemplateCachedData();

                if(defined("BX_COMP_MANAGED_CACHE")) {
                    $CACHE_MANAGER->EndTagCache();
                }

                $obCache->EndDataCache([
                    'arResult' => $this->arResult,
                    'templateCachedData' => $templateCachedData
                ]);
            } else {
                $obCache->AbortDataCache();
                if(defined("BX_COMP_MANAGED_CACHE")) {
                    $CACHE_MANAGER->AbortTagCache();
                }
            }
        } else {
            $this->arResult = $obCache->GetVars()['arResult'];
            $this->SetTemplateCachedData($obCache->GetVars()['templateCachedData']);
        }


        if($isAjaxRequest){
            ob_end_clean();
            $status = [
                'success' => false,
                'message' => '',
                'data' => [],
                'error' => '',
            ];

            $APPLICATION->ResetException();
            foreach (GetModuleEvents("its_component", "beforeIblockFormSend", true) as $arEvent) {
                $bEventRes = ExecuteModuleEventEx($arEvent, [$this->arParams, $request, &$data]);

                if(is_array($data) && !empty($data)) $status['data'] = $data;

                if($bEventRes === false) {
                    if($err = $APPLICATION->GetException()) {
                        $status['error'] = $err->GetString();
                    }
                    break;
                }
            }

            $typeCode = trim(htmlspecialchars($request->getPost('TYPE_CODE'))) ?: false;

            if($typeCode && $this->arResult['SECTION']['CODE'] !== $typeCode)
                $status['error'] = Loc::getMessage('UNKNOWN_FORM');

            if(empty($status['error'])) {
                $arFiles = [];
                foreach ($request->getFileList()->toArray() as $key => $file) {
                    $count = count($file['name']);
                    for ($i = 0; $i < $count; $i++) {
                        $arFiles[] = [
                            "VALUE" => [
                                'name' => $file['name'][$i],
                                'type' => $file['type'][$i],
                                'tmp_name' => $file['tmp_name'][$i],
                                'error' => $file['error'][$i],
                                'size' => $file['size'][$i],
                                'del' => 'N',
                                'MODULE_ID' => 'iblock'
                            ], "DESCRIPTION" => ""
                        ];
                    }
                }

                $props = array_column($this->arResult['FIELDS'], null, 'ID');

                $PROP = [];
                foreach ($request->getPost('PROPERTY') as $key => $prop) {
                    if (is_int($key)) {
                        $PROP[intval($key)] = $prop[0];
                    }
                }

                //Вроде бы, если не прикреплять обязательные свойства к разделу, то при пустом значении bitrix на него ругаться не будет

//                $anotherRequiredProps = PropertyTable::query()
//                    ->setSelect(['*'])
//                    ->where('ACTIVE', true)
//                    ->where('IS_REQUIRED', true)
//                    ->whereNotIn('ID', array_keys($props))
//                    ->where('IBLOCK_ID', $this->arParams['IBLOCK_ID'])
//                    ->fetchAll();
//                foreach ($anotherRequiredProps as $otherProp) $PROP[$otherProp] = '-';

                array_filter($PROP);

                $arElementFields = [
                    "IBLOCK_ID" => $this->arParams['IBLOCK_ID'],
                    "PROPERTY_VALUES" => $PROP,
                    "NAME" => Loc::getMessage('MESSAGE') .' '. date('d.m.Y H:i:s'),
                    "IBLOCK_SECTION_ID" => intval($this->arResult['SECTION']['ID']),
                ];

                $filePropertyCode = 'FILES';
                if (!empty($arFiles)) {
                    foreach ($props as $prop) {
                        if ($prop['PROPERTY_TYPE'] == 'F' && $prop['MULTIPLE'] == 'Y') {
                            $filePropertyCode = $prop['CODE'];
                            foreach ($arFiles as $key => $file) {
                                $err = CFile::CheckFile($file['VALUE'], 1048576*10, false, $prop['FILE_TYPE']);
                                if (!empty($err)) {
                                    $status['error'] = $err;
                                    break 2;
                                }
                            }
                        }
                    }
                }

                if (empty($status['error'])) {
                    $el = new CIBlockElement;
                    if ($ID = $el->Add($arElementFields)) {
                        if (!$el->SetPropertyValueCode($ID, $filePropertyCode, $arFiles)) {
                            $status['error'] = Loc::getMessage('FILE_ADD_FAILED');
                        }

                        $status['success'] = true;

                        $properties = [$ID => []];
                        CIBlockElement::GetPropertyValuesArray($properties, $this->arParams['IBLOCK_ID'], ['ID' => $ID]);
                        $elementId = current($properties)['SYS_PRODUCT']['VALUE'];
                        if ($elementId) {
                            $key = key($properties);
                            $res = CIBlockElement::GetByID($elementId);
                            if ($element = $res->GetNext()) {
                                $properties[$key]['PRODUCT_NAME'] = [
                                    'PROPERTY_TYPE' => 'S',
                                    'CODE' => 'PRODUCT_NAME',
                                    'VALUE' => $element['NAME']
                                ];
                                $properties[$key]['PRODUCT_URL'] = [
                                    'PROPERTY_TYPE' => 'S',
                                    'CODE' => 'PRODUCT_URL',
                                    'VALUE' => $element['DETAIL_PAGE_URL']
                                ];
                            }
                        }
                        $formattedPropValues = [];
                        foreach ($properties[$ID] as $key => $prop) {
                            switch($prop['PROPERTY_TYPE']){
                                case 'F':
                                    $formattedPropValues[$prop['CODE']] = CFile::GetPath($prop['VALUE']);
                                    break;
                                default:
                                    $formattedPropValues[$prop['CODE']] = $prop['VALUE'];
                                    break;
                            }
                        }

                        $toMailList = [
                            'ID' => $ID,
                            'IBLOCK_ID' => $this->arParams['IBLOCK_ID'],
                            'NAME' => $arElementFields['NAME'],
                            'TEXT' => $arElementFields['PREVIEW_TEXT'],
                            'CURRENT_DATE' => FormatDate('d.m.Y')
                        ];

                        foreach ($formattedPropValues as $propCode => $value) {
                            $toMailList[$propCode] = $value;
                        }

                        foreach (GetModuleEvents("its_component", "afterIblockFormSend", true) as $arEvent)
                            ExecuteModuleEventEx($arEvent, [
                                $ID, [
                                    'IBLOCK_TYPE' => $this->arParams['IBLOCK_TYPE'],
                                    'FORM_CODE' => $this->arParams['FORM_CODE'],
                                    'TYPE_CODE' => $this->arParams['TYPE_CODE'],
                                    'FORM_PROPS' => $this->arResult['FIELDS'],
                                    'ELEMENT_FIELDS' => $arElementFields,
                                ],
                                &$toMailList
                            ]);

                        $eventDataFiles = [];
                        if(!empty($this->arParams['EVENT_FILE_PROPS'])) {
                            foreach($this->arParams['EVENT_FILE_PROPS'] as $propCode) {
                                if(
                                    isset($properties[$ID][$propCode]) &&
                                    $properties[$ID][$propCode]['PROPERTY_TYPE'] == 'F' &&
                                    !empty($properties[$ID][$propCode]['VALUE'])
                                ) {
                                    $val = $properties[$ID][$propCode]['VALUE'];
                                    if($properties[$ID][$propCode]['MULTIPLE'] == 'N') {
                                        $eventDataFiles[] = $val;
                                    } else {
                                        $eventDataFiles[] = array_merge($eventDataFiles, is_array($val) ? $val : []);
                                    }
                                }
                                $eventDataFiles = array_filter($eventDataFiles);
                            }
                        }

                        $formEventCode = trim($request->getPost('TYPE_CODE')) ?: trim($request->getPost('FORM_CODE'));
                        $eventDataArray = [
                            "EVENT_NAME" => strtoupper($formEventCode) . "_FORM_FILLING_CUSTOM",
                            "LID" => SITE_ID,
                            "C_FIELDS" => $toMailList,
                        ];

                        if(!empty($eventDataFiles)) $eventDataArray["FILE"] = $eventDataFiles;

                        Event::send($eventDataArray);

                        foreach (GetModuleEvents("its_component", "afterIblockFormEventSend", true) as $arEvent)
                            ExecuteModuleEventEx($arEvent, [
                                $ID, [
                                    'IBLOCK_TYPE' => $this->arParams['IBLOCK_TYPE'],
                                    'FORM_CODE' => $this->arParams['FORM_CODE'],
                                    'TYPE_CODE' => $this->arParams['TYPE_CODE'],
                                    'FORM_PROPS' => $this->arResult['FIELDS'],
                                    'ELEMENT_FIELDS' => $arElementFields,
                                ]
                            ]);

                    } else {
                        $status['error'] = $el->LAST_ERROR;
                    }
                }

                if($status['success']) $status['message'] = $this->arResult['RESP_SUCCESS_MESSAGE'];
            }

            if(!$status['success'] && empty($status['error'])) {
                $status['error'] = $this->arResult['RESP_DEFAULT_ERROR_MSG'];
            }

            header('Content-Type: application/json');
            echo json_encode($status);
            die();

        }
    }
}
