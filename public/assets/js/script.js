$(document).ready(function(){
	$('.chat_head').click(function(){
		$('.chat_body').slideToggle('slow');
	});
	$(document).on('click', '.msg_head', function(){
		$('div.msg_wrap').slideToggle('slow');
	});
	
	$(document).on('click', '.close', function(){
		$('div.msg_box').hide();
	});
    // chat box on click displays
    $(document).on('click', '.user', function(e) {
    	e.preventDefault();
        var convId = $(this).data('userId');
        //alert(convId);
        var container = $('div.monconteneur');
        if(convId != null) {
            $.ajax({
                url: '/chat_box/' + convId,
                type: "GET",
                datatype: 'html',

                success: function(html){

                    $(container).html(html);

                    // var title = $('.chat_head');
                    // title.text($(this).data(userName))

                },
                error: function (data) {
                    $.each(data.responseJSON, function (key, value) {
                        $.notify(value, "error");
                    });
                }
            });
        }
        // alert('ok');
        $('.msg_wrap').show();
        $('.msg_box').show();
    });

    $(document).on('keypress', '.msg_input', function(e){
	// $('textarea').keypress(
    // function(e){
        if (e.keyCode == 13) {
           e.preventDefault();
            //envoi du message
            var form = ('form.reply-form_pop');
            var msg = $(form).find('.txt-reply_pop');
            if(msg != '')
            {
                $.ajax({
                    url: $(form).attr('action'),
                    type: "PUT",
                    data : $(form).serialize(),
                    datatype: 'html',

                    success: function(html){
                        $.notify('message envoyer', 'success');
                    },
                    error: function (data) {
                        $.each(data.responseJSON, function (key, value) {
                            // $.notify(value, "error");
                            $.notify('Ecrivez votre message d\'abord', 'warnning');
                        });
                    }
                });

            }else{
                $.notify('Ecrivez votre message d\'abord', 'success');
            }
            var msg = $(this).val();
			$(this).val('');
			if(msg!='')
            {
                //afiichage du message encour d'envoie
                $('<div class="msg_a">'+msg+'</div>').insertBefore('.msg_push');
                $('.msg_body').scrollTop($('.msg_body')[0].scrollHeight);
            }
        }
    });
	
});

//Load Online users after 5 sec
loadMessages();

function loadMessages()
{
    if(authUserId != null)
    {
        var msgId = $(this).data('messageId');
        $.ajax({
            url: '/messages/'+ msgId,
            type: "GET",
            datatype: 'html',

            success: function(html){

                //console.log(data.users)
                //$("#faq-result").append(data);
                $('div.msg_body').html(html);

            },
            error: function (data) {
                $.each(data.responseJSON, function (key, value) {
                    $.notify(value, "error");
                });
            }
        });
        setTimeout(loadMessages, 5000);
    }
}
//
// function sendMessage()
// {
//     var form = ('form.reply-form');
//     var msg = $(form).find('.txt-reply');
//     if(msg != '')
//     {
//         $.ajax({
//             url: $(form).attr('action'),
//             type: "PUT",
//             data : $(form).serialize(),
//             datatype: 'html',
//
//             success: function(html){
//                 $('<div class="msg_b">'+msg+'</div>').insertBefore('.msg_push');
//                 $('.msg_body').scrollTop($('.msg_body')[0].scrollHeight);
//
//             },
//             error: function (data) {
//                 $.each(data.responseJSON, function (key, value) {
//                     $.notify(value, "error");
//                 });
//             }
//         });
//
//     }
// }