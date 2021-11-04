<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>
<div class="header__phone-wrapper">
    <?$APPLICATION->IncludeComponent(
        "bitrix:main.include",
        "",
        Array(
            "AREA_FILE_SHOW" => "file",
            "PATH" => SITE_TEMPLATE_PATH."/include/blocks/contacts/phone800.php",
            "AREA_FILE_RECURSIVE" => "N"
        ),
        false
    );?>
    <div class="header__phone-content">
        <p class="sm font-weight-medium mb-0">
            <?$APPLICATION->IncludeComponent(
                "bitrix:main.include",
                "",
                Array(
                    "AREA_FILE_SHOW" => "file",
                    "PATH" => SITE_TEMPLATE_PATH."/include/blocks/contacts/phone800.php",
                    "AREA_FILE_RECURSIVE" => "N"
                ),
                false
            );?>
        </p>
        <p class="sm font-weight-medium mb-0">
            <?$APPLICATION->IncludeComponent(
                "bitrix:main.include",
                "",
                Array(
                    "AREA_FILE_SHOW" => "file",
                    "PATH" => SITE_TEMPLATE_PATH."/include/blocks/contacts/phone_spb.php",
                    "AREA_FILE_RECURSIVE" => "N"
                ),
                false
            );?>
        </p>
        <p class="sm mb-15">
            <?$APPLICATION->IncludeComponent(
                "bitrix:main.include",
                "",
                Array(
                    "AREA_FILE_SHOW" => "file",
                    "PATH" => SITE_TEMPLATE_PATH."/include/blocks/contacts/mail.php",
                    "AREA_FILE_RECURSIVE" => "N"
                ),
                false
            );?>
        </p>
        <p class="xs mb-0">C 10:00 до 22:00<br>7 дней в неделю</p>
    </div>
</div>
