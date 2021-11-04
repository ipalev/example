$(document).on('click', '[data-product-tab]', function(e) {
  e.preventDefault();
  var id = this.dataset.productTab;
  var link = $('.product__tabs-top .nav-link[href="' + id + '"]')[0];

  if (link) {
    link.click();
    var parent = link.closest('.product__tabs-top');

    if (parent) {
      $('html, body').animate(
        {
          scrollTop: $(parent).offset().top,
        },
        600
      );
    }
  }
});

document.addEventListener('pageLoaded', function() {
  var $firstLink = $('.product__tabs-top .nav-link').first();
  $firstLink.addClass('active');
  var href = $firstLink.attr('href');
  $(href).addClass('active show');
});

document.addEventListener('pageLoaded', function initFavoriteMarks() {
  var product = document.querySelector('.product');

  if (!product) return;

  var allFavoriteProducts = [];
  var favoriteControl = product.querySelector('.js__favorite');
  var favoritePageLink = document.querySelector('.header__controls-item-wish a.header__btn').href;

  setTimeout(function() {
    getFavoriteProducts();
  }, 3000);


  favoriteControl.addEventListener('click', function () {
    if (!product.getAttribute('data-product-id')) return;

    var isFavorite = false;

    for (var i in allFavoriteProducts) {
      if (allFavoriteProducts[i] == $('.product')[0].dataset.productId)
        isFavorite = true;
    }

    if (isFavorite)
      delFromWishList(product.getAttribute('data-product-id'));
    else
      addToWishList(product.getAttribute('data-product-id'));
  });

  function getFavoriteProducts () {
    $.ajax({
      url: '/ajax/whishlist/whishlist.php',
      success: (data) => {
        allFavoriteProducts = data || [];
        setFavoriteMark();
      }
    });
  }

  function setFavoriteMark () {
    var isFavorite = false;

    allFavoriteProducts.forEach((id) => {
      if (id == product.getAttribute('data-product-id'))
        isFavorite = true;
    })

    if (isFavorite) favoriteControl.classList.add('active');
    else favoriteControl.classList.remove('active');
  }

  function updateHeaderFavoriteCounter () {
    $('.js__wish_count').text(allFavoriteProducts.length);
    if (allFavoriteProducts.length) {
      $(".header__controls-item-wish").removeClass("header__controls-item-wish--empty");
      $(".js-header-wish-btn a.header__btn")[0].href = favoritePageLink;
    } else {
      $(".header__controls-item-wish").addClass("header__controls-item-wish--empty");
      $(".js-header-wish-btn a.header__btn")[0].removeAttribute('href');
    }
  }

  function addToWishList (productId) {
    var event;
    $.ajax({
      url: '/ajax/sale/basket/',
      type: 'post',
      data: {
        action: 'increase',
        id: productId,
        delay: 'Y'
      },
      dataType: 'json',
      success: function (answer) {
        if (answer.STATUS === 'OK') {

          allFavoriteProducts.push(productId);

          setFavoriteMark();
          updateHeaderFavoriteCounter();

          event = new CustomEvent('favourites:add-success', {
            'detail': {
              'message': 'Товар успешно добавлен в избранное'
            }
          });
          document.dispatchEvent(event);

        } else {
          event = new CustomEvent('favourites:add-error', {});
          document.dispatchEvent(event);
        }
      },
      error: function () {
        event = new CustomEvent('favourites:add-error', {
          'detail': {
            'message': 'Internal Server Error'
          }
        });
        document.dispatchEvent(event);
      }
    });
  }

  function delFromWishList (productId) {
    var event;
    $.ajax({
      url: '/ajax/sale/basket/',
      type: 'post',
      data: {
        action: 'remove',
        id: productId
      },
      dataType: 'json',
      success: function (answer) {
        if (answer.STATUS === 'OK') {

          for (var i in allFavoriteProducts) {
            if (allFavoriteProducts[i] == productId) {
              allFavoriteProducts.splice(i, 1);
            }
          }

          setFavoriteMark();
          updateHeaderFavoriteCounter();

          event = new CustomEvent('favourites:del-success', {
            'detail': {
              'message': 'Товар успешно удален из избранного'
            }
          });
          document.dispatchEvent(event);
        } else {
          event = new CustomEvent('favourites:del-error', {});
          document.dispatchEvent(event);
        }
      },
      error: function () {
        event = new CustomEvent('favourites:del-error', {
          'detail': {
            'message': 'Internal Server Error'
          }
        });
        document.dispatchEvent(event);
      }
    });
  }
});


