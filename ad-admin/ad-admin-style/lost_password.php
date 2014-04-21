<?php include 'Header.php'; ?>
            <div class="body">
                <div class="loginPage">
                    <div class="ajax-result alert alert-danger" id="reset_errorMessge"></div>
                    <small id="go_login" class="ajax-result"><a href="<?php echo SITE_URL ?>/user/login">اضغط هنا للتوجه لصفحة الدخول .</a></small>
                    <form id="lost_password_reset_form">
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="كلمة المرور الجديدة" name="new_pass" id="new_pass"/>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="أعد كتابة كلمة المرور الجديدة." name="r_new_pass" id="r_new_pass"/>
                        </div>
                        <button type="submit" class="btn btn-primary" name="login" value="yes">حفظ</button>&nbsp;
                        <img src="<?php echo SITE_URL?>/ad-admin/ad-admin-style/cdn/css/img/ajax.GIF" class="ajax-result" id="lost_password_loading_reset"/>
                    </form>
                </div>
            </div>
<script type="text/javascript">
    $("#lost_password_reset_form").submit(function (){
        pass = $("#new_pass").val();
        pass_r = $("#r_new_pass").val();
        alertShow = $("#reset_errorMessge");
        ajaxLoading = $("#lost_password_loading_reset");
        
        if(alertShow.hasClass("alert-danger") || alertShow.hasClass("alert-success")){
                alertShow.removeClass("alert-danger");
                alertShow.removeClass("alert-success");
        }
        
        if(pass == "" || pass_r == ""){
            alertShow.slideDown("600");
            alertShow.addClass("alert-danger");
            alertShow.text("الرجاء ملئ الحقلين سويًا!");
        }else if(pass != pass_r){
            alertShow.slideDown("600");
            alertShow.addClass("alert-danger");
            alertShow.html("كلمتا المرور غير متطابقة !");
        }else{
            $.ajax({
                url: "lost_password?reset=password&auth=<?php echo $_SESSION['auth_reset'];?>&send=true",
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                beforeSend: function (xhr) {
                    ajaxLoading.show();
                },
                success: function (data, textStatus, jqXHR) {
                    ajaxLoading.hide();
                    alertShow.slideDown("600");
                    if(data['success'] != 1){
                        alertShow.addClass("alert-danger");
                        alertShow.html(data['msg']);
                    }else{
                        alertShow.addClass("alert-success");
                        alertShow.html(data['msg']);
                        $("#lost_password_reset_form").slideUp(900);
                        $("#go_login").slideDown(400);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alertShow.slideDown("600");
                    alertShow.html(errorThrown);
                }
            });
        }
        return false;
    });
    
</script>
<?php include 'Footer.php'; ?>