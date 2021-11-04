<?php

namespace Its;

class Getcount extends \CBitrixComponent
{
    public function executeComponent()
    {
        $this->arResult['COUNT'] = count($_SESSION[$this->arParams['COMPARE_LIST_NAME']][$this->arParams['IBLOCK_ID']]['ITEMS']);
        $this->includeComponentTemplate();
    }
}
