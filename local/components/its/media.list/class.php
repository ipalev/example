<?
namespace Its\Component;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main;
class MediaList extends \CBitrixComponent{
    public function onPrepareComponentParams($arParams){
        if (!is_array($arParams['COLLECTIONS'] ) || empty($arParams['COLLECTIONS'])) return false;

        $arParams['CACHE_TIME'] = intval($arParams['CACHE_TIME']);
        if($arParams['CACHE_TIME'] < 0) $arParams['CACHE_TIME'] = 0;

        return $arParams;
    }

    public function executeComponent(){
        $this->arResult['ITEMS'] = [];

        $obCache = new \CPHPCache();
        $cachePath = '/its/media_list';
        if ($obCache->InitCache($this->arParams['CACHE_TIME'], serialize($this->arParams), $cachePath)) {
            $this->arResult['ITEMS'] = $obCache->GetVars();
        } elseif ($obCache->StartDataCache()) {
            Main\Loader::includeModule('fileman');
            \CMedialib::Init();

            $this->arResult['ITEMS'] = \CMedialibItem::GetList([
                'arCollections' => $this->arParams['COLLECTIONS']
            ]);

            $this->arResult['ITEMS'] = is_array($this->arResult['ITEMS']) ?
                $this->arResult['ITEMS'] : [];

            $obCache->EndDataCache($this->arResult['ITEMS']);
        }

        $this->includeComponentTemplate();
    }
}