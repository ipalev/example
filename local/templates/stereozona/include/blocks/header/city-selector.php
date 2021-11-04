<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$cityName = \Its\Lib\Geo\IpCity\HelperIpCity::getCity();
?>
<a
    class="header__city js__geo_city"
    href="#"
    data-fancybox
    data-no-swup
    data-src="#modalCity"
    data-animation-effect="false"
    data-touch="false"
    data-modal="true"
>
    <?=$cityName?>
</a>
<div class="modal modal--left modal--city" id="modalCity">
    <a class="modal__close" href="#" data-fancybox-close data-no-swup></a>
    <div class="container-fluid px-md-0">
        <div id="city-search-wrap-lazy" class="modal__content">
        </div>
    </div>
</div>
