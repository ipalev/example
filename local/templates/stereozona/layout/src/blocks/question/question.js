function handleQuestion() {
  $(document).on('click', '.question__title', function(e) {
    e.preventDefault();

    if ($(this).hasClass('active')) {
      $(this).removeClass('active');

      $(this)
        .siblings('.question__content')
        .slideUp(300);
    } else {
      $('.question__title').removeClass('active');
      $('.question__content').slideUp(300);
      $(this).addClass('active');
      $(this)
        .siblings('.question__content')
        .slideDown(300);
    }
  });
}

document.addEventListener('DOMContentLoaded', handleQuestion);
