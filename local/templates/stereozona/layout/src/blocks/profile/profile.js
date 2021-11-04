function handleProfile() {
  $(document).on('click', '.profile__menu-link--active', function(e) {
    e.preventDefault();
    if ($(this).hasClass('active')) {
      $(this).removeClass('active');
      $(this)
        .siblings('.profile__menu-wrap')
        .slideUp(300);
    } else {
      $(this).addClass('active');
      $(this)
        .siblings('.profile__menu-wrap')
        .slideDown(300);
    }
  });

  $(document).on('click', '#change-password', function(e) {
    e.preventDefault();
    $(this).hide();
    $('.profile__info-password-content').slideDown(300);
  });
}

document.addEventListener('DOMContentLoaded', handleProfile);
