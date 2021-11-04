"use strict";

export default class SendForm {
    constructor(form) {
        this.initForm(form);

        this.fd = this.getFormData(form);
        this.sendData(this.fd);
    }

    initForm(form) {
        this.form = form;
    }

    success(response) {
        response = JSON.parse(response);
        let ev;
        if (response.success) {
            ev = new CustomEvent('onSuccessFormSubmit', {
                detail: { message: response.message, form: this.form },
                bubbles: true
            });
            this.clearForm(this.form);
        } else {
            ev = new CustomEvent('onErrorFormSubmit', {
                detail: { message: response.error, form: this.form },
                bubbles: true
            });
        }
        this.form.dispatchEvent(ev);
        if (typeof response.data === 'object' && !!response.data.refresh_recaptcha) eval(response.data.refresh_recaptcha);
    }

    sendData(fd) {

        // if( !window.checkFormValidity(this.form) ) return false; //frontend api

        BX.ajax({
            url: fd.form.attributes.action.value,
            method: fd.form.attributes.method.value,
            // dataType: "json",
            processData: false,
            data: fd.data,
            preparePost: false,
            onsuccess: this.success.bind(this),
            onfailure: function () {
                console.log('Internal Server Error');
            }
        });

    };

    /**
     *
     * @param form - form
     * @param ffi - file fake inputs (for order form)
     * @returns {{data: FormData, files: boolean, form: object, successMsg: string, errorMsg: string}}
     */
    getFormData(form, ffi) {
        ffi = !!ffi;

        let fd = new FormData(form);
        let isFormWithFile = !!form.querySelector('input[type="file"]');

        if (isFormWithFile && typeof validatedFiles === 'object') {
            let fileInput = form.querySelector('input[type="file"]');
            let files = validatedFiles;

            let mainName = this.checkMultiFileName(fileInput.name) ? fileInput.name : fileInput.name + '[]';
            let iterableName = this.checkMultiFileName(fileInput.name) ? fileInput.name.substring(0, fileInput.name.length - 2) : fileInput.name;

            for (let i = 0; i < files.length; i++) {
                fd.append(mainName, files[i]);
                if (ffi) fd.append(iterableName + '[' + i + '][ID]', '');
            }
        }

        return {
            files: isFormWithFile,
            form: form,
            data: fd
        };
    };

    checkMultiFileName(name) {
        return name.indexOf('[]') !== -1 && name.indexOf('[]') === (name.length - 2);
    };

    clearForm(form) {
        [
            'textarea',
            'input[type="text"]',
            'input[type="password"]',
            'input[type="tel"]',
            'input[type="email"]',
            'input[type="file"]',
            'input[type="checkbox"]',
            'input[type="radio"]',
        ].forEach(type => {
            Array.from(form.querySelectorAll(type)).forEach(el => {
                switch (el.type) {
                    case 'checkbox':
                    case 'radio':
                        el.checked = false;
                        break;
                    default:
                        el.value = '';
                        el.dispatchEvent((new CustomEvent('keyup', { bubbles: true })));
                        break;
                }
            });
        });
    };
}
