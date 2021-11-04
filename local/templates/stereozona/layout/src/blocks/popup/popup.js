var closePopupTimer;

function openPopup(data) {
  var title = data.title;
  var text = data.text;
  var img = data.img;
  var button = data.button;

  clearTimeout(closePopupTimer);
  setTimeout(closePopup, 5000);

  if (title) {
    $('.popup__content-title').html(title);
  }

  if (text) {
    $('.popup__content-dscr').html(text);
  }

  if (img) {
    $('.popup__icon-img').attr('src', img);
  }

  var $btn = $('.popup__content-btn');

  if (!button) {
    $btn.hide();
    $('.popup').addClass('popup--active');
    return false;
  }

  if (button.modal) {
    $btn.text(button.text);
    $btn.show();
    $btn[0].onclick = function(e) {
      e.preventDefault();
      showModal(button.id);
    };
  } else if (button.href) {
    $btn[0].onclick = function() {
      setTimeout(closePopup, 10);
    };

    $btn.text(button.text);
    $btn.attr('href', button.href);
    $btn.attr('target', button.target || '_blank');
    $btn.show();
  }

  $('.popup').addClass('popup--active');
}

function closePopup() {
  $('.popup').removeClass('popup--active');

  closePopupTimer = setTimeout(function() {
    $('.popup__content-btn')[0].onclick = '';
    $('.popup__content-btn').hide();
    $('.popup__content-title').html('');
    $('.popup__content-dscr').html('');
    $('.popup__icon-img').attr('src', '');
  }, 600);
}

function showModal(id) {
  if (!id) return false;

  $.fancybox.open({
    src: id,
    modal: true,
  });
}

document.addEventListener('popup:open', function(e) {
  openPopup(e.detail);
});

document.addEventListener('popup:close', closePopup);

$(document).on('click', function(e) {
  if (
    !$(e.target).hasClass('popup') &&
    $(e.target).parents('.popup').length === 0 &&
    !$(e.target).is('#popupCart') &&
    $(e.target).parents('#popupCart').length === 0 &&
    !$(e.target).is('#popupFavorite') &&
    $(e.target).parents('#popupFavorite').length === 0 &&
    !$(e.target).is('#popupCompare') &&
    $(e.target).parents('#popupCompare').length === 0 &&
    !$(e.target).hasClass('subscribe__btn') &&
    $(e.target).parents('.subscribe__btn').length === 0
  ) {
    closePopup();
  }
});
