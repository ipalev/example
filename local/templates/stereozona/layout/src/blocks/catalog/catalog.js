function initCatalogSort() {
  $('.catalog__sorting-btn').on('click', function(e) {
    e.preventDefault();
    $('.catalog__wrapper-sorting-dropdown').fadeIn(300);
    $('.catalog__sorting-overflow').fadeIn(300);
  });
  $('.catalog__sorting-overflow').on('click', function(e) {
    $('.catalog__wrapper-sorting-dropdown').fadeOut(300);
    $('.catalog__sorting-overflow').fadeOut(300);
  });
}

document.addEventListener('pageLoaded', initCatalogSort);
