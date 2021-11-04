<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$normalizeEnumValue = function(string $value) use (&$normalizeEnumValue): string {
    return trim(mb_strtolower($value));
};
?>
<form class="catalog__filters" id="catalog-filters-aside" action="#" method="GET" v-cloak>
    <?php

    /**
     * @var array $arParams
     * @var array $arResult
     */

    if(!is_array($arParams['SKIP_PROPERTIES'])) $arParams['SKIP_PROPERTIES'] = [];

    foreach ($arResult["ITEMS"] as $arItem) {
        $isPrice = array_key_exists('PRICE', $arItem) && $arItem['PRICE'];

        if (!$isPrice && !in_array($arItem['CODE'], $arParams['QUICK_FILTERS'])) continue;

        if (
            empty($arItem["VALUES"]) ||
            $arItem["DISPLAY_TYPE"] == "A" && ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0) ||
            in_array($arItem['CODE'], $arParams['SKIP_PROPERTIES'])
        ) continue;

        if($isPrice) $arItem["DISPLAY_TYPE"] = 'A';

        $vueCode = strtolower($arItem["CODE"]);

        switch ($arItem["DISPLAY_TYPE"]) {

            //NUMBERS_WITH_SLIDER
            case "A":
                $filteredValue = [
                    'min' => $arItem['VALUES']['MIN']['FILTERED_VALUE'] ?: $arItem['VALUES']['MIN']['VALUE'],
                    'max' => $arItem['VALUES']['MAX']['FILTERED_VALUE'] ?: $arItem['VALUES']['MAX']['VALUE']
                ];

                ?>
                <div class="dropdown"
                     v-if="filters.<?=$vueCode?>"
                >
                    <a class="dropdown__header" href="#" data-no-swup><?=$arItem["NAME"]?></a>
                    <div class="dropdown__content">
                        <div class="dropdown__price">
                            <input class="dropdown__price-input"
                                   type="number"
                                   min="<?=$arItem['VALUES']['MIN']['VALUE']?>"
                                   max="<?=$arItem['VALUES']['MAX']['VALUE']?>"
                                   v-model="filters.<?=$vueCode?>.min"
                                   name="<?=$arItem['VALUES']['MIN']['CONTROL_ID']?>"
                                   placeholder="<?=$filteredValue['min']?>"
                                   onkeyup="smartFilter.keyup(this, true)"
                            >
                            <div class="dropdown__price-dash"></div>
                            <input class="dropdown__price-input"
                                   type="number"
                                   min="<?=$arItem['VALUES']['MIN']['VALUE']?>"
                                   max="<?=$arItem['VALUES']['MAX']['VALUE']?>"
                                   v-model="filters.<?=$vueCode?>.max"
                                   name="<?=$arItem['VALUES']['MAX']['CONTROL_ID']?>"
                                   placeholder="<?=$filteredValue['max']?>"
                                   onkeyup="smartFilter.keyup(this, true)"
                            >
                        </div>
                    </div>
                </div>
                <?break;

            //NUMBERS
            case "B":
                break;

            //RADIO_BUTTONS
            case "K":
                break;

            //DROPDOWN
            //CHECKBOXES
            case "P":
            case "F":
                ?>
                <div class="dropdown" v-if="filters.<?=$vueCode?>">
                    <a class="dropdown__header" href="#" data-no-swup><?=$arItem["NAME"]?></a>
                    <div class="dropdown__content">
                        <?php foreach ($arItem['VALUES'] as $ar) {?>
                            <div class="checkbox">
                                <input
                                        class="u-hidden"
                                        type="checkbox"
                                        value="<?= $ar["HTML_VALUE"] ?>"
                                        name="<?= $ar["CONTROL_ID"] ?>"
                                        :checked="filters.<?=$vueCode?>.indexOf('<?= $ar["CONTROL_ID"] ?>') !== -1"
                                >
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input"
                                           type="checkbox"
                                           v-model="filters.<?=$vueCode?>"
                                           value="<?= $ar["CONTROL_ID"] ?>"
                                           id="<?=$ar["CONTROL_ID"]?>"
                                           onclick="smartFilter.click(this, true)"
                                           <?= $ar["CHECKED"] ? 'checked="checked"' : '' ?>
                                    >
                                    <label class="custom-control-label" for="<?=$ar["CONTROL_ID"]?>">
                                        <span class="custom-control-text"><?= $ar['VALUE'] ?></span>
                                        <span class="checkbox__amount num_<?= $ar["CONTROL_ID"] ?>"><?= $ar['ELEMENT_COUNT'] ?></span>
                                    </label>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <?
                break;
        }
    }
    ?>
