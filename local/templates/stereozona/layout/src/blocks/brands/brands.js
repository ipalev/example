document.addEventListener('DOMContentLoaded', function () {
  var header = document.querySelector('header.header');
  var brandPreview = document.querySelector('.brand-preview');
  var brandAside = document.querySelector('.brands__aside');

  if (!brandAside || !brandPreview) return;

  var brandAsidePaddingTop = window.getComputedStyle(brandAside, null).getPropertyValue("padding-top");
  var brandAsideNumberPaddingTop = Math.floor(Number(brandAsidePaddingTop.replace('px', '')));

  var brandPreviewHeight = 
    document.documentElement.clientHeight - (header.clientHeight + brandAsideNumberPaddingTop);

  brandPreview.style.height = brandPreviewHeight + 'px';
});