<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) {
	die();
}

use Bitrix\Main\AccessDeniedException;

/**
 * @var CAllUser $USER
 * @var CAllMain $APPLICATION
 * @var CBitrixComponent $component
 * @var array $arParams
 * @var array $arResult
 */

global $USER;
$request = \Bitrix\Main\Context::getCurrent()->getRequest();

if ($arParams['SHOW_PRIVATE_PAGE'] !== 'Y' && $arParams['USE_PRIVATE_PAGE_TO_AUTH'] !== 'Y') {
	LocalRedirect($arParams['SEF_FOLDER']);
}

if ($arParams['SET_TITLE'] === 'Y') {
	$APPLICATION->SetTitle('Заказы');
}

if (!$USER->IsAuthorized() || $arResult['SHOW_LOGIN_FORM'] === 'Y') {
	throw new AccessDeniedException();
}

?>
<main class="page-content" id="swup">
	<div class="profile">
		<?php
		include('include/aside.php');
		?>
		<div class="profile__wrapper">
			<div class="container-fluid">
				<div class="profile__wrapper-top">
					<div class="badge">
						<a class="logo badge__logo" href="index.html">
							<img src="/assets/img/logo--white.svg" alt>
						</a>
						<div class="badge__status">Premium</div>
					</div>
				</div>
				<div class="profile__content">
					<?php

                    $request->set('filter_history', 'Y');
                    $_REQUEST['filter_history'] = 'Y';

                    $APPLICATION->IncludeComponent(
						"bitrix:sale.personal.order.list",
						"orders",
						array(
							"PATH_TO_DETAIL" => $arResult["PATH_TO_ORDER_DETAIL"],
							"PATH_TO_CANCEL" => $arResult["PATH_TO_ORDER_CANCEL"],
							"PATH_TO_CATALOG" => $arParams["PATH_TO_CATALOG"],
							"PATH_TO_COPY" => $arResult["PATH_TO_ORDER_COPY"],
							"PATH_TO_BASKET" => $arParams["PATH_TO_BASKET"],
							"PATH_TO_PAYMENT" => $arParams["PATH_TO_PAYMENT"],
							"SAVE_IN_SESSION" => $arParams["SAVE_IN_SESSION"],
							"ORDERS_PER_PAGE" => $arParams["ORDERS_PER_PAGE"],
							"SET_TITLE" =>$arParams["SET_TITLE"],
							"ID" => $arResult["VARIABLES"]["ID"],
							"NAV_TEMPLATE" => $arParams["NAV_TEMPLATE"],
							"ACTIVE_DATE_FORMAT" => $arParams["ACTIVE_DATE_FORMAT"],
							"HISTORIC_STATUSES" => $arParams["ORDER_HISTORIC_STATUSES"],
							"ALLOW_INNER" => $arParams["ALLOW_INNER"],
							"ONLY_INNER_FULL" => $arParams["ONLY_INNER_FULL"],
							"CACHE_TYPE" => $arParams["CACHE_TYPE"],
							"CACHE_TIME" => $arParams["CACHE_TIME"],
							"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
							"DEFAULT_SORT" => $arParams["ORDER_DEFAULT_SORT"],
							"DISALLOW_CANCEL" => $arParams["ORDER_DISALLOW_CANCEL"],
							"RESTRICT_CHANGE_PAYSYSTEM" => $arParams["ORDER_RESTRICT_CHANGE_PAYSYSTEM"],
							"REFRESH_PRICES" => $arParams["ORDER_REFRESH_PRICES"],
							"CONTEXT_SITE_ID" => $arParams["CONTEXT_SITE_ID"],
							"AUTH_FORM_IN_TEMPLATE" => 'Y',
						),
						$component
					);
					?>
				</div>
			</div>
		</div>
	</div>
</main>