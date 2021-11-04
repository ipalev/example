<?php $cartTemplate =
    '<div class="cart-item" data-cart-id="{id}" data-product-id="{product_id}">'.
    '    <a class="cart-item__picture" href="#">'.
    '        <img src="{picture}" alt="{name}">'.
    '    </a>'.
    '    <div class="cart-item__info">'.
    '        <a href="{url}" class="mb-0 cart-item__title">{name}</a>'.
    '        <div class="cart-item__price">'.
    '            <p class="{add_price_classes} mb-0">{price_f}</p>'.
    '            <p style="{old_price_style}" class="xs cart-item__price-old mb-0">{old_price_f}</p>'.
    '        </div>'.
    '    </div>'.
    '    <div class="cart-item__break"></div>'.
    '    <div class="cart-item__amount">'.
    '        <a class="cart-item__amount-btn cart-item__amount-btn--less"' .
    '           onclick="Basket.setQuantity({id}, 1, \'down\', {use_float});"' .
    '           href="#"' .
    '           data-no-swup' .
    '        ></a>'.
    '        <p class="mb-0">{quantity}</p>'.
    '        <a class="cart-item__amount-btn cart-item__amount-btn--more"' .
    '           onclick="Basket.setQuantity({id}, 1, \'up\', {use_float});"' .
    '           href="#"' .
    '           data-no-swup' .
    '        ></a>'.
    '        <input type="hidden" id="QUANTITY_{id}" name="QUANTITY_{id}" value="{quantity}" />' .
    '        <input type="hidden"'.
    '               id="QUANTITY_INPUT_{id}"'.
    '               name="QUANTITY_INPUT_{id}"'.
    '               value="{quantity}"'.
    '               onchange="Basket.updateQuantity(\'QUANTITY_INPUT_{id}\', \'{id}\', \'{ratio}\', {use_float})"'.
    '        >'.
    '    </div>'.
    '    <div class="cart-item__controls-wrapper">'.
    '    <div class="cart-item__price cart-item__price-overall">{price_sum_f}</div>'.
//    '        <a class="cart-item__btn" data-no-swup href="#">' .
//    '            <img src="./img/icon-items-white.svg" alt>' .
//    '        </a>' .
//    '        <a class="cart-item__btn" data-no-swup href="#">' .
//    '            <img src="./img/icon-fav.svg" alt>' .
//    '        </a>' .
    '        <a class="cart-item__remove js__product-action"' .
    '           data-action="remove"' .
    '           data-product="{product_id}"' .
    '           data-no-swup' .
    '           href="#"' .
    '        ></a>'.
    '    </div>'.
    '</div>';
