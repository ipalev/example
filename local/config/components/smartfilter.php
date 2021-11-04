<?php
/**
 * @var \Its\Config\ComponentInterface $this
 */

return [
    "IBLOCK_TYPE" => $this->arParentParams["IBLOCK_TYPE"],
    "IBLOCK_ID" => $this->arParentParams["IBLOCK_ID"],
    "FILTER_NAME" => $this->arParentParams["FILTER_NAME"],
    "PREFILTER_NAME" => $this->arParentParams["PREFILTER_NAME"],
    "SECTION_ID" => $this->arParentResult['VARIABLES']['SECTION_ID'],
    "PRICE_CODE" => $this->arParentParams["~PRICE_CODE"],
    "CACHE_TYPE" => $this->arParentParams["CACHE_TYPE"],
    "CACHE_TIME" => $this->arParentParams["CACHE_TIME"],
    "CACHE_GROUPS" => $this->arParentParams["CACHE_GROUPS"],
    "SAVE_IN_SESSION" => "N",
    "XML_EXPORT" => "N",
    "SECTION_TITLE" => "NAME",
    "SECTION_DESCRIPTION" => "DESCRIPTION",
    'HIDE_NOT_AVAILABLE' => $this->arParentParams["HIDE_NOT_AVAILABLE"],
    "TEMPLATE_THEME" => $this->arParentParams["TEMPLATE_THEME"],
    'CONVERT_CURRENCY' => $this->arParentParams['CONVERT_CURRENCY'],
    'CURRENCY_ID' => $this->arParentParams['CURRENCY_ID'],
    "SEF_MODE" => $this->arParentParams["SEF_MODE"],
    "SEF_RULE" => $this->arParentResult["FOLDER"].$this->arParentResult["URL_TEMPLATES"]["smart_filter"],
    "SMART_FILTER_PATH" => $this->arParentResult["VARIABLES"]["SMART_FILTER_PATH"],
    "PAGER_PARAMS_NAME" => $this->arParentParams["PAGER_PARAMS_NAME"],
    "SHOW_ALL_WO_SECTION" => $this->arParentParams['SHOW_ALL_WO_SECTION'],
    "INSTANT_RELOAD" => $this->arParentParams["INSTANT_RELOAD"],
    "QUICK_FILTERS" => $this->arParentParams["QUICK_FILTERS"],
    "SKIP_PROPERTIES" => $this->arParentParams["SKIP_PROPERTIES"],
];