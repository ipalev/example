function initMap() {
  if ($('#map').length) {
    ymaps.ready(function() {
      moveStyles();

      var myMap = new ymaps.Map('map', {
          center: [59.927572, 30.358287],
          zoom: 16,
          controls: [],
        }),
        myPlacemark = new ymaps.Placemark(myMap.getCenter(), null, {
          iconLayout: 'default#image',
          iconImageHref: '/assets/img/marker.svg',
          iconImageSize: [40, 46],
          iconContentOffset: [33, 7],
          zIndex: 900,
        });

      myMap.controls.remove('zoomControl');
      myMap.controls.remove('fullscreenControl');
      myMap.controls.remove('typeSelector');
      myMap.controls.remove('routeButtonControl');
      myMap.controls.remove('trafficControl');
      myMap.controls.remove('rulerControl');
      myMap.geoObjects.add(myPlacemark);
    });
  }
}

initMap();

function moveStyles() {
  var $styles = $('[data-ymaps="css-modules"]');
  var body = document.body;
  $styles.each(function(i, style) {
    body.appendChild(style);
  });
}
