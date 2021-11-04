// Catalog filters
window.catalogFiltersStore = {
  namespaced: true,
  state: {
    filters: {},
    isLoading: false,
    requestResponse: { url: '', text: '', count: 0 },
  },
  getters: {
    requestResponse: function(state) {
      return state.requestResponse;
    },
    isLoading: function(state) {
      return state.isLoading;
    },
    filters: function(state) {
      return state.filters;
    },
    filtersLength: function(state) {
      var keys = window.getCatalogFilters().keys;

      let sum = 0;

      keys.forEach(function(key) {
        var prop = state.filters[key];
        if (Array.isArray(prop)) sum += prop.length;
      });

      return sum;
    },
  },
  mutations: {
    setRequestResponse: function(state, payload) {
      state.requestResponse = { ...payload };
    },
    setLoading: function(state, payload) {
      state.isLoading = payload;
    },
    setFilters: function(state, payload) {
      state.filters = Object.assign({}, state.filters, payload);
    },
  },
  actions: {
    setRequestResponse(ctx, payload) {
      ctx.commit('setRequestResponse', payload);
    },
    resetRequestResponse(ctx) {
      ctx.commit('setRequestResponse', {});
    },
    setFilters(ctx, filters) {
      ctx.commit('setFilters', filters);
    },
    setLoading(ctx, isLoading) {
      ctx.commit('setLoading', isLoading);
    },
  },
};
