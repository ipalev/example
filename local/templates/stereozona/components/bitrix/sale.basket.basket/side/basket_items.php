<?php $cartTemplate =
    '<div class="cart-item" data-cart-id="{id}" data-product-id="{product_id}">'.
    '    <a class="cart-item__picture" href="#">'.
    '        <img src="{picture}" alt="{name}">'.
    '    </a>'.
    '    <div class="cart-item__info">'.
    '        <a href="{url}" class="mb-0 cart-item__title">{name}</a>'.
    '        <div class="cart-item__price">'.
    '            <p class="mb-0">{price_sum_f}</p>'.
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
    '        <a class="cart-item__remove js__product-action"' .
    '           data-action="remove"' .
    '           data-product="{product_id}"' .
    '           data-no-swup' .
    '           href="#"' .
    '        ></a>'.
    '    </div>'.
    '</div>';
