$(document).ready(function() {
// ============================================================================
  // sign in click request
  $('a#signin').click(function(event) {
    event.preventDefault();
    $.ajax({
      url: 'back/indexph.php',
      dataType: 'JSON',
      data: {
        name: "signin"
      }
    }).done(function(response) {
        window.location = response.link;
    }).fail(function() {
      alert("please check your connection");
    });
  });
  // ============================================================================
  // sign in click request
    $('a#signup').click(function(event) {
    event.preventDefault();
    $.ajax({
      url: 'back/indexph.php',
      dataType: 'JSON',
      data: {
        name: "signup"
      }
    }).done(function(response) {
        window.location = response.link;
    }).fail(function() {
      alert("please check your connection");
    });
  });
});
