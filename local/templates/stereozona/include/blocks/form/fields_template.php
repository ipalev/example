<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CAllMain $APPLICATION
 * @var CBitrixComponent $component
 * @var array $arParams
 * @var array $arResult
 */

foreach(
    array_filter($arResult['FIELDS'], function($prop) {return strpos($prop['CODE'], 'SYS_') !== 0;}) as $key => $arField
)
{

    $type = 'text';
    $minlength = 2;
    $placeholder = $arField['HINT'] ?: $arField['NAME'];
    $addClasses = '';
    $addAttributes = '';

    if(strpos($arField['CODE'], 'EMAIL') !== false) {
        $minlength = 3;
        $type = 'email';
        $addClasses = 'js-mask-email';
        $addAttributes = 'inputmode="email" data-inputmask="\'alias\': \'email\'"';
    }

    if(strpos($arField['CODE'], 'PHONE') !== false) {
        $minlength = 6;
        $type = 'tel';
        $addClasses = 'js-mask-phone';
    }

    switch($arField['PROPERTY_TYPE']) {
        case 'L':

            if($arField['LIST_TYPE'] == 'C' && $arField['MULTIPLE'] != 'Y') {/*
                        $enum = current($arField['VALUES']);
                        ?>
                        <td class="custom-control custom-checkbox ">
                            <input class="custom-control-input"
                                   id="<?=$arField['CODE']?>_<?=$enum['ID']?>"
                                   name="PROPERTY[<?=$arField['ID']?>][0]"
                                   type="checkbox"
                                   value="<?=$enum['ID']?>"
                            >
                            <label class="custom-control-label" for="<?=$arField['CODE']?>_<?=$enum['ID']?>">
                                <?=$arField['NAME']?>
                            </label>
                        </td>
                    <?*/} else {/*?>
                        <td class="pb-20">
                            <div class="select">
                                <select class="js-select"
                                        name="PROPERTY[<?=$arField['ID']?>][0]"
                                    <?=$arField['IS_REQUIRED'] == 'Y' ? 'required' : ''?>
                                >
                                    <?foreach($arField['VALUES'] as $enum){?>
                                        <option value="<?=$enum['ID']?>"><?=$enum['VALUE']?></option>
                                    <?}?>
                                </select>
                            </div>
                        </td>
                    <?*/}
            break;
        default:
            if($arField['ROW_COUNT'] > 1) {?>
                <div class="form__item form-group">
                            <textarea class="input form-control <?=$addClasses?>"
                                      minlength="<?=$minlength?>"
                                      placeholder="<?=$placeholder?>"
                                      name="PROPERTY[<?=$arField['ID']?>][0]"
                                      <?=$addAttributes?>
                                      <?=$arField['IS_REQUIRED'] == 'Y' ? 'required' : ''?>
                            ></textarea>
                </div>
            <?} else {?>
                <div class="form__item form-group">
                    <input class="input form-control <?=$addClasses?>"
                           minlength="<?=$minlength?>"
                           type="<?=$type?>"
                           placeholder="<?=$placeholder?>"
                           name="PROPERTY[<?=$arField['ID']?>][0]"
                           <?=$addAttributes?>
                           <?=$arField['IS_REQUIRED'] == 'Y' ? 'required' : ''?>
                    >
                </div>
            <?}
            break;
    }
}