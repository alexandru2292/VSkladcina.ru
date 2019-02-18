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
     * if exist description in category or subcategory or types create div with description data
      */
    // select description
    function showSelectDesc(){
        $(".form-item .selectpicker").each(function(){
            /**
             *
             */
            if($(this).find('option[data-description]').length){
                $(this).closest(".bootstrap-select").next().remove();
            }

            var description  =	$(this).find("option:selected").data("description");

            if($(this).find('option[data-description]:selected').length){
                $(this).closest(".bootstrap-select").after('<div class="form-item__text">' + description + '</div>');
            }
        });
    }

    showSelectDesc();

    $(".selectpicker").on("change", function(){
        showSelectDesc();
    });




    /**
     * Auto save stock Name
     */

    $("#stockName").keyup(function () {
        var val = $(this).val();
        $(this).removeClass("errorName");
        if(val.length == 0){

            $.ajax({
                url: "/profile/stock/rmSessName",
                method: "POST",
                data: {stockName: val},

            });
        }
        $("#errorName").hide();

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
                    $("#errorTitle").hide();

                }
            }
        });
    });


    /**
     * Auto save paragraph
     */
    $("#textarea_paragraph").keyup(function () {
        var val = $(this).val();

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
        $("#errorParagraph").hide();
        $.ajax({
            url: "/profile/stock/add",
            method: "POST",
            data: {paragraph: val},
            success: function (data) {
                if(data['paragraph']){
                    $(".show_paragraph").text(data['paragraph']);
                    $("#errorParagraph").hide();
                }
            }
        });
    });
    /**
     * Auto Save Image
     */
/**
 * Anulat
 */
    // $("#img__js").change(function (objEvent) {
    //
    //     var objFormData = new FormData();
    //     // GET FILE OBJECT
    //     var objFile = $(this)[0].files[0];
    //     // APPEND FILE TO POST DATA
    //     objFormData.append('img', objFile);
    //
    //     $.ajax({
    //         url: "/profile/stock/add",
    //         method: 'POST',
    //         contentType: false,
    //         data: objFormData,
    //         //JQUERY CONVERT THE FILES ARRAYS INTO STRINGS.SO processData:false
    //         processData: false,
    //         success: function (data) {
    //             if(data['img']['error']){
    //                 $("#errorImg").empty().append("<br>"+data['img']['error']).show();
    //             }else{
    //                 var url = window.location.href;
    //                 var arr = url.split(":");
    //                 var protocol = arr[0];
    //                 var imageUrl = protocol + "://"+document.domain+"/img/content/cards/"+data['img'];
    //                 $('#showImg').css('background-image', 'url(' + imageUrl + ')');
    //                 $("#BigImgHidden").val(data['img']);
    //                 $("#nameImg").val(data['img']);
    //                 $("#errorImg").empty();
    //             }
    //
    //
    //         }
    //     });
    // });
    /**
     * Auto save youtube_link
     */


    // $("#yt_link").keyup(function () {
    //     var val = $(this).val();
    //     if(val.length == 0){
    //         $("#videoContainer").hide();
    //         $.ajax({
    //             url: "/profile/stock/rmSessYtLink",
    //             method: "POST",
    //             data: {link: val},
    //             success:function(data){
    //                 if(data['success']){
    //                    $("#yt_link").text(data);
    //                 }
    //             }
    //         });
    //     }
    //     $("#errorYtLink").hide();
    //     var yt_link = $("#yt_link").val();
    //     var split1 =  yt_link.split('?');
    //     var split2 = split1[1].split("&");
    //     var split3 = split2[0].split("=");
    //     var videoId = split3[1];
    //
    //     autoPlayVideo(videoId,'615','360');
    //     $("#videoContainer").show();
    //
    //     $.ajax({
    //         url: "/profile/stock/add",
    //         method: "POST",
    //         data: {link: val},
    //         success:function(data){
    //             $("#yt_link").text(data);
    //         }
    //     });
    // });

    /**
     * Add IFRAME with video from youtube
     *
     * @param videoId  - id video from youtube link
     * @param width
     * @param height
     */
    // function autoPlayVideo(videoId, width, height){
    //     "use strict";
    //     $("#videoContainer").html('<iframe id="videoFrameYt" width="'+width+'" height="'+height+'" src="https://www.youtube.com/embed/'+videoId+'?autoplay=0&loop=1&rel=0&wmode=transparent" frameborder="0" allowfullscreen wmode="Opaque"></iframe>');
    // }
