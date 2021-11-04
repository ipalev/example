(function start () {
  var $body = $('body');
  var $front = $('.front');
  var $preloader = $('.preloader');
  var $bg = $('.preloader__bg');

  if ($preloader.length <= 0) return false;

  if ($front.length <= 0) {
    setTimeout(function() {
      $bg.fadeOut(300);
      $body.removeClass('preload');
    }, 100);

    return
  }

  var $logo = $('.preloader__img');
  var header = $('.header__bottom')[0];
  var headerRect = header.getBoundingClientRect();
  var headerTopMargin = headerRect.top;
  var height = $logo[0].getBoundingClientRect().height;

  $body.addClass('preload');

  $logo.addClass('preloader__img--show');
  setTimeout(function () {
    $logo.removeClass('preloader__img--show');

    if ($body.hasClass('preload'))
      $logo.addClass('preloader__img--pulse');
  }, 2000);

  $logo.css({
    top: 0,
    transform: `translate(-50%, ${window.innerHeight / 2 - height / 2 - headerTopMargin}px)`
  });

  window.addEventListener('load', initAnimations);
})();

function initAnimations() {
  var $body = $('body');
  var $bg = $('.preloader__bg');
  var $logo = $('.preloader__img');
  var front = $('.front')[0];
  var scaleY = front.offsetHeight / window.innerHeight;
  var y = front.offsetTop;

  animateLogo();
  animateHeader();
  $bg.css({ transform: `translateY(${y}px) scaleY(${scaleY})`, opacity: 0 });

  setTimeout(function() {
    $bg.hide();
    $body.removeClass('preload');
    $logo.removeClass('preloader__img--pulse');
  }, 1400);
}

function animateLogo() {
  var $logo = $('.preloader__img');
  var header = $('.header__bottom')[0];
  var headerRect = header.getBoundingClientRect();
  var logoRect = $logo[0].getBoundingClientRect();
  var top = (headerRect.height - logoRect.height) / 2;

  $logo.removeClass('preloader__img--pulse');

  setTimeout(function() {
    $logo.addClass('preloader__img--trs');
    $logo.css({ transform: `translate(-50%, ${top}px)` });
  }, 125);
}

function animateHeader() {
  var $headerTop = $('.header__city, .header__phone, .header__top-menu');
  var $header = $('.header__bottom, .header__top-line, .header');
  $headerTop.css({ transform: 'translateY(0px)', opacity: 1 });
  $header.css({ opacity: 1 });
}
