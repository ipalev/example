<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/** @var CAllMain $APPLICATION */

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <title><? $APPLICATION->ShowTitle(); ?></title>
    <link rel="shortcut icon" href="/assets/img/favicon.ico" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
    <meta name="format-detection" content="telephone=no">

</head>
    <body>
        <div id="swup-modals">
            <?php
            // Modal Processor modals
            \Its\Lib\Modal\Processor::placeMarker();
            ?>
        </div>
