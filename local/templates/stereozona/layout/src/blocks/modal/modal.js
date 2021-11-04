function initModalsContact(event) {
  var modalAddressBtnFind = $('.modal__address-btn--find');
  var modalAddressBtnMap = $('.modal__address-btn--map');
  var modalAddressContentItem = $('.modal__address-content-item');

  var modalContactsTabContacts = $('.modal__contacts-tab--contacts');
  var modalContactsTabOffice = $('.modal__contacts-tab--office');
  var modalContactsLeft = $('.modal__contacts-left');
  var modalContactsRight = $('.modal__contacts-right');

  modalAddressBtnFind.on('click', function(e) {
    e.preventDefault();
    $(this).hide();
    modalAddressBtnMap.css({ display: 'flex' });
    modalAddressContentItem.removeClass('modal__address-content-item--active');
    $('.modal__address-content-item--find').addClass('modal__address-content-item--active');
  });

  modalAddressBtnMap.on('click', function(e) {
    e.preventDefault();
    $(this).hide();
    modalAddressBtnFind.css({ display: 'flex' });
    modalAddressContentItem.removeClass('modal__address-content-item--active');
    $('.modal__address-content-item--map').addClass('modal__address-content-item--active');
  });

  modalContactsTabContacts.on('click', function(e) {
    e.preventDefault();
    modalContactsTabOffice.removeClass('modal__contacts-tab--active');
    modalContactsTabContacts.addClass('modal__contacts-tab--active');
    modalContactsRight.hide();
    modalContactsLeft.show();
  });

  modalContactsTabOffice.on('click', function(e) {
    e.preventDefault();
    modalContactsTabContacts.removeClass('modal__contacts-tab--active');
    modalContactsTabOffice.addClass('modal__contacts-tab--active');
    modalContactsRight.show();
    modalContactsLeft.hide();
  });

  $('body').on('click', function(e) {
    var isModal = $(e.target).is('.modal');
    var inModal = $(e.target).closest('.modal').length;
    var isModalOpen = !!$.fancybox.getInstance().current;
    var isCatalogFilter = e.target.id.includes('arrFilter');
    var isModalFilter = e.target.className.includes('modal__filter');
    var isPopupBtn = e.target.className.includes('popup__content-btn');

    if (!isModal && !inModal && isModalOpen && !isCatalogFilter && !isModalFilter && !isPopupBtn) {
      $.fancybox.close();
    }
  });
};

jQuery(document).ready(function($) {
  // Safari detect
  if (isSafari() || isMobileSafari()) $('html').addClass('is-safari');

  // Modal
  var isSideModalClosing = false;
  var isTopModalClosing = false;
  var isBotModalClosing = false;

  $(document).on('afterShow.fb', function(e, instance, slide) {
    var $content = slide.$content;
    checkTopModalsAfterShow($content);
    checkBotModalsAfterShow($content);
    checkSideModalsAfterShow($content);
  });

  $.fancybox.defaults.beforeClose = function(e, instance) {
    var $content = instance.$content;

    // Check side modals
    var classes = ['modal--left', 'modal--right', 'modal--right-narrow'];
    var hasClass = classes.some(cls => $content.hasClass(cls));

    if (hasClass && !isSideModalClosing) {
      isSideModalClosing = true;

      var sideClass = classes.find(cls => $content.hasClass(cls));
      $('.page-content').removeClass(`modal-active-${sideClass.split('--')[1]}`);
      $content.removeClass('modal--visible');
      setTimeout(function() {
        $.fancybox.close();
        isSideModalClosing = false;
      }, 800);
      return false;
    }

    // Check top modals
    classes = ['modal--top'];
    hasClass = classes.some(cls => $content.hasClass(cls));

    if (hasClass && !isTopModalClosing) {
      isTopModalClosing = true;

      $content.removeClass('modal--visible');
      setTimeout(function() {
        $.fancybox.close();
        isTopModalClosing = false;
      }, 800);
      return false;
    }

    // Check bottom modals
    classes = ['modal--bottom'];
    hasClass = classes.some(cls => $content.hasClass(cls));

    if (hasClass && !isBotModalClosing) {
      isBotModalClosing = true;

      $content.removeClass('modal--visible');
      setTimeout(function() {
        $.fancybox.close();
        isBotModalClosing = false;
      }, 800);
      return false;
    }
  };

  $(document).on('beforeClose.fb', function () {

    if ($('.modal--order-info').length)
      $('.page-content').removeClass(`modal-active-right`);
  });
});

