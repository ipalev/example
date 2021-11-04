var settings_slider_card = {
  mobileFirst: true,
  arrows: false,
  dots: false,
  variableWidth: true,
};

var callbacksCard = [];

function checkPositionSlider() {
  var width = $(window).width();

  if (width <= 992) {
    $('.card-slider')
      .not('.slick-initialized')
      .slick(settings_slider_card);
  } else {
    $('.card-slider.slick-initialized').slick('unslick');
  }
}

$(window).on('resize', checkPositionSlider);
document.addEventListener('pageLoaded', checkPositionSlider);
