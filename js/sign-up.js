$(document).ready(function() {
  $('#signUp').submit(function(event) {
    event.preventDefault();
    $('p#errormsg').hide().html('');
    $('p#successmsg').hide();
    $.ajax({
      url: 'back/SignUp.php',
      type: 'POST',
      dataType: 'JSON',
      data: $('#signUp').serialize(),
    }).done(function(response) {
      console.log(response);
      if (response.status == 'success') {
        $('p#successmsg').html(response.msg).show();
        setTimeout(function() {
          $('p#successmsg').html(response.msg).hide();
        }, 5000);
        $('#signUp')[0].reset();
        window.location = response.link;
      } else if (response.status == 'error') {
        $.each(response.errors, function(key, value) {
          for (var i = 0; i < value.length; i++) {
            $('p#errormsg[data="' + key + '"]').append("<strong>" + 'WARNNING!! ' + "</strong>" + " " + value[i] + "<br>").show();
          }
        });
      }
    }).fail(function() {
      console.log("request fail");
    })
  });
});
