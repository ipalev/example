var callbacksBrand = [];

var settings_slider_brand = {
  dots: true,
  arrows: true,
  infinite: false,
  slidesToShow: 3,
  slidesToScroll: 1,
};

function initBrand() {
  if ($('.brand__section-list').length > 0) {
    // slider
    var $slick_slider = $('.brand__section-list');
    handleSlickBrand($slick_slider, settings_slider_brand);
  }
}

function handleSlickBrand(slider, settings) {
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
    callbacksBrand.push(cb);
  } else {
    $(window).on('resize', cb);
    callbacksBrand.push(cb);
    cb();
  }
}

document.addEventListener('pageLoaded', function() {
  callbacksBrand.forEach(function(cb) {
    $(window).off('load resize', cb);
  });
  callbacksBrand = [];
  initBrand();
});
