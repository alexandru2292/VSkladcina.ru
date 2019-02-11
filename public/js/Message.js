$(document).ready(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});


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

    var data = {sender_user_id: sender, message_id: messageId};
    $.ajax({
        url: "/profile/showDialog",
        method: "POST",
        data: data,
        success: function (data) {
            $("#showDialog").empty().html(data);
            if(data['success']){
                alert("da ");
            }
        }
    });
});