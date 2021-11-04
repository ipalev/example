<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/** @var array $arParams */

$this->__component->arResult['PAGEN_MANAGER'] = $arResult['PAGEN_MANAGER'] = new \Its\Lib\PagenManager($arParams['PAGER_TITLE']);
$this->__component->SetResultCacheKeys(['PAGEN_MANAGER']);