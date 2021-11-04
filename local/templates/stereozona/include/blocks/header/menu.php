<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>
<div class="menu" id="menu">
    <a class="menu__btn" id="catalog-btn-mob" href="#" data-no-swup onclick="catalogMobToggle(this)"></a>
    <div class="menu__wrapper d-xl-block" id="catalog-mob">
        <div class="menu__header">
            <a class="menu__close" href="#" data-no-swup onclick="catalogMobToggle()"></a>
            <div class="menu__header-right">
                <a class="menu__control header__btn" href="/catalog/compare/" data-no-swup>
                    <img src="/assets/img/icon-items.svg" alt>
                    <?php
                    $iblockId = Its\Lib\Iblock::getInstance()->get('catalog');
                    if ($iblockId !== null) {
                        $APPLICATION->IncludeComponent(
                            'its:compare_count',
                            'count',
                            array(
                                'IBLOCK_ID' => $iblockId,
                                'COMPARE_LIST_NAME' => 'CATALOG_COMPARE_LIST',
                            ),
                            false
                        );
                    }?>
                </a>
                <a class="menu__control header__btn" href="<?=$USER->IsAuthorized() ? '/personal' : ''?>/wishlist/" data-no-swup>
                    <img src="/assets/img/icon-fav.svg" alt>
                    <span class="header__btn-count js__wish_count">0</span>
                </a>
                <?php
                $frame = new \Bitrix\Main\Composite\BufferArea('mobile-profile');
                $frame->begin();
                if ($USER->IsAuthorized()) {?>
                    <a class="menu__control header__btn"
                       href="/personal/"
                       data-is-goal="click"
                       data-base-goal-name="akk"
                    >
                        <img src="/assets/img/icon-profile.svg" alt>
                    </a>
                    <?php
                } else { ?>
                    <a
                            href="#"
                            data-fancybox
                            data-no-swup
                            data-src="#modalEnter"
                            data-animation-effect="false"
                            data-touch="false"
                            data-modal="true"
                            data-is-goal="click"
                            data-base-goal-name="akk"
                    >
                        <img src="/assets/img/icon-profile.svg" alt>
                    </a>
                    <?php
                }?>
                <?php
                $frame->beginStub();
                // Заглушка
                $frame->end();
                ?>
            </div>
        </div>
        <div class="menu__container">
            <div class="menu__content">
                <?php
                // menu
                include($_SERVER['DOCUMENT_ROOT'].SITE_TEMPLATE_PATH.'/include/blocks/header/menu-catalog.php');
                $APPLICATION->IncludeComponent(
                    "bitrix:menu",
                    "top2_menu",
                    [
                        "ROOT_MENU_TYPE" => "top2",
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
        <div class="menu__contacts">
            <p class="font-weight-medium mb-0"><a href="#">+7 800 201 47 67</a></p>
            <p class="font-weight-medium mb-0"><a href="#">+7 950 223 37 37</a></p>
            <p class="mb-0"><a href="#">info@stereozona.ru</a></p>
        </div>
    </div>
</div>
