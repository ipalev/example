var easing = 'cubicBezier(.65,.0,.35,1)';

window.productTrs = {
  in: function(next) {
    if (window.innerWidth >= 992) {
      productTrsIn(next);
    } else {
      anime({
        targets: '#swup, .footer',
        opacity: [0, 1],
        duration: 400,
        easing: easing,
        complete: function() {
          setTimeout(next, 0);
        },
      });
    }
  },
  out: function(next) {
    anime({
      targets: '#swup, .footer',
      opacity: [1, 0],
      duration: 400,
      easing: easing,
      complete: function() {
        setTimeout(next, 0);
      },
    });
  },
};

function productTrsIn(next) {
  anime({
    targets: '#swup, .footer',
    opacity: [0, 1],
    duration: 600,
    easing: easing,
  });

  anime({
    targets: '.product__logo, .gallery__nav-container',
    opacity: [0, 1],
    duration: 600,
    delay: 200,
    easing: easing,
  });

  anime({
    targets: '.product__top-right',
    translateY: [72, 0],
    opacity: [0, 1],
    duration: 1000,
    delay: 400,
    easing: easing,
  });

  anime({
    targets: '.gallery__slider',
    translateY: [88, 0],
    opacity: [0, 1],
    duration: 1000,
    delay: 600,
    easing: easing,
    complete: function() {
      setTimeout(next, 0);
    },
  });
}
