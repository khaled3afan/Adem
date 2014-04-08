$(document).ready(function (){

    
    // GOOGLE FORM !
    $("#googleForm").submit(function (){
        allData = $("#googleForm").serialize();
        alertShow = $("#google-alert");
        ajaxLoading = $("#google-loading");
        upCode = $("#upGoogleCode").val();
        
        if(alertShow.hasClass("alert-danger") || alertShow.hasClass("alert-success")){
                alertShow.removeClass("alert-danger");
                alertShow.removeClass("alert-success");
        }
        
        if(upCode == ""){
            alertShow.slideDown(600);
            alertShow.addClass("alert-danger");
            alertShow.html("<span class='glyphicon glyphicon-remove'></span>" + "   " + "سيدي .. أرجو منك إدخال الشفرة :(");
            alertShow.delay(2000);
            alertShow.slideUp(700);
        }else{
            $.ajax({
                url: "index.php?page=cp&cp=settings&update=google-code",
                type: 'POST',
                data: allData,
                dataType: 'json',
            beforeSend: function(xhr) {
                ajaxLoading.show();
            },
            success: function (data,statutsText,xhr){
                ajaxLoading.hide();
                alertShow.slideDown(600);
                if(data['status'] == 0){
                    alertShow.addClass("alert-danger");
                    alertShow.html("<span class='glyphicon glyphicon-remove'></span>" + "   " + data['msg']);
                }else if(data['status'] == 1){
                    alertShow.addClass("alert-success");
                    alertShow.html("<span class='glyphicon glyphicon-ok'></span>" + "   " + data['msg']);
                }
                alertShow.delay(2000);
                alertShow.slideUp(700);
            }
        });
    }
    return false;
});
    
    $("#siteForm").submit(function (){
        allData = $("#siteForm").serialize();
        alertShow = $("#site-alert");
        ajaxLoading = $("#site-loading");
        
        upName = $("#upSiteName").val();
        upDescrip = $("#upSiteDescrip").val();
        upUrl = $("#upSiteUrl").val();
        
        if(upName == "" && upDescrip == "" && upUrl == ""){
            alertShow.slideDown(600);
            alertShow.addClass("alert-danger");
            alertShow.html("<span class='glyphicon glyphicon-remove'></span>" + "   " + " سيدي .. أرجو منك إدخال بعض البيانات :(");
            alertShow.delay(2000);
            alertShow.slideUp(700);
        }else{
            $.ajax({
                url: "index.php?page=cp&cp=settings&update=site-info",
                type: 'POST',
                data: allData,
                beforeSend: function(xhr) {
                    ajaxLoading.show();
                },
            success: function (data,statutsText,xhr){
                ajaxLoading.hide();
                alertShow.slideDown(600);
                dataLength = data.length;
                    if(dataLength > 3){
                        alertShow.addClass("alert-danger");
                        alertShow.html("<span class='glyphicon glyphicon-remove'></span>" + "  "+data);
                    }else if (dataLength <= 3){
                        if(alertShow.hasClass("alert-danger")){
                            alertShow.removeClass("alert-danger");
                        }
                        alertShow.addClass("alert-success");
                        alertShow.html("<span class='glyphicon glyphicon-ok'></span>  تم التحديث بنجاح!");
                    }
                        alertShow.delay(2000);
                        alertShow.slideUp(700);
                    }
                });
            }
    return false;
});

    $("#emailForm").submit(function (){
        allData = $("#emailForm").serialize();
        alertShow = $("#email-alert");
        ajaxLoading = $("#email-loading");
        
        upEmail = $("#upEmail").val();
        
        if(alertShow.hasClass("alert-danger") || alertShow.hasClass("alert-success")){
                alertShow.removeClass("alert-danger");
                alertShow.removeClass("alert-success");
        }
        
        if(upEmail == ""){
            alertShow.slideDown(600);
            alertShow.addClass("alert-danger");
            alertShow.html("<span class='glyphicon glyphicon-remove'></span>" + "   " + "سيدي .. أرجو منك إدخال البريد الالكتروني .");
            alertShow.delay(2000);
            alertShow.slideUp(700);
        }else{
            $.ajax({
            url: "index.php?page=cp&cp=settings&update=email",
            type: 'POST',
            data: allData,
                dataType: 'json',
            beforeSend: function(xhr) {
                ajaxLoading.show();
            },
            success: function (data,statutsText,xhr){
                ajaxLoading.hide();
                alertShow.slideDown(600);
                    if(data['status'] == 0){
                        alertShow.addClass("alert-danger");
                        alertShow.html("<span class='glyphicon glyphicon-remove'></span>" + "   " + data['msg']);
                    }else if(data['status'] == 1){
                        alertShow.addClass("alert-success");
                        alertShow.html("<span class='glyphicon glyphicon-ok'></span>" + "   " + data['msg']);
                    }
                        alertShow.delay(2000);
                        alertShow.slideUp(700);
                    }
                });
            }
    return false;
});

    $("#passForm").submit(function (){
        allData = $("#passForm").serialize();
        alertShow = $("#pass-alert");
        ajaxLoading = $("#pass-loading");
        
        upPass = $("#upPass").val();
        upPassRewrite = $("#upPassRewrite").val();
        
        if(alertShow.hasClass("alert-danger") || alertShow.hasClass("alert-success")){
                alertShow.removeClass("alert-danger");
                alertShow.removeClass("alert-success");
        }
        
        if(upPass == "" && upPassRewrite == ""){
            alertShow.slideDown(600);
            alertShow.addClass("alert-danger");
            alertShow.html("<span class='glyphicon glyphicon-remove'></span>" + "   " + "يا سيدي .. أرجو منك إدخال كلمة المرور الجديدة وإعادة كتابتها مرة أخرى .");
            alertShow.delay(2000);
            alertShow.slideUp(700);
        }else if(upPassRewrite == ""){
            alertShow.slideDown(600);
            alertShow.addClass("alert-danger");
            alertShow.html("<span class='glyphicon glyphicon-remove'></span>" + "   " + "أعد كتابة كلمة المرور يا سيدي .. :(");
            alertShow.delay(2000);
            alertShow.slideUp(700);
        }else if(upPass != upPassRewrite){
            alertShow.slideDown(600);
            alertShow.addClass("alert-danger");
            alertShow.html("<span class='glyphicon glyphicon-remove'></span>" + "   " + "لم تتطابق كلمتا المرور المدخلة ، أعد المحاولة يا سيدي :(");
            alertShow.delay(2000);
            alertShow.slideUp(700);
        }else{
            if(confirm("هل أنت متأكد من تغيير كلمة المرور ؟") == false){
                
            }else{
                $.ajax({
                url: "index.php?page=cp&cp=settings&update=password",
                type: 'POST',
                data: allData,
                    dataType: 'json',
                beforeSend: function(xhr) {
                    ajaxLoading.show();
                },
                success: function (data,statutsText,xhr){
                    ajaxLoading.hide();
                    alertShow.slideDown(600);
                        if(data['status'] == 0){
                            alertShow.addClass("alert-danger");
                            alertShow.html("<span class='glyphicon glyphicon-remove'></span>" + "   " + data['msg']);
                        }else{
                            alertShow.addClass("alert-success");
                            alertShow.html("<span class='glyphicon glyphicon-ok'></span>" + "   " + data['msg']);
                        }
                            alertShow.delay(2000);
                            alertShow.slideUp(700);
                        }
                    });
                }   
            }
    return false;
});


/* EDIT */

    function getOption(){
        selector = $("#selector").val();
        updatesForm = $("#updatesForm");
        deleteINFO = $("#delete-form");
        if(updatesForm.hasClass("shower")){
            updatesForm.fadeOut(500);
        }
        if(deleteINFO.hasClass("shower")){
            deleteINFO.fadeOut(500);
        }
        if(selector != 0)
        {
            /*$.post("index.php?page=cp&cp=edit",$("#selectEdit").serialize(),function (output){
                $("#test").val(output['A']);
            });*/
            $.ajax({
                url: "index.php?page=cp&cp=edit",
                data: $("#selectEdit").serialize(),
                type: 'POST',
                dataType: 'json',
                beforeSend: function(xhr) {
                    $("#info-loading").show(500);
                },
                success: function(data, textStatus, jqXHR) {
                    $("#info-loading").hide();
                    updatesForm.fadeIn(500);
                    updatesForm.addClass("shower");
                    deleteINFO.fadeIn(500);
                    deleteINFO.addClass("shower");
                    $("#up_infoName").val(data['info_name']);
                    $("#up_infoTooltip").val(data['info_tooltip']);
                    $("#up_infoStyleID").val(data['info_styleID']);
                    $("#up_infoContent").val(data['info_content']);
                    $("#delete_id").val(data['info_id']);
                    $("#upID").val(data['info_id']);
                },
            });
            return false;
        }
    }
    $("#selector").change(function (){
        $("#selectEdit").submit(getOption());
    });
    
    
    $("#updatesForm").submit(function (){
        allData = $("#updatesForm").serialize();
        ajaxLoading = $("#save-info-loading");
        alertShow = $("#info-save-alert");
        name = $("#up_infoName").val();
        tooltip = $("#up_infoTooltip").val();
        styleID = $("#up_infoStyleID").val();
        content = $("#up_infoContent").val();
        
        if(name == "" || tooltip == "" || styleID == "" || content == ""){
            sure = confirm("بعض الحقول فارغة ، هل أنت متأكد ؟");
            if(sure == true){
                
            }
        }else{
            if(alertShow.hasClass("alert-danger") || alertShow.hasClass("alert-success")){
                alertShow.removeClass("alert-danger");
                alertShow.removeClass("alert-success");
            }
            $.ajax({
                url: "index.php?page=cp&cp=edit",
                type: 'POST',
                data: allData,
                dataType: 'json',
                beforeSend: function(xhr) {
                    ajaxLoading.show()
                },
                success: function(data, textStatus, jqXHR) {
                    ajaxLoading.hide();
                    alertShow.slideDown(600)
                    if(data['status'] == 1){
                        alertShow.addClass("alert-success");
                        alertShow.html("<span class='glyphicon glyphicon-ok'></span>" + "   " + data['message']);
                    }else if(data['status'] == 0){
                        alertShow.addClass("alert-danger");
                        alertShow.html("<span class='glyphicon glyphicon-remove'></span>" + "   " + data['message'])
                    }else{
                        alertShow.addClass("alert-danger");
                        alertShow.html("<span class='glyphicon glyphicon-remove'></span>" + "   " + data['message']);
                    }
                    alertShow.delay(2000);
                    alertShow.slideUp(700);
                }
            })
        }
        return false;
    })
    
    $("#delete-form").submit(function (){
        ajaxloading = $("#delete-loading");
        alertShow = $("#delete-alert");
        delete_id = $("#delete_id").val();
        $.ajax({
            url: "index.php?page=cp&cp=edit&delete="+delete_id,
            type: 'POST',
            data: $("#delete-form").serialize(),
            dataType: 'json',
            beforeSend: function(xhr) {
                ajaxloading.show();
            },
            success: function(data, textStatus, jqXHR) {
                ajaxloading.hide();
                alertShow.slideDown(600)
                alertShow.html(data['done']);
                alertShow.delay(2000);
                setTimeout(function(){
                    location.reload();
                }, 5000);
            }
        });
        return false;
    });
    
    
    
    $("#addNew-Form").submit(function (){
        ajaxLoading = $("#newI-ajax-loadin");
        alertShow = $("#newI-alertShow");
        allData = $(this).serialize();
        N_name = $("#newIName").val();
        N_tooltip = $("#newITip").val();
        N_content = $("#newIContent").val();
        N_sid = $("#newISID").val();
        if(alertShow.hasClass("alert-danger") || alertShow.hasClass("alert-success")){
                alertShow.removeClass("alert-danger");
                alertShow.removeClass("alert-success");
        }
        if(N_name == "" || N_content == "" || N_sid == ""){
            alertShow.slideDown(600);
            alertShow.delay(2000);
            alertShow.addClass("alert-danger");
            alertShow.html("<span class='glyphicon glyphicon-remove'></span>" + "   " + "أدخل يا سيدي اسم الحقل ومحتواه على الأقل .");
            alertShow.slideUp(700);
        }else{
            alertShow.slideDown(600);
            alertShow.delay(2000);
            $.ajax({
                url: "index.php?page=cp&cp=edit",
                type: 'POST',
                data: allData,
                dataType: 'json',
                beforeSend: function(xhr) {
                    ajaxLoading.show();
                },
                success: function(data, textStatus, jqXHR) {
                    ajaxLoading.hide();
                    if(data['success'] != 1){
                        alertShow.addClass("alert-danger");
                        alertShow.html("<span class='glyphicon glyphicon-remove'></span>" + "   " + data['message']);
                    }else{
                        alertShow.addClass("alert-success");
                        alertShow.html("<span class='glyphicon glyphicon-ok'></span>" + "   " + data['messege']);
                    }
                   
                    alertShow.slideUp(700);
                }
            })
        }
        return false;
    });
    
    $("#social_edit").submit(function (){
        ajaxLoading = $("#social-loading");
        alertShow = $("#social-result");
        allData = $("#social_edit").serialize();
        
        if(alertShow.hasClass("alert-danger") || alertShow.hasClass("alert-success")){
                alertShow.removeClass("alert-danger");
                alertShow.removeClass("alert-success");
        }
        
        
        facebook = $("#facebook").val();
        twitter = $("#twitter").val();
        google = $("#google_plus").val();
        skype = $("#skype").val();
        tumblr = $("#tumblr").val();
        github = $("#github").val();
        instagram = $("#instagram").val();
        youtube = $("#youtube").val();
        
        if(facebook == "" &&twitter == "" &&google == "" &&skype == "" &&tumblr == "" &&github == "" &&instagram == ""&&youtube ==""){
            alertShow.slideDown(600);
            alertShow.addClass("alert-danger");
            alertShow.html("<span class='glyphicon glyphicon-remove'></span>" + "   " + "املأ حقلًا واحدًا على الأقل .");
            alertShow.delay(2000);
            alertShow.slideUp(700);
        }else{
            
            $.ajax({
                type: 'POST',
                url: "index.php?page=cp&cp=edit",
                data: allData,
                dataType: 'json',
                beforeSend: function(xhr) {
                    ajaxLoading.show();
                },
                success: function(data, textStatus, jqXHR) {
                   ajaxLoading.hide(); 
                   alertShow.slideDown(600);
                   if(data['success'] != 1){
                        alertShow.addClass("alert-danger");
                        alertShow.html("<span class='glyphicon glyphicon-remove'></span>" + "   " + data['msg']);
                   }else{
                       alertShow.addClass("alert-success");
                       alertShow.html("<span class='glyphicon glyphicon-ok'></span>" + "   " + data['msg']);
                   }
                   alertShow.delay(2000);
                   alertShow.slideUp(700);
                }
            });
        }
        return false;
    });
});