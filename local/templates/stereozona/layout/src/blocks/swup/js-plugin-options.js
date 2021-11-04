window.getJSPluginOptions = function getJSPluginOptions() {
  // Regex paths for JS Plugin
  var regex = {
    any: '(.*)',
    productTrs: '(/build)?/product(/|.html)(.*?)',
  };

  var transitions = {
    productTrs: window.productTrs,
  };
  var keys = Object.keys(transitions);

  var initialOptions = [
    {
      from: regex.any,
      out: function(next) {
        window.fadeTrs.out(next);
      },
      to: regex.any,
      in(next) {
        window.fadeTrs.in(next);
      },
    },
  ];

  var betweenPagesTransitions = keys.reduce(function(acc, curr) {
    var objs = keys
      .filter(function(fKey) {
        return fKey !== curr;
      })
      .map(function(key) {
        return {
          from: regex[curr],
          out: function(next) {
            transitions[curr].out(next);
          },
          to: regex[key],
          in: function(next) {
            transitions[key].in(next);
          },
        };
      });

    return [].concat(acc).concat(objs);
  }, []);

  var betweenAnyAndPageTransitions = keys.reduce(function(acc, curr) {
    var objs = [];

    objs.push({
      from: regex.any,
      out: function(next) {
        window.fadeTrs.out(next);
      },
      to: regex[curr],
      in: function(next) {
        transitions[curr].in(next);
      },
    });

    objs.push({
      from: regex[curr],
      out: function(next) {
        transitions[curr].out(next);
      },
      to: regex.any,
      in: function(next) {
        window.fadeTrs.in(next);
      },
    });

    return [].concat(acc).concat(objs);
  }, initialOptions);

  return [].concat(betweenAnyAndPageTransitions).concat(betweenPagesTransitions);
};
