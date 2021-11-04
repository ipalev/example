var easing = 'cubicBezier(.65,.0,.35,1)';

window.fadeTrs = {
  in: function(next) {
    anime({
      targets: '#swup, .footer',
      opacity: [0, 1],
      duration: 400,
      easing: easing,
      complete: function() {
        setTimeout(next, 0);
      },
    });
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
