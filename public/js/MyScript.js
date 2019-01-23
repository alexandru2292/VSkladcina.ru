$(document).ready(function () {


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    /**
     * If uri = profile set clear blue bgcolor on Body
     * @type {string}
     */
// var uri = location.pathname.substr(1)
// if (uri == "profile") {
//     $(".bg-stars").css("display", "none");
// }
    /*--------------------------------------------*/
    /**
     * Open form register
     * @type {jQuery}
     */

    var registerError = $("#registerError").val();


    if (registerError) {
        $.fancybox.open({
            src: "#popup-registration",
            type: 'inline',
            opts: {
                afterClose: function (instance, current) {
                    $.fancybox.close();
                }
            }
        });


        $("#errorEmail").hide();
        $("#errorPassword").hide();

    }

    /**
     * Show errors in form login
     * @type {jQuery}
     */
    var loginError = $("#loginError").val();

    if (loginError) {
        // $(".dropdown-menu").css("display", "block");
        $(".openAuth").slideToggle(0);

        /**
         * Open the form login
         */
        $("#btnCloseOpen").on("click", function () {
            $(".openAuth").slideToggle(0);

        });


        /**
         * hide error for form register
         */
        $(".errorRegName").hide();
        $(".errorRegEmail").hide();
        $(".errorRegPassword").hide();
    }


    /**
     * Hide button "Dobaviti Skladcinu"
     */
    var uri = window.location.pathname;

    if(uri == "/profile/stock/add"){
        $(".addStock").hide();
    }

    /**
     *                                                              ADD STOCK
     */

    /**
     * Auto save stock Name
     */

    $("#stockName").keyup(function () {
        var val = $(this).val();
        if(val.length == 0){

            $.ajax({
                url: "/profile/stock/rmSessName",
                method: "POST",
                data: {stockName: val},

            });
        }
        $.ajax({
            url: "/profile/stock/add",
            method: "POST",
            data: {name: val},
            success: function (data) {
                if(data['name']){
                    $("#stockName").text(data['name']);
                }
            }
        });
    });

    /**
     * Auto Save TITLE Stock
     */
    $("#textarea_title").keyup(function () {
        var val = $(this).val();
        if(val.length == 0){

            $.ajax({
                url: "/profile/stock/rmSessTitle",
                method: "POST",
                data: {stockTitle: val},
                success: function (data) {
                    if(data['success']){
                        $(".title__js").text("");
                    }
                }
            });
        }
        $.ajax({
            url: "/profile/stock/add",
            method: "POST",
            data: {titleVal: val},
            success: function (data) {
                if(data['title']){
                    $(".title__js").text(data['title']);
                }
            }
        });
    });


    /**
     * Auto save paragraph
     */
    $("#textarea_paragraph").keyup(function () {
        var val = $(this).val();
        console.log(val);
        if(val.length == 0){

            $.ajax({
                url: "/profile/stock/rmSessParagraph",
                method: "POST",
                data: {stockParagraph: val},
                success: function (data) {
                    if(data['success']){
                        $(".show_paragraph").text('');
                    }
                }
            });
        }
        $.ajax({
            url: "/profile/stock/add",
            method: "POST",
            data: {paragraph: val},
            success: function (data) {
                if(data['paragraph']){
                    $(".show_paragraph").text(data['paragraph']);
                }
            }
        });
    });
    /**
     * Auto Save Image
     */

    $("#img__js").change(function (objEvent) {

        var objFormData = new FormData();
        // GET FILE OBJECT
        var objFile = $(this)[0].files[0];
        // APPEND FILE TO POST DATA
        objFormData.append('img', objFile);

        $.ajax({
            url: "/profile/stock/add",
            method: 'POST',
            contentType: false,
            data: objFormData,
            //JQUERY CONVERT THE FILES ARRAYS INTO STRINGS.SO processData:false
            processData: false,
            success: function (data) {
                if(data['img']['error']){
                    $("#errorImg").empty().append("<br>"+data['img']['error']).show();
                }else{
                    var url = window.location.href;
                    var arr = url.split(":");
                    var protocol = arr[0];
                    var imageUrl = protocol + "://"+document.domain+"/img/content/"+data['img'];
                    $('#showImg').css('background-image', 'url(' + imageUrl + ')');
                    $("#nameImg").val(imageUrl);
                    $("#errorImg").empty();
                }

            }
        });
    });
    /**
     * Auto save youtube_link
     */


    $("#yt_link").keyup(function () {
        var val = $(this).val();
        if(val.length == 0){
            $("#videoContainer").hide();
            $.ajax({
                url: "/profile/stock/rmSessYtLink",
                method: "POST",
                data: {link: val},
                success:function(data){
                    if(data['success']){
                       $("#yt_link").text(data);
                    }
                }
            });
        }
        var yt_link = $("#yt_link").val();
        var split1 =  yt_link.split('?');
        var split2 = split1[1].split("&");
        var split3 = split2[0].split("=");
        var videoId = split3[1];

        autoPlayVideo(videoId,'615','360');
        $("#videoContainer").show();

        $.ajax({
            url: "/profile/stock/add",
            method: "POST",
            data: {link: val},
            success:function(data){
                $("#yt_link").text(data);
            }
        });
    });

    /**
     * Add IFRAME with video from youtube
     *
     * @param videoId  - id video from youtube link
     * @param width
     * @param height
     */
    function autoPlayVideo(videoId, width, height){
        "use strict";
        $("#videoContainer").html('<iframe id="videoFrameYt" width="'+width+'" height="'+height+'" src="https://www.youtube.com/embed/'+videoId+'?autoplay=1&loop=1&rel=0&wmode=transparent" frameborder="0" allowfullscreen wmode="Opaque"></iframe>');
    }

    /**
     * AUTO Save the tags
     */
    $("#stockTags").keyup(function () {
        var val = $(this).val();
        if(val.length == 0){
            $.ajax({
                url: "/profile/stock/rmSessTags",
                method: "POST",
                data: {stockTags: val},
                // success:function(data){
                //     if(data['success']){
                //         $("#yt_link").text(data);
                //     }
                // }
            });
        }
        console.log(val);
        $.ajax({
            url: "/profile/stock/add",
            method: "POST",
            data: {tags: val},
        });
    });

    /**
     * Add Title  - hide other input
     */
    $("#add_title__js").on("click", function () {
        if($("#stockName").val() == "Название складчины" || $("#stockName").val() == 0){
            $("#errorTitle").show().text('Поле "название " обязательно для заполнения');
           return false;
        }
        $("#errorTitle").hide();
        showTitle();
    });
       function showTitle(){
        $(".content-text").css("margin-top", "-28px");
        $(".add_paragraph__js").hide();
        $(".title__js").hide();
        $(".show_paragraph").hide();
        $(".show_img").hide();
        $(".add_image__js").hide();
        $(".add_video__js").hide();
        $(".add_title__js").show();

        $("#add_title__js").removeClass("btn--border").addClass("active");
        $(".add_paragraph").removeClass("active").addClass("btn--border");
        $(".add_img").removeClass("active").addClass("btn--border");
        $(".add_video").removeClass("active").addClass("btn--border");
    }

    function showParagraph(){
        $(".content-text").css("margin", "0 auto");
        $(".add_title__js").hide();
        $(".show_paragraph").hide();
        $(".show_img").hide();
        $(".add_image__js").hide();
        $(".add_video__js").hide();
        $(".title__js").show();
        $(".add_paragraph__js").show();

        $("#add_title__js").removeClass("active").addClass("btn--border");
        $(".add_paragraph").removeClass("btn--border").addClass("active");
        $(".add_img").removeClass("active").addClass("btn--border");
        $(".add_video").removeClass("active").addClass("btn--border");


    }
    function showImg(){
        $(".content-text").css("margin", "0 auto");
        $(".add_paragraph__js").hide();
        $(".add_title__js").hide();
        $(".add_video__js").hide();
        $(".show_paragraph").show();
        $(".title__js").show();
        $(".show_img").show();
        $(".add_image__js").show();
        $(".add_img").removeClass("btn--border").addClass("active");
        $("#add_title__js").removeClass("active").addClass("btn--border");
        $(".add_paragraph").removeClass("active").addClass("btn--border");
        $(".add_video").removeClass("active").addClass("btn--border");
    }

    function showVideLink(){
        $(".content-text").css("margin", "0 auto");
        $(".add_paragraph__js").hide();
        $(".add_title__js").hide();
        $(".add_image__js").hide();
        $(".show_img").hide();
        $(".show_paragraph").hide();
        $(".title__js").show();
        $(".add_video__js").show();
        $(".add_img").removeClass("active").addClass("btn--border");
        $("#add_title__js").removeClass("active").addClass("btn--border");
        $(".add_paragraph").removeClass("active").addClass("btn--border");
        $(".add_video").removeClass("btn--border").addClass("active");
    }
    /**
     *  Add paragraph -  Open the input paragraph and hide other input with event ON
     */
    $(".add_paragraph").on("click",function () {
        if($("#stockName").val() == "Название складчины" || $("#stockName").val() == 0){
            $("#errorTitle").show().text('Поле "название " обязательно для заполнения');
            return false;
        }
        // $("#errorTitle").hide();
       if($("#textarea_title").val().length < 1){
             showTitle();
             $("#errorTitle").show().text('Поле "имя заголовка" обязательно для заполнения');
           return false;
       }
        $("#errorTitle").hide();
        showParagraph();
    });

    /**
     * Add Image - hide other inputs
     */
    $(".add_img").on("click", function () {
        if($("#stockName").val() == "Название складчины" || $("#stockName").val() == 0){
            $("#errorTitle").show().text('Поле "название " обязательно для заполнения');
            return false;
        }
        $("#errorTitle").hide();
        if($("#textarea_title").val().length < 1){
            showTitle();
            $("#errorTitle").show().text('Поле "имя заголовка" обязательно для заполнения');
            return false;
        }
        $("#errorTitle").hide();
        if ($("#textarea_paragraph").val().length < 1){
            showParagraph();
            $("#errorParagraph").show().text('Поле "абзац" обязательно для заполнения');
            return false;
        }
        $("#errorParagraph").hide();
        showImg();
    });

    /**
     * Add Video - hide other input 
     */
    $(".add_video").on("click", function () {
        if($("#stockName").val() == "Название складчины" || $("#stockName").val() == 0){
            $("#errorTitle").show().text('Поле "название " обязательно для заполнения');
            return false;
        }
        $("#errorTitle").hide();

        if($("#textarea_title").val().length < 1){
            showTitle();
            $("#errorTitle").show().text('Поле "имя заголовка" обязательно для заполнения');
            return false;
        }
        $("#errorTitle").hide();

        if ($("#textarea_paragraph").val().length < 1){
            showParagraph();
            $("#errorParagraph").show().text('Поле "абзац" обязательно для заполнения');
            return false;
        }
        $("#errorParagraph").hide();

        if($("#nameImg").val().length == 0){
            showImg();
            $("#errorImg").show().text('Выберите изображение ');
            return false;
        }
        $("#errorImg").hide();

        showVideLink();

        var yt_link = $("#yt_link").val();
        var split1 =  yt_link.split('?');
        var split2 = split1[1].split("&");
        var split3 = split2[0].split("=");
        var videoId = split3[1];

        autoPlayVideo(videoId,'615','360');
        if (yt_link.length > 23) {
            $("#videoContainer").show();
            return false;
        }
    });


    /**
     * Upload Min IMG AutoSave
     */

    $("#min_img").on("click", function () {
        if($("#stockName").val() == "Название складчины" || $("#stockName").val() == 0){
            $("#errorTitle").show().text('Поле "название " обязательно для заполнения');
            return false;
        }
        $("#errorTitle").hide();

        if($("#textarea_title").val().length < 1){
            showTitle();
            $("#errorTitle").show().text('Поле "имя заголовка" обязательно для заполнения');
            return false;
        }
        $("#errorTitle").hide();

        if ($("#textarea_paragraph").val().length < 1){
            showParagraph();
            $("#errorParagraph").show().text('Поле "абзац" обязательно для заполнения');
            return false;
        }
        $("#errorParagraph").hide();

        if($("#nameImg").val().length == 0){
            showImg();
            $("#errorImg").show().text('Выберите изображение ');
            return false;
        }

        $("#errorImg").hide();

        if($("#yt_link").val().length < 1){

            showVideLink();
            $("#errorYtLink").text("Поле \"видео\" обязательно для заполнения");
            return false;
        }

        var stockTags = $("#stockTags").val();
        if (stockTags.length < 1){
            showVideLink();
            $("#errorYtLink").empty().text("Поле \"Теги\" обязательно для заполнения").show();
            return false;
        }
        // $("#errorTags").hide();
    });
});


