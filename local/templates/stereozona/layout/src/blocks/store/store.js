var isStoreInitialized = false;

function initStore() {
  if (!window.Vue || !window.Vuex || isStoreInitialized) return false;

  window.Vue.use(window.Vuex);

  var store = new window.Vuex.Store({
    modules: {
      catalogfilter: window.catalogFiltersStore,
    },
  });

  window.store = store;
  isStoreInitialized = true;

  document.dispatchEvent(new Event('store:init'));
}

document.addEventListener('Vue:init', initStore);
document.addEventListener('Vuex:init', initStore);
