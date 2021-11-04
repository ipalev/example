function createCatalogFilter(el) {
  var store = window.store;

  return new window.Vue({
    el: el,
    store: store,
    computed: Object.assign(
      {},
      window.Vuex.mapGetters({
        filters: 'catalogfilter/filters',
        filtersLength: 'catalogfilter/filtersLength',
        isLoading: 'catalogfilter/isLoading',
        requestResponse: 'catalogfilter/requestResponse',
      }),
      {
        selectedFilters: function() {
          var self = this;
          var selectedFilters = [];

          // Array
          var arrayKeys = Object.keys(self.filters).filter(function(key) {
            var field = self.filters[key];
            return Array.isArray(field);
          });

          arrayKeys.forEach(function(key) {
            var field = self.filters[key];

            field.forEach(function(id) {
              var $input = $('#' + id);
              var $checkbox = $input.closest('.checkbox');
              var text = $checkbox.find('.custom-control-text').text();

              var $dropdown = $input.closest('.dropdown');
              var title = $dropdown.find('.dropdown__header').text();

              selectedFilters.push({
                key: key,
                title: title,
                text: text,
                id: id,
              });
            });
          });

          // Range
          var rangeKeys = Object.keys(self.filters).filter(function(key) {
            var field = self.filters[key];
            return field.isRange;
          });

          rangeKeys.forEach(function(key) {
            var field = self.filters[key];
            var min = field.min;
            var max = field.max;

            if (!min && !max) return false;

            selectedFilters.push({
              isRange: true,
              min: min,
              max: max,
              key: key,
              id: key,
            });
          });

          return selectedFilters;
        },
      }
    ),
    data: {
      filtersBeforeModal: {},
    },
    mounted() {
      this.init();
    },
    methods: {
      init: function() {
        // Get filters
        this.$store.dispatch('catalogfilter/setFilters', window.getCatalogFilters().data);
      },
      deselectFilter: function(e, filter) {
        if (filter.isRange) {
          this.filters[filter.key].min = '';
          this.filters[filter.key].max = '';
        } else {
          var list = this.filters[filter.key].filter(function(id) {
            return id !== filter.id;
          });

          this.filters[filter.key] = list;
        }
        this.afterDeselect(filter.key);
      },
      deselectAllFilters: function() {
        var self = this;

        // Array keys
        var arrayKeys = Object.keys(self.filters).filter(function(key) {
          var field = self.filters[key];
          return Array.isArray(field);
        });

        arrayKeys.forEach(function(key) {
          self.filters[key] = [];
        });

        // Range
        var rangeKeys = Object.keys(self.filters).filter(function(key) {
          var field = self.filters[key];
          return field.isRange;
        });

        rangeKeys.forEach(function(key) {
          self.filters[key].min = '';
          self.filters[key].max = '';
        });

        this.afterDeselect(arrayKeys);
      },
      afterDeselect: function(keys) {
        var isModalOpened = document.querySelector('.fancybox-is-open .modal--filters');

        if (!Array.isArray(keys)) keys = [keys]

        // Ресетим ответ
        if (!isModalOpened) {
          store.dispatch('catalogfilter/resetRequestResponse');
        }

        if (window.smartFilter) {
          // Вызываем smartFilter
          this.$nextTick(function() {
            keys.forEach(function(key) {
              window.smartFilter.click(
                document.querySelector(`[data-model="${key}"]`),
                !isModalOpened
              );
            });
          });
        }
      },
      onSubmitClick() {
        store.dispatch('catalogfilter/setLoading', true);

        window.replaceCatalogContent(this.requestResponse.url, function() {
          $.fancybox.close();
          store.dispatch('catalogfilter/setLoading', false);
        });
      },
    },
  });
}

window.createCatalogFilter = createCatalogFilter;
