<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/** @var CAllMain $APPLICATION */

?>
<div class="modal modal--right modal--close-outside modal--contacts" id="modalContacts">
    <a class="modal__close" href="#" data-fancybox-close data-no-swup></a>
    <div class="container-fluid px-md-0">
        <div class="modal__content">
            <div class="modal__title h2">Контакты</div>
            <div class="modal__contacts-tabs">
                <a class="modal__contacts-tab modal__contacts-tab--contacts modal__contacts-tab--active" href="#" data-no-swup>Контакты</a>
                <a class="modal__contacts-tab modal__contacts-tab--office" href="#" data-no-swup>салон</a>
            </div>
            <div class="modal__contacts-left">
                <div class="modal__contacts-info">
                    <div class="modal__contacts-info-item">
                        <div class="h3">
                            <?$APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                Array(
                                    "AREA_FILE_SHOW" => "file",
                                    "PATH" => SITE_TEMPLATE_PATH."/include/blocks/contacts/contacts_phone800.php",
                                    "AREA_FILE_RECURSIVE" => "N"
                                ),
                                false
                            );?>
                        </div>
                        <p class="xs mb-0">Бесплатный номер для России</p>
                    </div>
                    <div class="modal__contacts-info-item">
                      <div class="modal__contacts-link-wrapper h3">
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
                    </div>
                    <div class="modal__contacts-info-item modal__contacts-info-item--email">
                      <div class="modal__contacts-link-wrapper h3">
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
                        <p class="xs mb-0"><a class="modal__contacts-copy" href="#">Скопировать адрес</a></p>
                    </div>
                    <div class="modal__contacts-info-item">
                        <div class="modal__contacts-link-wrapper h3"><a href="https://www.instagram.com/stereozona.ru/" target="_blank">@stereozona.ru</a></div>
                        <p class="xs mb-0">Ищите нас в Instagram</p>
                    </div>
                </div>
                <?php $APPLICATION->IncludeComponent(
                    "its:iblock.form",
                    "default",
                    array(
                        "IBLOCK_TYPE" => "forms",
                        "TYPE_CODE" => "",
                        "FORM_CODE" => "callback-form",
                        "RESP_SUCCESS_MSG_FIELD" => "",
                        "RESP_DEFAULT_ERROR_MSG_FIELD" => "",
                        "CACHE_TYPE" => "A",
                        "CACHE_TIME" => "3600",
                        "EVENT_FILE_PROPS" => array(
                            0 => "",
                        )
                    ),
                    false
                ); ?>
            </div>
            <div class="modal__contacts-right">
                <div class="modal__address">
                    <div class="modal__address-top">
                        <div class="modal__address-top-left">
                            <?$APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                Array(
                                    "AREA_FILE_SHOW" => "file",
                                    "PATH" => SITE_TEMPLATE_PATH."/include/blocks/contacts/address.php",
                                    "AREA_FILE_RECURSIVE" => "N"
                                ),
                                false
                            );?>
                        </div>
                        <a class="btn btn-outline-primary btn-sm modal__address-btn modal__address-btn--find" href="#" data-no-swup>
                            <span>Как нас найти?</span>
                        </a>
                        <a class="btn btn-outline-primary btn-sm modal__address-btn modal__address-btn--map" href="#" data-no-swup>
                            <span>показать карту</span>
                        </a>
                    </div>
                    <div class="modal__address-content">
                        <div class="modal__address-content-item modal__address-content-item--active modal__address-content-item--map">
                            <iframe src="https://yandex.ru/map-widget/v1/-/CCUMULgLPD" class="map"></iframe>
                        </div>
                        <div class="modal__address-content-item modal__address-content-item--find">
                            <div class="streetview">
                                <div class="streetview-toggle checkbox checkbox--switch checkbox--switch-reverse">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" id="streetview-checkbox" type="checkbox">
                                        <label class="custom-control-label" for="streetview-checkbox">Панорамный вид</label>
                                    </div>
                                </div>
                                <?$APPLICATION->IncludeComponent(
                                    "bitrix:main.include",
                                    "",
                                    Array(
                                        "AREA_FILE_SHOW" => "file",
                                        "PATH" => SITE_TEMPLATE_PATH."/include/blocks/contacts/img_orientir.php",
                                        "AREA_FILE_RECURSIVE" => "N"
                                    ),
                                    false
                                );?>
                                <div class="streetview__content">
                                    <div class="streetview__content-left">
                                        <p class="xs mb-0 text-white">
                                            Ориентируйтесь на соседние&nbsp;магазины «Лига» и Сinnabon
                                        </p>
                                    </div>
                                    <div class="streetview__content-right">
                                        <button class="streetview__slider-prev-btn">Назад</button>
                                        <button class="streetview__slider-next-btn">Далее</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
