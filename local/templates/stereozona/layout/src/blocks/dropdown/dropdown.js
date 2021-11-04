document.addEventListener('DOMContentLoaded', initDropdown);

function initDropdown() {
  $(document).on('click', '.dropdown__header', function(e) {
    e.preventDefault();
    var $this = $(this);
    var $modalFilters = $this.parents('.modal__filters');

    if ($modalFilters.length > 0) {
      $modalFilters.find('.dropdown__header').removeClass('active');
      $modalFilters.find('.dropdown__content').slideUp(300);
    }

    $this.toggleClass('active');
    $this.siblings('.dropdown__content').slideToggle(300);
  });
}
