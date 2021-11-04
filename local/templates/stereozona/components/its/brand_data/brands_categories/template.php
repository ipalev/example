<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<select class="select__input without-reload" data-placeholder="Категория">
    <option>Категория не указана</option>
    <?foreach ($arResult['categories'] as $id => $arCategory) :?>
        <option
            value="<?=$id?>"
            data-brandids='<?=json_encode(array_values($arCategory['BREND_IDS']))?>'
        >
            <?=$arCategory['NAME']?>
        </option>
    <?endforeach?>
</select>