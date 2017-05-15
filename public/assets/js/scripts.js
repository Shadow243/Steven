(function ($) {
    $('.comment-form').hide();
    $('.show-comment').click(function () {
        $(this).parent().find('.comment-form').slideDown();
        ///$(parent).find('.comment-form').slideDown();

    })

    //script pour j'aime
    $('.jaimebutton').on('click', function (e) {
        var link = $(this);
        $.ajax({
            type: $(link).click(),
            url: $(link).attr('href'),
            data: link.serialize(),
            success: function (response) {
                alert(response.msg);
            },
            error: function () {

            }
        });
        return false;
    });
       // script pour commenter
    $('.comment-form').on('submit', function (e) {
          var form = $(this);
          $.ajax({
              type: $(form).attr('method'),
              url: $(form).attr('action'),
              data: form.serialize(),
              success: function (data) {
                  alert(data.msg)

                  $(form).find('.comment-content').val('');
                  form.fadeOut();
              } ,
              error: function (reponse) {
                  
              }
              
          });
          //console.log(form.serialize());
         return false;
    });
})(jQuery);