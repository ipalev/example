$(document).on('click', '[data-brandcode]', function(e) {
  e.preventDefault();

  if ($(window).width() < 1200 && this.href)
    return window.location.href = this.href;

  var code = this.dataset.brandcode;
  if (!code) return false;

  $.ajax('/ajax/brand/get.php', {
    data: { brandcode: code },
    success: function(html) {
      if (!html || typeof html !== 'string') return false;
      $('.brands__aside').html(html);
    },
  });
});
