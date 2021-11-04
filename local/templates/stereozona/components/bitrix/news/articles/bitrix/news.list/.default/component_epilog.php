<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$arResult['PAGEN_MANAGER']->cut();
?>

<?php $content='<div class="modal modal--bottom" id="modalArticles">
        <a class="modal__close" href="#" data-fancybox-close data-no-swup></a>
        <div class="container-fluid px-md-0">
            <div class="modal__content">
                <div class="row">';
                ?>
                <?php foreach ($templateData['PRODUCT_SECTIONS'] as $row) :?>
                <?php $content.='<div class="col-md-4">';?>
                    <?php foreach ($row as $arSection) :?>
                        <?php $content.='<a
                            class="modal__counted-link"
                            href="/articles/obzori/filter/'.$arSection['CODE'].'/"
                            >'.$arSection['NAME'].'<span class="modal__counted-link-number">'.$arSection['COUNT_PRODUCT'].'</span></a>';?>
                    <?php endforeach?>
                <?php $content.='</div>';?>
                <?php endforeach?>
            <?php $content.='</div>
        </div>
    </div>
</div>';?>

<?php
$articleModal = new Its\Lib\Modal\ArticlesModal();
$articleModal->setContent($content);
Its\Lib\Modal\Processor::getInstance()->addModal($articleModal);
?>
