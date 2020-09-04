$(document).ready(function() {
  $("#signIn").submit(function(event) {
    event.preventDefault();
    $("p#errormsg").html("").hide();
    $.ajax({
      url: 'back/signIn.php',
      type: 'POST',
      dataType: 'JSON',
      data: $("#signIn").serialize(),
    }).done(function(response) {
      console.log(response);
      if (response.status == "error") {
        $.each(response.error, function(key, value) {
          for (var i = 0; i < value.length; i++) {
            $('p#errormsg[data="' + key + '"]').append("<strong>" + 'WARNNING!! ' + "</strong>" + " " + value[i] + "<br>").show();
          }
        })
      }
      if (response.status == "success") {
        window.location = response.link;
      }
    }).fail(function() {
      console.log("error");
    });
  });
});