document.addEventListener('pageLoaded', function initCompareMarks () {
  var product = document.querySelector('.product');

  if (!product) return;

  var allCompareProducts = [];
  var compareControl = product.querySelector('.js__compare');

  // getComparedItems();

  compareControl.addEventListener('click', function () {
    if (!product.getAttribute('data-product-id')) return;

    var isInCompare = false;

    for (var i in allCompareProducts) {
      if (allCompareProducts[i] == $('.product')[0].dataset.productId)
        isInCompare = true;
    }

    if (isInCompare)
      delFromCompareList(product.getAttribute('data-product-id'));
    else
      addToCompareList(product.getAttribute('data-product-id'));
  });

  (function getComparedItems() {
    $.ajax({
      url: "/ajax/compare/list_compare.php?action=getlist",
      complete: (data) => {
        allCompareProducts = data.responseJSON.COMPARE_LIST;
        setCompareMarks();
      }
    })
  })();

  function setCompareMarks () {
    var isInCompare = false;

    allCompareProducts.forEach((id) => {
      if (id == product.getAttribute('data-product-id'))
        isInCompare = true;
    })

    if (isInCompare) compareControl.classList.add('active');
    else compareControl.classList.remove('active');

    // Header counter
    $('.js__compare_count').text(allCompareProducts.length);

    if (allCompareProducts.length) {
      $(".header__controls-item-compare").removeClass("header__controls-item-compare--empty");
      $(".js-header-compare-btn a.header__btn")[0].href = "/catalog/compare/";
    } else {
      $(".header__controls-item-compare").addClass("header__controls-item-compare--empty");
      $(".js-header-compare-btn a.header__btn")[0].removeAttribute('href');
    }
  }

  function addToCompareList (productId) {
    var event;
    $.ajax({
      url: '/ajax/compare/list_compare.php',
      type: 'post',
      data: {
        id: productId,
        ajax_action: 'Y',
        action: 'add'
      },
      dataType: 'json',
      success: function (answer) {
        if (answer.STATUS === 'OK') {

          allCompareProducts.push(productId);

          setCompareMarks();

          event = new CustomEvent('comparison:add-success', {
            'detail': {
              'message': answer.MESSAGE
            }
          });
          document.dispatchEvent(event);

        } else {
          event = new CustomEvent('comparison:add-error', {
            'detail': {
              'message': answer.MESSAGE
            }
          });
          document.dispatchEvent(event);
        }
      },
      error: function () {
        event = new CustomEvent('comparison:add-error', {
          'detail': {
            'message': 'Internal Server Error'
          }
        });
        document.dispatchEvent(event);
      },
      complete: function (answer) {
        return answer.MESSAGE;
      }
    });
  }

  function delFromCompareList (productId) {
    var event;
    $.ajax({
      url: '/catalog/compare/?action=DELETE_FROM_COMPARE_RESULT&ID=' + productId,
      type: 'get',
      complete: function (answer) {
        if (answer.status === 200) {

          for (var i = 0; i < allCompareProducts.length; i++) {
            if (allCompareProducts[i] == productId)
              allCompareProducts.splice(i, 1);
          }

          setCompareMarks();

          event = new CustomEvent('comparison:add-success', {
            'detail': {
              'message': 'Товар удалён из сравнения'
            }
          });
          document.dispatchEvent(event);

        } else {

          event = new CustomEvent('comparison:add-error', {
            'detail': {
              'message': 'Ошибка удаления'
            }
          });
          document.dispatchEvent(event);

        }
      }
    });
  }
});


