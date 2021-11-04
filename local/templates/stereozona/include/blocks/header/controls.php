<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/**
 * @var CAllMain $APPLICATION
 */

use Bitrix\Main\Context;
use Its\Lib\Modal\AuthModal;
use Its\Lib\Modal\ForgotPasswordModal;
use Its\Lib\Modal\ChangePasswordModal;
use Its\Lib\Modal\Processor;
use Its\Lib\Modal\RegisterModal;
use Its\Lib\Modal\ConfirmMailModal;

if (!$USER->IsAuthorized()) {
    $fields = ['backurl' => $APPLICATION->GetCurUri()];
    if (strpos(current($fields), '/personal/') === false && strpos(current($fields), '/cart/order/') === false) {
        Processor::getInstance()
            ->addModal(
                (new AuthModal())->setFields($fields)
            )
            ->addModal(
                (new RegisterModal())->setFields($fields)
            )
            ->addModal(
                (new ForgotPasswordModal())->setFields($fields)
            );
    }
}
$request = Context::getCurrent()->getRequest();

if ($request->get('confirm_registration')) {
    Processor::getInstance()->addModal(
        (new ConfirmMailModal())->setInstantOpen(true)
    );
} else {
    Processor::getInstance()->addModal(
        (new ConfirmMailModal())->setInstantOpen(false)
    );
}

if ($request->get('change_password')) {
    Processor::getInstance()->addModal(
        (new ChangePasswordModal())->setInstantOpen(true)
    );
}
?>
<div class="header__controls-wrapper">
    <div class="header__controls-item">
        <a class="header__btn" data-no-swup onclick="searchToggle()">
            <img src="/assets/img/icon-search.svg" alt>
        </a>
    </div>
    <div class="header__controls-item header__controls-item-compare header__controls-item-compare--empty js-header-compare-btn">
        <a class="header__btn" data-no-swup>
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
            }
            ?>
        </a>
        <div class="header__btn-content">
            <p class="header__btn-content-title">Сравнение</p>
            <p class="header__btn-content-subtitle">
                Начните выбор с каталога или воспользуйтесь поиском
            </p>
        </div>
    </div>
    <div class="header__controls-item header__controls-item-wish header__controls-item-wish--empty js-header-wish-btn">
        <a class="header__btn" href="<?=$USER->IsAuthorized() ? '/personal' : ''?>/wishlist/" data-no-swup>
            <img src="/assets/img/icon-fav.svg" alt>
            <span class="header__btn-count js__wish_count">0</span>
        </a>
        <div class="header__btn-content">
            <p class="header__btn-content-title">Избранное</p>
            <p class="header__btn-content-subtitle">
                Добавьте товары в список желаний
            </p>
        </div>
    </div>
    <div id="profile-link" class="header__controls-item">
        <?php
        $dynamicArea = new \Bitrix\Main\Composite\StaticArea('profile-link');
        $dynamicArea->setAnimation(true);
        $dynamicArea->setStub('<a class="header__btn" ><img src="/assets/img/icon-cart.svg" alt> <span class="header__btn-count js__cart_count" id="minicart_count"> </span> <span class="header__btn-price" id="minicart_sum"> </span> </a>');
        $dynamicArea->setContainerID('profile-link');
        $dynamicArea->startDynamicArea();?>
            <?php if ($USER->IsAuthorized()) {?>
                <a class="header__btn"
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
        <?php $dynamicArea->finishDynamicArea();?>
    </div>
    <div id="cart-controls-dynamic" class="header__controls-item header__controls-item-cart header__controls-item--mobile <?$APPLICATION->ShowViewContent('cart: empty-class')?>">
        <?php
            $dynamicArea = new \Bitrix\Main\Composite\StaticArea('stereozona_basket_coun');
            $dynamicArea->setAnimation(true);
            $dynamicArea->setStub('<a class="header__btn" ><img src="/assets/img/icon-cart.svg" alt> <span class="header__btn-count js__cart_count" id="minicart_count"> </span> <span class="header__btn-price" id="minicart_sum"> </span> </a>');
            $dynamicArea->setContainerID('cart-controls-dynamic');
            $dynamicArea->startDynamicArea();?>
        <a class="header__btn"
                   data-no-swup
                   data-is-goal="click"
                   data-base-goal-name="korzina_perehod"
                   <?= __CURRENT_PAGE__ !== 'cart' ? 'data-fancybox data-src="#modalCart" data-animation-effect="false" data-touch="false" data-modal="true"' : ''?>
                >
                    <img src="/assets/img/icon-cart.svg" alt>
                    <span class="header__btn-count js__cart_count" id="minicart_count">
                        <?$APPLICATION->ShowViewContent('cart: count')?>
                    </span>
                    <span class="header__btn-price" id="minicart_sum">
                        <?$APPLICATION->ShowViewContent('cart: formatted_price')?>
                    </span>
                </a>
            <?php if(__CURRENT_PAGE__ !== 'cart') {?>
                <div class="modal modal--right modal--cart" id="modalCart">
                    <a class="modal__close" href="#" data-fancybox-close data-no-swup></a>
                    <div class="container-fluid px-md-0">
                        <?$APPLICATION->IncludeComponent(
                            'bitrix:sale.basket.basket',
                            'side',
                            array(
                                "COLUMNS_LIST_EXT" => array(
                                    0 => "DETAIL_PAGE_URL",
                                    1 => "PROPERTY_GALLERY",
                                    2 => "DISCOUNT",
                                    3 => "SUM",
                                    4 => "PRICE",
                                ),
                                "PATH_TO_ORDER" => "/cart/order/",
                                "HIDE_COUPON" => "N",
                                "PRICE_VAT_SHOW_VALUE" => "N",
                                "USE_PREPAYMENT" => "N",
                                "QUANTITY_FLOAT" => "N",
                                "CORRECT_RATIO" => "Y",
                                "AUTO_CALCULATION" => "Y",
                                "SET_TITLE" => "N",
                                "ACTION_VARIABLE" => "action",
                                "COMPATIBLE_MODE" => "Y",
                                "BASKET_IMAGES_SCALING" => "adaptive",
                                "USE_GIFTS" => "N",
                            ),
                            false
                        );?>
                    </div>
                </div>
            <?php }?>
        <?php $dynamicArea->finishDynamicArea();?>
    </div>
</div>
