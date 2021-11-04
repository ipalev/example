var phoneCodes = null;

function loadPhoneCodes() {
  return $.masksSort($.masksLoad('/assets/json/phone-codes.json'), ['#'], /[0-9]|#/, 'mask');
}

function initMaskPhone() {
  var list = phoneCodes || loadPhoneCodes();
  phoneCodes = list;

  var phoneOptions = {
    inputmask: {
      definitions: {
        '#': {
          validator: '[0-9]',
          cardinality: 1,
        },
      },
      showMaskOnHover: false,
      autoUnmask: true,
    },
    match: /[0-9]/,
    replace: '#',
    list: list,
    listKey: 'mask',
    onMaskChange: function(maskObj, completed) {
      $(this).attr('placeholder', $(this).inputmask('getemptymask'));

      var field = this;
      var isFieldValid = false;

      field.classList.remove('input--invalid');

      if (field.value[0] == '7' && field.value.length === 11)
        isFieldValid = true;

      if (!isFieldValid)
        field.dataset.invalid = "";
      else
        delete field.dataset.invalid;
    },
  };

  $('.js-mask-phone').inputmasks(phoneOptions);
}

function initMaskEmail() {
  $('.js-mask-email').each(function(i, field) {
    if (!field.inputmask) {
      $(field).inputmask({ 
        alias: 'email',
        postValidation: function () {
          var isAtSignExist = false;
          var isDomainNameExist = false;

          field.classList.remove('input--invalid');

          for (var i = 0; i < field.value.length; i++) {
            if (field.value[i] === '@' && i > 0) 
              isAtSignExist = true;

            if (field.value[i] === '.' && i < field.value.length-2) 
              isDomainNameExist = true;
          }

          if (!isAtSignExist || !isDomainNameExist)
            field.dataset.invalid = "";
          else
            delete field.dataset.invalid;

          return true;
        }
      });
    }
  });
}

document.addEventListener('pageLoaded', function() {
  initMaskPhone();
  initMaskEmail();
});
