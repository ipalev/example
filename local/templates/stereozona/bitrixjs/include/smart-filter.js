"use strict";

import Utils from '../include/utils';

export default function JCSmartFilter(ajaxURL, viewMode) {
    this.ajaxURL = ajaxURL;
    this.form = document.querySelector('.modal .modal__filters');
    this.timer = null;
    this.cacheKey = '';
    this.cache = [];
    this.viewMode = viewMode;
    this.modef = BX('modef');
    this.panelBtns = document.querySelectorAll('.set_filter');

    this.init();
}

JCSmartFilter.controlsInited = false;

JCSmartFilter.prototype.init = function (input) {
    if (!JCSmartFilter.controlsInited) {

        $(document).on('click', '.set_filter', function (ev) {
            if (!!this.dataset.link.length) {
                let reloadEv = new CustomEvent('pageToLoadUrl', {
                    detail: {
                        url: this.dataset.link,
                    }
                });
                document.dispatchEvent(reloadEv);
            } else {
                window.modal.closeActiveModals();
            }
        });

        JCSmartFilter.controlsInited = true;
    }
};

JCSmartFilter.prototype.keyup = function (input, instantReload = false) {
    instantReload = !!instantReload;
    if (!!this.timer) {
        clearTimeout(this.timer);
    }

    this.timer = setTimeout(BX.delegate(function () {
        this.reload(input, instantReload);
    }, this), 500);
};

JCSmartFilter.prototype.click = function (checkbox, instantReload = false) {
    instantReload = !!instantReload;
    if (!!this.timer) {
        clearTimeout(this.timer);
    }

    this.timer = setTimeout(BX.delegate(function () {
        this.reload(checkbox, instantReload);
    }, this), 500);

};

JCSmartFilter.prototype.reload = function (input, instantPageReload = false) {

    if (this.cacheKey !== '') {
        //Postprone backend query
        if (!!this.timer) {
            clearTimeout(this.timer);
        }
        this.timer = setTimeout(BX.delegate(function () {
            this.reload(input);
        }, this), 1000);
        return;
    }
    this.cacheKey = '|';

    if (this.form) {
        var values = [];
        values[0] = {name: 'ajax', value: 'y'};

        this.gatherInputsValues(values, BX.findChildren(this.form, {'tag': new RegExp('^(input|select)$', 'i')}, true));

        for (var i = 0; i < values.length; i++) this.cacheKey += values[i].name + ':' + values[i].value + '|';

        let curFilterinput = {
            el: input
        };

        let startEv = new Event('Event');
        startEv.initEvent('onFilterRequestStarted');
        document.dispatchEvent(startEv);

        if (this.cache[this.cacheKey]) {
            this.postHandler(this.cache[this.cacheKey], true, instantPageReload, curFilterinput);
        } else {
            BX.ajax.loadJSON(
                this.ajaxURL,
                this.values2post(values),
                BX.delegate(function (response) {
                    this.postHandler(response, false, instantPageReload, curFilterinput);
                }, this)
            );
        }
    }
};

JCSmartFilter.prototype.postHandler = function (result, fromCache, instantReload, initiator) {
    var modef_num = BX('modef_num');
    if (!!result && !!result.ITEMS) {
        let checkboxNum = {};
        let ranges = {};

        for (var PID in result.ITEMS) {
            if (result.ITEMS.hasOwnProperty(PID)) {
                for (var i in result.ITEMS[PID].VALUES) {
                    if (result.ITEMS[PID].VALUES.hasOwnProperty(i)) {
                        let val = result.ITEMS[PID].VALUES[i];

                        if (typeof val.ELEMENT_COUNT !== 'undefined')
                            checkboxNum[val.CONTROL_ID] = val.ELEMENT_COUNT;

                        if(i === 'MAX' || i === 'MIN') {
                            ranges[val.CONTROL_ID] = !!val.FILTERED_VALUE ? val.FILTERED_VALUE : val.VALUE;
                        }
                    }
                }
            }
        }

        if (!!this.modef) {
            if (initiator) {
                let completeEv = new CustomEvent('onFilterRequestCompleted', {
                    detail: {
                        foundCount: result.ELEMENT_COUNT,
                        btnText: result.ELEMENT_COUNT + ' ' + Utils.Declension(result.ELEMENT_COUNT, 'товар', 'товара', 'товаров'),
                        resultsUrl: BX.util.htmlspecialcharsback(result.FILTER_URL),
                        instantReload: instantReload,
                        dataset: initiator.el.dataset,
                        checkboxNum: checkboxNum,
                        ranges: Object.values(ranges).length ? ranges : null
                    }
                });
                document.dispatchEvent(completeEv);
            }
        }
    }

    if (!fromCache && this.cacheKey !== '') {
        this.cache[this.cacheKey] = result;
    }
    this.cacheKey = '';
};

JCSmartFilter.prototype.gatherInputsValues = function (values, elements) {
    if (elements) {
        for (var i = 0; i < elements.length; i++) {
            var el = elements[i];
            if (el.disabled || !el.type)
                continue;
            switch (el.type.toLowerCase()) {
                case 'text':
                case 'number':
                case 'textarea':
                case 'password':
                case 'hidden':
                case 'select-one':
                    if (el.value.length) {
                        values[values.length] = {name: el.name, value: el.value};
                    }
                    break;
                case 'radio':
                case 'checkbox':
                    if (el.checked) {
                        values[values.length] = {name: el.name, value: el.value};
                    }
                    break;
                case 'select-multiple':
                    for (var j = 0; j < el.options.length; j++) {
                        if (el.options[j].selected)
                            values[values.length] = {name: el.name, value: el.options[j].value};
                    }
                    break;
                default:
                    break;
            }
        }
    }
};

JCSmartFilter.prototype.values2post = function (values) {
    var post = [];
    var current = post;
    var i = 0;

    while (i < values.length) {
        var p = values[i].name.indexOf('[');
        if (p == -1) {
            current[values[i].name] = values[i].value;
            current = post;
            i++;
        } else {
            var name = values[i].name.substring(0, p);
            var rest = values[i].name.substring(p + 1);
            if (!current[name])
                current[name] = [];

            var pp = rest.indexOf(']');
            if (pp == -1) {
                current = post;
                i++;
            } else if (pp == 0) {
                current = current[name];
                values[i].name = '' + current.length;
            } else {
                current = current[name];
                values[i].name = rest.substring(0, pp) + rest.substring(pp + 1);
            }
        }
    }
    return post;
};
