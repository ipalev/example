$(window).on('load scroll', function() {
  if (window.innerWidth < 1200 || $(this).scrollTop() <= 1) {
    $('.header').removeClass('is-fixed');
    $('.menu__catalog-content').removeClass('is-fixed');
  } else {
    $('.header').addClass('is-fixed');
    $('.menu__catalog-content').addClass('is-fixed');
  }
});

document.addEventListener('pageLoaded', function() {
  var $el = $('[data-header-classlist]');

  if ($el.length <= 0) {
    $('.header').removeClass('header--white header--border-bottom');
  } else {
    $('.header').removeClass('header--white header--border-bottom');
    $('.header').addClass($el.data().headerClasslist);
  }


  $.ajax({
    url: "/ajax/compare/list_compare.php?action=getlist",
    complete: function (data) {
      var compareItems = data;
      $('.js__compare_count').text(compareItems.length)

      if (compareItems.length) {
        $(".header__controls-item-compare").removeClass("header__controls-item-compare--empty");

        var compareLink = $(".js-header-compare-btn a.header__btn")[0];
        compareLink.href = "/catalog/compare/";
      }
    }
  });

  setTimeout(function() {
    $.ajax({
      url: "/ajax/whishlist/whishlist.php",
      complete: function (data) {
        var favoriteProductsId = data.responseJSON;
        $('.js__wish_count').text(favoriteProductsId.length)

        if (favoriteProductsId.length) {
          $(".header__controls-item-wish").removeClass("header__controls-item-wish--empty");
        }
      }
    });
  }, 3000);

  document.addEventListener('basket:onchange', function (e) {
    var totalBasketProductsAmount = 0;
    var productsId = Object.keys(e.detail.products_count);

    if (Object.keys(e.detail.product_fields).length) {
      for (var i = 0; i < productsId.length; i++) {
        totalBasketProductsAmount += e.detail.products_count[productsId[i]];
      }
    }

    if (totalBasketProductsAmount)
      $(".header__controls-item-cart").removeClass("header__controls-item-cart--empty");
    else
      $(".header__controls-item-cart").addClass("header__controls-item-cart--empty");
  });
});


document.addEventListener("DOMContentLoaded", function () {

  $(".js-header-compare-btn")[0].addEventListener("click", function (e) {
    var isModalClosed = !e.currentTarget.classList.contains("controls-modal");

    if (isModalClosed)
      e.currentTarget.classList.add("controls-modal");
    else
      e.currentTarget.classList.remove("controls-modal");
  });

  $(".js-header-wish-btn")[0].addEventListener("click", function (e) {
    var isModalClosed = !e.currentTarget.classList.contains("controls-modal");

    if (isModalClosed)
      e.currentTarget.classList.add("controls-modal");
    else
      e.currentTarget.classList.remove("controls-modal");
  });

  BX.bind(BX('modalContactsLink'), 'click', function (event) {
    event.preventDefault();
    event.stopPropagation();
    addLazyComponentContact();
  });

  BX.bind(BX('modalContactsLinkMobile'), 'click', function (event) {
    event.preventDefault();
    event.stopPropagation();
    addLazyComponentContact();
  });
});
