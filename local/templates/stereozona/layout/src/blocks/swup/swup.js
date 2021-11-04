if (!window.disableSwup) {
  initSwup();
} else {
  handleLoadEvents(['DOMContentLoaded']);
}

window.goToPage = function(url) {
  if (window.swupInstance) {
    window.swupInstance.loadPage({ url: url });
  } else {
    location.href = url;
  }
};

function initSwup() {
  var swup = new Swup({
    linkSelector: `
      a[href]:not([data-no-swup]):not([href^="http"]):not([href^="mailto:"]):not([href^="tel:"]):not([target="_blank"]):not([download]),
      a[href^="#"]:not([data-no-swup])
      `,
    containers: ['#swup', '#swup-modals'],
    cache: false,
    plugins: [
      // new SwupDebugPlugin(),
      new SwupHeadPlugin(),
      new SwupScrollPlugin({ animateScroll: false }),
      new SwupJsPlugin(window.getJSPluginOptions()),
    ],
  });

  window.swupInstance = swup;

  swup.on('transitionStart', closeModals);
  swup.on('willReplaceContent', window.loadScripts);
  swup.on('contentReplaced', onContentReplaced);
  swup.on('samePage', reloadPage);

  handleLoadEvents(['DOMContentLoaded', 'swup:contentReplaced']);
}

function handleLoadEvents(events) {
  var event = new CustomEvent('pageLoaded');

  events.forEach(function(ev) {
    document.addEventListener(ev, function() {
      document.dispatchEvent(event);
    });
  });
}

function onContentReplaced() {
  resetScroll();
  document.dispatchEvent(new CustomEvent("swup: contentReplaced", {}));
  console.log('swup: contentReplaced');
}

function closeModals() {
  $.fancybox.close();
  window.catalogClose();
}

function resetScroll() {
  window.scrollTo(0, 0);
}

function reloadPage() {
  window.location.reload();
}
