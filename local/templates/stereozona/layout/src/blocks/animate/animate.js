// Create observer
var observer = new IntersectionObserver(
  function(items) {
    items.forEach(function(item) {
      if (item.intersectionRatio > 0) {
        setTimeout(function () {
          item.target.classList.add('is-visible');
        }, 200);
      }
    });
  },
  {
    threshold: [0, 0.25, 0.5, 0.75, 1],
  }
);

var observe = function() {
  window.observerElements = $('.js-observe');

  window.observerElements.each(function(i, el) {
    observer.observe(el);
  });
};

document.addEventListener('pageLoaded', observe);
