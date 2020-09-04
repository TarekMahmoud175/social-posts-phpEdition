$(document).ready(function($) {
  $('.info_header').click(function(event) {
    event.preventDefault();
    $('.info').toggle('slow');
  });
});
