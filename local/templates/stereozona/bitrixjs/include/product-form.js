"use strict";

import SendForm from "./iblock-form";

export default class ProductForm extends SendForm {
    initForm(form) {
        super.initForm(form);

        let productField = this.form.querySelector('[data-product-id-field]');
        let productPage = document.querySelector('[data-product-page]');

        if(productPage && productField) {
            productField.value = productPage.dataset.productId;
        }
    }
}
