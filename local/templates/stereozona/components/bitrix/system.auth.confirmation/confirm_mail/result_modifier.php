<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$arResult['NEED_CONFIRMATION'] = \COption::GetOptionString("main", "new_user_registration_email_confirmation", "Y") == "Y";

if ($arResult['NEED_CONFIRMATION'] && $arResult["CONFIRM_CODE"] && $arResult['USER_ACTIVE']['ACTIVE'] == 'Y') {
    $USER->Authorize($arResult['USER_ACTIVE']['ID']);
}