function checkTopModalsAfterShow($content) {
  var classes = ['modal--top'];
  var hasClass = classes.some(cls => $content.hasClass(cls));

  if (hasClass) {
    $content.addClass('modal--visible');
  }
}

function checkBotModalsAfterShow($content) {
  var classes = ['modal--bottom'];
  var hasClass = classes.some(cls => $content.hasClass(cls));

  if (hasClass) {
    $content.addClass('modal--visible');
  }
}

function checkSideModalsAfterShow($content) {
  var classes = ['modal--left', 'modal--right', 'modal--right-narrow'];
  var hasClass = classes.some(cls => $content.hasClass(cls));

  if (hasClass) {
    var sideClass = classes.find(cls => $content.hasClass(cls));
    $('.page-content').addClass(`modal-active-${sideClass.split('--')[1]}`);
    $content.addClass('modal--visible');
  }
}

function isMobileDevice() {
  var check = false;
  (function(a) {
    if (
      /(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino|android|ipad|playbook|silk/i.test(
        a
      ) ||
      /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(
        a.substr(0, 4)
      )
    )
      check = true;
  })(navigator.userAgent || navigator.vendor || window.opera);
  return check;
}

function isMobileSafari() {
  var ua = window.navigator.userAgent;
  var iOS = !!ua.match(/iP(ad|hone)/i);
  var webkit = !!ua.match(/WebKit/i);
  var iOSSafari = iOS && webkit && !/(Chrome|CriOS|OPiOS)/.test(ua);

  return iOSSafari;
}

function isSafari() {
  return (
    navigator.userAgent.indexOf('Safari') != -1 &&
    navigator.userAgent.indexOf('Chrome') == -1 &&
    !isMobileDevice()
  );
}


function initCitySelect () {
  var currentCityInput = document.querySelector('.modal__city-form .bx-ui-sls-route');
  var oldCity = currentCityInput.value;
  var bxSearch = document.querySelector('.bx-ui-sls-fake');
  var defaultCity = "Санкт-Петербург";

  document.querySelector('.header__city').addEventListener('click', function () {
    var citySearchVariants = document.querySelector('.modal__city-form .bx-ui-sls-variants');

    currentCityInput.value = "";
    bxSearch.value = "";

    bxSearch.classList.add('modal__city-input');
    citySearchVariants.classList.add('modal__city-list');
  });

  window.addEventListener('mouseup', function (e) {
    if (!e.target.classList.contains('modal__close') && !e.target.classList.contains('fancybox-slide'))
      return

    onCloseModal();
  });

  window.addEventListener('click', function (e) {
    var currentCity = currentCityInput.value;
    var isModalOpen = !!$.fancybox.getInstance().current;

    if (!isModalOpen || typeof e.path == 'undefined') return;

    for (var i = 0; i < e.path.length; i++) {
      if (e.path[i] === document) return;

      if (e.path[i].classList.contains('dropdown-item')) {
        onCloseModal();
        $.fancybox.close();
        oldCity = currentCity;
        return

      } else if (e.path[i].classList.contains('quick-location-tag')) {

        var checkCityUpdate = setInterval(function () {
          if (bxSearch.value) {
            document.querySelector('.js__geo_city').innerText = bxSearch.value;
            $.fancybox.close();
            clearInterval(checkCityUpdate);
          }
        }, 200);

        return
      }
    }
  });

  document.querySelector('.modal__city-geo').addEventListener('mouseup', function () {
    navigator.geolocation.getCurrentPosition(
      function (position) {
        $.ajax({
          url: '/ajax/geo/?latitude=' + position.coords.latitude + '&longitude=' + position.coords.longitude,
          type: 'get',
          success: function (response) {
            var inputField = document.querySelector('.bx-ui-sls-fake');
            var changeEvent = new Event('change');

            inputField.value = response;
            inputField.dispatchEvent(changeEvent);
          },
          error: function () {
            var geoError = document.querySelector('.modal__city-geo-error');

            geoError.style.opacity = 1;

            setTimeout(function () {
              geoError.style.opacity = 0;
            }, 3000);
          }
        });
      },
      function (error) {
        if (error.code === 1) alert("Разрешите определение местоположения");
        else if (error.code === 2) alert("Не удалось определить местоположение");
        else if (error.code === 3) alert("Время вышло, попробуйте снова");
      }
    )
  });

  function onCloseModal () {
    if (currentCityInput.value === "") {
      document.querySelector('.js__geo_city').innerText = defaultCity;
      bxSearch.value = "";
    } else {
      document.querySelector('.js__geo_city').innerText = bxSearch.value;
      defaultCity = bxSearch.value;
    }
  }
}


function initLostPassRequest () {
  var lostPassForm = document.querySelector('.modal__form-lost-password');
  var emailInput = document.querySelector('.modal__form-lost-password .input');
  var sendBtn = document.querySelector('.modal__form-lost-password .send-btn');

  if (!lostPassForm) return;

  emailInput.addEventListener('input', function (e) {
    var field = e.currentTarget;

    if (field.dataset.invalid !== undefined)
      sendBtn.disabled = true;
    else
      sendBtn.disabled = false;
  });

  lostPassForm.addEventListener('submit', function (e) {
    e.preventDefault();
    console.log(emailInput.value);
    BX.ajax({
      url: '/ajax/auth/forgotPass/',
      method: 'post',
      dataType: 'json',
      data: {
        'USER_EMAIL': emailInput.value,
        'USER_LOGIN': emailInput.value,
        'AUTH_ACTION': 'Y'
      },
      onsuccess: function (response) {
        console.log(response);
        if (response.success) {
          document.dispatchEvent(new CustomEvent('onSuccessFormSubmit', {
            detail: {
              message: 'Вам отправлена ссылка для восстановления пароля'
            }
          }));
        } else {
          document.dispatchEvent(new CustomEvent('onErrorFormSubmit', {
            detail: {
              message: response.message
            }
          }));
        }
      },
      onfailure: function () {
        console.log('Internal Server Error');
      }
    });
  });
}


function initSwitchReceiptProductAgree () {
  var switchInput = document.querySelector('#switch-receipt-product-agree');
  var productReceiptSubmitBtn = document.querySelector('#product-receipt-submit-btn');

  if (!switchInput) return;

  if (!switchInput.checked) productReceiptSubmitBtn.disabled = true;

  switchInput.addEventListener('change', function () {
    if (!switchInput.checked)
      productReceiptSubmitBtn.disabled = true;
    else
      productReceiptSubmitBtn.disabled = false;
  });
}


function initEmailCopy () {
  var emailToCopy = document.querySelector('.modal__contacts-info-item--email');

  if (!emailToCopy) return;

  var emailLink = emailToCopy.querySelector('.contact-link');
  var emailCopyBtn = emailToCopy.querySelector('.modal__contacts-copy');

  emailLink.addEventListener('click', function (e) { e.preventDefault() })

  emailCopyBtn.addEventListener('click', function (e) {
    e.preventDefault();
    e.stopPropagation();

    var range = document.createRange();
    range.selectNode(emailLink);

    var selection = window.getSelection();
    selection.removeAllRanges();
    selection.addRange(range);

    document.execCommand("copy");
  });
}


document.addEventListener("init-contact", initModalsContact);
document.addEventListener("init-city-search", initCitySelect);

window.addEventListener('load', initLostPassRequest);
window.addEventListener('load', initSwitchReceiptProductAgree);
window.addEventListener('load', initEmailCopy);
