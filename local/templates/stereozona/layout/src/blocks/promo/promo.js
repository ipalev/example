function handlePromo() {
  var $slides = $('.promo.slick-slide');
  var $preloader = $('.preloader');
  var delay = $preloader.length > 0 ? 800 : 0;

  setTimeout(function() {
    $slides.css({ opacity: 1 });
  }, delay);
}

window.addEventListener('load', handlePromo);

document.addEventListener('pageLoaded', function() {
  if (document.readyState === 'interactive') {
    window.addEventListener('load', handlePromo);
  } else {
    handlePromo();
  }
});
