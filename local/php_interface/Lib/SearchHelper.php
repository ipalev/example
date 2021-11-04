<?
namespace Its\Lib;

class SearchHelper {

    public const ITEM_TYPE_ELEMENTS = 1;
    public const ITEM_TYPE_SECTIONS = 2;
    public const ITEM_TYPE_ALL = self::ITEM_TYPE_ELEMENTS| self::ITEM_TYPE_SECTIONS;

    public const FILTER_NAME = 'arrSearchFilter';

    private static $defaultComponentParameters = [
        "SHOW_CHAIN" => "N",
        "SHOW_RATING" => "N",
        "AJAX_MODE" => "N",
        "RESTART" => "Y",
        "NO_WORD_LOGIC" => "N",
        "USE_LANGUAGE_GUESS" => "N",
        "CHECK_DATES" => "Y",
        "USE_TITLE_RANK" => "Y",
        "DEFAULT_SORT" => "rank",
        "FILTER_NAME" => self::FILTER_NAME,
        "arrFILTER" => [],
        "SHOW_WHERE" => "Y",
        "SHOW_WHEN" => "Y",
        "PAGE_RESULT_COUNT" => 150,
        "CACHE_TYPE" => "N",
        "DISPLAY_TOP_PAGER" => "N",
        "DISPLAY_BOTTOM_PAGER" => "N",
        "PAGER_TITLE" => "",
        "PAGER_SHOW_ALWAYS" => "N",
        "PAGER_TEMPLATE" => "",
    ];

    public static function getComponentParameters(array $typeFilter, int $itemTypes = self::ITEM_TYPE_ALL, int $count = 150): array {
        $currentParameters = [];
        if($count > 0) {
            $currentParameters['PAGE_RESULT_COUNT'] = $count;
        }

        if(!empty($typeFilter)) {
            $currentParameters['arrFILTER'] = array_keys($typeFilter);

            foreach($typeFilter as $type => $typeList)
                $currentParameters['arrFILTER_'.$type] = $typeList;
        }

        if($itemTypes !== self::ITEM_TYPE_ALL) {
            $currentParameters[self::FILTER_NAME] = [
                ($itemTypes&self::ITEM_TYPE_ELEMENTS ? '!' : '?').'ITEM_ID' => 'S%'
            ];
        }

        return array_merge(self::$defaultComponentParameters, $currentParameters);
    }

    public static function getIblockConfig(array $iblockCodes): array
    {
        $iblockFilterConfig = [];

        foreach($iblockCodes as $iblockCode){
            if($iblockId = Iblock::getInstance()->get($iblockCode)) {
                $iblockFilterConfig['iblock_'. Iblock::getInstance()->getType($iblockCode)][] = $iblockId;
            }
        }

        return $iblockFilterConfig;
    }
}
