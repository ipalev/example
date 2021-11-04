"use strict";

import SendForm from "./iblock-form";

export default class RegisterForm extends SendForm {
    success(response) {
        response = JSON.parse(response);
        let ev;

        let detail = {
            message: response.message,
            form: this.form,
            data: response.data ? response.data : {}
        };

        if (response.success) {
            ev = new CustomEvent('iblock-form:register-success', {
                detail: detail,
                bubbles: true
            });
        } else {
            ev = new CustomEvent('iblock-form:register-fail', {
                detail: detail,
                bubbles: true
            });
        }

        document.dispatchEvent(ev);

        if (typeof response.data === 'object' && !!response.data.refresh_recaptcha) eval(response.data.refresh_recaptcha);
    }
}
