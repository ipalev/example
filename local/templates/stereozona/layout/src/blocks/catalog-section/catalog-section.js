var settings_slider_cpage = {
  dots: true,
  arrows: true,
  infinite: false,
  slidesToShow: 3,
  slidesToScroll: 1,
};

var callbacksCPage = [];

function initCPage() {
  if ($('.catalog-page__sections-list').length) {
    // slider
    $slick_slider = $('.catalog-page__sections-list');
    handleSlickCPage($slick_slider, settings_slider_cpage);
  }
}

function handleSlickCPage(slider, settings) {
  var cb = function() {
    if ($(window).width() > 767) {
      if (slider.hasClass('slick-initialized')) {
        slider.slick('unslick');
      }
      return;
    }
    if (!slider.hasClass('slick-initialized')) {
      return slider.slick(settings);
    }
  };

  if (document.readyState === 'interactive') {
    $(window).on('load resize', cb);
    callbacksCPage.push(cb);
  } else {
    $(window).on('resize', cb);
    callbacksCPage.push(cb);
    cb();
  }
}

document.addEventListener('pageLoaded', function() {
  callbacksCPage.forEach(function(cb) {
    $(window).off('load resize', cb);
  });
  callbacksCPage = [];
  initCPage();
});
