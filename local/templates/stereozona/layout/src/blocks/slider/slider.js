function initSlider() {
  $('.slider').each(function(i, el) {
    var $el = $(el);

    if (!$el.hasClass('slick-initialized')) {
      $el.slick({
        dots: false,
        arrows: true,
        infinite: false,
        slidesToShow: 4,
        slidesToScroll: 1,
        variableWidth: true,
        responsive: [
          {
            breakpoint: 767,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 1,
            },
          },
          {
            breakpoint: 576,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
            },
          },
        ],
      });
    }
  });
}
document.addEventListener('pageLoaded', initSlider);
