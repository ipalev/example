document.addEventListener('pageLoaded', initCompareHover);
function initCompareHover() {
  var compareSpecsRow = $('.compare__specs-row');

  compareSpecsRow.on('mouseenter', function(e) {
    var index = $(this).data('index');
    $(this)
      .parents('.compare__specs-row-wrap')
      .siblings('.compare__specs-row-wrap')
      .find('[data-index="' + index + '"]')
      .addClass('is-hover');
  });
  compareSpecsRow.on('mouseleave', function(e) {
    var index = $(this).data('index');
    $(this)
      .parents('.compare__specs-row-wrap')
      .siblings('.compare__specs-row-wrap')
      .find('[data-index="' + index + '"]')
      .removeClass('is-hover');
  });

  var waypoints = $('.compare').waypoint({
    handler: function(direction) {
      if (direction === 'down') {
        $('.compare__top').addClass('is-sticky');
      } else if (direction === 'up') {
        $('.compare__top').removeClass('is-sticky');
      }
    },
    offset: 30,
  });
}

document.addEventListener('pageLoaded', resizeEqualHeight);
window.addEventListener('resize', resizeEqualHeight);
function resizeEqualHeight() {
  if ($(window).width() > 767) {
    let columnsAmount = $('.compare__specs-row-wrap').length
    let largestHeight = []
    
    for (let column = 0; column < columnsAmount; column++) {
      $(`.compare__specs-row-wrap:nth-child(${column+1}) > .compare__specs-row`).each((i, elem) => {
        largestHeight[i] = 
          (elem.offsetHeight > (largestHeight[i] || 0)) ? elem.offsetHeight : largestHeight[i]
      })
    }

    for (let column = 0; column < columnsAmount; column++) {
      $(`.compare__specs-row-wrap:nth-child(${column+1}) > .compare__specs-row`).each((i, elem) => {
        elem.style.height = largestHeight[i] + 'px';
      })
    }
  }
}

// Compare slider
var callbacksCompSlider = [];
var compare_settings_slider = {
  dots: false,
  arrows: true,
  infinite: false,
  slidesToShow: 2,
  slidesToScroll: 2,
  prevArrow: '.compare__slider-arrow--prev',
  nextArrow: '.compare__slider-arrow--next',
  asNavFor: $('.compare__specs-right, .compare__slider-select'),
};
function initCompSlider() {
  var $compare_slider = $('.compare__items-row');
  compare_slick_on_mobile($compare_slider, compare_settings_slider, callbacksCompSlider);
}

// Compare select
var callbacksCompSelect = [];
var compare_select_settings_slider = {
  dots: false,
  arrows: false,
  infinite: false,
  slidesToShow: 2,
  slidesToScroll: 2,
  asNavFor: $('.compare__items-row, .compare__specs-right'),
};

function initCompareSelect() {
  var $compare_select_slider = $('.compare__slider-select');
  compare_slick_on_mobile(
    $compare_select_slider,
    compare_select_settings_slider,
    callbacksCompSelect
  );
}

// Compare specs
var callbacksCompSpecs = [];
var compare_specs_settings_slider = {
  dots: false,
  arrows: false,
  infinite: false,
  slidesToShow: 2,
  slidesToScroll: 2,
  asNavFor: $('.compare__items-row, .compare__slider-select'),
};

function initCompSpecs() {
  var $compare_specs_slider = $('.compare__specs-right');
  compare_slick_on_mobile($compare_specs_slider, compare_specs_settings_slider, callbacksCompSpecs);
}

document.addEventListener('pageLoaded', handleCompares);
function handleCompares() {
  // Compare slider
  callbacksCompSlider.forEach(function(cb) {
    $(window).off('load resize', cb);
  });
  callbacksCompSlider = [];
  initCompSlider();

  // Compare select
  callbacksCompSelect.forEach(function(cb) {
    $(window).off('load resize', cb);
  });
  callbacksCompSelect = [];
  initCompareSelect();

  // Compare specs
  callbacksCompSpecs.forEach(function(cb) {
    $(window).off('load resize', cb);
  });
  callbacksCompSpecs = [];
  initCompSpecs();
}

function compare_slick_on_mobile(slider, settings, callbacks) {
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
    callbacks.push(cb);
  } else {
    $(window).on('resize', cb);
    callbacks.push(cb);
    cb();
  }
}

// Compage change/init
document.addEventListener('pageLoaded', handleCompareChange);
function handleCompareChange() {
  $('.compare__items-row').on('init reInit afterChange', function(
    event,
    slick,
    currentSlide,
    nextSlide
  ) {
    var i = (currentSlide ? currentSlide : 0) + 1;
    var slidesToShow = slick.slickGetOption('slidesToShow');
    var curPage = parseInt((i - 1) / slidesToShow) + 1;
    var lastPage = parseInt((slick.slideCount - 1) / slidesToShow) + 1;
    $('.compare__slider-info--current').text(curPage);
    $('.compare__slider-info--all').text(lastPage);
  });
}
