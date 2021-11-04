var upOnScroll = function() {
  if ($(this).scrollTop() > 120) {
    $('.up').fadeIn();
  } else {
    $('.up').fadeOut();
  }
};

document.addEventListener('pageLoaded', function() {
  $(window).off('scroll', upOnScroll);

  if ($('.up').length) {
    $(window).on('scroll', upOnScroll);
  }
});

document.addEventListener('DOMContentLoaded', handleUpClick);
function handleUpClick() {
  $(document).on('click', '.up', function() {
    $('body,html').animate(
      {
        scrollTop: 0,
      },
      500
    );
    return false;
  });
}
