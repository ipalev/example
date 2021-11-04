"use strict";

let createPopupEvent = params => new CustomEvent('popup:open', {'detail': params});

document.addEventListener('basket:onchange',  (ev) => {
    // Если это страница большой корзины, не выполняем показ попапа
    if(document.getElementById('cart-page')) return;

    if(
        ev.detail.after === 'increase'
        && ev.detail.product_fields
        && ev.detail.product_fields.hasOwnProperty(ev.detail.product_id)
    ) {
        let productData = ev.detail.product_fields[ev.detail.product_id];

        let eventData = {
            title: 'Товар добавлен в корзину',
            text: productData['name'],
            img: productData['picture'],
        };

        if(ev.detail.modal_basket) {
            eventData['button'] = {
                modal: true,
                id: '#modalCart',
                text: 'Открыть'
            };
        }

        document.dispatchEvent(createPopupEvent(eventData));
    }
});

document.addEventListener('personal-order:repeat-success',  (ev) => {
    document.dispatchEvent(createPopupEvent({
        title: 'Готово',
        text: 'Содержимое заказа добавлено в корзину',
        img: '/local/templates/stereozona/include/images/success.png',
        button: {
            modal: true,
            id: '#modalCart',
            text: 'Смотреть в корзине'
        }
    }));
});

document.addEventListener('personal-order:repeat-fail', (ev) => {
    document.dispatchEvent(createPopupEvent({
        title: 'Ошибка',
        text: ev.detail.error,
        img: '/local/templates/stereozona/include/images/error.png',
    }));
});

document.addEventListener('onErrorFormSubmit', (ev) => {
    document.dispatchEvent(createPopupEvent({
        title: 'Ошибка',
        text: ev.detail.message,
        img: '/local/templates/stereozona/include/images/error.png',
    }));
});

document.addEventListener('onSuccessFormSubmit', (ev) => {
    document.dispatchEvent(createPopupEvent({
        title: 'Успех',
        text: ev.detail.message,
        img: '/local/templates/stereozona/include/images/success.png',
    }));
});

document.addEventListener('basket:coupon-applied', (ev) => {
    let coupon = ev.detail.coupon;

    document.dispatchEvent(createPopupEvent({
        title: `Купон ${coupon.COUPON}`,
        text: coupon.JS_CHECK_CODE,
        img: '/local/templates/stereozona/include/images/success.png',
    }));
});

document.addEventListener('basket:coupon-fail', (ev) => {
    let coupon = ev.detail.coupon;

    document.dispatchEvent(createPopupEvent({
        title: `Купон ${coupon.COUPON}`,
        text: coupon.JS_CHECK_CODE,
        img: '/local/templates/stereozona/include/images/error.png',
    }));
});

document.addEventListener('soa:component.error', (ev) => {
    document.dispatchEvent(createPopupEvent({
        title: `Ошибка оформления заказа`,
        text: ev.detail.message,
        img: '/local/templates/stereozona/include/images/error.png',
    }));
});

document.addEventListener('soa:component.order-saved', (ev) => {
    document.dispatchEvent(createPopupEvent({
        title: `Заказ успешно оформлен`,
        text: '',
        img: '/local/templates/stereozona/include/images/success.png',
    }));
});

document.addEventListener('comparison:add-success', (ev) => {
    document.dispatchEvent(createPopupEvent({
        title: ev.detail.message,
        text: '',
        img: '/local/templates/stereozona/include/images/success.png',
    }));
});

document.addEventListener('comparison:add-success', (ev) => {
    document.dispatchEvent(createPopupEvent({
        title: ev.detail.message,
        text: '',
        img: '/local/templates/stereozona/include/images/success.png',
    }));
});

document.addEventListener('favourites:add-success', (ev) => {
    document.dispatchEvent(createPopupEvent({
        title: ev.detail.message,
        text: '',
        img: '/local/templates/stereozona/include/images/success.png',
    }));
});

document.addEventListener('favourites:add-error', (ev) => {
    document.dispatchEvent(createPopupEvent({
        title: `Ошибка добавления в избранное`,
        text: ev.detail.message,
        img: '/local/templates/stereozona/include/images/error.png',
    }));
});

document.addEventListener('favourites:del-success', (ev) => {
    document.dispatchEvent(createPopupEvent({
        title: ev.detail.message,
        text: '',
        img: '/local/templates/stereozona/include/images/success.png',
    }));
});

document.addEventListener('iblock-form:register-success', (ev) => {
    if(ev.detail.data && ev.detail.data.subscription) {
        let success = ev.detail.data.subscription.success;
        let message = !success ? ev.detail.data.subscription.errors.join("\n") : ev.detail.data.subscription.message;

        document.dispatchEvent(createPopupEvent({
            title: `Вы ${!success ? 'не' : ''}подписаны на рассылку`,
            text: message,
            img: `/local/templates/stereozona/include/images/${success ? 'success' : 'error'}.png`,
        }));
    }
});

document.addEventListener('favourites:del-error', (ev) => {
    document.dispatchEvent(createPopupEvent({
        title: `Ошибка удаления из избранного`,
        text: ev.detail.message,
        img: '/local/templates/stereozona/include/images/error.png',
    }));
});

document.addEventListener('iblock-form:auth-fail', (ev) => {
    document.dispatchEvent(createPopupEvent({
        title: ``,
        text: ev.detail.message,
        img: '/local/templates/stereozona/include/images/error.png',
    }));
});

document.addEventListener('iblock-form:register-fail', (ev) => {
    document.dispatchEvent(createPopupEvent({
        title: ``,
        text: ev.detail.message,
        img: '/local/templates/stereozona/include/images/error.png',
    }));
});

document.addEventListener('city: identified-success', (ev) => {
    document.dispatchEvent(createPopupEvent({
        title: `Ваш город`,
        text: ev.detail.message,
        img: '/local/templates/stereozona/include/images/success.png',
    }));
});

document.addEventListener('city: identified-error', (ev) => {
    document.dispatchEvent(createPopupEvent({
        title: `Ошибка определения города`,
        text: '',
        img: '/local/templates/stereozona/include/images/error.png',
    }));
});

document.addEventListener('sale-profile: error', (ev) => {
    document.dispatchEvent(createPopupEvent({
        title: `Ошибка сохранения профиля`,
        text: ev.detail.message,
        img: '/local/templates/stereozona/include/images/error.png',
    }));
});

document.addEventListener('profile-form:save-success', (ev) => {
    document.dispatchEvent(createPopupEvent({
        title: `Данные сохранены успешно`,
        text: '',
        img: '/local/templates/stereozona/include/images/success.png',
    }));
});

document.addEventListener('profile-form:save-fail', (ev) => {
    document.dispatchEvent(createPopupEvent({
        title: `Ошибка обновления данных`,
        text: ev.detail.message,
        img: '/local/templates/stereozona/include/images/error.png',
    }));
});

document.addEventListener('soa:failed-location-response', (ev) => {
    document.dispatchEvent(createPopupEvent({
        title: ev.detail.response.message,
        text: ev.detail.suggestion_data.value,
        img: '/local/templates/stereozona/include/images/error.png',
    }));
});
