<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
use Bitrix\Main\Page\Asset;
/**
 * @var CAllUser $USER
 * @var CAllMain $APPLICATION
 * @var CBitrixComponent $component
 * @var array $arParams
 * @var array $arResult
 */

if($arResult["ID"]) {?>
    <div class="row">
        <form class="col-xl-8 col-lg-11 offset-lg-1"
              method="post"
              data-personal="form-personal"
              action="<?=POST_FORM_ACTION_URI?>"
              enctype="multipart/form-data"
        >
            <?=bitrix_sessid_post()?>
            <input type="hidden" name="ID" value="<?=$arResult["ID"]?>">
            <input type="hidden" name="NAME" value="<?=$arResult["NAME"]?>">

            <?php
            $locationProperty = $arResult["ORDER_PROPS"]['LOCATION'];
            $locationPropertyValue = $arResult["ORDER_PROPS"]['LOCATION']['VALUE'];
            if($locationProperty) {
                Asset::getInstance()->addCss("https://cdn.jsdelivr.net/npm/suggestions-jquery@20.3.0/dist/css/suggestions.min.css");
                Asset::getInstance()->addJs(SITE_TEMPLATE_PATH."/bitrixjs/suggestions.js");
            ?>
                <input type="hidden" name="ORDER_PROP_<?=$locationProperty['ID']?>" id="ORDER_LOCATION" value="<?=$locationPropertyValue?>">
            <?php }?>

            <div class="row mb-30">
                <?php foreach($arResult["ORDER_PROPS"] as $property) {
                    $key = (int) $property["ID"];
                    $name = "ORDER_PROP_".$key;
                    $currentValue = $arResult["ORDER_PROPS_VALUES"][$name];

                    if ($property["TYPE"] === "TEXT") {?>
                        <div class="col-lg-6">
                            <div class="form__item form-group">
                                <input class="input form-control <?=$property['CODE'] == 'DELIVERY_ADDR'? 'suggestions-input' : ''?>"
                                       type="text"
                                       name="<?=$name?>"
                                       maxlength="50"
                                       id="sppd-property-<?=$key?>"
                                       value="<?=$currentValue?>"
                                       autocomplete="off"
                                       data-code="<?=$property['CODE']?>"
                                       <?=$property['CODE'] == 'DELIVERY_ADDR'? 'data-address="DELIVERY_ADDR"' : ''?>"
                                       <?=$property['REQUIED'] === 'Y' ? 'required' : ''?>
                                >
                                <label class="form__label"><?= $property["NAME"] . ($property['REQUIED'] === 'Y' ? '*' : '')?></label>
                            </div>
                        </div>
                    <?php }
                } ?>
            </div>
            <div class="profile__form-footer">
                <input class="btn btn-primary profile__save"
                   type="submit"
                   id="save-password"
                   name="apply"
                   value="Сохранить"
                >
                <button class="btn btn-primary"
                    data-fancybox
                    data-no-swup
                    data-src="#<?=$arParams['PASSWORD_MODAL_ID']?>"
                    data-animation-effect="false"
                    data-touch="false"
                    data-modal="true"
                >
                    Сменить пароль
                </button>
            </div>
        </form>
    </div>
<?}
if($arResult["ERROR_MESSAGE"]) {?>
    <script>
        document.addEventListener('DOMContentLoaded', function(){
            document.dispatchEvent(new CustomEvent('sale-profile: error', {
                detail: {
                    message: '<?=$arResult["ERROR_MESSAGE"]?>'
                }
            }));
        });
    </script>
<?php }?>
<script>var suggestionsToken = '<?=getenv('DADATA_API_KEY')?>';</script>
