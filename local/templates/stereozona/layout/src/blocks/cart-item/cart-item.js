function initCartOverall() {
  if ($(window).width() > 767) {
    var cartItemPriceOverall = $('.cart-item__price-overall');

    if (cartItemPriceOverall.length) {
      var greatestWidth = 0;

      cartItemPriceOverall.each(function() {
        var theWidth = $(this).outerWidth();

        if (theWidth > greatestWidth) {
          greatestWidth = theWidth;
        }
      });

      cartItemPriceOverall.width(greatestWidth);
    }
  }
}

document.addEventListener('pageLoaded', initCartOverall);
window.addEventListener('resize', initCartOverall);
