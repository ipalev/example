function handleOption() {
  $('.option .custom-control-input').on('change', function(e) {
    if ($(this).is(':checked')) {
      $(this)
        .parents('.order__section')
        .find('.option')
        .removeClass('is-checked');
      $(this)
        .parents('.option')
        .addClass('is-checked');
    }
  });
}

document.addEventListener('pageLoaded', handleOption);
