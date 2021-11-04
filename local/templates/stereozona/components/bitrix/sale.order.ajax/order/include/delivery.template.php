<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) {
    die();
}

$deliveryTemplate =
    '<div class="col-md-3 px-0">' .
    '    <div class="option">' .
    '        <div class="custom-control custom-radio">' .
    '            <input class="custom-control-input"' .
    '                   type="radio"' .
    '                   name="DELIVERY_ID"' .
    '                   value="{id}"' .
    '                   onclick="BX.Sale.OrderAjaxComponent.sendRequest()"' .
    '                   id="DELIVERY_{id}"' .
    '                   {checked}' .
    '            >' .
    '            <label class="custom-control-label" for="DELIVERY_{id}">' .
    '                <span class="option__top">' .
    '                    <span class="option__title">{name}</span>' .
    '                    <span class="option__dscr">{description}</span>' .
    '                </span>' .
    '                <span class="option__bottom"><span>{cost}</span></span>' .
    '            </label>' .
    '        </div>' .
    '    </div>' .
    '</div>';
