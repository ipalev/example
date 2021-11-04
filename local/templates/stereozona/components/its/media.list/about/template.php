<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>

<?php foreach ($arResult['ITEMS'] as $items) :?>
    <?php foreach ($items as $index => $arPhoto) :?>
        <?php if ($arResult['DIV_MAP'][$index] == 'one_photo') :?>
            <div class="picture its-fade js-observe">
                <img class="picture__img" src="<?=$arPhoto['PATH']?>" alt>
                <a class="picture__btn" href="#" data-no-swup></a>
                <div class="picture__dscr"><?=$arPhoto['DESCRIPTION']?></div>
            </div>
        <?php endif?>
        <?php if ($arResult['DIV_MAP'][$index] == 'row_start') :?>
            <div class="row">
        <?php endif?>
        <?php if ($arResult['DIV_MAP'][$index] != 'one_photo') :?>
            <div class="col-lg-6 its-fade js-observe">
                <div class="picture">
                    <img class="picture__img" src="<?=$arPhoto['PATH']?>" alt>
                    <a class="picture__btn" href="#" data-no-swup></a>
                    <div class="picture__dscr"><?=$arPhoto['DESCRIPTION']?></div>
                </div>
            </div>
        <?php endif?>
        <?php if ($arResult['DIV_MAP'][$index] == 'row_end') :?>
            </div>
        <?php endif?>
    <?php endforeach?>
<?php endforeach?>