/**
 *  /Anulat
 */

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
        $("#errorTags").hide();
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
        $(".show_paragraph").show();
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
     * Upload Min IMG Validate previous input
     */

    $("#min_img").on("click", function () {
        if($("#stockName").val() == "Название складчины" || $("#stockName").val() == 0){
            $("#errorName").show().text('Поле "название " обязательно для заполнения').css("padding-bottom", "10px");
            return false;
        }
        $("#errorName").hide();
/**
 * ANULAT
 */
        //
        // if($("#textarea_title").val().length < 1){
        //     showTitle();
        //     $("#errorTitle").show().text('Поле "имя заголовка" обязательно для заполнения');
        //     return false;
        // }
        // $("#errorTitle").hide();

        // if ($("#textarea_paragraph").val().length < 1){
        //     showParagraph();
        //     $("#errorParagraph").show().text('Поле "дополнение" обязательно для заполнения').css("");
        //     // $("#textarea_paragraph").show().attr('placeholder',"Поле \"Теги\" обязательно для заполнения").addClass('errorTags');
        //     return false;
        // }
        // $("#errorParagraph").hide();

        // if($("#nameImg").val().length == 0){
        //     showImg();
        //     $("#errorImg").show().text('Выберите изображение ');
        //     return false;
        // }

        // $("#errorImg").hide();

        // if($("#yt_link").val().length < 1){
        //
        //     showVideLink();
        //     $("#errorYtLink").text("Поле \"видео\" обязательно для заполнения");
        //     return false;
        // }
/**
 *  /ANULAT
 */
        // var stockTags = $("#stockTags").val();

        // if (stockTags.length < 1){
           // showVideLink();
            //
            // var yt_link = $("#yt_link").val();
            // var split1 =  yt_link.split('?');
            // var split2 = split1[1].split("&");
            // var split3 = split2[0].split("=");
            // var videoId = split3[1];
            // autoPlayVideo(videoId,'615','360');
            // if (yt_link.length > 23) {
            //     $("#videoContainer").show();
            // }

            // $("#stockTags").css("margin-bottom", "10px");
        //
        //     $("#stockTags").show().attr('placeholder',"Поле \"Теги\" обязательно для заполнения").addClass('errorTags');
        //     return false;
        // }

        // $("#errorTags").hide();
/**
 * /Anulat
 */
    });


    /**
     *                                                                              ADD STOCK - Left Form
     */

    /**
     * Auto Save min_img
     */

    $("#min_img").change(function (objEvent) {

        var objFormData = new FormData();
        // GET FILE OBJECT
        var objFile = $(this)[0].files[0];
        objFormData.append('img_min', objFile);

        var old_img = $("#old_img").val();
        objFormData.append('old_img',old_img);

        $.ajax({
            url: "/profile/stock/add",
            method: 'POST',
            contentType: false,
            data: objFormData,
            //JQUERY CONVERT THE FILES ARRAYS INTO STRINGS.SO processData:false
            processData: false,
            success: function (data) {
                if(data['img_min']['error']){
                    $("#ImgMinError").empty().append("<br>"+data['img_min']['error']).show();
                }else{
                    var url = window.location.href;
                    var arr = url.split(":");
                    var protocol = arr[0];
                    var imageUrl = protocol + "://"+document.domain+"/img/content/cards/"+data['img_min'];
                    $("#min_img_hidden").attr('value', data['img_min']);
                    $('#showImgMin').attr('src', imageUrl);
                    $(".cover-image__img").removeClass("cover-image__img--blur");
                    $(".cover-image__title").hide();
                    $(".cover-image__subtitle").hide();
                    $("#errorImg").empty();
                    $("#ImgMinError").hide();

                    $("#old_img").val(data['img_min']);
                }
            }
        });
    });


    /**
     * Save all data from stock form
     */
    $("#createStock").on("click", function () {
        var fd = new FormData(document.querySelector("form"));
        // If isset img_min
        var min_img_hidd = $("#old_img").val().length;

        if(min_img_hidd > 0){
            var min_img = $("#old_img").val();
        }else{
            var min_img = '';
        }
        fd.append("min_imghidden", min_img);
        /**
         * prepares the right form data
         */
          //name
            if($("#stockName").val() != "Название складчины" || $("#stockName").val().length > 0){
                var name = $("#stockName").val();
            }else{
                var name = '';
            }
            fd.append("name", name);

        //     if($("#stockInfo").val().length > 0){
        //         var description = $("#stockInfo").val();
        //     }else{
        //         var description = '';
        //     }
        //
        // fd.append("description", description);

/**
 * Anulat
 */
        //
            // // title
            // if($("#textarea_title").val().length > 0){
            //     var title = $("#textarea_title").val();
            // }else{
            //     var title = '';
            // }
            // fd.append("title", title);
            //
              // subtitle
            if($("#textarea_paragraph").val().length > 0){
                var subtitle = $("#textarea_paragraph").val();
            }else{
                var subtitle = '';
            }
            fd.append("subtitle", subtitle);
            //
            // // Big img
            //
            // if($("#BigImgHidden").val().length > 0){
            //     var big_img = $("#BigImgHidden").val();
            // }else{
            //     var big_img = '';
            // }
            // fd.append("big_img", big_img);
            //
            // // youtube_link
            // if($("#yt_link").val().length > 0){
            //     var youtube_link = $("#yt_link").val();
            // }else{
            //     var youtube_link = '';
            // }
            // fd.append("youtube_link", youtube_link);
/**
 *  /Anulat
 */


        /**
         * get value from input tags
          */
        if($("#stockTags").val().length > 0){
                 var tags = $("#stockTags").val();
             }else{
                 var tags = '';
             }
         fd.append("tags", tags);

        /**
         * get data from textarea stockInfo
         * @type {*|String|string|*}
         */
        var editor_data = CKEDITOR.instances.stockInfo.getData();
        fd.append("description", editor_data);
        $.ajax({
            url: "/profile/stock/add",
            method: 'POST',
            contentType: false,
            data: fd,
            processData: false,
            success: function (data) {
                if(data['errors']){
                    if(data['errors']['name']){
                        $("#stockName").val(data['errors']['name'][0]).addClass("errorName").scrollView();
                           return false;
                    }
                    if(data['errors']['title']){
                            showTitle();
                            $("#errorTitle").show().text(data['errors']['title']);
                                $("#add_title__js").scrollView();
                            return false;
                    }
                    $("#errorTitle").hide();

                    if(data['errors']['description']){
                        $(".editor").scrollView();
                        $("#infoStockError").show().text(data['errors']['description']);
                        return false;
                    }

                    if(data['errors']['subtitle']){
                            showParagraph();
                            $("#errorParagraph").show().text(data['errors']['subtitle']);
                            $(".subtitleStock").scrollView();
                            return false;
                    }

                    $("#errorParagraph").hide();

                    if(data['errors']['big_img']){
                        showImg();
                        $("#errorImg").show().text(data['errors']['big_img']).scrollView();
                        return false;
                    }
                    $("#errorImg").hide();
                    if(data['errors']['youtube_link']){
                        showVideLink();
                        $("#errorYtLink").show().text(data['errors']['youtube_link']);
                        $(".add_img").scrollView();
                        return false;
                    }
                    $("#errorYtLink").hide();

                    if(data['errors']['tags']){
                        showVideLink();
                        $("#stockTags").show().attr('placeholder',data['errors']['tags']).addClass('errorTags').scrollView();
                        return false;
                    }
                    $("#stockTags").removeClass("errorTags");


                    $("#ImgMinError").hide();
                    if(data['errors']['min_img']){
                        $("#ImgMinError").show().text(data['errors']['min_img']).scrollView();
                        // return false;
                    }

                    $("#errorMinCount").hide();
                    if(data['errors']['min_count']){
                        $("#errorMinCount").show().text(data['errors']['min_count']);
                        // $("#min_count").scrollView();
                    }

                    $("#errorContrComiss").hide();
                    if(data['errors']['commission_contribution']){
                        $("#errorContrComiss").show().text(data['errors']['commission_contribution']);
                        // return false;
                    }

                    $("#errorContrPrice").hide();
                    if(data['errors']['price_contribution']){
                        $("#errorContrPrice").show().text(data['errors']['price_contribution']);
                        // return false;
                    }

                    $("#errorDateColl").hide();
                    if(data['errors']['date_collection']){
                        $("#errorDateColl").show().text(data['errors']['date_collection']);
                        // return false;
                    }

                    $("#errorDelivery2").hide();
                    if(data['errors']['delivery']){
                        $("#errorDelivery2").show().text(data['errors']['delivery']);
                        // return false;
                    }
                    // $("#errorMinCount").hide();

                }else{
                    CKEDITOR.instances.stockInfo.setData('Напишите что-нибудь'); // Clear textarea ckeditor
                    /**
                     * Clear value OLD min img
                     */
                    $("#old_img").val('');
                    $(".cke_top").css("margin-top:", "30px");
                    $("#errorMinCount").hide();
                    $("#errorDateColl").hide();
                    $("#errorContrComiss").hide();
                    $("#errorDelivery2").hide();
                    $("#infoStockError").hide();



                }

                if(data['successAdmin']){
                    clearFormData();
                    $("#stockName").attr("placeholder", 'Складчина была успешно опубликована').scrollView();
                    $("#stockName").addClass("successStock");
                    // $("#success").show().text('Складчина была успешно опубликована');
                    return false;
                }
                if(data['successModerator']){
                    clearFormData();
                    $.fancybox.open({
                        src  : '#popup-admin-stock-added',
                        type : 'inline',
                        opts : {
                            animationEffect: "fade",
                        }
                    });
                    // $("#success").show().text('Складчина отправлено администратору для проверки');
                    $("#stockName").scrollView();
                    $("#stock-added-message").text('Складчина отправлено администратору для проверки');

                    // $("#stockName").addClass("successStock");
                    return false;
                }
                if(data['success']){
                    clearFormData();
                    // $("#success").show().text('Складчина успешно добавлена');
                    $("#stockName").attr("placeholder", 'Складчина отправлено администратору для проверки').scrollView();
                    // $("#stockName").addClass("successStock");
                }
                if(data['useRights']){
                    alert(data['useRights']);

                }

            }
        });
    });

    $.fn.scrollView = function () {
        return this.each(function () {
            $('html, body').animate({
                scrollTop: $(this).offset().top
            });
        });
    }

    /**
     * This function clear all data from left form and right stock form
     */

    function clearFormData() {
        $("#min_img_hidden").val("");
        $("#ShowBlurClass").addClass("cover-image__img--blur");
        $(".cover-image__title").show();
        $(".cover-image__subtitle").show();
        $("#videoContainer").hide();
        $("#stockName").val("");
        $(".title__js").text("");
        $(".show_paragraph").text("");
        $('#showImg').css('background-image', 'url()');

        $("#textarea_title").val("");

        $("#textarea_paragraph").val("");

        $("#BigImgHidden").val("");

        $("#yt_link").text("");

        $("#stockTags").val();
        showTitle();
    }
    /**
     * Save the change stock status
     */

    $("#confirm").on("click", function () {
       var formData = new FormData(document.querySelector("form"));
       var stockName =  $(this).data('stock-name');
        $("#messageToStocker").val("Складчина " + '"'+stockName+'"');
        /**
         * get status value
         */

           var status  = $("#status").val();
            if(status == "on_editing"){
                $.fancybox.open({
                    src  : '#popup-admin-msgToStocker',
                    type : 'inline',
                    opts : {
                        animationEffect: "fade",
                    }
                });
                $("#sendSuccessMess").hide();

                /**
                 * Set personalize message from admin to Stocker
                 */
                $("#btnSendMess").one("click", function () {

                    var message = $("#messageToStocker").val();
                   formData.append('message', message);
                    $.ajax({
                        url: "/edit_status",
                        method: 'POST',
                        contentType: false,
                        data: formData,
                        //JQUERY CONVERT THE FILES ARRAYS INTO STRINGS.SO processData:false
                        processData: false,
                        success: function (data) {
                            if(data['success']){
                                $("#sendSuccessMess").show().text(data['successMsg']);
                                $("#messageToStocker").val('');
                                setTimeout(function () {
                                    $.fancybox.close({
                                        src  : '#popup-admin-msgToStocker',
                                        type : 'inline',
                                        opts : {
                                            animationEffect: "fade",
                                        }
                                    });
                                }, 1500)
                            }
                            if(data['success'] == 0) {
                                alert(data['successMsg']);
                            }
                        }
                    });
                });
                return false;
            }
        $.ajax({
            url: "/edit_status",
            method: 'POST',
            contentType: false,
            data: formData,
            //JQUERY CONVERT THE FILES ARRAYS INTO STRINGS.SO processData:false
            processData: false,
            success: function (data) {
                if(data['success']){
                    $("#changedStatus").show();
                    setTimeout(function () {
                        $("#changedStatus").hide();
                    }, 1500)
                }
                if(data['success'] == 0) {
                    alert(data['successMsg']);
                }
            }
        });

    });

    /**
     *  Replace stock textarea with CKEDITOR
     */

    CKEDITOR.replace( 'stockInfo' , {
        filebrowserUploadUrl:'/profile/stock/add_img_with_ckeditor',
        filebrowserImageUploadUrl:'/profile/stock/add_img_with_ckeditor'
    });

    // When user clicks the 'upload image' button
    $('.upload-img-btn').on('click', function(){
        createStock
        // Add click event on the image upload input
        // field when button is clicked
        $('#image-input').click();

        $(document).on('change', '#image-input', function(e){
            $("#successCopied").hide();
            // Get the selected image and all its properties
            var image_file = document.getElementById('image-input').files[0];
            if(image_file){
                var path = URL.createObjectURL(image_file);
                $("#url_field").val(path);
                $.fancybox.open({
                    src  : '#popup-link-image',
                    type : 'inline',
                    opts : {
                        animationEffect: "fade",
                    }
                });
            }



            $('#copyLinnk').on('click', function () {
                var urlField = document.querySelector('#url_field');
                // select the contents
                urlField.select();
                var copied = document.execCommand('copy'); // or 'cut'

                if(copied){
                    $("#copyLinnk").attr("value", 'Скопированный\n');
                    $("#successCopied").show();
                    setTimeout(function () {
                        $.fancybox.close({
                            src  : '#popup-link-image',
                            type : 'inline',
                            opts : {
                                animationEffect: "fade",
                            }
                        });
                    }, 1500)
                }
            });
        });
    });


});

/**
 * Follows on stock
 */

$("#follows").on('click', function () {
    var stock_id = $(this).data('stock-id');
    $.ajax({
        url: "/follows/"+stock_id,
        method: 'GET',
        contentType: false,
        //JQUERY CONVERT THE FILES ARRAYS INTO STRINGS.SO processData:false
        processData: false,
        success: function (data) {
            if(data['success']) {
                $("#follows").hide();
                $("#unfoll_js").show();
                var currCntFoll = $("#countFollowers").text();
                var resCntFoll =  parseInt(currCntFoll) + 1;
                $("#countFollowers").text(resCntFoll);
            }
        }
    });
});

/**
 * UnFollows on stock
 */
 function unfollowed(stock_id) {
    $.ajax({
        url: "/un_follows/"+stock_id,
        method: 'GET',
        contentType: false,
        //JQUERY CONVERT THE FILES ARRAYS INTO STRINGS.SO processData:false
        processData: false,
        success: function (data) {
            if(data['success']) {
                $(".unfollowed").hide();
                $("#follows").show();
                var currCntFoll = $("#countFollowers").text();
                var resCntFoll =  parseInt(currCntFoll) - 1;
                $("#countFollowers").text(resCntFoll);
            }
        }
    });
};


