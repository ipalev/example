<?php

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Page\Asset;
use Bitrix\Main\Security\Sign\Signer;
use Its\Lib\Constant;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CAllMain $APPLICATION
 * @var CBitrixComponent $component
 * @var string $templateFolder
 * @var array $arParams
 * @var array $arResult
 */

$locationProperty = $arResult['RES_MOD']['ALL_PROPS']['LOCATION'];

if($locationProperty) {
    $locationPropertyValue = $arResult["USER_VALS"]["ORDER_PROP"][$locationProperty['ID']];

    Asset::getInstance()->addCss("https://cdn.jsdelivr.net/npm/suggestions-jquery@20.3.0/dist/css/suggestions.min.css");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH."/bitrixjs/suggestions.js");
    ?>
    <input type="hidden" name="ORDER_PROP_<?=$locationProperty['ID']?>" id="ORDER_LOCATION" value="<?=$locationPropertyValue?>">
<?php } ?>
<input type="hidden" name="BUYER_STORE" id="BUYER_STORE" value="<?=$arResult['BUYER_STORE']?>">
<input type="hidden" name="<?=$arParams['ACTION_VARIABLE']?>" value="saveOrderAjax">
<input type="hidden" name="location_type" value="code">
<input type="hidden" name="sessid" value="<?=bitrix_sessid()?>">
<input type="hidden" name="PERSON_TYPE" id="PERSON_TYPE" value="<?=current($arResult['PERSON_TYPE'])['ID']?>">


<div class="row" id="bx-soa-rows">
    <?php
    foreach($arResult['RES_MOD']['HIDDEN_PROPS'] as $property){
        printf(
            '<input type="hidden" name="ORDER_PROP_%s" value="%s" data-code="%s">',
            $property['ID'],
            $arResult["USER_VALS"]["ORDER_PROP"][$property['ID']],
            $property['CODE']
        );
    }

    foreach($arResult['RES_MOD']['PERSONAL_PROPS'] as $property){
        if ($property['CODE'] == 'MIDDLE_NAME') continue;
        $fieldName = $property['NAME'];
        if(strlen($property['DESCRIPTION'])) {
            $fieldName = $property['DESCRIPTION'];
        }

        $value = $arResult["USER_VALS"]["ORDER_PROP"][$property['ID']];
        $type = 'text';
        $addClasses = '';
        $addAttributes = '';

        if($property['IS_PHONE'] === 'Y') {
            $addClasses = 'js-mask-phone';
            $type = 'tel';
            $addAttributes = '';
        } elseif($property['IS_EMAIL'] === 'Y') {
            $addClasses = 'js-mask-email';
            $addAttributes = 'inputmode="email" data-inputmask="\'alias\': \'email\'"';
        }
        ?>
        <div class="col-md-6">
            <div class="form__item form-group">
                <input class="input form-control <?=$addClasses?>"
                       type="<?=$type?>"
                       placeholder="<?=$fieldName?>"
                       name="ORDER_PROP_<?=$property['ID']?>"
                       value="<?=$value?>"
                       data-code="<?=$property['CODE']?>"
                       <?=$addAttributes?>
                       <?=$property['IS_ADDRESS'] === 'Y' ? 'data-address="'.$property['CODE'].'"' : ''?>
                >
            </div>
        </div>
    <?}?>
</div>
<?php if(!empty($arResult['DELIVERY'])) {?>
    <div class="order__section" id="bx-soa-delivery">
        <h3 class="mb-25">Доставка</h3>
        <div class="row no-gutters" id="bx-soa-delivery-rows">
            <?php
            // browser side rendering

            /** @var string $deliveryTemplate */
            require('include/delivery.template.php');
            ?>
        </div>
        <script data-skip-moving="true">
            window.deliveryTemplate = '<?=str_replace("'", "\'", $deliveryTemplate)?>';
        </script>
    </div>
<?php }

