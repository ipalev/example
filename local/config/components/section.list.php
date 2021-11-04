<?php
/**
 * @var \Its\Config\ComponentInterface $this
 */

return [
    "IBLOCK_TYPE" => $this->arParentParams["IBLOCK_TYPE"],
    "IBLOCK_ID" => $this->arParentParams["IBLOCK_ID"],
    "SECTION_ID" => $this->arParentResult["VARIABLES"]["SECTION_ID"],
    "CACHE_TYPE" => $this->arParentParams["CACHE_TYPE"],
    "CACHE_TIME" => $this->arParentParams["CACHE_TIME"],
    "CACHE_GROUPS" => $this->arParentParams["CACHE_GROUPS"],
    "COUNT_ELEMENTS" => "N",
    "HIDE_SECTION_NAME" => isset($this->arParentParams["SECTIONS_HIDE_SECTION_NAME"]) ? $this->arParentParams["SECTIONS_HIDE_SECTION_NAME"] : "N",
    "ADD_SECTIONS_CHAIN" => 'N',
    "NOT_EMPTY" => "Y",
    "TOP_DEPTH" => 1,
    "SECTION_USER_FIELDS" => [
        'UF_BAR_ICON',
    ],
    'FILTER_NAME' => '',
];