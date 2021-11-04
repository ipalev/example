<?php

namespace Its\Component;

use Bitrix\Main\Localization\Loc;
use Bitrix\Sale\Order;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

\CBitrixComponent::includeComponentClass('bitrix:sale.personal.order.detail');

class PersonalOrderDetailComponent extends \CBitrixPersonalOrderDetailComponent
{
    /**
     * @inheritDoc
     */
	protected function doCaseOrderIdNotSet()
	{
		throw new \Exception(Loc::getMessage('ITS_COMPONENT_ORDER_DETAIL'));
	}
}