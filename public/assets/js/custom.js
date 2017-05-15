$(document).ready(function() {
   /*============ Chat sidebar ========*/
  // $('.chat-sidebar, .nav-controller, .chat-sidebar a').on('click', function(event) {
  //     $('.chat-sidebar').toggleClass('focus');
  // });

  $(".hide-chat").click(function(){
      $('.chat-sidebar').toggleClass('focus');
  });

    /*============ hover menu ========*/
    var timerIn = 200;
    var timerOut = 200;
    $('ul.nav li.dropdown').on('click', function() {
        $(this).find('> .dropdown-menu').stop(true, true).fadeIn(timerIn);
        $(this).addClass('open');
    }, function() {
        $(this).find('> .dropdown-menu').stop(true, true).fadeOut(timerOut);
        $(this).removeClass('open');
    });
    /*============= About Profil Request ==============*/
    $('.form-profil').on('keydown', '.add-comment-input', function (e) {
        //e.preventDefault();
       // alert(e.keyCode)
         // var form = $(this);

         // $.ajax({
         //     type: $(form).attr('method'),
         //     url: $(form).attr('action'),
         //     data: form.serialize(),
         //     success: function(response){
         //         alert(response.msg)
         //         $(form).find('.add-comment-input').val('');
         //     },
         //     error: function () {
         //
         //     }
         // });
    });
    /*============= About likes Request ==============*/
    $('a.likelink').on('click', function (e) {
         e.preventDefault();
        var link = $(this);

        $.ajax({
            type: 'GET',
            url: $(link).attr('href'),
            data: { _token: $(link).data('token')},
            success: function(response){
               // alert(response.msg)
                $.notify(response.msg, "success");
                if(response.type == 'like')
                {
                    $(link).find('i').removeClass('fa-thumbs-o-up').addClass('fa-thumbs-o-down')
                    //console.log(response.post.likes.length)
                    if(response.post.likes.length == 0)
                    {
                        $(link).append('<em class="number_likes">1</em>');
                    }else{
                        var nbField = $(link).find('.number_likes');
                        $(nbField).text(parseInt($(nbField).text()) + 1);                    
                    }

                    $(link).attr('title', 'Je n\'aime plus')
                }

            },
            error: function (data) {
                $.each(data.responseJSON, function (key, value) {
                    $.notify(value, "error");
                });
            }
        });
    });

    $("#photo_profil_user").on('change', function () {

        //Get count of selected files
        var countFiles = $(this)[0].files.length;

        var imgPath = $(this)[0].value;
        var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
        var image_holder = $("#image-holder");
        image_holder.empty();

        if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
            if (typeof (FileReader) != "undefined") {

                //loop for each file selected for uploaded.
                for (var i = 0; i < countFiles; i++) {

                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $("<img />", {
                            "src": e.target.result,
                            "class": "img-thumbnail",
                            "style": "width:160px;height:160px;"
                        }).appendTo(image_holder);
                    }

                    image_holder.show();
                    reader.readAsDataURL($(this)[0].files[i]);
                }

            } else {
                alert("This browser does not support FileReader.");
            }
        } else {
            alert("Pls select only images");
        }
    });
   //Homepage user profile previsialisation
    $("#photo_profil_user_home").on('change', function () {

        var info ='';
        //Get count of selected files
        var countFiles = $(this)[0].files.length;

        var imgPath = $(this)[0].value;
        var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
        var image_holder = $(".cover-photo");
       image_holder.empty();
       // alert(imgPath);

        if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
            if (typeof (FileReader) != "undefined") {

                //loop for each file selected for uploaded.
                for (var i = 0; i < countFiles; i++) {

                    var reader = new FileReader();
                    reader.onload = function (e) {
                       // var image_div = $(".cover-photo");
                        //image_div.attr('src', imgPath);
                        $("<img />", {
                            "src": e.target.result,
                            "class": "profile-photo img-thumbnail show-in-modal",
                        }).appendTo(image_holder);
                    }

                    image_holder.show();
                    reader.readAsDataURL($(this)[0].files[i]);
                }

            } else {
                info = "This browser does not support FileReader.";

            }
        } else {
            info = "Pls select only images";
        }
        $.notify(info, "info");
    });
    //Homepage user profile update


    $('#photo_profil_form').ajaxForm({

        dataType:   'json' ,
        clearForm: true,
            beforeSubmit:  function () {
            var input = $('#photo_profil_user');
                input.attr('disabled', function(_, attr){ return !attr});
                $(input).siblings('i').removeClass('fa-paperclip').addClass('fa-spinner fa-spin');
            },
            success:  function (data) {
                var input = $('#photo_profil_user');
                $(input).siblings('i').removeClass('fa-spinner fa-spin').addClass('fa-paperclip');
                input.removeAttr('disabled');
                $('#avatarModal').modal('hide')
                $("#image-holder").empty();
                $('.profile-image').attr('src', data.photo);
                $.notify(data.msg, "success");
            },
            error: function (data) {
                $.each(data.responseJSON, function (key, value) {
                    $.notify(value, "error");
                });
            }
    });

    $("#photo_cover_user").on('change', function () {
        var info = '';
        //Get count of selected files
        var countFiles = $(this)[0].files.length;

        var imgPath = $(this)[0].value;
        var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
        var image_previ = $(".post-image");
        var uploadform = $(".foruploading");
        var file_input_label = $(".file_input")
        image_previ.empty();
        alert(imgPath)

        if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
            if (typeof (FileReader) != "undefined") {

                //loop for each file selected for uploaded.
                for (var i = 0; i < countFiles; i++) {

                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $("<img />", {
                            "src": e.target.result,
                            "class": "img-thumbnail animated fadeInDown",
                            "style": "width:903px;height:315px;"
                        }).appendTo(image_previ);
                    }

                    image_previ.show();
                    uploadform.slideDown();
                    //file_input_label.slideUp();
                    reader.readAsDataURL($(this)[0].files[i]);
                }

            } else {
                info ="This browser does not support FileReader.";
            }
        } else {
            info = "Pls select only images";
        }
        $.notify(info, "info");
    });

    $('#photo_cover_form').ajaxForm({

        dataType:   'json' ,
        //clearForm: true,
            beforeSubmit:  function () {
            var input = $('#photo_cover_user');
                input.attr('disabled', function(_, attr){ return !attr});
                $(input).siblings('i').removeClass('fa-paperclip').addClass('fa-spinner fa-spin');
            },
            success:  function (data) {
                var input = $('#photo_cover_user');
                $(input).siblings('i').removeClass('fa-spinner fa-spin').addClass('fa-paperclip');
                input.removeAttr('disabled');
                //$('#avatarModal').modal('hide')
                $(".image-previ").empty();
                $('.cover-image').attr('src', data.MurPhoto);
                $.notify(data.msg, "success");
                $(".foruploading").slideUp();
            },
            error: function (data) {
                $.each(data.responseJSON, function (key, value) {
                    $.notify(value, "error");
                });
            }
    });

    // bind form using 'ajaxForm' 
    $('#form-profil').ajaxForm({

        dataType:   'json' ,
        //clearForm: true,
        beforeSubmit:  function () {

        },
        success:  function (data) {
            var form = $('#form-profil');
            $.notify(data.msg, "success");
            console.log(data.user);
            $(form).find('.profile-image').attr('src', data.user.photo);
            ///$(form).find('.cover-image').attr('src', data.user.MurPhoto);
        },
        error: function (data) {
            $.each(data.responseJSON, function (key, value) {
                $.notify(value, "error");
            });
        }
    });
    /*============= About comment Request ==============*/
    $('.comment-form').on('submit', function () {
        $('small.help-block').text('').hide();
        var form = $(this);
        
        $.ajax({
            type: $(form).attr('method'),
            url: $(form).attr('action'),
            data: form.serialize(),
            success: function(response){
                $(form).find('.add-comment-input').val('');
                $(form).siblings('.alert').text(response.msg).show(function () {
                    $(this).delay(2000).slideUp().fadeOut('slow');
                });
                
                var commentForm = '<li class="comment"> \
                        <a class="pull-left" href="#"> \
                        <img class="avatar" src="img/Friends/guy-3.jpg" alt="avatar"> \
                        </a> \
                        <div class="comment-body"> \
                            <div class="comment-heading"> \
                                <h4 class="comment-user-name"><a href="#"> ' + response.comment.user.name + '</a></h4> \
                                <h5 class="time"> ' + response.comment.created_at + '</h5> \
                                </div>     \
                            <p> ' + response.comment.content + '</p>  \
                        </div> \
                    </li>';

                $(form).siblings('.comments-list').append(commentForm);

            },
            error: function (data) {
                $.each(data.responseJSON, function (key, value) {
                    var input = $(form).find('input[name=' + key + ']');
                    $(input).parent().find('small').text(value).show(function () {
                        $(this).delay(3000).slideUp().fadeOut('slow');
                    });
                    $(input).parent().addClass('has-error');
                });
            }
        })
        ;
        return false;
    });
    /*about deleting a comment*/

    $('button.delete-comment').on('click', function (e) {
        e.preventDefault();
        var comment = $(this).parent().parent();
        var form = $(this).parent();
        $.ajax({
            type: 'DELETE',
            url: $(form).attr('action'),
            data: form.serialize(),
            success: function(response){
                comment.slideUp().fadeOut('slow', function () {
                    $(this).delay(1500).remove();
                });
                $(comment).parent().parent().find('div.alert').text(response.msg).show(function () {
                    $(this).delay(3000).slideUp().fadeOut('slow');
                });;

            },
            error: function (data) {
                var div = $(comment).parent().parent().find('.alert');
                div.removeClass('alert-info').addClass('alert-danger');
                $.each(data.responseJSON, function (key, value) {
                    div.append(value);
                });
            }
        });
    });

  /*============= About page ==============*/
  $(".about-tab-menu .list-group-item").click(function(e) {
      e.preventDefault();
      $(this).siblings('a.active').removeClass("active");
      $(this).addClass("active");
      var index = $(this).index();
      $("div.about-tab>div.about-tab-content").removeClass("active");
      $("div.about-tab>div.about-tab-content").eq(index).addClass("active");
  });

    /*============= Send Freindrequest ===================*/
    $("a.add-friend").on('click', function(e) {
        e.preventDefault();
        var link = $(this);
        var formData = {
            url : link.data('url'),
            userId : link.data('user'),
            _token : link.data('token'),
        }
        $.ajax({
            type: 'POST',
            url: formData.url,
            data: formData,
            success: function(response){
                $.notify(response.msg, response.type);
                $(link).parents('.suggested-'+formData.userId).fadeOut('slow', function () {
                    $(this).slideUp().remove();
                });
            },
            error: function (data) {
                $.each(data.responseJSON, function (key, value) {
                    $.notify(value, "error");
                });
            }
        });
    });  $("a.add-friend_sugestion").on('click', function(e) {
        e.preventDefault();
        var link = $(this);
        var formData = {
            url : link.data('url'),
            userId : link.data('user'),
            _token : link.data('token'),
        }
        $.ajax({
            type: 'POST',
            url: formData.url,
            data: formData,
            beforeSubmit:  function () {
                var link = $('a.add-friend_sugestion');
                link.attr('disabled', function(_, attr){ return !attr});
                $(link).siblings('i').removeClass('fa-user-plus').addClass('fa-spinner fa-spin');
            },
            success: function(response){
                $.notify(response.msg, response.type);
                $(link).parents('.suggested-'+formData.userId).fadeOut('slow', function () {
                    $(this).slideUp().remove();
                });
            },
            error: function (data) {
                $.each(data.responseJSON, function (key, value) {
                    $.notify(value, "error");
                });
            }
        });
    });


