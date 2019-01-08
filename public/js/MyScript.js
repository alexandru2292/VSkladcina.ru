/**
 * Open form register
 * @type {jQuery}
 */

var errorEmail = $("#errEmail").length;
var errPassword = $("#errPassword").length;
var errName = $("#errName").length;

if (errPassword > 0 || errorEmail > 0 || errName > 0) {
    $.fancybox.open({
        src: "#popup-registration",
        type: 'inline',
        opts: {
            afterClose: function (instance, current) {
                $.fancybox.close();
            }
        }
    });
}

/**
 * Show errors in form login
 * @type {jQuery}
 */
var statusName = $("#statusName").length;
var statusEmail = $("#statusEmail").length;
var statusPassword = $("#statusPassword").length;

if (statusName > 0 || statusEmail > 0 || statusPassword > 0) {
    $(".dropdown-menu").css("display", "block");


    /**
     * Close the form if you click outside the div block
     */
    $(document).mouseup(function (e) {
        var container = $(".dropdown-menu");
        if (container.has(e.target).length === 0){
            container.hide();
        }
    });

    /**
     * Open the form login
     */
    $(".dropdown-auth").on("click", function () {
        $(".openAuth").css("display", "block");
    });
}


// if(){
//     $.fancybox.open({
//         src  : "#popup-registration",
//         type : 'inline',
//         opts : {
//             afterClose : function( instance, current ) {
//                 $.fancybox.close();
//             }
//         }
//     });
// }

//
// $("#popup-registration").on('submit', function(event){
//     event.preventDefault();
//     var $this = $(this);
//
//     // var  name_client = $this.find("[name='name']").val();
//     var  phone_client = $this.find("[name='email']").val();
//     var  email_client = $this.find("[name='password']").val();
//
//     dataForm1.append('name_client', name_client);
//     dataForm1.append('email_client', email_client);
//     dataForm1.append('phone_client', phone_client);
//     // console.log( $( this ).serialize());
//     var dataForm = new FormData(this);
//     if($this.valid()){
//
//
//         $.ajax({
//             url: "/platformselection",
//             method: "POST",
//             data: dataForm1,
//             dataType: 'JSON',
//             contentType: false,
//             cache:false,
//             processData: false,
//             success: function (data){
//                 if(data['success']){
//                     $.fancybox.close();
//                     $.fancybox.open({
//                         src  : "#thanks_2",
//                         type : 'inline',
//                         opts : {
//                             afterClose : function( instance, current ) {
//                                 location.reload();
//                             }
//                         }
//
//                     });
//                     $this.find("input:not([type='hidden'])").val(''); //krome input type hidden
//                     $this.find("textarea").val('');
//                 }
//                 if(data['success'] == 0){
//                     data.message.forEach(function(item){
//                         alert(item)
//                     });
//                 }
//                 if (thiss.hasClass("form-request-card")){
//                     localStorage.setItem('request', 'true');
//                 }
//             }
//         });
//     }
// });