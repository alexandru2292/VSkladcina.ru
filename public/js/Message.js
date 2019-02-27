$(document).ready(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});

/**
 * This action is for show the dialog with sender user and show sender name,
 * but(dar) also(deasemenea) to(pentru)  indicate sender id to use them(pe el) for send a new message
 */
$('.showMessage').on("click",function(evt){
    var sender;
    var messageId;
    if(evt.target.id == "removeMessage")
        return;
    //For descendants of .showMessage being clicked, remove this check if you do not want to put constraint on descendants.
    if($(evt.target).closest('#removeMessage').length)
        return;
    //Do processing of click event here for every element except with id removeMessage

    /**
     * Add and remove class Active
     */
    $(".showMessage").removeClass("active");
    $(this).addClass("active");

    sender = $(this).data('sender');

    messageId = $(this).data('message-id');

    var newMes = $("#newMessageId_"+sender).is(":visible");

    /**
     * check if isset new message to read it
     */
    if(newMes){
       var hideRedPoint = 1;
    }else{
        var hideRedPoint = 0;
    }
    /**
     * Show sender name for right window with dialog
     * @type {jQuery}
     */
    var senderName = $(this).find(".senderName").data('sender-name');
    $("#senderName").empty().text(senderName);

    /**
     * set sender id in the textarea data
     */
    showMessage(sender, messageId, hideRedPoint);

    /**
     * Scroll bar to bottom window
     * @type {HTMLElement}
     */
    scrollBottom();
    /**
     * set attribute data-sender-id for use in a send new message
     */
    $("#newMessage").data('sender-id', sender);

    /**
     * check if exist new message then show it
     */
   if($(this).hasClass('active') == true){
       checkIfExistNewMessage(sender, 0);
   }
    setInterval(function () {
        ifNewMessage();
    }, 3000);
});

/**
 * Scroll to bottom on event on mouseover
 */
$(".showMessage").on("mouseover", function () {
    scrollBottom();
});


/**
 * send new message to sender user
 */

$("#btnSendNewMessage").on("click", function () {
    sendNewMessageToSenderUser();
    scrollBottom();

});
$('#newMessage').keyup(function(e){
    if(e.which == 13){
        sendNewMessageToSenderUser();
        scrollBottom();
    }
});

function scrollBottom() {

    if ($('.scroll-pane').length){
        $('.scroll-pane').jScrollPane({
            autoReinitialise: true
        });
    }
    var scrollPane = $('.scroll-pane').jScrollPane().data('jsp');
    scrollPane.scrollToBottom();
    /**
     * if not exist red point on sender user, remove red point to message icon in header
     */
    setTimeout(function () {
        if($(".message--new").length == 1 && $(".showMessage:first .message--new").data('flag') == 1){
            $("#iconMessage").removeClass("btn-toggle--active");
        }
    }, 4000)
}

function sendNewMessageToSenderUser() {
    var message = $("#newMessage").val();
    var senderId = $("#newMessage").data('sender-id');
    var data = {sender_user_id: senderId, message: message};
    $.ajax({
        url: "/profile/sendNewMessage",
        method: "POST",
        data: data,
        success: function (data) {
            if(data['success']){
                $("#newMessage").val('');
                $("#showDialog .jspPane").append(data['dialog']);

                /**
                 * scroll bar to bottom
                 */
                scrollBottom();
            }
        }
    });
}

/**
 * if exist conversation
 */

if ($(".showMessage .message-menu__item-img").length > 0){
    $(".getFirstDialog .showMessage:first").addClass("active");

    /**
     * Verified if exist new message to add a class with red point to message icon
     */
    ifNewMessage();
    /**
     * Show first  dialog in the right window
     * @type {jQuery}
     */
    var firstSenderId = $(".getFirstDialog .showMessage").first().data('sender');
    var firstMessageId = $(".getFirstDialog .showMessage").first().data('message-id');
    var senderName = $(showMessage).first().find(".senderName").data('sender-name');
    $("#senderName").empty().text(senderName);

    showMessage(firstSenderId, firstMessageId, 0);

    setTimeout(function () {
        /**
         * Mark as a read message
         */
        updateIsRead(firstSenderId, 1);


    }, 4000);

    /**
     * set attribute data-sender-id for use in a send new message (in textarea attribute)
     */
    var senderId = $(".showMessage:first").data('sender');

    $("#newMessage").data('sender-id', senderId);

    /**
     * Check if exist new message then show it
     * @param setTimeOut_read - use in case we need hide red point after 5 second
     */

    checkIfExistNewMessage(senderId, 1);


     /**
     * scroll to bottom dialog window
     */
    scrollBottom();

    setInterval(function () {
        ifNewMessage();

    }, 3000);


}