if(!empty($arResult['PAY_SYSTEM'])) {?>
    <div class="order__section">
        <h3 class="mb-25">Оплата</h3>
        <div class="row no-gutters">
            <?php foreach($arResult['PAY_SYSTEM'] as $paymentSystem){?>
                <div class="col-md-3 px-0">
                    <div class="option">
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input"
                                   type="radio"
                                   name="PAY_SYSTEM_ID"
                                   id="PAY_SYSTEM_<?=$paymentSystem['ID']?>"
                                   onclick="BX.Sale.OrderAjaxComponent.sendRequest()"
                                   value="<?=$paymentSystem['ID']?>"
                            >
                            <label class="custom-control-label" for="PAY_SYSTEM_<?=$paymentSystem['ID']?>">
                                <span class="option__top">
                                    <span class="option__title"><?=$paymentSystem['PSA_NAME']?></span>
                                    <?php if(trim($paymentSystem['NAME']) != trim($paymentSystem['PSA_NAME'])) {
                                        printf('<span class="option__dscr">%s</span>', $paymentSystem['NAME']);
                                    }?>
                                </span>
                                <?php
                                $imgPaths = [];

                                if($paymentSystem['PSA_LOGOTIP']['SRC']) {
                                    $imgPaths[] = $paymentSystem['PSA_LOGOTIP']['SRC'];
                                } elseif (
                                    array_key_exists($paymentSystem['CODE'], $arResult['RES_MOD']['PS_DATA'])
                                    && ($images = $arResult['RES_MOD']['PS_DATA'][$paymentSystem['CODE']]['UF_IMAGE'])
                                ) {
                                    $imgPaths = array_map(function($img){return CFile::GetPath($img);}, $images);
                                    $imgPaths = array_filter($imgPaths);
                                }

                                if(!empty($imgPaths)) {?>
                                    <span class="option__bottom">
                                        <span class="d-flex flex-wrap">
                                            <?foreach ($imgPaths as $imgPath) {?>
                                                <span class="payment">
                                                    <?php
                                                    printf('<img src="%s" alt="%s">',
                                                        $imgPath,
                                                        $paymentSystem['PSA_NAME']
                                                    );

                                                    ?>
                                                </span>
                                            <?php }?>
                                        </span>
                                    </span>
                                <?php }?>
                            </label>
                        </div>
                    </div>
                </div>
            <?php }?>
        </div>
    </div>
<?php } else {?>
    <div class="order__section">
        <h5 class="mb-25">*С Вами свяжется менеджер для уточнения информации по заказу.</h5>
    </div>
<?php }

