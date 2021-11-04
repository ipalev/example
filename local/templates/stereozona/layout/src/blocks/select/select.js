function handleSelect() {
  if ($('.select').length) {
    $('.select__input')
      .prepend('<option selected></option>')
      .select2({
        minimumResultsForSearch: -1,
        width: '100%',
        escapeMarkup: function(markup) {
          return markup;
        },
      });
    
    $('.select__input:not(.without-reload)').on('change', function () { 
      window.location.search = '?' + 'SECTION_ID=' + this.value 
    });
  }
}

document.addEventListener('pageLoaded', handleSelect);
