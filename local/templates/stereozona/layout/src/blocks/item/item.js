function initMarksDropdown() {
  $('.js__compare').on('click', function(e) {
    e.preventDefault();

    var clickedItem = $(`.item[data-product-id=${e.currentTarget.dataset.productId}]`);

    if (!clickedItem[0].classList.contains('js__compare--compared')) return;

    clickedItem.find('.catalog-compare__dropdown').fadeIn(300);
    clickedItem.find('.catalog-compare__overflow').fadeIn(300);
  });

  $('.catalog-compare__overflow').on('click', fadeOut);
  $('.js__compare--remove').on('click', fadeOut);

  function fadeOut () {
    $('.catalog-compare__dropdown').fadeOut(300);
    $('.catalog-compare__overflow').fadeOut(300);
  }
}

function initItemsCompareMarks() {
  if (!document.querySelector('.item')) return;

  var allCompareProducts = [];
  var compareControls = $('.js__compare');
  var compareRemoveControls = $('.js__compare--remove');

  for (var i = 0; i < compareControls.length; i++) {
    compareControls[i].addEventListener("click", function (event) {
      event.preventDefault();
      var isItemInCompare =
        !!$(`.js__compare--compared[data-product-id=${event.currentTarget.dataset.productId}]`).length;

      if (!isItemInCompare)
        addToCompareList(event.currentTarget.dataset.productId);
    })
  }

  for (var i = 0; i < compareRemoveControls.length; i++) {
    compareRemoveControls[i].addEventListener("click", function (event) {
      event.preventDefault();
      var isItemInCompare =
        !!$(`.js__compare[data-product-id=${event.currentTarget.dataset.productId}]`).length;

      if (isItemInCompare)
        delFromCompareList(event.currentTarget.dataset.productId);
    })
  }

  (function getComparedItems() {
    $.ajax({
      url: "/ajax/compare/list_compare.php?action=getlist",
      complete: (data) => {
        allCompareProducts = data.responseJSON.COMPARE_LIST;
        setCompareMarks();
      }
    })
  })();

  function setCompareMarks() {
    var allItems = $('.item');

    for (var i = 0; i < allItems.length; i++) {
      $('.item')[i].classList.remove('js__compare--compared');
      $('.item')[i].classList.remove('item--compared');
    }

    for (var i in allCompareProducts) {
      var currentItem = $(`.item[data-product-id=${allCompareProducts[i]}]`);

      if (currentItem.length) {
        currentItem.addClass('js__compare--compared');
        currentItem.addClass('item--compared');
        currentItem.find('.item__compare-status')[0].innerText = allCompareProducts.length;
      }
    }

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
}

function initFavoriteMarks () {
  if (!document.querySelector('.item')) return;

  var allFavoriteProducts = [];
  var favoriteControls = document.querySelectorAll('.item__control-favorite');
  var favoritePageLink = document.querySelector('.header__controls-item-wish a.header__btn').href;

  setTimeout(function() {
    getFavoriteProducts();
  }, 3000);

  for (var i = 0; i < favoriteControls.length; i++) {
    favoriteControls[i].addEventListener('click', function (e) {
      if (e.currentTarget.classList.contains('item__control-favorite--added')) {
        delFromWishList(e.currentTarget.dataset.productId);
      }
      else if (e.currentTarget.classList.contains('item__control-favorite--not-added')) {
        addToWishList(e.currentTarget.dataset.productId);
      }
    });
  }

  function getFavoriteProducts () {
    $.ajax({
      url: '/ajax/whishlist/whishlist.php',
      success: (data) => {
        allFavoriteProducts = data || [];
        setFavoriteProducts();
      }
    });
  }


  function setFavoriteProducts () {

    // Header counter
    $('.js__wish_count').text(allFavoriteProducts.length);

    if (allFavoriteProducts.length) {
      $(".header__controls-item-wish").removeClass("header__controls-item-wish--empty");
      $(".js-header-wish-btn a.header__btn")[0].href = favoritePageLink;
    } else {
      $(".header__controls-item-wish").addClass("header__controls-item-wish--empty");
      $(".js-header-wish-btn a.header__btn")[0].removeAttribute('href');
    }
    //

    for (var i = 0; i < favoriteControls.length; i++) {
      favoriteControls[i].classList.add('item__control-favorite--not-added');
      favoriteControls[i].classList.remove('item__control-favorite--added');

      for (var a = 0; a < allFavoriteProducts.length; a++) {
        if (allFavoriteProducts[a] === favoriteControls[i].dataset.productId) {
          favoriteControls[i].classList.remove('item__control-favorite--not-added');
          favoriteControls[i].classList.add('item__control-favorite--added');
        }
      }
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

          setFavoriteProducts();

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

          for (var i = 0; i < allFavoriteProducts.length; i++) {
            if (allFavoriteProducts[i] === productId)
              allFavoriteProducts.splice(i, 1);
          }

          setFavoriteProducts();

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
}

document.addEventListener('pageLoaded', initItemsCompareMarks);
document.addEventListener('onPagenContentLoaded', initItemsCompareMarks);

document.addEventListener('pageLoaded', initFavoriteMarks);
document.addEventListener('onPagenContentLoaded', initFavoriteMarks);

document.addEventListener('pageLoaded', initMarksDropdown);
document.addEventListener('onPagenContentLoaded', initMarksDropdown);

document.addEventListener('pageLoaded', function () {

  if(!document.querySelector('.tab-catalog-items')) return;

  var waiter = window.setInterval(function () {
    if (
      !document.querySelector('#slider-latest .item') ||
      !document.querySelector('#slider-similar .item')
    ) return;

    initItemsCompareMarks();
    initFavoriteMarks();
    initMarksDropdown();

    window.clearInterval(waiter);
  }, 200);
});
