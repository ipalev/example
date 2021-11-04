"use strict";

export default class BasketPoolQuantity {

    constructor() {
        this.processing = false;
        this.poolQuantity = {};
        this.updateTimer = null;
        this.currentQuantity = {};
        this.lastStableQuantities = {};
        var $this = this;

        if (window.frameCacheVars !== undefined) {
            BX.addCustomEvent("onFrameDataReceived" , function() {
                $this.updateQuantity();
            });
        } else {
            this.updateQuantity();
        }
    }

    updateQuantity () {
        const items = BX('basket_items');

        if (items) {
            const rows = items.querySelectorAll('.cart-item');

            if (rows.length > 0) {
                rows.forEach(i => {
                    this.currentQuantity[i.dataset.cartId] = BX('QUANTITY_' + i.dataset.cartId).value;
                });
            }

            this.lastStableQuantities = BX.clone(this.currentQuantity, true);
        }
    }

    changeQuantity (config) {
        const quantity = BX('QUANTITY_' + config.basket_id).value;
        const isPoolEmpty = this.isPoolEmpty();

        if (this.currentQuantity[config.basket_id] && this.currentQuantity[config.basket_id] != quantity) {
            this.poolQuantity[config.basket_id] = this.currentQuantity[config.basket_id] = quantity;
        }

        if (!isPoolEmpty) {
            this.enableTimer(true, config);
        } else {
            this.trySendPool(config);
        }
    }

    trySendPool (config) {
        if (!this.isPoolEmpty() && !this.isProcessing()) {
            this.enableTimer(false);
            Basket.recalcBasketAjax({counter: true, extEventData: config});
        }
    }

    isPoolEmpty () {
        return Object.keys(this.poolQuantity).length === 0;
    };

    clearPool () {
        this.poolQuantity = {};
    };

    isProcessing () {
        return (this.processing === true);
    };

    setProcessing (value) {
        this.processing = (value === true);
    };

    enableTimer (value, config = false) {
        clearTimeout(this.updateTimer);
        if (value === false)
            return;

        this.updateTimer = setTimeout(() => {
            this.trySendPool(config);
        }, 1500);
    };
}