/**
 * update columns is_read
 * @param firstSenderId
 * @param intervalUpdate
 */

function updateIsRead(firstSenderId, intervalUpdate) {
    var data = {sender_user_id: firstSenderId, intervalUpdate: intervalUpdate};
    $.ajax({
        url: "/profile/updateIsReadColumn",
        method: "POST",
        data: data,
        success: function (data) {
            if(data['success']){
                $("#newMessageId_"+firstSenderId).hide();

                /**
                 * if not exist red point on sender user, remove red point to message icon in header
                 */
                var cntVisibleMsgs = $(".message--new:visible").length;

                if(cntVisibleMsgs < 1){

                    $("#iconMessage").removeClass("btn-toggle--active");


                }
            }


           setTimeout(function () {
               /**
                * if not exist red point on sender user, remove red point to message icon in header
                */
               // if($(".message--new:visible").length < 1){
               //     alert($(".message--new:visible").length) ;
               //     $("#iconMessage").removeClass("btn-toggle--active");
               // }


           }, 1000)
            // $(".showMessage").each(function (index) {
            //     if($(".showMessage .message-menu__item-content .message-menu__item-title .message--new")
            //         .attr('id', "newMessageId_"+ $(this).data('sender'))
            //         .css("display") != "inline-block")
            //     {
            //         // $("#iconMessage").removeClass("btn-toggle--active");
            //         alert("treb sa dispara")
            //     }
            // });
        }
    });
}

/**
 * Verified if exist new message then add Class with red point to message icon
 */
function ifNewMessage() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "/profile/ifNewMessage",
        method: "POST",
        success: function (data) {
            if(data['success']){
                $("#iconMessage").addClass("btn-toggle--active");
                /**
                 * if exist new message then add red point on sender user
                 */
                // $.each(data['senders'], function (index, senderId) {
                //     $(".showMessageRed_"+senderId).addClass("btn-toggle--active");
                // });
                // alert("Daa");
            }else{
                $("#iconMessage").removeClass("btn-toggle--active");
            }
        }
    });

}

/**
 * Event after loaded page
 */
document.addEventListener("DOMContentLoaded", function() {
    /**
     * Verified if exist new message
     */
    ifNewMessage();
});

setInterval(function () {
    ifNewMessage();
}, 3000);
/**
 * This function return a dialog with sender and logged user
 * @param sender_id
 * @param messageId
 * @param hideRedPoint
 */
function showMessage(sender_id, messageId, hideRedPoint){
    // console.log('sender -- ' +sender_id +'; messageId --- ' + messageId + '; hideRedPoint --' +hideRedPoint)
    var data = {sender_user_id: sender_id, message_id: messageId, hideRedPoint: hideRedPoint};
    $.ajax({
        url: "/profile/showDialog",
        method: "POST",
        data: data,
        success: function (data) {
            if($("#showDialog .jspPane").length) {

                $("#showDialog .jspPane").empty().append(data['dialogs']);
            } else {
                $("#showDialog").empty().css('overflow', 'auto').append(data['dialogs']);
            }

          if(data['updateIsRead']){
              $("#newMessageId_"+sender_id).hide();
              var cntVisibleMsgs = $(".message--new:visible").length;
              if(cntVisibleMsgs < 1){
                  $("#iconMessage").removeClass("btn-toggle--active");
              }
          }
          scrollBottom();
        }
    });
}

/**
 * Send sender_id in the confirm delete button
 */
$(".removeMessage").on("click", function () {
    var senderId = $(this).data('sender-id');
    alert(senderId);
    $("#confirm-msg-delete").data('sender-id', senderId);
});

