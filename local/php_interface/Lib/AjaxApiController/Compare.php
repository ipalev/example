<?php

namespace Its\Lib\AjaxApiController;

use Bitrix\Main\Result;

/**
 * Class Compare
 *
 * @property array $existingProducts
 * @property array $cartProductMap
 *
 * @package Its\Lib
 */

class Compare extends AbstractController
{

    public function createAnswer(Result $result): array
    {
        $answer = [
            'STATUS' => 'ERROR',
        ];

        if ($result->isSuccess()) {
            $answer['STATUS'] = 'OK';
            $answer['COMPARE_LIST'] = $result->getData();
        } else {
            $answer['MESSAGE'] = implode("\n", $result->getErrorMessages());
        }

        return $answer;
    }

    protected function getlistAction (): Result
    {
        $catalogIblockId = \Its\Lib\Iblock::getInstance()->get('catalog');
        $compareList = [];
        foreach ($_SESSION['CATALOG_COMPARE_LIST'][$catalogIblockId]['ITEMS'] as $item) {
            $compareList[] = $item['ID'];
        }

        return (new Result())->setData($compareList);
    }

    protected function addAction (array $data)
    {
        $_REQUEST['action'] = 'ADD_TO_COMPARE_LIST';
        $_REQUEST['id'] = $data['id'];
        $_REQUEST['ajax_action'] = $data['ajax_action'];
        $catalogIblockId = \Its\Lib\Iblock::getInstance()->get('catalog');
        global $APPLICATION;
        $APPLICATION->IncludeComponent(
            "bitrix:catalog.compare.list",
            "",
            array(
                "IBLOCK_TYPE" => "catalog",
                "IBLOCK_ID" => $catalogIblockId,
                "AJAX_MODE" => "N",
                "AJAX_OPTION_JUMP" => "N",
                "AJAX_OPTION_STYLE" => "Y",
                "AJAX_OPTION_HISTORY" => "N",
                "DETAIL_URL" => "#SECTION_CODE#",
                "COMPARE_URL" => "/catalog/compare/",
                "NAME" => "CATALOG_COMPARE_LIST",
                "AJAX_OPTION_ADDITIONAL" => "Y"
            ),
            false
        );
    }
}