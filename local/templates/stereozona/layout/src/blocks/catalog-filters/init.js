var asideFilter;
var modalFilter;

document.addEventListener('onFilterRequestStarted', onFilterRequestStarted);
document.addEventListener('onFilterRequestCompleted', onFilterRequestCompleted);
document.addEventListener('onBeforeFilterReset', onBeforeFilterReset);
document.addEventListener('pageLoaded', initFilters);
document.addEventListener('pageLoaded', checkNumbersVisibility);

$(document).on('beforeShow.fb', beforeModalShow);
$(document).on('beforeClose.fb', beforeModalClose);

function initFilters() {
  if (window.store) {
    createFilters();
  } else {
    document.addEventListener('store:init', createFilters);
  }
}

function createFilters() {
  var asideNode = document.querySelector('#catalog-filters-aside');
  var modalNode = document.querySelector('#catalog-filters-modal');

  window.store.dispatch('catalogfilter/setLoading', false);

  // Destroy old
  if (asideFilter && asideFilter.$destroy) asideFilter.$destroy();
  if (modalFilter && modalFilter.$destroy) asideFilter.$destroy();

  // Init new
  if (asideNode) asideFilter = window.createCatalogFilter(asideNode);
  if (modalNode) modalFilter = window.createCatalogFilter(modalNode);

  document.dispatchEvent(new Event('catalog-filters:init'));
}

function onFilterRequestStarted() {
  window.store.dispatch('catalogfilter/setLoading', true);
}

function onFilterRequestCompleted(e) {
  var detail = e.detail;
  var resultsUrl = detail.resultsUrl;
  var count = detail.foundCount;
  var checkboxNum = detail.checkboxNum;
  var rangeFiltersDiapasonList = detail.ranges

  if (detail.instantReload) {
    replaceCatalogContent(resultsUrl);
  }

  window.store.dispatch('catalogfilter/setLoading', count <= 0);
  window.store.dispatch('catalogfilter/setRequestResponse', {
    count: count,
    text: `${count} ${declension(count, 'товар', 'товара', 'товаров')}`,
    url: resultsUrl,
  });

  if (checkboxNum) {
    var keys = Object.keys(checkboxNum);

    keys.forEach(function(key) {
      var num = window.parseInt(checkboxNum[key]);

      // Бежим по циферкам в чекбоксе
      var numbers = Array.from(document.querySelectorAll(`.num_${key}`));

      numbers.forEach(function(el) {
        var checkbox = el.closest('.checkbox');

        if (num <= 0) {
          checkbox.classList.add('u-hidden');
        } else {
          checkbox.classList.remove('u-hidden');
        }

        el.textContent = num;
      });
    });
  }

  if(rangeFiltersDiapasonList) {
    var rangeFilterCodes = Object.keys(rangeFiltersDiapasonList);

    rangeFilterCodes.forEach(code => {
      var rangeFilterInputs = Array.from(document.querySelectorAll(`[name="${code}"]`));

      rangeFilterInputs.forEach(input => {
        if(rangeFiltersDiapasonList.hasOwnProperty(code)) {
          input.placeholder = rangeFiltersDiapasonList[code];
        }
      });
    });
  }
}

function onBeforeFilterReset() {
  window.store.dispatch('catalogfilter/resetRequestResponse');
}

function checkNumbersVisibility() {
  if (!document.querySelector('#catalog-filters-modal')) return false;

  // Бежим по циферкам в чекбоксе
  var numbers = Array.from(document.querySelectorAll('.checkbox__amount'));

  numbers.forEach(function(el) {
    var checkbox = el.closest('.checkbox');
    var num = window.parseInt(el.textContent);

    if (num <= 0) {
      checkbox.classList.add('u-hidden');
    } else {
      checkbox.classList.remove('u-hidden');
    }
  });
}

function declension(number, one, two, five) {
  var num = number;

  num = Math.abs(num);
  num %= 100;

  if (num >= 5 && num <= 20) {
    return five;
  }

  num %= 10;
  if (num === 1) {
    return one;
  }

  if (num >= 2 && num <= 4) {
    return two;
  }

  return five;
}

function replaceCatalogContent(url, cb) {
  if (url) {
    window.isReplacingCatalog = true;
    var containerSelector = '.catalog__items-wrapper';
    var countSelector = '.catalog__count';

    loadAndReplace(url, countSelector, function() {
      loadAndReplace(url, containerSelector, function() {
        document.dispatchEvent(new Event('catalog:contentReplaced'));
        if (cb) cb();
        window.isReplacingCatalog = false;
      });
    });
  }
}

function loadAndReplace(url, selector, callback = null, isPage = true) {
  $.ajax({
    url: url,
    headers: {
      'X-Requested-With': 'load-and-replace',
      Accept: 'text/html, application/xhtml+xml',
    },
    success: function(page) {
      var container = document.createElement('div');
      container.innerHTML = page;

      if (isPage) {
        var title = container.querySelector('title');
        var titleText = document.title;
        if (title) titleText = title.textContent;

        // History record
        window.history.pushState(
          {
            url: url,
            random: Math.random(),
            source: 'swup',
          },
          titleText,
          url
        );

        // Title
        document.title = titleText;
      }

      var element = container.querySelector(selector);
      var oldElement = document.querySelector(selector);

      if(!oldElement && element) {
        let parentPrototypeSelector = 'body';

        let parentPrototype = element.parentElement;
        if(parentPrototype.id) {
          parentPrototypeSelector = '#'+parentPrototype.id;
        }

        let parent = document.querySelector(parentPrototypeSelector);

        if(parent) {
          oldElement = document.createElement('div');
          parent.insertAdjacentElement('afterbegin', oldElement);
        }
      }

      if (!container.querySelector(selector)) element = "";

      // New element
      oldElement.replaceWith(element);
      if (callback) callback();
    },
  });
}

function beforeModalShow(e, b) {
  var modalName = b.current.src;
  if (modalName !== '#modalFilters') return false;
  modalFilter.filtersBeforeModal = Object.assign({}, modalFilter.filters);
}

function beforeModalClose(e, b) {
  var modalName = b.current.src;
  if (modalName !== '#modalFilters' || window.isReplacingCatalog) return false;

  window.store.dispatch(
    'catalogfilter/setFilters',
    Object.assign({}, modalFilter.filtersBeforeModal)
  );
}
