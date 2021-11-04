document.addEventListener('pageLoaded', function() {
  var promocode = document.querySelector('.promocode');
  if (!promocode) return false;

  var input = promocode.querySelector('.promocode__field');
  if (!input) return false;

  input.addEventListener('focus', function() {
    if (!promocode.classList.contains('promocode--focused')) {
      promocode.classList.add('promocode--focused');
    }
  });

  var checkPromocodeBtn = promocode.querySelector('.promocode__btn');
  checkPromocodeBtn.addEventListener("click", function () {
    var isPromocodeValid = Math.random() < 0.5;

    promocode.classList.remove('promocode--success');
    promocode.classList.remove('promocode--error');

    if (isPromocodeValid)
      promocode.classList.add('promocode--success');
    else 
      promocode.classList.add('promocode--error');
  })
});
