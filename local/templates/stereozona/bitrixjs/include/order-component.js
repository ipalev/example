import Utils from "./utils";

BX.namespace('BX.Sale.OrderAjaxComponent');

(function() {
	'use strict';

	/**
	 * Show empty default property value to multiple properties without default values
	 */
	if (BX.Sale && BX.Sale.Input && BX.Sale.Input.Utils)
	{
		BX.Sale.Input.Utils.asMultiple = function (value)
		{
			if (value === undefined || value === null || value === '')
			{
				return [];
			}
			else if (value.constructor === Array)
			{
				var i = 0, length = value.length, val;

				for (; i < length;)
				{
					val = value[i];

					if (val === undefined || val === null || val === '')
					{
						value.splice(i, 1);
						--length;
					}
					else
					{
						++i;
					}
				}

				return value.length ? value : [''];
			}
			else
			{
				return [value];
			}
		};
	}

	BX.Sale.OrderAjaxComponent = {

		initializePrimaryFields: function()
		{
			this.BXFormPosting = false;
			this.regionBlockNotEmpty = false;
			this.locations = {};
			this.cleanLocations = {};
			this.locationsTemplate = '';
			this.options = {};
			this.activeSectionId = '';
			this.firstLoad = true;
			this.mapsReady = false;
			this.lastSelectedDelivery = 0;
			this.deliveryPagination = {};
			this.paySystemPagination = {};
			this.validation = {};
			this.hasErrorSection = {};
			this.pickUpPagination = {};
			this.timeOut = {};
			this.isMobile = BX.browser.IsMobile();
			this.isHttps = window.location.protocol === "https:";
			this.orderSaveAllowed = true;
			this.socServiceHiddenNode = false;
		},

		/**
		 * Initialization of sale.order.ajax component js
		 */
		init: function(parameters)
		{
			this.initializePrimaryFields();

			this.result = parameters.result || {};
			this.params = parameters.params || {};
			this.signedParamsString = parameters.signedParamsString || '';
			this.siteId = parameters.siteID || '';
			this.ajaxUrl = parameters.ajaxUrl || '';
			this.templateFolder = parameters.templateFolder || '';
			this.defaultBasketItemLogo = this.templateFolder + "/images/product_logo.png";
			this.defaultStoreLogo = this.templateFolder + "/images/pickup_logo.png";
			this.defaultDeliveryLogo = this.templateFolder + "/images/delivery_logo.png";
			this.defaultPaySystemLogo = this.templateFolder + "/images/pay_system_logo.png";

			this.totalBlockNode = BX(parameters.totalBlockId);
			this.mobileTotalBlockNode = BX(parameters.totalBlockId + '-mobile');
			this.orderSaveBlockNode = BX('bx-soa-orderSave');
			this.mainErrorsNode = BX('bx-soa-main-notifications');
			this.mainRows = BX('bx-soa-rows');
			this.deliveryRows = BX('bx-soa-delivery-rows');

			this.orderBlockNode = BX(parameters.orderBlockId);
			this.authBlockNode = BX(parameters.authBlockId);
			this.authHiddenBlockNode = BX(parameters.authBlockId + '-hidden');
			this.basketBlockNode = BX(parameters.basketBlockId);
			this.basketHiddenBlockNode = BX(parameters.basketBlockId + '-hidden');
			this.regionBlockNode = BX(parameters.regionBlockId);
			this.regionHiddenBlockNode = BX(parameters.regionBlockId + '-hidden');
			this.paySystemBlockNode = BX(parameters.paySystemBlockId);
			this.paySystemHiddenBlockNode = BX(parameters.paySystemBlockId + '-hidden');
			this.deliveryBlockNode = BX(parameters.deliveryBlockId);
			this.deliveryHiddenBlockNode = BX(parameters.deliveryBlockId + '-hidden');
			this.pickUpBlockNode = BX(parameters.pickUpBlockId);
			this.pickUpHiddenBlockNode = BX(parameters.pickUpBlockId + '-hidden');
			this.propsBlockNode = BX(parameters.propsBlockId);
			this.propsHiddenBlockNode = BX(parameters.propsBlockId + '-hidden');

			this.orderSubmitButtons = document.querySelectorAll('.js-order-submit-btn');
			this.suggestionsToken = parameters.suggestionsToken;

			if (this.result.SHOW_AUTH)
			{
				this.authBlockNode.style.display = '';
				BX.addClass(this.authBlockNode, 'bx-active');
				this.authGenerateUser = this.result.AUTH.new_user_registration_email_confirmation !== 'Y' && this.result.AUTH.new_user_phone_required !== 'Y';
			}

			if (this.totalBlockNode)
			{
				this.totalInfoBlockNode = this.totalBlockNode.querySelector('.bx-soa-cart-total');
			}

			let locationField = document.querySelector('#ORDER_LOCATION');
			if(locationField) {
				locationField.addEventListener('change', Utils.debounce(event => {
					this.sendRequest();
				}, 700));
			}

			this.options.totalPriceChanged = false;

			this.editOrder();

			if (this.params.USER_CONSENT === 'Y')
			{
				this.initUserConsent();
			}

			document.dispatchEvent(new CustomEvent('soa:component.inited', {detail:{component:this}}));
		},

		refreshOrder: function(result)
		{
			if (result.error) {
				this.showError(result.error);
			} else if (result.order.SHOW_AUTH) {
				BX.merge(this.result, result.order);

				this.showErrors(result.order.ERROR, false);
			} else {
				this.isPriceChanged(result);

				this.result = result.order;

				this.editOrder();
				BX.saleOrderAjax && BX.saleOrderAjax.initDeferredControl();
			}

			return true;
		},

		editOrder: function() {
			if (!this.orderBlockNode || !this.result) return;

			this.refreshDeliveries();
			this.editTotalBlock();
			this.showErrors(this.result.ERROR, false);
		},

		showError: function(msg) {
			if (BX.type.isArray(msg))
				msg = msg.join('<br>');

			if (!msg.length) return;

			document.dispatchEvent(new CustomEvent('soa:component.error', {detail: {
				message: msg
			}}));
		},

		showErrors: function(errors, showAll)
		{
			if (!errors || BX.util.object_keys(errors).length < 1)
				return;

			for (let k in errors) {
				if (!errors.hasOwnProperty(k)) continue;

				let blockErrors = errors[k];
				switch (k.toUpperCase()) {
					case 'MAIN':
						this.showError(blockErrors);

						break;
					case 'AUTH':
						if (this.authBlockNode && this.authBlockNode.style.display === 'none') {
							this.showError(blockErrors);
						}
						else
							this.showError(blockErrors);
						break;
					case 'REGION':
						if (showAll || this.regionBlockNode.getAttribute('data-visited') === 'true')
						{
							this.showError(blockErrors);
							this.showError(blockErrors);
						}
						break;
					case 'DELIVERY':
						if (showAll || this.deliveryBlockNode.getAttribute('data-visited') === 'true')
						{
							this.showError(blockErrors);
							this.showError(blockErrors);
						}
						break;
					case 'PAY_SYSTEM':
						if (showAll || this.paySystemBlockNode.getAttribute('data-visited') === 'true')
						{
							this.showError(blockErrors);
							this.showError(blockErrors);
						}
						break;
					case 'PROPERTY':
						if (showAll || this.propsBlockNode.getAttribute('data-visited') === 'true')
						{
							this.showError(blockErrors);
							this.showError(blockErrors);
						}
						break;
				}
			}
		},

		/**
		 * Send ajax request with order data and executes callback by action
		 */
		sendRequest: function(action, actionData)
		{
			let form;
			this.firstLoad = false;

			action = BX.type.isNotEmptyString(action) ? action : 'refreshOrderAjax';
			this.disableSubmitButtons();

			if (action === 'saveOrderAjax')
			{
				form = BX('bx-soa-order-form');
				if (form)
				{
					form.querySelector('input[type=hidden][name=sessid]').value = BX.bitrix_sessid();
				}

				BX.ajax.submitAjax(
					BX('bx-soa-order-form'),
					{
						url: this.ajaxUrl,
						method: 'POST',
						dataType: 'json',
						data: {
							via_ajax: 'Y',
							action: 'saveOrderAjax',
							sessid: BX.bitrix_sessid(),
							SITE_ID: this.siteId,
							signedParamsString: this.signedParamsString
						},
						onsuccess: BX.proxy(this.saveOrderWithJson, this),
						onfailure: BX.proxy(this.handleNotRedirected, this)
					}
				);
			}
			else
			{
				BX.ajax({
					method: 'POST',
					dataType: 'json',
					url: this.ajaxUrl,
					data: this.getData(action, actionData),
					onsuccess: BX.delegate(function(result) {
						if (result.redirect && result.redirect.length)
							document.location.href = result.redirect;

						switch (action)
						{
							case 'refreshOrderAjax':
								this.refreshOrder(result);
								break;
							case 'confirmSmsCode':
							case 'showAuthForm':
								this.firstLoad = true;
								this.refreshOrder(result);
								break;
						}

						this.enableSubmitButtons();

					}, this),

					onfailure: BX.delegate(function(){
						this.enableSubmitButtons();
					}, this)
				});
			}
		},

		saveOrderWithJson: function(result)
		{

			this.enableSubmitButtons();
			if (result && result.order)
			{
				result = result.order;

				if(result.ID){
					this.disallowOrderSave();

					document.dispatchEvent(new CustomEvent('soa:component.order-saved', {
						detail: {
							id: result.ID,
							params: this.params
						}
					}));
				}


				if (result.SHOW_AUTH) {
					this.result.SHOW_AUTH = result.SHOW_AUTH;
					this.result.AUTH = result.AUTH;
					this.result.SMS_AUTH = result.SMS_AUTH;

				} else {
					this.showErrors(result.ERROR, true, true);
				}
			}
		},

		getData: function(action, actionData)
		{
			var data = {
				order: this.getAllFormData(),
				sessid: BX.bitrix_sessid(),
				via_ajax: 'Y',
				SITE_ID: this.siteId,
				signedParamsString: this.signedParamsString
			};

			data[this.params.ACTION_VARIABLE] = action;

			return data;
		},

		getAllFormData: function()
		{
			var form = BX('bx-soa-order-form'),
				prepared = BX.ajax.prepareForm(form),
				i;

			for (i in prepared.data)
			{
				if (prepared.data.hasOwnProperty(i) && i == '')
				{
					delete prepared.data[i];
				}
			}

			return !!prepared && prepared.data ? prepared.data : {};
		},

		doSaveAction: function()
		{
			if (this.isOrderSaveAllowed()) {
				this.sendRequest('saveOrderAjax');
			}
		},

		activatePhoneAuth: function()
		{
			if (!this.result.SMS_AUTH)
				return;

			new BX.PhoneAuth({
				containerId: 'bx_register_resend',
				errorContainerId: 'bx_register_error',
				interval: 60,
				data: {
					signedData: this.result.SMS_AUTH.SIGNED_DATA
				},
				onError: function(response)
				{
					var errorDiv = BX('bx_register_error');
					var errorNode = BX.findChildByClassName(errorDiv, 'errortext');
					errorNode.innerHTML = '';

					for (var i = 0; i < response.errors.length; i++)
					{
						errorNode.innerHTML = errorNode.innerHTML + BX.util.htmlspecialchars(response.errors[i].message) + '<br>';
					}

					errorDiv.style.display = '';
				}
			});
		},

		popupShow: function(e, url, source)
		{
			if (this.popup)
				this.popup.destroy();

			var that = this;
			this.popup = new BX.PopupWindow('bx-soa-image-popup', null, {
				lightShadow: true,
				offsetTop: 0,
				offsetLeft: 0,
				closeIcon: {top: '3px', right: '10px'},
				autoHide: true,
				bindOptions: {position: "bottom"},
				closeByEsc: true,
				zIndex: 100,
				events: {
					onPopupShow: function() {
						BX.create("IMG", {
							props: {src: source || url},
							events: {
								load: function() {
									var content = BX('bx-soa-image-popup-content');
									if (content)
									{
										var windowSize = BX.GetWindowInnerSize(),
											ratio = this.isMobile ? 0.5 : 0.9,
											contentHeight, contentWidth;

										BX.cleanNode(content);
										content.appendChild(this);

										contentHeight = content.offsetHeight;
										contentWidth = content.offsetWidth;

										if (contentHeight > windowSize.innerHeight * ratio)
										{
											content.style.height = windowSize.innerHeight * ratio + 'px';
											content.style.width = contentWidth * (windowSize.innerHeight * ratio / contentHeight) + 'px';
											contentHeight = content.offsetHeight;
											contentWidth = content.offsetWidth;
										}

										if (contentWidth > windowSize.innerWidth * ratio)
										{
											content.style.width = windowSize.innerWidth * ratio + 'px';
											content.style.height = contentHeight * (windowSize.innerWidth * ratio / contentWidth) + 'px';
										}

										content.style.height = content.offsetHeight + 'px';
										content.style.width = content.offsetWidth + 'px';

										that.popup.adjustPosition();
									}
								}
							}
						});
					},
					onPopupClose: function() {
						this.destroy();
					}
				},
				content: BX.create('DIV', {
					props: {id: 'bx-soa-image-popup-content'},
					children: [BX.create('IMG', {props: {src: this.templateFolder + "/images/loader.gif"}})]
				})
			});
			this.popup.show();
		},

		getCouponsList: function(active)
		{
			let couponsList = [], i;

			for (i = 0; i < this.result.COUPON_LIST.length; i++)
			{
				if (active || (!active && this.result.COUPON_LIST[i].JS_STATUS === 'APPLIED'))
				{
					couponsList.push(this.getCouponNode({
						text: this.result.COUPON_LIST[i].COUPON,
						desc: this.result.COUPON_LIST[i].JS_CHECK_CODE,
						status: this.result.COUPON_LIST[i].JS_STATUS
					}, active));
				}
			}

			return couponsList;
		},

		editTotalBlock: function()
		{
			if (!this.totalInfoBlockNode || !this.result.TOTAL) return;

			var total = this.result.TOTAL,
				priceHtml,
				params = {},
				discText,
				valFormatted,
				i,
				curDelivery,
				deliveryError,
				deliveryValueRaw,
				deliveryValue,
				showOrderButton = this.params.SHOW_TOTAL_ORDER_BUTTON === 'Y';

			let currentPaySystem = this.result.PAY_SYSTEM ? this.result.PAY_SYSTEM.filter(paySystem => {
				return paySystem.CHECKED === 'Y';
			}) : [];

			currentPaySystem = currentPaySystem.length > 0 ? currentPaySystem[0] : null;
			let submitButtonText = BX.message('ORDER_DEFAULT');

			if(currentPaySystem && currentPaySystem.IS_CASH !== 'Y') {
				submitButtonText = BX.message('SOA_PAY_NOW_BTN');
			}

			this.orderSubmitButtons.forEach(btn => {
				btn.innerText = submitButtonText;
			});


			let totalPrices = {
				/* сумма заказа со скидками НО БЕЗ ДОСТАВКИ */
				orderDiscounted: {
					formatted: total.ORDER_PRICE_FORMATED,
					raw: total.ORDER_PRICE,
				},
				/* сумма заказа без скидок И БЕЗ ДОСТАВКИ */
				order: {
					formatted: total.PRICE_WITHOUT_DISCOUNT,
					raw: total.PRICE_WITHOUT_DISCOUNT_VALUE,
				},
				/* стоимость доставки */
				delivery: {
					formatted: parseFloat(total.DELIVERY_PRICE) > 0 ? total.DELIVERY_PRICE_FORMATED : BX.message('PRICE_FREE_DEFAULT'),
					raw: total.DELIVERY_PRICE,
				},
				/* скидка на доставку */
				deliveryDiscount: {
					formatted: '',
					raw: 0,
				},
				/* величина скидки заказа */
				discount: {
					formatted: total.DISCOUNT_PRICE_FORMATED,
					raw: total.DISCOUNT_PRICE,
				},
				/* цена заказа СО СКИДКАМИ И ДОСТАВКОЙ */
				orderDiscountedDelivered: {
					formatted: total.ORDER_TOTAL_PRICE_FORMATED,
					raw: total.ORDER_TOTAL_PRICE,
				}
			};

			params = {};
			curDelivery = this.getSelectedDelivery();
			deliveryError = curDelivery && curDelivery.CALCULATE_ERRORS && curDelivery.CALCULATE_ERRORS.length;

			if (deliveryError)
			{
				deliveryValueRaw = 0;
				deliveryValue = BX.message('SOA_NOT_CALCULATED');
				params.error = deliveryError;

				totalPrices.delivery.raw = deliveryValueRaw;
				totalPrices.delivery.formatted = deliveryValue;
			}
			else
			{
				if (
					curDelivery && typeof curDelivery.DELIVERY_DISCOUNT_PRICE !== 'undefined'
					&& parseFloat(curDelivery.PRICE) > parseFloat(curDelivery.DELIVERY_DISCOUNT_PRICE)
				)
				{
					totalPrices.deliveryDiscount.raw = parseFloat(curDelivery.DELIVERY_DISCOUNT_PRICE);
					totalPrices.deliveryDiscount.formatted = curDelivery.DELIVERY_DISCOUNT_PRICE_FORMATED;
				}
			}

			for (i in this.result.DELIVERY) {
				if (this.result.DELIVERY[i].CHECKED) {
					totalPrices.deliveryHint = this.result.DELIVERY[i].DELIVERY_HINT;
				}
			}

			document.dispatchEvent(new CustomEvent('soa:component.total-update', {
				detail: totalPrices
			}));
		},

		getSelectedDelivery: function()
		{
			var deliveryCheckbox = this.deliveryBlockNode.querySelector('input[type=checkbox][name=DELIVERY_ID]:checked'),
				currentDelivery = false,
				deliveryId, i;

			if (deliveryCheckbox)
			{
				deliveryId = deliveryCheckbox.value;

				for (i in this.result.DELIVERY)
				{
					if (this.result.DELIVERY[i].ID === deliveryId)
					{
						currentDelivery = this.result.DELIVERY[i];
						break;
					}
				}
			}

			return currentDelivery;
		},

		refreshDeliveries() {
			if(!window.deliveryTemplate) {
				return;
			}

			this.deliveryRows.innerHTML = '';

			for (let i in this.result.DELIVERY)
			{
				if(this.result.DELIVERY.hasOwnProperty(i)) {
					let delivery = this.result.DELIVERY[i];
					let cost = delivery.hasOwnProperty('PRICE') && delivery.PRICE > 0 ? delivery.PRICE : null;
					let costText = cost ? delivery.PRICE_FORMATED : BX.message('PRICE_FREE_DEFAULT');
					let hintPosition = delivery.DESCRIPTION.indexOf('##HINT##');
					delivery.DELIVERY_HINT = '';
					if (hintPosition > 0) {
						delivery.DELIVERY_HINT = delivery.DESCRIPTION.substring(hintPosition+8);
						delivery.DESCRIPTION = delivery.DESCRIPTION.substring(0,hintPosition);
					}

					let html = Utils.replaceArrays(
						window.deliveryTemplate,
						['{checked}', '{id}', '{name}', '{description}', '{cost}'],
						[
							delivery.CHECKED === 'Y' ? 'checked="checked"' : '',
							delivery.ID,
							delivery.NAME,
							delivery.DESCRIPTION,
							costText
						]
					);

					this.deliveryRows.insertAdjacentHTML('beforeend', html);
				}
			}
		},

		isOrderSaveAllowed: function()
		{
			return this.orderSaveAllowed === true;
		},

		allowOrderSave: function()
		{
			this.orderSaveAllowed = true;
		},

		disallowOrderSave: function()
		{
			this.orderSaveAllowed = false;
			this.orderSubmitButtons.forEach(btn => {
				btn.parentNode.removeChild(btn);
			});
		},

		handleNotRedirected: function()
		{
			this.enableSubmitButtons();
		},

		isPriceChanged: function(result)
		{
			let priceBefore = this.result.TOTAL.ORDER_TOTAL_LEFT_TO_PAY === null || this.result.TOTAL.ORDER_TOTAL_LEFT_TO_PAY === ''
				? this.result.TOTAL.ORDER_TOTAL_PRICE
				: this.result.TOTAL.ORDER_TOTAL_LEFT_TO_PAY,
				priceAfter = result.order.TOTAL.ORDER_TOTAL_LEFT_TO_PAY === null ? result.order.TOTAL.ORDER_TOTAL_PRICE : result.order.TOTAL.ORDER_TOTAL_LEFT_TO_PAY;

			this.options.totalPriceChanged = parseFloat(priceBefore) != parseFloat(priceAfter);
		},

		initUserConsent: function()
		{
			BX.ready(BX.delegate(function(){
				var control = BX.UserConsent && BX.UserConsent.load(this.orderBlockNode);
				if (control)
				{
					BX.addCustomEvent(control, BX.UserConsent.events.save, BX.proxy(this.doSaveAction, this));
					BX.addCustomEvent(control, BX.UserConsent.events.refused, BX.proxy(this.disallowOrderSave, this));
				}
			}, this));
		},

		enableSubmitButtons() {
			this.orderSubmitButtons.forEach(btn => {
				btn.disabled = false;
			});
		},

		disableSubmitButtons() {
			this.orderSubmitButtons.forEach(btn => {
				btn.disabled = true;
			});
		}
	};
})();