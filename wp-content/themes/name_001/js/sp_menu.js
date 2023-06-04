$(function() {
  $('#toggle').on('click', function() {
    $('body').toggleClass('is-open');
    $('#main').toggleClass('overlay');
  });
  $(document).on('click','.overlay', function() {
    $('body').removeClass('is-open');
    $('#main').removeClass('overlay');
  });
});