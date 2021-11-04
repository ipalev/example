"use strict";

import '../include/product-sliders'
import '../include/popup-actions'
import '../include/deferred-load'
import '../include/rcm-section'
import '../include/pagination'
import '../include/basket'
import '../include/order-component'
import '../include/order'
import '../include/goals'

import SendForm         from '../include/iblock-form';
import ProductForm      from "../include/product-form";
import AuthForm         from "../include/auth-form";
import ProfileForm       from "../include/profile-form";
import RegisterForm     from "../include/register-form";
import SmartFilter      from '../include/smart-filter';
import productAction    from "../include/product-action";

document.addEventListener('catalog-filters:init', function (e) {
    window.smartFilter = new SmartFilter(location.pathname, 'vertical');
});

document.addEventListener('pageLoaded', e=>{
    document.dispatchEvent(new CustomEvent('deferred-load:force', {}))
});

document.addEventListener('onBasketStateChanged',  function(ev) {
    Basket.updateBasket({extEventData: ev.detail});
});

document.addEventListener('soa:component.init',  function(ev) {
    BX.Sale.OrderAjaxComponent.init(ev.detail);
});

document.addEventListener('soa:component.order-saved',  function(ev) {
    if(ev.detail.params) {
        let path = ev.detail.params.PATH_TO_DETAIL.replace('#id#', ev.detail.id);

        loadAndReplace(path, '#modalNewOrder', () => {
            if(document.querySelector('#modalNewOrder')){
                window.showModal('#modalNewOrder');
            }
        }, false);
    }
});

document.addEventListener('iblock-form:auth-success',  function(ev) {
    let form = ev.detail && ev.detail.form ? ev.detail.form : null;
    if(form) {
        let backUrl = form.querySelector('input[name="backurl"]');
        if(backUrl && backUrl.value.length > 0) {
            location.href = backUrl.value;
        }
    }
});

document.addEventListener('iblock-form:register-success',  function(ev) {
    showModal('#modalRegistrationDone');
});

$(document).on('click', '.js__product-action', ev => {
    ev.preventDefault();

    let product = ev.target.dataset.product;
    let action = ev.target.dataset.action;
    let quantity = ev.target.dataset.quantity > 0 ? ev.target.dataset.quantity : 1;

    if (action) productAction(action, product, quantity);
});

$(document).on('submit', '.js__searchline', function(ev) {
    ev.preventDefault();
    if(!this.searchline.value) return;

    window.goToPage(this.action + BX.util.urlencode(this.searchline.value) + '/')
});

$(document).on('submit', '.js__send-ajax', (ev) => {
    ev.preventDefault();
    new SendForm(ev.target);
});

$(document).on('submit', '.js__ajax-auth', (ev) => {
    ev.preventDefault();

    var inputFields = document.querySelectorAll(".modal__form-login .input");
    var isFormValid = true;

    for (var i = 0; i < inputFields.length; i++) {
        if (!inputFields[i].value) {
            isFormValid = false;
            inputFields[i].classList.add('input--invalid');
        }
    }

    if (isFormValid)
        new AuthForm(ev.target);
});

$(document).on('submit', '.js__ajax-register', (ev) => {
    ev.preventDefault();

    var inputFields = document.querySelectorAll('.modal__form-registration .input');
    var isFormValid = true;

    for (var i = 0; i < inputFields.length; i++) {
        inputFields[i].classList.remove('input--invalid');

        if (!inputFields[i].value || inputFields[i].dataset.invalid !== undefined) {
            isFormValid = false;
            inputFields[i].classList.add('input--invalid');
        }
    }

    if (isFormValid)
        new RegisterForm(ev.target);
});

$(document).on('submit', '.js__ajax-passwd-change', (ev) => {
    ev.preventDefault();
    new ProfileForm(ev.target);
});

$(document).on('submit', '.js__product-form-ajax', (ev) => {
    ev.preventDefault();
    new ProductForm(ev.target);
});

$(document).on('click', '.js__personal-order', function (ev) {
    ev.preventDefault();

    if(this.dataset.href && this.dataset.modalId) {
        let modalId = `#${this.dataset.modalId}`;
        let cb = () => {
            if(document.querySelector(modalId)){
                window.showModal(modalId);
            }
        };

        if(!document.querySelector(modalId)){
            loadAndReplace(this.dataset.href, modalId, cb);
        } else {
            cb();
        }
    }
});
