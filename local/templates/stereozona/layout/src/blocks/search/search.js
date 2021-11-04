function searchToggle(e) {
  let search = searchPosition();
  search
    .fadeToggle('fast')
    .find('input')
    .focus();

  $('.header').toggleClass('header--search-active');
}

function searchPosition() {
  let w = $('#menu').outerWidth();
  let offset = $('#catalog-btn').outerWidth();
  let search = $('#search-header');
  if ($(window).width() > 1199) {
    search.outerWidth(w - offset).css('left', offset + 'px');
  } else {
    search.css('width', '100%');
  }
  return search;
}

$(window).resize(function() {
  searchPosition();
});
