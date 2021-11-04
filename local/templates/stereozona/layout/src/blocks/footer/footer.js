document.addEventListener('DOMContentLoaded', handleFooter);

function handleFooter() {
  $(document).on('click', '.footer__sitemap-header', function(e) {
    if ($(window).width() >= 768) return false;

    e.preventDefault();
    if ($(this).hasClass('active')) {
      $(this).removeClass('active');
      $(this)
        .siblings('.footer__sitemap-content')
        .slideUp(300);
    } else {
      $(this).addClass('active');
      $(this)
        .siblings('.footer__sitemap-content')
        .slideDown(300);
    }
  });
}