/**
 * Delete the dialog
 */
$("#confirm-msg-delete").on("click", function () {
   var sender_user_id = $(this).data('sender-id');
    var data = {sender_user_id: sender_user_id};
    console.log(sender_user_id +' ----' + data);
    $.ajax({
        url: "/profile/removeDialog",
        method: "POST",
        data: data,
        success: function (data) {
          if(data['success']){
             location.reload();
          }
        }
    });
});


/**
 * Check if exist new massage show it
 * @param setTimeOut_read - use in case we need hide red point after 5 second
 * @param senderId - it is sender to send message
 */


function checkIfExistNewMessage(senderId, setTimeOut_read){
    /**
     * Set interval for checking if exist new message
     */
    setInterval(function () {
        /**
         * Don't have repeat message
         */
        var lastMessage =  $("#showDialog .comment-item:last .comment-item__text").text();

        $.ajax({
            url: "/profile/checkIfExistNewMessage",
            method: "POST",
            data: {sender_user_id: senderId, lastMessage: lastMessage},
            success: function (data) {
                if(data['success'] ==1){
                    /**
                     * If this showMessage > data('sender') == senderId from DB then show This message else don't show
                     */
                    $(".showMessage" ).each(function( index ) {
                        if($( this ).hasClass('active') && $( this ).data('sender') == data['senderId']){
                            $("#showDialog .jspPane").append(data['message']);
                        }
                    });
                    /**
                     * hide red point if exist new message and mark the message as reading
                     */
                    if(setTimeOut_read == 1){
                        setTimeout(function () {
                            $("#newMessageId_"+senderId).hide();
                        }, 5000)
                    }

                    /**
                     * Scroll bar to bottom window
                     * @type {HTMLElement}
                     */
                    scrollBottom();
                }
            }
        });
     }, 2000);
}


/**
 * Onclick on User from page http://vskladcine.ru/card/4
 */

$(".user_item_popup").on("click", function () {
    /**
     * set the analogue url as the laravel method url()
     * @type {string}
     */
    var url = window.location.href;
    var arr = url.split("/");
    var myUrl = arr[0] + "//" + arr[2]
    /**
     * get value about user
     */
    var user_img = $(".user_item_popup:first").data('user-img');
    var user_name = $(".user_item_popup:first").data('user-name');
    var user_role = $(".user_item_popup:first").data('user-role');
    var user_id = $(".user_item_popup:first").data('user-id');
    var user_created_at = $(".user_item_popup:first").data('user-created_at');


    //set image
    if(user_img.split('://').length > 1){
        $("#popup-user .user__img img").attr('src', user_img);
    }else{
        $("#popup-user .user__img img").attr('src', myUrl +'/img/content/'+user_img);
    }
    //set the user name

   $("#popup-user .user__title").text(user_name);
    //set the user role
   $("#popup-user .user__status").text(user_role);
   //set user_id
   $("#popup-user .user__btn-message").data('user-id', user_id);
   //set user created_at
    $("#popup-user #created_at").text(user_created_at);
});
$("#write-a-message").on("click", function () {
    var user_name = $(".user_item_popup:first").data('user-name');
    $("#popup-user-message .popup-title").text("Сообщение "+user_name);


});


/**
 * Send Message to creator stiock
 */
$("#btn-send-message").on("click",function () {
    var messageForUser = $("#popup-user-message textarea[name=message]").val();
    var user_id = $(".user_item_popup:first").data('user-id');
    var data = {sender_user_id: user_id, message: messageForUser};
    $.ajax({
        url: "/profile/sendNewMessage",
        method: "POST",
        data: data,
        success: function (data) {
            if(data['success']){
                $("#successSent").text('Сообщение успешно отправлено');
                setTimeout(function () {
                    $.fancybox.close({
                        src  : '#popup-user-message',
                        type : 'inline',
                        opts : {
                            animationEffect: "fade",
                        }

                    });
                    $("#successSent").text('');
                    $("#popup-user-message textarea[name=message]").val('');
                }, 2000)
            }
        }
    });
});





