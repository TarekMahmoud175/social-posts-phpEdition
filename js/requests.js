$(document).ready(function() {
// ============================================================================
  //navBar brand request
  $('a#brand').click(function(event) {
    event.preventDefault();
    $.ajax({
      url: '../back/requests.php',
      dataType: 'JSON',
      data: {
        name: 'brand'
      },
    }).done(function(response) {
      if (response.empty == 'yes') {
        window.location = response.link;
      }
      if (response.empty == 'no') {
        window.location = response.link;
      }
    }).fail(function() {
      console.log("error");
    });
  });
// ============================================================================

  //home button request
  $('a#home').click(function(event) {
    event.preventDefault();
    $.ajax({
      url: '../back/requests.php',
      dataType: 'JSON',
      data: {
        name: "home"
      }
    }).done(function(response) {
      if (response.empty == "yes") {
        window.location = response.link;
      } else if (response.empty == "no") {
        window.location = response.link;
      }
    }).fail(function() {
      alert("please check your connection");
    });
  });
// ============================================================================
  //profile button request
  $('a#profile').click(function(event) {
    event.preventDefault();
    $.ajax({
      url: '../back/requests.php',
      dataType: 'JSON',
      data: {
        name: "profile",
      }
    }).done(function(response) {
      if (response.empty == "yes") {
        window.location = response.link;
      } else if (response.empty == "no") {
        window.location = response.link;
      }
    }).fail(function() {
      alert("please check your connection");
    });
  });
// ============================================================================
  //logout button request
  $('a#logout').click(function(event) {
    event.preventDefault();
    $.ajax({
      url: '../back/requests.php',
      dataType: 'JSON',
      data: {
        name: "logout",
      }
    }).done(function(response) {
      if (response.empty == "yes") {
        window.location = response.link;
      }
    }).fail(function() {
      alert("please check your connection");
    });
  });
});
// ============================================================================
$("#postForm").submit(function(event) {
  event.preventDefault();
  $.ajax({
    url: '../back/requests.php',
    dataType: 'JSON',
    data:{
      name:"post",
      post: $("#post").val(),
    }
  })
  .done(function(response){
    $("#postForm")[0].reset();
    var replaced =(response.post).replace(/\n/g,"<br>",);
    $(".posts-container").prepend(  '<div class="row justify-content-center hidden">'
    +'<div class="col-xmd-6 col-xs-12 col-xl-6 col-md-6 col-lg-6 col-sm-12">'
    +'<div class="card">'
    +"<div class='card-header post-header'>"
    +"<div class='row row-header'>"
    +"<div class=' col-7'>" + "<strong>" + response.name + "</strong>" +  "</div>"
    +"<div class='col offset-3'>"
    +"<div class='dropdown'>"
    +"<button type='button' class='btn btn-outline-warning dropdown-toggle' data-toggle='dropdown'>"
    +"</button>"
    +"<div class='dropdown-menu'>"
    +"<a class='dropdown-item edit'>" + "edit"   + "</a>"
    +"<a class='dropdown-item delete'>" + "delete" +"</a>"
    +"</div>"
    +"</div>"
    +"</div>"
    +"</div>"
    +"</div>"
    + '<div class="card-block '+response.user_id +'" id="'+response.post_id+'">'
    + "<p class='post-content'>" +replaced+ "</p>"
    + "</div>"
    + "</div>"
    + "</div>"
    + "</div>");
    var hidden_post= $(".posts-container") .children('.hidden');
    hidden_post.show('slow').removeClass('hidden').removeClass('hidden').css({display:""});
  })
  .fail(function(error){

  })
  });

 // ============================================================================

$("#postFormProfile").submit(function(event) {
  event.preventDefault();
  $.ajax({
    url: '../back/requests.php',
    dataType: 'JSON',
    data:{
      name:"post-profile",
      post: $("#post").val(),
    }
  })
  .done(function(response){
    var replaced =(response.post).replace(/\n/g,"<br>",);
    $("#postFormProfile")[0].reset();
    $(".posts-container").prepend(  '<div class="row justify-content-center hidden">'
    +'<div class="col-xmd-6 col-xs-12 col-xl-6 col-md-6 col-lg-6 col-sm-12  ">'
    +'<div class="card">'
    +"<div class='card-header post-header'>"
    +"<div class='row row-header'>"
    +"<div class=' col-7'>" + "<strong>" + response.name + "</strong>" +  "</div>"
    +"<div class='col offset-3'>"
    +"<div class='dropdown'>"
    +"<button type='button' class='btn btn-outline-warning dropdown-toggle' data-toggle='dropdown'>"
    +"</button>"
    +"<div class='dropdown-menu'>"
    +"<a class='dropdown-item edit'>" + "edit"   + "</a>"
    +"<a class='dropdown-item delete'>" + "delete" +"</a>"
    +"</div>"
    +"</div>"
    +"</div>"
    +"</div>"
    +"</div>"
    + '<div class="card-block '+response.user_id +'" id="'+response.post_id+'">'
    + "<p class='post-content'>" +replaced+ "</p>"
    + "</div>"
    + "</div>"
    + "</div>"
    + "</div>");
    var hidden_post= $(".posts-container") .children('.hidden');
    hidden_post.show('slow').removeClass('hidden').removeClass('hidden').css({display:""});
  })
  .fail(function(error){

  })
  });
 // ============================================================================
 // the new post can not be deleted
$(document).on('click', '.delete' , function(event) {
  event.preventDefault();
  var post_row = $(this).parent().parent().parent().parent().parent().parent().parent().parent();
  var element = $(this).parent().parent().parent().parent().parent().parent().children()[1];
  var post_id = element.getAttribute('id');
  var user_id = element.classList[1];
  $.ajax({
    url : "../back/requests.php",
    dataType:"JSON",
    data:{
      name    : "delete",
      post_id : post_id ,
      user_id : user_id ,
    },
  }).done(function(response){
    if(response.status == 'success'){
      post_row.hide('slow');
      post_row.remove();
    }else if(response.status == 'error')
    {
        alert("this process can not be done right now please try again later");
    }
  }).error(function(error) {
      alert("check your connection");
  });
});
 // ============================================================================

$("#search").mouseover(function(event) {
 event.preventDefault();
 alert('search is not ready please try again later')
});
 // ============================================================================
$(document).on('click', '.edit', function(event) {
  event.preventDefault();
  var element            = $(this).parent().parent().parent().parent().parent().parent().children()[1];
  var post_id            = element.getAttribute('id');
  var user_id            = element.classList[1];
  var old_post_content   = element.childNodes[0].innerHTML;
  $('.modal').modal('show');
  $('#post_edit').val(old_post_content);
$("#submit_edit").click(function(event)
{
   event.preventDefault();
   var new_post = $('#post_edit').val();
    $.ajax({
      url: '../back/requests.php',
      dataType: 'JSON',
      data: {
        name    : "edit",
        user_id : user_id,
        post_id : post_id,
        post    : new_post,
      }
    })
    .done(function(response){
      var replaced =(response.new_post).replace(/\n/g,"<br>",);
      element.childNodes[0].innerHTML=replaced;
      $('.modal').modal('hide');
    })
    .fail(function(error) {
      alert("please check your connection");
      console.log(error);
    });
  });


});
//
