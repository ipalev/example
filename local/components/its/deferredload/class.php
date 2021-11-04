<?
namespace ITS\Component;
use Bitrix\Main\Context;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

class DeferredLoad extends \CBitrixComponent {

    public function onPrepareComponentParams($arParams){
        $arParams['DEFERRED_BLOCK_CODE'] = trim($arParams['DEFERRED_BLOCK_CODE']);

        if(strlen($arParams['DEFERRED_BLOCK_CODE']) <= 0)
            throw new \Exception('The code must be filled here, otherwise the call to the component is meaningless');
        $arParams['TEMPLATE_NAME'] = $this->getTemplateName();
        $arParams['DISPATCH_EVENT'] = $arParams['DISPATCH_EVENT'] == 'Y';

        if(strlen($arParams['TEMPLATE_NAME']) <= 0) $arParams['TEMPLATE_NAME'] = '.default';

        $arParams['HASH_CODE'] = md5($arParams['TEMPLATE_NAME'].$arParams['DEFERRED_BLOCK_CODE']);
        $arParams['MARKER'] = '<div data-deferredload-marker="deferred-block-'.$arParams['HASH_CODE'].'" style="display:none"></div>';

        return $arParams;
    }

    public function executeComponent() {
        if(
            $this->request->isAjaxRequest() &&
            $this->request->get('request-action') == 'deferredload' &&
            $this->request->get('deferred_block_marker') == 'deferred-block-' . $this->arParams['HASH_CODE']
        ) {
            $GLOBALS['APPLICATION']->RestartBuffer();

            $this->includeComponentTemplate();
            if($this->arParams['DISPATCH_EVENT'])
                echo
                    '<script>' .
                    '    document.dispatchEvent(new CustomEvent(\'ContentDeferredDone\', { detail: {' .
                    '        deferred_block_id: \'' . $this->arParams['DEFERRED_BLOCK_CODE'] . '\''.
                    '    }}))' .
                    '</script>';

            //$GLOBALS['APPLICATION']->FinalActions();
            die();
        }

        echo $this->arParams['~MARKER'];

        return true;
    }
}
