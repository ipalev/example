function handleTooltip() {
  var tooltipTrigger = $('.tooltip__trigger');

  tooltipTrigger.on('click', function(e) {
    e.preventDefault();
  });

  tooltipTrigger.popover({
    placement: 'right',
    html: true,
    template:
      '<div class="popover tooltip__popover" role="tooltip">' +
      '<div class="popover-body tooltip__content"></div>' +
      '</div>',
    offset: 0,
  });
}

document.addEventListener('pageLoaded', handleTooltip);

$('body').on('click', function(e) {
  $('[data-toggle=popover]').each(function() {
    if (
      !$(this).is(e.target) &&
      $(this).has(e.target).length === 0 &&
      $('.popover').has(e.target).length === 0
    ) {
      $(this).popover('hide');
    }
  });
});
