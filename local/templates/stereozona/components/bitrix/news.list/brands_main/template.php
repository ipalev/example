<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>

<div class="alphabet its-fade js-observe">
    <a class="alphabet__header" href="/brands/">Все бренды</a>
    <div class="alphabet__content">
        <?foreach ($arResult['BRANDS'] as $key => $arLetters):?>
            <div class="alphabet__letter">
                <a
                    class="alphabet__letter-btn"
                    data-toggle="tooltip"
                    title="
                    <?php foreach ($arLetters as $letter) :?>
                        &lt;a class=&quot;alphabet__letter-brand&quot;href=&quot;<?=$letter['LINK']?>&quot;&gt;<?=$letter['NAME']?>&lt;/a&gt;
                    <?php endforeach?>"
                >
                    <?=$key?>
                </a>
            </div>
        <?endforeach?>
    </div>
</div>