</form>
<?php

/* render modal filter */

$this->SetViewTarget('catalog-filter: modal_filter'); ?>
    <div class="modal modal--filters modal--wide" id="modalFilters"><a class="modal__close" href="#" data-fancybox-close data-no-swup></a>
        <div class="container-fluid px-md-0">
            <div class="modal__content" id="catalog-filters-modal" v-cloak>
                <div class="h2">Все фильтры</div>
                <div class="modal__filters-chosen-list" :class="{ 'modal__filters-chosen-list--hidden': selectedFilters.length &lt;= 0 }">
                    <div class="modal__filter-chosen" v-for="filter in selectedFilters" :key="filter.id">
                        <template v-if="filter.isRange">
                            <template><span v-if="filter.min">{{ filter.min }}</span><span v-if="filter.max">
                                 -
                                {{ filter.max }}</span></template>
                        </template>
                        <template v-else>
                            <template v-if="filter.title">{{ filter.title }}: {{ filter.text }}</template>
                            <template v-else>{{ filter.text }}</template>
                        </template><a class="modal__filter-chosen-remove" data-no-swup href="#" @click.prevent="deselectFilter($event, filter)"></a>
                    </div><a class="modal__filters-chosen-clear" data-no-swup href="#" @click.prevent="deselectAllFilters">Очистить все</a>
                </div>
                <form class="modal__filters"
                      name="<?= $arResult["FILTER_NAME"] . "_form" ?>"
                      action="<?= $arResult["FORM_ACTION"] ?>"
                      method="get"
                >
                    <div class="row">
                        <?

                        foreach ($arResult["ITEMS"] as $key => $arItem) {
                            $isPrice = array_key_exists('PRICE', $arItem) && $arItem['PRICE'];

                            if (
                                empty($arItem["VALUES"]) ||
                                $arItem["DISPLAY_TYPE"] == "A" && ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0) ||
                                in_array($arItem['CODE'], $arParams['SKIP_PROPERTIES'])
                            ) continue;

                            if($isPrice) $arItem["DISPLAY_TYPE"] = 'A';

                            $vueCode = strtolower($arItem["CODE"]);

                            switch ($arItem["DISPLAY_TYPE"]) {

                                //NUMBERS_WITH_SLIDER
                                case "A":
                                    $filteredValue = [
                                        'min' => $arItem['VALUES']['MIN']['FILTERED_VALUE'] ?: $arItem['VALUES']['MIN']['VALUE'],
                                        'max' => $arItem['VALUES']['MAX']['FILTERED_VALUE'] ?: $arItem['VALUES']['MAX']['VALUE']
                                    ];
                                    ?>
                                    <div class="col-md-4"
                                         data-catalog-filter="<?=$vueCode?>"
                                         data-filter-range="true"
                                         <?=$arItem['VALUES']['MIN']['HTML_VALUE'] ? 'data-value-min="'.$arItem['VALUES']['MIN']['HTML_VALUE'].'"' : ''?>
                                         <?=$arItem['VALUES']['MAX']['HTML_VALUE'] ? 'data-value-max="'.$arItem['VALUES']['MAX']['HTML_VALUE'].'"' : ''?>
                                    >
                                        <div class="dropdown dropdown--big" v-if="filters.<?=$vueCode?>">
                                            <a class="dropdown__header" href="#" data-no-swup><?=$arItem["NAME"]?></a>
                                            <div class="dropdown__content">
                                                <div class="dropdown__price">
                                                    <input class="dropdown__price-input"
                                                           type="number"
                                                           min="<?=$arItem["VALUES"]["MIN"]["VALUE"]?>"
                                                           max="<?=$arItem["VALUES"]["MAX"]["VALUE"]?>"
                                                           step="1"
                                                           v-model="filters.<?=$vueCode?>.min"
                                                           name="<?= $arItem['VALUES']['MIN']['CONTROL_ID'] ?>"
                                                           placeholder="<?=$filteredValue['min']?>"
                                                           onkeyup="smartFilter.keyup(this)"
                                                    >
                                                    <div class="dropdown__price-dash"></div>
                                                    <input class="dropdown__price-input"
                                                           type="number"
                                                           min="<?=$arItem["VALUES"]["MIN"]["VALUE"]?>"
                                                           max="<?=$arItem["VALUES"]["MAX"]["VALUE"]?>"
                                                           step="1"
                                                           v-model="filters.<?=$vueCode?>.max"
                                                           name="<?= $arItem['VALUES']['MAX']['CONTROL_ID'] ?>"
                                                           placeholder="<?=$filteredValue['max']?>"
                                                           onkeyup="smartFilter.keyup(this)"
                                                    >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?break;

                                //NUMBERS
                                case "B":
                                    break;

                                //RADIO_BUTTONS
                                case "K":
                                    break;

                                //DROPDOWN
                                //CHECKBOXES
                                case "P":
                                case "F":
                                    $firstEnumValue = current($arItem["VALUES"])['VALUE'] ?? '';

                                    if (count($arItem["VALUES"]) > 1 || !in_array($normalizeEnumValue($firstEnumValue), ['да', 'есть']) ) {?>
                                        <div class="col-md-4" data-catalog-filter="<?=$vueCode?>">
                                            <div class="dropdown dropdown--big" v-if="filters.<?=$vueCode?>">
                                                <a class="dropdown__header" href="#" data-no-swup><?=$arItem["NAME"]?></a>
                                                <div class="dropdown__content">
                                                    <div class="catalog-filters-list">
                                                        <?php foreach ($arItem['VALUES'] as $ar) {?>
                                                            <div class="checkbox">
                                                                <input
                                                                        class="u-hidden"
                                                                        type="checkbox"
                                                                        value="<?= $ar["HTML_VALUE"] ?>"
                                                                        name="<?= $ar["CONTROL_ID"] ?>"
                                                                        :checked="filters.<?=$vueCode?>.indexOf('<?= $ar["CONTROL_ID"] ?>') !== -1"
                                                                >
                                                                <div class="custom-control custom-checkbox">
                                                                    <input class="custom-control-input"
                                                                           type="checkbox"
                                                                           v-model="filters.<?=$vueCode?>"
                                                                           value="<?= $ar["CONTROL_ID"] ?>"
                                                                           id="<?=$ar["CONTROL_ID"]?>"
                                                                           data-model='<?=$vueCode?>'
                                                                           onclick="smartFilter.click(this)"
                                                                           <?= $ar["CHECKED"] ? 'checked="checked"' : '' ?>
                                                                    >
                                                                    <label class="custom-control-label" for="<?=$ar["CONTROL_ID"]?>">
                                                                        <span class="custom-control-text"><?= $ar['VALUE'] ?></span>
                                                                        <span class="checkbox__amount num_<?= $ar["CONTROL_ID"] ?>"><?= $ar['ELEMENT_COUNT'] ?></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?} else {
                                        foreach($arItem['VALUES'] as $ar) {?>
                                            <div class="col-md-4" data-catalog-filter="<?=$vueCode?>">
                                                <div class="checkbox checkbox--switch">
                                                    <input class="u-hidden"
                                                           type="checkbox"
                                                           value="<?= $ar["HTML_VALUE"] ?>"
                                                           name="<?= $ar["CONTROL_ID"] ?>"
                                                           :checked="filters.<?=$vueCode?>.indexOf('<?= $ar["CONTROL_ID"] ?>') !== -1"
                                                    >
                                                    <div class="custom-control custom-checkbox">
                                                        <input class="custom-control-input"
                                                               type="checkbox"
                                                               v-model="filters.<?=$vueCode?>"
                                                               value="<?= $ar["CONTROL_ID"] ?>"
                                                               id="<?=$ar["CONTROL_ID"]?>"
                                                               data-model='<?=$vueCode?>'
                                                               onclick="smartFilter.click(this)"
                                                               <?= $ar["CHECKED"] ? 'checked="checked"' : '' ?>
                                                        >
                                                        <label class="custom-control-label" for="<?=$ar["CONTROL_ID"]?>">
                                                            <span class="custom-control-text"><?=$arItem["NAME"]?></span>
                                                            <span class="checkbox__amount num_<?=$ar["CONTROL_ID"]?>"><?= $ar['ELEMENT_COUNT'] ?></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        <?}
                                    }
                                    break;
                            }
                        } ?>
                    </div>
                    <button class="btn btn-primary"
                            id="modef"
                            type="button"
                            :disabled="isLoading"
                            :data-link="requestResponse.url"
                            @click.prevent="onSubmitClick"
                    >
                        Применить
                    </button>
                </form>
            </div>
        </div>
    </div>
<? $this->EndViewTarget();
