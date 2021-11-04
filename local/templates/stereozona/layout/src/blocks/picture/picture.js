function handlePictureBtn() {
  $(document).on('click', '.picture__btn', function(e) {
    e.preventDefault();
    $(this)
      .closest('.picture')
      .find('.picture__dscr')
      .fadeToggle('fast');
  });
}

document.addEventListener('DOMContentLoaded', handlePictureBtn);
