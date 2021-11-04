document.addEventListener('DOMContentLoaded', function () {
  (function initOrderForm () {
    var orderForm = document.querySelector('#bx-soa-order-form');

    if (!orderForm) return;

    orderForm.addEventListener('submit', function(e) {
      e.preventDefault();

      var fields = Array.from(document.querySelectorAll('.order input.input'));
      var exceptions = ["MIDDLE_NAME"];
      var fieldsToCheck = [];
      var isFormValid = true;

      for (var a = 0; a < fields.length; a++) {
        var isFieldToCheck = true;

        for (var b = 0; b < exceptions.length; b++) {

          if (exceptions[b] === fields[a].dataset.code)
            isFieldToCheck = false;
        }

        if (isFieldToCheck)
          fieldsToCheck.push(fields[a]);
      }
      
      for (var i = 0; i < fieldsToCheck.length; i++) {
        if (!fieldsToCheck[i].value || fieldsToCheck[i].dataset.invalid !== undefined) {
          fieldsToCheck[i].classList.add('input--invalid');
          isFormValid = false;
        }
      }


      if (isFormValid) {
        var submitButtons = Array.from(document.querySelectorAll('.js-order-submit-btn'));

        for (var i = 0; i < submitButtons.length; i++) {
          submitButtons[i].classList.add('preload-animation');
        }

        window.BX.Sale.OrderAjaxComponent.doSaveAction();

      } else
        window.BX.Sale.OrderAjaxComponent.showError('Извините, остались незаполненные обязательные поля');
    });
  })();


  (function initOrderingLink () {
    var submitLink = document.querySelector('.js-order-submit-link');

    if (!submitLink) return;

    submitLink.addEventListener('click', function (e) {
      e.currentTarget.classList.add('preload-animation');
    });
  })();
});