<?php

use Bitrix\Main\Application;
use \Bitrix\Main\Page\Asset;
use Its\Lib\Modal\Processor as ModalProcessor;

/** @var CAllMain $APPLICATION */


$request = Application::getInstance()->getContext()->getRequest();

ModalProcessor::getInstance()->init();

if (in_array($request->getHeader('x-requested-with'), ['deferredload', 'load-and-replace' ])) {
    include('footer.min.php');
    return;
}

?>
        <div class="footer">
            <div class="container-fluid footer__container">
                <div class="footer__body">
                    <div class="footer__top">
                        <div class="footer__top-left">
                            <div class="footer__sitemap-section"><a class="footer__sitemap-header" data-no-swup href="#">Рассылка stereozona</a>
                                <div class="footer__sitemap-content">
                                    <?php
                                    $APPLICATION->IncludeComponent(
                                        "bitrix:sender.subscribe",
                                        "footer-line",
                                        Array(
                                            "COMPONENT_TEMPLATE" => "footer-line",
                                            "USE_PERSONALIZATION" => "Y",
                                            "CONFIRMATION" => "Y",
                                            "SHOW_HIDDEN" => "Y",
                                            "AJAX_MODE" => $request->isAjaxRequest() ? "Y" : "N",
                                            "AJAX_OPTION_JUMP" => "N",
                                            "AJAX_OPTION_STYLE" => "N",
                                            "AJAX_OPTION_HISTORY" => "N",
                                            "CACHE_TYPE" => "A",
                                            "CACHE_TIME" => "3600",
                                            "SET_TITLE" => "N"
                                        )
                                    );
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="footer__top-right">
                            <div class="footer__sitemap-section"><a class="footer__sitemap-header" data-no-swup href="/info/">Поддержка</a>
                                <div class="footer__sitemap-content">
                                    <?php
                                    $APPLICATION->IncludeComponent(
                                        "bitrix:menu",
                                        "bottom_menu",
                                        [
                                            "ROOT_MENU_TYPE" => "bottom",
                                            "MAX_LEVEL" => "1",
                                            "MENU_CACHE_TYPE" => "A",
                                            "CACHE_SELECTED_ITEMS" => "N",
                                            "MENU_CACHE_TIME" => "3600000",
                                            "MENU_CACHE_USE_GROUPS" => "N",
                                            "MENU_CACHE_GET_VARS" => [],
                                        ],
                                        false
                                    );?>
                                </div>
                            </div>
                            <div class="footer__sitemap-section">
                                <a class="footer__sitemap-header"
                                   href="#"
                                   data-fancybox
                                   data-no-swup
                                   data-src="#modalContacts"
                                   data-animation-effect="false"
                                   data-touch="false"
                                   data-modal="true"
                                   data-base-class="fancybox--modal-contacts"
                                >
                                    Контакты
                                </a>
                                <div class="footer__sitemap-content">
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
                                    <div class="additional-phones">
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
                                    </div>
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
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="footer__middle">
                        <div class="socials">
                            <a class="socials__item socials__item--ig-white" href="https://www.instagram.com/stereozona.ru/" target="_blank"></a>
                            <a class="socials__item socials__item--vk-white" href="#"></a>
                            <a class="socials__item socials__item--fb-white" href="#"></a>
                            <a class="socials__item socials__item--yt" href="#"></a>
                        </div>
                    </div>
                </div>
                <div class="footer__bottom">
                    <div class="footer__bottom-left">
                        <span class="footer__text">©Stereozona <?=date('Y')?>. Все права защищены</span>
                        <a class="footer__text" href="/info/policy/" target="_blank">Конфиденциальность</a>
                    </div>
                    <a class="footer__bottom-author" href="https://its.agency" target="_blank">
                        <img src="/assets/img/its.svg" alt>
                    </a>
                </div>
            </div>
            <a class="up" href="#" data-no-swup></a>
        </div>
        <div id="vue-script" data-src="/assets/lib/vue.min.js"></div>
        <?

        switch(__CURRENT_PAGE__) {
            case 'main':
                ob_start();
                include($_SERVER['DOCUMENT_ROOT'].SITE_TEMPLATE_PATH.'/include/blocks/header/preloader.php');
                $APPLICATION->AddViewContent('preloader', ob_get_clean());
                break;
        }

        //Asset::getInstance()->addJs("https://api-maps.yandex.ru/2.1/?lang=ru_RU");
        Asset::getInstance()->addJs("/assets/js/vendor.js");
        Asset::getInstance()->addJs("/assets/js/scripts.js");
        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH."/bitrixjs/entry/scripts.min.js");

        ?>
    <?$APPLICATION->IncludeComponent(
        "bitrix:main.include",
        ".default",
        array(
            "AREA_FILE_SHOW" => "file",
            "PATH" => SITE_TEMPLATE_PATH.'/include/microdata/organization.php',
            "COMPONENT_TEMPLATE" => ".default",
            "EDIT_TEMPLTE" => "standard.php"
        ),
        false
    );?>
    </body>
</html>
