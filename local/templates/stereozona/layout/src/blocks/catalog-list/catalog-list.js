var settings_slider_clist = {
  dots: true,
  arrows: false,
  infinite: false,
  slidesToShow: 1,
  slidesToScroll: 1,
};

var callbacksClist = [];

function initClist() {
  if ($('.catalog-list--mobile').length) {
    // slider
    $slick_slider = $('.catalog-list--mobile');
    handleSlickClist($slick_slider, settings_slider_clist);
  }
}

function handleSlickClist(slider, settings) {
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
    callbacksClist.push(cb);
  } else {
    $(window).on('resize', cb);
    callbacksClist.push(cb);
    cb();
  }
}

document.addEventListener('pageLoaded', function() {
  callbacksClist.forEach(function(cb) {
    $(window).off('load resize', cb);
  });
  callbacksClist = [];
  initClist();
});
