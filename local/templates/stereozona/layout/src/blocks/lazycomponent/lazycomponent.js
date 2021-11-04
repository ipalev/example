const addLazyComponentContact = function() {

    if ($('#modalContacts').length > 0) {
        $.fancybox.open({
            src  : '#modalContacts',
            type : 'inline',
            opts : {
                animationEffect: false,
                touch: false,
                modal: false,
                baseClass: 'fancybox--modal-contacts',
            }
        });
        return;
    }

    if (document.loadContactsBlockRun === true) {
        return;
    }

    document.loadContactsBlockRun = true;

    const request = window.BX.ajax.runAction('its:lazycomponent.api.lazycomponent.addToBody', {
    });

    request.then(function (response) {
        // eslint-disable-next-line eqeqeq
        if (response.status === 'success') {
            let div = document.createElement('div');
            div.id = 'lazycomponent';
            div.innerHTML = response.data.html;
            document.body.append(div);
            var event = new CustomEvent('init-contact');
            document.dispatchEvent(event);
            $.fancybox.open({
                src  : '#modalContacts',
                type : 'inline',
                opts : {
                    animationEffect: false,
                    touch: false,
                    modal: false,
                    baseClass: 'fancybox--modal-contacts',
                }
            });

            window.dispatchEvent(new CustomEvent('contacts-component-loaded'));
        }
    });
};

/*
Search other comments as #task-355
const addLazyComponentCitySearch = function() {
    const request = window.BX.ajax.runAction('its:lazycomponent.api.lazycomponent.citySearch', {
    });

    request.then(function (response) {
        // eslint-disable-next-line eqeqeq
        if (response.status === 'success') {
            let div = document.createElement('div');
            let citySearchWrap = document.getElementById('city-search-wrap-lazy');
            div.id = 'lazycomponent-citySearch';
            div.innerHTML = response.data.html;
            citySearchWrap.append(div);
            BX.ajax.processRequestData(response.data.html, {
                'scriptsRunFirst': false,
                'dataType': 'HTML'
            });
            var event = new CustomEvent('init-city-search');
            document.dispatchEvent(event);
        }
    });
};
*/

setTimeout(function () {
    /*
    Search other comments as #task-355
    addLazyComponentCitySearch();
    */

}, 5000);
