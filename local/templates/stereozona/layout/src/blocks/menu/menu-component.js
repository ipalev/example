document.addEventListener('Vue:init', initCatalogMenu);

function initCatalogMenu() {
  var menuNode = document.querySelector('#catalog-menu');
  var catalogMenu = createCatalogMenu(menuNode);

  loadMenu().then(function(response) {
    var list = response.data;
    catalogMenu.list = list;
  });
}

function createCatalogMenu(el) {
  return new window.Vue({
    el: el,
    computed: {
      treeList: function() {
        return flatToTree(this.list);
      },
      filteredList: function() {
        return filterByName(this.treeList, this.search);
      },
    },
    data: {
      list: [],
      search: '',
      listSearch: '',
      activeCategory: -1,
      hoverTimer: false,
    },
    mounted() {
      this.initPerfectScrollbar();

      document.querySelector('#catalog-menu').addEventListener('click', function () {
        if ($(window).width() > 1199) {
          catalogClose();
        }
      });
    },
    methods: {
      filterList(list, str) {
        return filterByName(list, str);
      },
      initPerfectScrollbar() {
        this.$nextTick(initPerfectScrollbar);
      },
      onBackClick() {
        this.listSearch = '';
        window.catalogSectionClose();
      },
      onSectionBtnClick(e) {
        var el = e.target;

        if ($(window).width() < 1200) {
          window.catalogSectionToggle(e, el);
        } else {
          window.location = el.href;
        }
      },
      onMouseover(i) {
        window.clearTimeout(this.hoverTimer);
        var self = this;
        this.hoverTimer = setTimeout(function() {
          self.activeCategory = i;
        }, 200);
      },
    },
  });
}

function loadMenu() {
  return new Promise(function(resolve) {
    var mock = 'https://run.mocky.io/v3/dd8ba982-9696-4cc0-970b-b95df93179e2';
    var url = window.BX ? '/ajax/menu/catalog/get.php' : mock;

    $.ajax(url, {
      success: function(response) {
        resolve(response);
      },
    });
  });
}

function filterByName(arr, str) {
  if (str === '') return arr;
  return arr.filter(function(item) {
    var name = item.name.toLowerCase();
    var search = str.toLowerCase();
    return name.includes(search);
  });
}

function flatToTree(arr) {
  var tree = [];
  var mappedArr = {};
  let arrElem;
  let mappedElem;

  // First map the nodes of the array to an object -> create a hash table.
  for (let i = 0, len = arr.length; i < len; i++) {
    arrElem = arr[i];
    mappedArr[arrElem.path] = arrElem;
    mappedArr[arrElem.path].list = [];
  }

  for (var path in mappedArr) {
    if (mappedArr.hasOwnProperty(path)) {
      mappedElem = mappedArr[path];
      // If the element is not at the root level, add it to its parent array of children.
      if (mappedElem.parentPath) {
        mappedArr[mappedElem.parentPath].list.push(mappedElem);
      }
      // If the element is at the root level, add it to first level elements array.
      else {
        mappedElem.root = true;
        tree.push(mappedElem);
      }
    }
  }

  return tree;
}

function initPerfectScrollbar() {
  var perfectScrollbarOptions = {
    wheelSpeed: 0.5,
    wheelPropagation: false,
  };

  var ps = new PerfectScrollbar('.menu__catalog-content', perfectScrollbarOptions);

  $('.menu__catalog-section-content').each(function() {
    var ps = new PerfectScrollbar($(this)[0], perfectScrollbarOptions);
  });

  var $menu = $('.menu__catalog-content');
  var $bg = $('.menu__catalog-bg');

  $menu[0].addEventListener('ps-scroll-y', function() {
    if (window.innerWidth >= 1200) $bg.css({ top: $menu[0].scrollTop });
  });
}
