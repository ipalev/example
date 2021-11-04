function initAlphabet() {
  var tooltip = $('[data-toggle="tooltip"]');
  var alphabetLetterBtn = $('.alphabet__letter-btn');

  if ($(window).width() < 1200) {
    alphabetLetterBtn.click(function(e) {
      e.preventDefault();
    });
  }

  tooltip
    .tooltip({
      placement: 'top',
      html: true,
      template:
        '<div class="tooltip alphabet__letter-content" role="tooltip">' +
        '<div class="tooltip-inner alphabet__letter-content-list"></div>' +
        '</div>',
      trigger: 'manual',
      offset: 0,
    })
    .on({
      mouseenter: function() {
        $('.alphabet__letter-btn').removeClass('is-active');
        $(this).addClass('is-active');

        tooltip.tooltip('hide');
        $(this).tooltip('show');

        $('.alphabet__letter-btn:not(.is-active)').addClass('inactive');
      },
      mouseleave: function() {
        $(this).removeClass('is-active');

        var leaveInterval = setInterval(function() {
          if (
            !$('.alphabet__container:hover').length && 
            !$('.alphabet__letter-content:hover').length
          ) {

            $('.alphabet__letter-btn').removeClass('inactive');
            $('.alphabet__letter-btn').removeClass('is-active');

            $(this).tooltip('hide');

            clearInterval(leaveInterval);
          }
        }.bind(this), 200);
      }
    });
}

document.addEventListener('pageLoaded', initAlphabet);
