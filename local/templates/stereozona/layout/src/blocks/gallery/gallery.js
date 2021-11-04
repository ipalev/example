function handleGallery() {
  $('.gallery__slider').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    fade: true,
    asNavFor: '.gallery__nav',
    responsive: [
      {
        breakpoint: 576,
        settings: {
          asNavFor: null,
          dots: true,
        },
      },
    ],
  });

  $('.gallery__nav').slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    asNavFor: '.gallery__slider',
    arrows: false,
    variableWidth: true,
    focusOnSelect: true,
    responsive: [
      {
        breakpoint: 576,
        settings: {
          asNavFor: null,
        },
      },
    ],
  });
}
document.addEventListener('pageLoaded', handleGallery);
