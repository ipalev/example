function handleOverallMobile() {
  if ($(window).width() < 768) {
    if (!$('.overall--no-border').length) {
      var waypoints = $('.overall').waypoint({
        handler: function(direction) {
          if (direction === 'down') {
            $('.overall__mobile').slideUp(300);
            $('.overall__mobile-overflow').fadeOut(300);
            $('.overall__mobile').removeClass('is-active');
          } else if (direction === 'up') {
            $('.overall__mobile').slideDown(300);
          }
        },
        offset: '100%',
      });
    }
  }
}

function handleOverallClick() {
  $('.overall__expand-link').on('click', function(e) {
    e.preventDefault();
    $('.overall__mobile-overflow').fadeToggle(300);
    $(this)
      .parent()
      .toggleClass('is-active');
  });
}

window.addEventListener('resize', handleOverallMobile);
document.addEventListener('pageLoaded', handleOverallMobile);
document.addEventListener('pageLoaded', handleOverallClick);
