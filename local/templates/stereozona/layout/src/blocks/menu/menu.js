function missClick(selector, event) {
  let div = $(selector);
  if (!div.is(event.target) && div.has(event.target).length === 0) {
    return true;
  } else {
    return false;
  }
}

function catalogToggle() {
  var $menu = $('#catalog-menu');

  if (document.loadVueScript !== true) {
    loadPackage('#vue-script', 'Vue');
    document.loadVueScript = true;
  }

  if ($menu.hasClass('is-show')) {
    catalogClose();
  } else {
    catalogOpen();
  }
}

function catalogMobToggle() {
  $('#catalog-mob').toggleClass('is-show');
}

function catalogClose() {
  var $menu = $('#catalog-menu');

  $menu.removeClass('is-show');

  if ($(window).width() >= 1200) {
    setTimeout(function() {
      $menu.hide();
    }, 800);
  }
}

function catalogOpen() {
  var $menu = $('#catalog-menu');

  if ($(window).width() >= 1200) {
    $menu.show();
  }

  setTimeout(function() {
    $menu.addClass('is-show');
  }, 0);
}

function catalogSectionToggle(e, link) {
  if ($(window).width() < 1200) {
    let section = $(link).next('.menu__catalog-section-content');
    e.preventDefault();
    section.addClass('is-show');
  }
}

function closeAllMenu() {
  if ($(window).width() < 1200) {
    $('#catalog-menu').removeClass('is-show');
    $('#catalog-mob').removeClass('is-show');
  }
}

function catalogSectionClose() {
  $('.menu__catalog-section-content').removeClass('is-show');
}

$(document).on('click', function(e) {
  if (missClick('#catalog-menu,#catalog-btn', e)) {
    catalogClose();
  }
});

