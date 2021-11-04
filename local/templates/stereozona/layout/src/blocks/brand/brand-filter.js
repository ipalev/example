function filterByBrandName(el, input) {
  var words = el.innerText.trim().toLowerCase().split(' ');
  
  for (var i = 0; i < words.length; i++) {
    if (words[i].indexOf(input.toLowerCase()) === 0) return true;
  }
}

function filterByCategory(el, ids) {
  return ids.includes(el.dataset.brandid);
}

function filterByCountry(el, country) {
  return el.dataset.brandcountry === country;
}

function filterBrands() {
  var $brandNameInput = $('.brands__form-input');
  var $categorySelect = $('.js-select-category .select__input');
  var $countrySelect = $('.js-select-country .select__input');

  var brand = null;
  if ($brandNameInput.length > 0) {
    brand = $brandNameInput[0].value.trim().toLowerCase();
  }

  var ids = null;
  if ($categorySelect.length > 0) {
    var select = $categorySelect[0];
    var option = select.options[select.options.selectedIndex];

    if (option.dataset.brandids) {
      ids = JSON.parse(option.dataset.brandids);
    }
  }

  var country = null;
  if ($countrySelect.length > 0) {
    var select = $countrySelect[0];
    var option = select.options[select.options.selectedIndex];

    if (option.value && !('brandignore' in option.dataset)) {
      country = option.value;
    }
  }

  $('[data-brandcode]').each(function(i, el) {
    var isValidName = brand ? filterByBrandName(el, brand) : true;
    var isValidCategory = ids ? filterByCategory(el, ids) : true;
    var isValidCountry = country ? filterByCountry(el, country) : true;

    if (isValidName && isValidCategory && isValidCountry) {
      $(el).removeClass('u-hidden');
    } else {
      $(el).addClass('u-hidden');
    }
  });

  var $rows = $('.brands__row').children();
  $rows.each((i, el) => {
    var hiddenLen = $(el).find('.brand-letter__item.u-hidden').length;
    var lettersLen = $(el).find('.brand-letter__item').length;

    if (hiddenLen === lettersLen) {
      $(el).addClass('u-hidden');
    } else {
      $(el).removeClass('u-hidden');
    }
  });
}

document.addEventListener('swup:transitionStart', function() {
  var $categorySelect = $('.js-select-category .select__input');
  var $countrySelect = $('.js-select-country .select__input');

  if ($categorySelect.length > 0) {
    $categorySelect.off('change', filterBrands);
  }

  if ($countrySelect.length > 0) {
    $countrySelect.off('change', filterBrands);
  }
});

document.addEventListener('pageLoaded', function() {
  var $brandNameInput = $('.brands__form-input');
  var $categorySelect = $('.js-select-category .select__input');
  var $countrySelect = $('.js-select-country .select__input');

  filterBrands();

  if ($brandNameInput.length > 0) {
    $brandNameInput.on('input', filterBrands);
  }

  if ($categorySelect.length > 0) {
    $categorySelect.on('change', filterBrands);
  }

  if ($countrySelect.length > 0) {
    $countrySelect.on('change', filterBrands);
  }
});
