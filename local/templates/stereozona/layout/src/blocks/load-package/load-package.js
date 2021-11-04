function dispatch(ev) {
  document.dispatchEvent(new Event(ev));
}

function loadScript(url, callback) {
  var script = document.createElement('script');
  script.onload = callback;
  script.async = true;
  script.src = url;
  document.body.appendChild(script);
}

function loadPackage(scriptID, packageName) {
  var script = document.querySelector(scriptID);

  if (script) {
    var src = script.dataset.src;
    if (!src) return false;

    if (window[packageName]) {
      dispatch(`${packageName}:init`);
    } else {
      loadScript(src, function() {
        dispatch(`${packageName}:init`);
      });
    }
  } else {
    dispatch(`${packageName}:destroy`);
  }
}

document.addEventListener('pageLoaded', function() {
  setTimeout(function () {
    loadPackage('#vue-script', 'Vue');
    loadPackage('#vuex-script', 'Vuex');
    document.loadVueScript = true;
  }, 3000);
});
