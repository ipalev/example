"use strict";

import SendForm from "./iblock-form";

export default class AuthForm extends SendForm {
    success(response) {
        response = JSON.parse(response);
        let ev;

        if (response.success) {
            ev = new CustomEvent('iblock-form:auth-success', {
                detail: { message: response.message, form: this.form },
                bubbles: true
            });
            this.clearForm(this.form);
        } else {
            ev = new CustomEvent('iblock-form:auth-fail', {
                detail: { message: response.message, form: this.form },
                bubbles: true
            });

        }

        document.dispatchEvent(ev);

        if (typeof response.data === 'object' && !!response.data.refresh_recaptcha) eval(response.data.refresh_recaptcha);
    }
}
