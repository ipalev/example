function initBreadcrumbs() {
  if ($(window).width() < 768) {
    var breadcrumbs = $('.breadcrumbs');
    var breadcrumbsLinkLength = $('.breadcrumbs__link').length;

    if (breadcrumbsLinkLength > 2) {
      breadcrumbs.addClass('is-full');
      breadcrumbs
        .find('.breadcrumbs__link:first')
        .after('<a href="#" class="breadcrumbs__icon" data-no-swup></a>');
    }

    $('.breadcrumbs__icon').on('click', function(e) {
      e.preventDefault();
      breadcrumbs.removeClass('is-full');
      $(this).remove();
    });
  }
}

document.addEventListener('pageLoaded', initBreadcrumbs);
