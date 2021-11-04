window.loadScripts = function loadScripts() {
  var mainContentStrings = window.swupInstance.cache.pages[window.location.pathname].blocks.filter(
    function(block) {
      return block.includes('<script');
    }
  );

  if (!mainContentStrings.length || !window.BX) return false;

  mainContentStrings.forEach(part => {
    let div = document.createElement('div');
    div.innerHTML = part;

    let scripts = div.querySelectorAll('script');

    scripts.forEach(function(script) {
      window.eval(window.BX.processHTML(script.outerHTML).SCRIPT[0].JS);
    });
  });
};