if($addInfo = $arResult['RES_MOD']['ALL_PROPS']['ADDITIONAL_INFO']) {?>
    <div class="order__section">
        <h3><?=$addInfo['NAME']?></h3>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group form__item mb-0">
                    <textarea class="input input--textarea form-control"
                              name="ORDER_PROP_<?=$addInfo['ID']?>"
                              placeholder="<?=$addInfo['DESCRIPTION']?>"
                    ></textarea>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<div class="order__section order__section--overall d-block d-md-none">
    <button
            class="btn btn-primary js-order-submit-btn"
            href="#"
            type="button"
            onclick="BX.Sale.OrderAjaxComponent.doSaveAction()"
            data-is-goal="click"
            data-base-goal-name="zakaz_send"
    >
        Оформить заказ
    </button>
    <p>Нажимая на кнопку «Перейти к оплате», даю согласие на отправку и обработку персональных данных</p>
</div>
<?
$signer = new Signer;
$signedParams = $signer->sign(base64_encode(serialize($arParams)), 'sale.order.ajax');
$messages = Loc::loadLanguageFile(__FILE__);
?>
<script>
    BX.message(<?=CUtil::PhpToJSObject($messages)?>);
    <?
    // spike: for children of cities we place this prompt
    $city = \Bitrix\Sale\Location\TypeTable::getList(array('filter' => array('=CODE' => 'CITY'), 'select' => array('ID')))->fetch();
    ?>
    BX.saleOrderAjax.init(<?=CUtil::PhpToJSObject(array(
        'source' => $component->getPath().'/get.php',
        'cityTypeId' => intval($city['ID'])
    ))?>);

    document.addEventListener('DOMContentLoaded', () => {
        document.dispatchEvent(new CustomEvent('soa:component.init', {detail: {
                result: <?=CUtil::PhpToJSObject($arResult['JS_DATA'])?>,
                locations: <?=CUtil::PhpToJSObject($arResult['LOCATIONS'])?>,
                params: <?=CUtil::PhpToJSObject($arParams)?>,
                signedParamsString: '<?=CUtil::JSEscape($signedParams)?>',
                siteID: '<?=CUtil::JSEscape($component->getSiteId())?>',
                ajaxUrl: '<?=CUtil::JSEscape($component->getPath().'/ajax.php')?>',
                templateFolder: '<?=CUtil::JSEscape($templateFolder)?>',
                propertyValidation: true,
                showWarnings: true,
                orderBlockId: 'bx-soa-order',
                authBlockId: 'bx-soa-auth',
                basketBlockId: 'bx-soa-basket',
                regionBlockId: 'bx-soa-region',
                paySystemBlockId: 'bx-soa-paysystem',
                deliveryBlockId: 'bx-soa-delivery',
                pickUpBlockId: 'bx-soa-pickup',
                propsBlockId: 'bx-soa-properties',
                totalBlockId: 'bx-soa-total',
                suggestionsToken: '<?=getenv('DADATA_API_KEY')?>'
            }
        }));
    });
</script>
<?php

$this->SetViewTarget('order: mobile'); ?>
    <div class="overall__mobile-overflow"></div>
    <div class="overall__mobile">
        <div class="overall__item overall__item--hidden overall__item--first">
            <p>Сумма</p>
            <p class="mb-0 font-weight-medium" id="js-order-sum-mobile">0</p>
        </div>
        <div class="overall__item overall__item--hidden">
            <p>Доставка
                <span class="tooltip tooltip--question">
                    <a class="tooltip__trigger"
                       href="#"
                       data-no-swup
                       data-container="body"
                       data-toggle="popover"
                       data-content=""
                    >
                    </a>
                </span>
            </p>
            <p class="mb-0 font-weight-medium" id="js-order-delivery-mobile">0</p>
        </div>
        <div class="overall__item overall__item--hidden">
            <p>Скидка</p>
            <p class="mb-0 font-weight-medium" id="js-order-discount-mobile">0</p>
        </div>
        <div class="overall__item overall__item--last">
            <p>Итого</p>
            <h4 class="mb-0" id="js-order-final-mobile">0</h4>
        </div>
        <div class="overall__expand-link">
            <p>Детали заказа</p>
        </div>
        <div class="overall__bottom overall__bottom--hidden">
            <p class="mb-0">
                <button class="btn btn-primary js-order-submit-btn"
                    href="#"
                    type="button"
                    onclick="BX.Sale.OrderAjaxComponent.doSaveAction()"
                    data-is-goal="click"
                    data-base-goal-name="zakaz_send"
                >
                    Оформить заказ
                </button>
            </p>
        </div>
    </div>
<?php $this->EndViewTarget();

$this->SetViewTarget('order: overall'); ?>
    <div class="overall overall--no-border" id="bx-soa-total">
        <div class="overall__top bx-soa-cart-total">
            <div class="overall__item">
                <p>Сумма</p>
                <p class="mb-0 font-weight-medium" id="js-order-sum">0</p>
            </div>
            <div class="overall__item">
                <p>Доставка<span class="tooltip tooltip--question">
                    <a class="tooltip__trigger"
                       href="#"
                       id="js-delivery-hint"
                       data-no-swup data-container="body"
                       data-toggle="popover"
                       data-content="">
                    </a>
                </span>
                </p>
                <p class="mb-0 font-weight-medium" id="js-order-delivery">0</p>
            </div>
            <div class="overall__item">
                <p>Скидка</p>
                <p class="mb-0 font-weight-medium" id="js-order-discount">0</p>
            </div>
            <div class="overall__item">
                <p>Итого</p>
                <h4 class="mb-0" id="js-order-final">0</h4>
            </div>
        </div>
        <div class="overall__bottom">
            <p class="mb-0">
                <button class="btn btn-primary js-order-submit-btn"
                        type="submit"
                        href="#"
                        data-is-goal="click"
                        data-base-goal-name="zakaz_send"
                >
                    Оформить заказ
                </button>
            </p>
        </div>
        <div class="modal modal--order" id="modalOrder"></div>
    </div>
<?php $this->EndViewTarget();
