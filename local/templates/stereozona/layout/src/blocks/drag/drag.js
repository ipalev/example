function handleDrag() {
  if ($('.drag').length) {
    var slider = document.querySelector('.drag');
    var isDown = false;
    var startX;
    var scrollLeft;

    slider.addEventListener('mousedown', function(e) {
      isDown = true;
      startX = e.pageX - slider.offsetLeft;
      scrollLeft = slider.scrollLeft;
    });
    slider.addEventListener('mouseleave', function() {
      isDown = false;
    });
    slider.addEventListener('mouseup', function() {
      isDown = false;
    });
    slider.addEventListener('mousemove', function(e) {
      if (!isDown) return;
      e.preventDefault();
      var x = e.pageX - slider.offsetLeft;
      var walk = (x - startX) * 3; //scroll-fast
      slider.scrollLeft = scrollLeft - walk;
    });
  }
}
document.addEventListener('pageLoaded', handleDrag);
