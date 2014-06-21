$(document).ready(function (){

    $.extend({
      getUrlVars: function(){
        var vars = [], hash;
        var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
        for(var i = 0; i < hashes.length; i++)
        {
          hash = hashes[i].split('=');
          vars.push(hash[0]);
          vars[hash[0]] = hash[1];
        }
        return vars;
      },
      getUrlVar: function(name){
        return $.getUrlVars()[name];
      }
    });

    $("#show_lost_password_page").click(function (){
       $("#login_page").slideUp(900);
       $("#lost_pass_page").slideDown(400);
    });
    
    $("#loginForm").submit(function (){
        alertShow = $("#errorMessge");
        pass = $("#password").val();
        
        if(pass == ""){
            alertShow.slideDown(600);
            alertShow.html("أدخل كلمة المرور رجاءً.");
        }else{
            $.ajax({
                url: "login",
                data: $(this).serialize(),
                type: 'POST',
                dataType: 'json',
                beforeSend: function(xhr) {
                    $("#login_loading").show(500);
                },
                success: function(data, textStatus, jqXHR) {
                    $("#login_loading").hide()
                    if(data['success'] != 1){
                        alertShow.slideDown(600);
                        alertShow.html(data['msg']);
                    }else{
                        window.location = "ad-admin";
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alertShow.slideDown(600);
                    alertShow.html(errorThrown);
                }
            });
        }
        return false;
    });
    
    $("#lost_password_form").submit(function (){
        
        $("#lost_result").slideUp(600);
        
        email = $("#lost_password").val();
        alertShow = $("#lost_result");
        ajaxLoading = $("#lost_password_loading");
        
        if(alertShow.hasClass("alert-danger") || alertShow.hasClass("alert-success")){
                alertShow.removeClass("alert-danger");
                alertShow.removeClass("alert-success");
        }
        
        if(email == ""){
          alertShow.addClass("alert-danger");
          alertShow.slideDown(700);
          alertShow.html("أرجو منك يا سيدي إدخال البريد الالكتروني .");
        }else{
            
            $.ajax({
                url: "lost_password",
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                beforeSend: function(xhr) {
                    ajaxLoading.show();
                },
                success: function(data, textStatus, jqXHR) {
                    ajaxLoading.hide();
                    alertShow.slideDown(600);
                    if(data['success'] != 1){
                        alertShow.addClass("alert-danger");
                        alertShow.html(data['msg']);
                    }else{
                        $("#lost_password_form").fadeOut(500);
                        alertShow.addClass("alert-success");
                        alertShow.html(data['msg']);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alertShow.html(errorThrown);
                }
            });
        }
        
        return false;
    });
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
                url: "settings.php?update=google-code",
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
                url: "settings.php?update=site-info",
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
            url: "settings.php?update=email",
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
                url: "settings.php?update=password",
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
        content = tinyMCE.get('upContent');
        if(updatesForm.hasClass("shower")){
            updatesForm.fadeOut(500);
        }
        if(deleteINFO.hasClass("shower")){
            deleteINFO.fadeOut(500);
        }
        if(selector != 0)
        {
            $.ajax({
                url: "edit.php",
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
                    //$("#up_infoContent").val(data['info_content']);
                    tinymce.editors[1].setContent(data['info_content']);
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
        tinyMCE.triggerSave();
        allData = $("#updatesForm").serialize();
        ajaxLoading = $("#save-info-loading");
        alertShow = $("#info-save-alert");
        name = $("#up_infoName").val();
        tooltip = $("#up_infoTooltip").val();
        styleID = $("#up_infoStyleID").val();
        //content = $("#up_infoContent").val();
        content = tinyMCE.get('upContent');
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
                url: "edit.php",
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
            url: "edit.php",
            type: 'POST',
            data: {delete: delete_id},
            dataType: 'json',
            beforeSend: function(xhr) {
                ajaxloading.show();
            },
            success: function(data, textStatus, jqXHR) {
                ajaxloading.hide();
                alertShow.slideDown(600);
                alertShow.addClass("alert-success");
                alertShow.html(data['done']);
                alertShow.delay(2000);
                setTimeout(function(){
                    location.reload();
                }, 2000);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                    alertShow.slideDown(600);
                    alertShow.html(errorThrown);
                }
        });
        return false;
    });
    
    
    
    $("#addNew-Form").submit(function (){
        tinyMCE.triggerSave();
        ajaxLoading = $("#newI-ajax-loadin");
        alertShow = $("#newI-alertShow");
        allData = $(this).serialize();
        N_name = $("#newIName").val();
        N_tooltip = $("#newITip").val();
        //N_content = $("#newIContent").val();
        N_content = tinyMCE.get('newIContent');
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
            $.ajax({
                url: "edit.php",
                type: 'POST',
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
                        alertShow.html("<span class='glyphicon glyphicon-remove'></span>" + "   " + data['message']);
                    }else{
                        alertShow.addClass("alert-success");
                        alertShow.html("<span class='glyphicon glyphicon-ok'></span>" + "   " + data['messege']);
                    }
                    alertShow.delay(2000);
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
                url: "edit.php",
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
    
    
    $(".del").click(function (){
        
        page_id = $(this).attr("rel");
        page_element = $("#page-"+page_id+"-tr");
        
        if(page_id == ""){
            alert("لا توجد بيانات.");
        }else{
            x = confirm("هل أنت متأكد من حذف هذه الصفحة؟");
            if(x == true){
                /*$.post("pages.php",{'delete_page':page_id},function(data){
                    if(data['success'] == 1){
                        page_element.hide(1000);
                        alert(data)
                    }else{
                        alert(data['msg']);
                    }
                });*/
                $.ajax({
                    url: "pages.php",
                    data: {'delete_page':page_id},
                    type: 'POST',
                    dataType: 'json',
                    success: function(data, textStatus, jqXHR) {
                        if(data['success'] == 1){
                            page_element.hide(1000);
                        }else{
                            alert(data['msg']);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert(errorThrown);
                        alert(data);
                    }
                });
            }
        }
    });
    
    
    $("#add_page").submit(function (){
        tinyMCE.triggerSave();
        title = $("#p_title").val();
        content = tinyMCE.get('p_content').getContent();
        url = $("#p_url").val();
        des = $("#p_des").val();
        key = $("#p_key").val();
        comments = $("#p_allowcom").prop('checked');
        
        if(title == "" || content == ""){
            alert("قم بإدخال محتوى الصفحة وعنوانها على الأقل .");
        }else{
            alertShow = $("#result_add");
            $.ajax({
                url: "pages.php?add-new",
                data: {
                    p_title:title,
                    p_content:content,
                    p_url:url,
                    p_des:des,
                    p_key:key,
                    p_comments:comments,
                    add:"YES"
                },
                type: 'POST',
                dataType: 'json',
                beforeSend: function(xhr) {
                    $("#p_add_ajax-loading").show();
                },
                success: function(data, textStatus, jqXHR) {
                    $("#p_add_ajax-loading").hide();
                    if(data['success'] == 1){
                        alertShow.slideDown(600);
                        alertShow.html(data['msg'] + " ، تستطيع رؤية الصفحة من <a href='"+data['url']+"' target='_blank'>هنا</a>");
                    }else{
                        alert(data['msg']);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert(errorThrown);
                }
            });
        }
        return false;
    });
    
    // EDIT
    $("#edit_page").submit(function (){
        tinyMCE.triggerSave();
        edit_id = $.getUrlVars()['edit'];
        title = $("#p_title").val();
        content = tinyMCE.get('p_content').getContent();
        url = $("#p_url").val();
        des = $("#p_des").val();
        key = $("#p_key").val();
        comments = $("#p_allowcom").prop('checked')
        if(title == "" || content == ""){
            alert("قم بإدخال محتوى الصفحة وعنوانها على الأقل .");
        }else{
            alertShow = $("#result_add");
            $.ajax({
                url: "pages.php?edit="+edit_id,
                data: {
                    p_title:title,
                    p_content:content,
                    p_url:url,
                    p_des:des,
                    p_key:key,
                    p_comments:comments,
                    edit:"YES"
                },
                type: 'POST',
                dataType: 'json',
                beforeSend: function(xhr) {
                    $("#p_add_ajax-loading").show();
                },
                success: function(data, textStatus, jqXHR) {
                    $("#p_add_ajax-loading").hide();
                    if(data['success'] == 1){
                        alertShow.slideDown(600);
                        alertShow.html(data['msg'] + " ، تستطيع رؤية الصفحة من <a href='"+data['url']+"' target='_blank'>هنا</a>");
                    }else{
                        alert(data['msg']);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert("ERROR:");
                    alert(errorThrown);
                }
            });
        }
        return false;
    });
});