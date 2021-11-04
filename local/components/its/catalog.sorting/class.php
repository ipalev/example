<?php

namespace Its\Component;

use \Bitrix\Main;

class CatalogSorting extends \CBitrixComponent
{
    private $needFilter = false;

    public function onPrepareComponentParams($arParams){

        if (!Main\Loader::includeModule('iblock')) return false;

        if ($arParams['IBLOCK_ID'] <= 0) return false;

        if(!strlen($arParams['SORT_COOKIENAME'])) $arParams['SORT_COOKIENAME'] = 'catalog_personal_sort';

        $arParams['DEFAULT_SORT_ORDER'] =
            ( !empty($arParams['DEFAULT_SORT_ORDER']) && strtoupper($arParams['DEFAULT_SORT_ORDER']) === 'DESC' ) ?
                $arParams['DEFAULT_SORT_ORDER'] : 'ASC';

        if(!isset($arParams["CACHE_TIME"]))
            $arParams["CACHE_TIME"] = 36000;

        $defaultFields = ['CODE', 'ID', 'NAME'];
        $arParams['SECTION_ID'] = intval($arParams['SECTION_ID']);
        $arParams['PROPERTY_FIELDS'] =
            is_array($arParams['PROPERTY_FIELDS']) && !empty(array_filter($arParams['PROPERTY_FIELDS'])) ?
                array_filter($arParams['PROPERTY_FIELDS']) : $defaultFields;

        $arParams['ALLOW_PROPERTIY_FIELDS'] = false;
        if($arParams['SHOW_PROPERTIES'] !== false) {
            $arParams['ALLOW_PROPERTIY_FIELDS'] = true;
            if (is_array($arParams['SHOW_PROPERTIES']) && !empty(array_filter($arParams['SHOW_PROPERTIES']))) {
                $arParams['SHOW_PROPERTIES'] = array_filter($arParams['SHOW_PROPERTIES']);
                $this->needFilter = true;
            }
        }

        $arParams['PRICE_INCLUDE'] = !isset($arParams['PRICE_INCLUDE']) || $arParams['PRICE_INCLUDE'] == 'Y';
        if($arParams['PRICE_INCLUDE']) {
            $arParams['PRICE_ID'] = intval($arParams['PRICE_ID']);
        }

        return $arParams;
    }

    public function executeComponent(){
        $request = Main\Application::getInstance()->getContext()->getRequest();
        $this->arResult['ITEMS'] = [];

        if($this->arParams['ALLOW_PROPERTIY_FIELDS']) {
            $qProps = \Bitrix\Iblock\PropertyTable::query()
                ->setSelect($this->arParams['PROPERTY_FIELDS'])
                ->registerRuntimeField('LINKED_PROP', [
                    'data_type' => '\\Bitrix\\Iblock\\SectionPropertyTable',
                    'reference' => [
                        '=this.ID' => 'ref.PROPERTY_ID'
                    ]
                ])
                ->where('LINKED_PROP.IBLOCK_ID', $this->arParams['IBLOCK_ID']);
            if ($this->needFilter) {
                $qProps->whereIn('CODE', $this->arParams['SHOW_PROPERTIES']);
            }
            $rsProps = $qProps->exec();

            while ($arProp = $rsProps->fetch()) {
                $this->arResult['ITEMS'][] = [
                    'HTML' => 'property_' . $arProp['CODE'],
                    'NAME' => $arProp['NAME'],
                    'CODE' => $arProp['CODE']
                ];
            }
        }

        if( $this->arParams['PRICE_INCLUDE'] && Main\Loader::includeModule('catalog') ) {
            $rsPrice = \Bitrix\Catalog\GroupLangTable::query()
                ->setSelect(['G.ID', 'CODE' => 'G.NAME', 'NAME', 'LANG'])
                ->where('G.ID', $this->arParams['PRICE_ID'])
                ->where('LANG', LANGUAGE_ID)
                ->registerRuntimeField('G', [
                    'data_type' => '\\Bitrix\\Catalog\\GroupTable',
                    'reference' => [
                        '=this.CATALOG_GROUP_ID' => 'ref.ID'
                    ]
                ])->exec();
            while($arPrice = $rsPrice->fetch()) {
                array_unshift($this->arResult['ITEMS'], [
                    'HTML' => 'catalog_PRICE_' . $arPrice['CATALOG_GROUP_LANG_G_ID'],
                    'NAME' => $arPrice['NAME'],
                    'CODE' => $arPrice['CODE']
                ]);
            }
        }

        foreach ($this->arParams['ADDITIONAL_FIELDS'] as $addField) {
            $this->arResult['ITEMS'][] = [
                'HTML' => $addField,
                'NAME' => Main\Localization\Loc::getMessage('SORTING_ADD_FIELD_'.strtoupper($addField)),
                'CODE' => strtoupper($addField)
            ];
        }

        $existingCodes = array_map(
            function($value){
                return strtoupper($value);
            },
            array_column($this->arResult['ITEMS'], 'HTML')
        );

        $cookiesSetting = false;
        $this->arResult['CURRENT'] = [];

        if( $cookieSetting = $this->getFromCookie() ) {
            list($field, $order) = explode('.', $cookieSetting);
            $cookiesSetting = true;
        }

        if($request->get('by')) {
            $field = $request->get('by');
            $order = $request->get('order');
            $cookiesSetting = false;
        }

        $foundSetting = isset($field) && in_array(strtoupper($field), $existingCodes);
        if($cookiesSetting && !$foundSetting) $this->removeCookie();

        if($foundSetting) {
            $this->arResult['CURRENT'] = $this->arResult['ITEMS'][array_search(strtoupper($field), $existingCodes)];
        }

        if( !empty($this->arResult['CURRENT']) ) {
            $this->arResult['CURRENT']['ORDER'] =
                isset($order) && in_array(strtoupper($order), ['DESC', 'ASC']) ?
                    $order : $this->arParams['DEFAULT_SORT_ORDER'];
        }

        $this->includeComponentTemplate();
        return $this->arResult['CURRENT'];
    }

    protected function setCookie($field){
        $context = Main\Application::getInstance()->getContext();
        $cookie = new Main\Web\Cookie($this->arParams['SORT_COOKIENAME'], $field, null, false);
        $cookie->setSecure(false);
        $cookie->setHttpOnly(false);
        $cookie->setDomain($_SERVER['SERVER_NAME']);
        $context->getResponse()->addCookie($cookie);
        $context->getResponse()->flush('');
    }

    protected function getFromCookie() {
        $context = Main\Application::getInstance()->getContext();
        $cookie = $context->getRequest()->getCookieRaw($this->arParams['SORT_COOKIENAME']);
        return $cookie;
    }

    protected function removeCookie() {
        $context = Main\Application::getInstance()->getContext();
        $current = $context->getRequest()->getCookieRaw($this->arParams['SORT_COOKIENAME']);
        $context->getResponse()->addCookie(
            new Main\Web\Cookie($this->arParams['SORT_COOKIENAME'], $current, time() - 3600, false)
        );
        $context->getResponse()->flush('');
    }


}