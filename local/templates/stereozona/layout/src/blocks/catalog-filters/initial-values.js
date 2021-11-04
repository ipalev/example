function getCatalogFilters() {
  var data = {};

  $('[data-catalog-filter]').each(function(i, el) {
    var filterName = el.dataset.catalogFilter;

    // Boolean (radio)
    if (el.dataset.filterBool) {
      var checkedInput = el.querySelector('input:checked[type="radio"]');
      data[filterName] = checkedInput ? checkedInput.value : '';
    }

    // Range
    else if (el.dataset.filterRange) {
      var minValue = el.dataset.valueMin;
      var maxValue = el.dataset.valueMax;

      data[filterName] = {
        min: minValue ? minValue : '',
        max: maxValue ? maxValue : '',
        isRange: true,
      };
    }

    // Checkboxes
    else {
      data[filterName] = [];
      var inputs = Array.from(el.querySelectorAll(`[data-model=${filterName}]`));

      inputs.forEach(function(input) {
        if (input.checked) {
          data[filterName].push(input.id);
        }
      });
    }
  });

  return { data, keys: Object.keys(data) };
}

window.getCatalogFilters = getCatalogFilters;