//Load Online users after 5 sec
loadOnlineUsers();

function loadOnlineUsers()
{
    if(authUserId != null)
    {
                $.ajax({
        url: '/online-users',
        type: "GET",

        success: function(data){

            //console.log(data.users)
            //$("#faq-result").append(data);
            if(data.users.length > 0)
            {
                $.each(data.users, function (key, value) {
                  // console.log(value.id);

                   var html = '<a href="javascript:register_popup('+ value.id +', ' + value.name +');" class="list-group-item">\
                    <i class="fa fa-check-circle connected-status"></i>\
                    <img src="' + value.avatar +'" class="img-chat img-thumbnail">\
                    <span class="chat-user-name">' + value.name +'</span>\
                </a>\
                   ';

                   $('div.online-users').html(html);
                });
            }else{
                $('div.online-users').html('<p> Aucun utilisateur en ligne </p>');
            }

        },
        error: function (data) {
            $.each(data.responseJSON, function (key, value) {
                $.notify(value, "error");
            });
        }
    });
    setTimeout(loadOnlineUsers, 5000);  
    }  
}


 /*============= Accept FreindRequest ===================*/
    // $("a.add-friend").on('click', function(e) {
    //     e.preventDefault();
    //     var link = $(this);
    //     var formData = {
    //         url : link.data('url'),
    //         userId : link.data('user'),
    //         _token : link.data('token'),
    //     }
    //     $.ajax({
    //         type: 'POST',
    //         url: formData.url,
    //         data: formData,
    //         success: function(response){
    //             $.notify(response.msg, response.type);
    //         },
    //         error: function (data) {
    //             $.each(data.responseJSON, function (key, value) {
    //                 $.notify(value, "error");
    //             });
    //         }
    //     });
    // });

    /*============= About scroll page ==============*/
    $(window).on('scroll',function(){
        if($(window).scrollTop()==($(document).height()-$(window).height())) {
            alert('load other post at last');
        }

        // $.ajax({
        //     url: url,
        //     type: "GET",
        //     //data:  {rowcount:$("#rowcount").val()},
        //     beforeSend: function(){
        //         //$('#loader-icon').show();
        //     },
        //     complete: function(){
        //         //$('#loader-icon').hide();
        //     },
        //     success: function(data){
        //         //$("#faq-result").append(data);
        //         $.each(data.responseJSON, function (key, value) {
        //             $.notify(value, "error");
        //         });
        //     },
        //     error: function (data) {
        //         $.each(data.responseJSON, function (key, value) {
        //             $.notify(value, "error");
        //         });
        //     }
        // });
    });

    /*===========for the windows scroll =============*/
    // $(document).ready(function(){
    //     function getresult(url) {
    //         $.ajax({
    //             url: url,
    //             type: "GET",
    //             data:  {rowcount:$("#rowcount").val()},
    //             beforeSend: function(){
    //                 // $('#loader-icon').show();
    //             },
    //             complete: function(){
    //                 // $('#loader-icon').hide();
    //             },
    //             success: function(data){
    //                 // $("#faq-result").append(data);
    //             },
    //             error: function(){}
    //         });
    //     }
    //     $(window).scroll(function(){
    //         if ($(window).scrollTop() == $(document).height() - $(window).height()){
    //             if($(".pagenum:last").val() <= $(".total-page").val()) {
    //                 alert(okokokokokoko);
    //                 // getresult('getresult.php?page='+pagenum);
    //             }
    //         }
    //     });
    // });

    // $("#photo_cover_user_home").on('change', function () {
    //
    //     //Get count of selected files
    //     var countFiles = $(this)[0].files.length;
    //
    //     var imgPath = $(this)[0].value;
    //     var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
    //     var image_previ = $(".cover-photo");
    //     var uploadform = $(".foruploading");
    //     var file_input_label = $(".file_input")
    //     image_previ.empty();
    //     // alert(imgPath)
    //
    //     if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
    //         if (typeof (FileReader) != "undefined") {
    //
    //             //loop for each file selected for uploaded.
    //             for (var i = 0; i < countFiles; i++) {
    //
    //                 var reader = new FileReader();
    //                 reader.onload = function (e) {
    //                     var image_div = $(".cover-photo");
    //                     image_div.attr('background-image', imgPath);
    //                     $("<img />", {
    //                         "src": e.target.result,
    //                         "class": "img-thumbnail animated fadeInDown",
    //                         "style": "width:903px;height:315px;"
    //                     }).appendTo(image_previ);
    //                 }
    //
    //                 image_previ.show();
    //                 uploadform.slideDown();
    //                 //file_input_label.slideUp();
    //                 reader.readAsDataURL($(this)[0].files[i]);
    //             }
    //
    //         } else {
    //             alert("This browser does not support FileReader.");
    //         }
    //     } else {
    //         alert("Pls select only images");
    //     }
    // });


})