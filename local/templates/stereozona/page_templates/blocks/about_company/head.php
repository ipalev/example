<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
define('__SIMPLE_PAGE__', 'tilda-menu');
?>
<main class="page-content" id="swup">
    <div class="container-fluid">
        <div class="pt-15 pb-10 pt-md-30 pb-md-45">
            <?php
                $APPLICATION->IncludeComponent(
                    "bitrix:breadcrumb",
                    "main",
                    [
                        "START_FROM" => "0",
                        "PATH" => "",
                        "SITE_ID" => SITE_ID
                    ]
                );
            ?>
        </div>
    </div>
    <div class="article">
        <div class="article__wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6 col-xl-5">
                        <div class="article__content">
