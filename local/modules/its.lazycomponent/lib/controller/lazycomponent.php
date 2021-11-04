<?php
namespace Its\LazyComponent\Controller;

use Bitrix\Main\Engine\Controller;

class LazyComponent extends Controller
{
    /**
     * @return array
     */
    public function configureActions()
    {
        return [
            'addToBody' => [
                'prefilters' => []
            ],
            'citySearch' => [
                'prefilters' => []
            ],
        ];
    }

    public static function addToBodyAction(): \Bitrix\Main\Engine\Response\Component
    {
        return new \Bitrix\Main\Engine\Response\Component(
            'bitrix:main.include',
            '',
            [
                'AREA_FILE_SHOW' => 'file',
                'PATH' => SITE_TEMPLATE_PATH .'/include/blocks/header/modals/contacts.php'
            ],
            [
            ]
        );
    }

    public static function citySearchAction(): \Bitrix\Main\Engine\Response\Component
    {
        return new \Bitrix\Main\Engine\Response\Component(
            'bitrix:sale.location.selector.search',
            'city_search',
            [
                "COMPONENT_TEMPLATE" => ".default",
                "ID" => 1,
                "INPUT_NAME" => "LOCATION",
                "PROVIDE_LINK_BY" => "id",
                "JSCONTROL_GLOBAL_ID" => "",
                "JS_CALLBACK" => "",
                "FILTER_BY_SITE" => "Y",
                "SHOW_DEFAULT_LOCATIONS" => "Y",
                "CACHE_TYPE" => "A",
                "CACHE_TIME" => "36000000",
                "FILTER_SITE_ID" => SITE_ID,
                "INITIALIZE_BY_GLOBAL_EVENT" => "",
                "SUPPRESS_ERRORS" => "N"
            ],
            [
            ]
        );
    }
}
