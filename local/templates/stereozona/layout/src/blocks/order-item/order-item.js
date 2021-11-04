function handleOrderItem() {
  $('.order-item__right').on('click', function(e) {
    e.preventDefault();
    $(this)
      .parent()
      .parent()
      .find('.order-item__content')
      .slideToggle(300);
    $(this)
      .parent()
      .toggleClass('is-active');

    if ($(window).width() > 767) {
      var cartItemFinalPrice = $('.cart-item__final-price');

      if (cartItemFinalPrice.length) {
        var greatestWidth = 0;

        cartItemFinalPrice.each(function() {
          var theWidth = $(this).outerWidth();

          if (theWidth > greatestWidth) {
            greatestWidth = theWidth;
          }
        });

        cartItemFinalPrice.width(greatestWidth);
      }
    }
  });
}

document.addEventListener('pageLoaded', handleOrderItem);
