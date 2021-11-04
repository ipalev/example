function initStreetviewSlider () {
  var streetviewSliderOpenBtn = document.querySelector('.modal__address-btn--find');
  var streetview = document.querySelector('.streetview');
  var photoSlider = document.querySelector('.streetview__slider--photo');
  var panorama = document.querySelector('.streetview__slider--panorama');
  var prevBtn = document.querySelector('.streetview__slider-prev-btn');
  var nextBtn = document.querySelector('.streetview__slider-next-btn');
  var panoramaCheckbox = document.querySelector('#streetview-checkbox');

  if (!photoSlider || !panorama) return;

  panoramaCheckbox.addEventListener('change', toggleView);
  streetviewSliderOpenBtn.addEventListener('click', function () {
    setSlider();
  });

  function toggleView () {
    if (panoramaCheckbox.checked) {
      streetview.classList.add('streetview--panorama');
      streetview.classList.remove('streetview--photo');
    } else {
      streetview.classList.remove('streetview--panorama');
      streetview.classList.add('streetview--photo');
    }
  }

  function setSlider () {
    $('.streetview__slider--photo').slick({
      infinite: true,
      fade: true,
      prevArrow: prevBtn,
      nextArrow: nextBtn,
      draggable: false,
      swipe: false
    });

    prevBtn.classList.remove('slick-arrow');
    nextBtn.classList.remove('slick-arrow');
  }
}

window.addEventListener('contacts-component-loaded', initStreetviewSlider)
