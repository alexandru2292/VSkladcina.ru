var modal = document.getElementById("myModal");
var modalSuccess = document.getElementById("successModal");
var span = document.getElementsByClassName("close")[0];
// btn.onclick = function () {
//     modal.style.display = "block";
// }
$(".btn-delete-stock").on("click", function () {
    $("#confirm-msg-delete").data('stock-id',$(this).data('stock-id'));
    $("#myModal").show();
});

$("#myModal .close").on("click", function () {
   $("#myModal").hide();

});
$(".close").on("click", function () {
    $(".modal").hide();
});

$(".btn-no").on("click", function () {
   $("#myModal").hide();
});


window.onclick = function (event){
   if(event.target == modal){

        modal.style.display = "none";
       modalSuccess.style.display = "none";

    }
}


/**
 * Confirm delete
 * */
$("#confirm-msg-delete").on("click", function () {
   var stockId = $(this).data('stock-id');


    $.ajax({
        url: "/administrator/deleteStock/"+stockId,
        method: "GET",
        success: function (data) {
            if(data['success']){

                $("#myModal").hide();
                $("#stock_"+stockId).hide();

                if(data['messageSent']){
                    $("#successModal .modal-content h2").text("Складчина успешно удалена! Всем пользователям было отправлено сообщение об удаление.");
                }else{
                    $("#successModal .modal-content h2").text("Складчина успешно удалена!");
                }
                $("#successModal").show();
                /**
                 * If onclick on X fot closing modal
                 */
                $(".close").on("click", function () {
                    location.reload();
                });
                /**
                 * if onclick in exterior successModal
                 * @param event
                 */
                window.onclick = function (event){
                    if(event.target !== modal){
                       location.reload();
                    }
                }

            }
        }
    });
});