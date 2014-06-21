<?php include 'Header.php'; ?>
        <div class="body" id="login_page">
                <div class="loginPage">
                    <div class="ajax-result alert alert-danger" id="errorMessge"></div>
                    <form id="loginForm">
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="أدخل كلمة المرور" name="password" id="password_login"/>
                        </div>
                        <button type="submit" class="btn btn-primary" name="login" value="yes">دخول</button>&nbsp;
                        <img src="<?php echo SITE_URL?>/ad-admin/cdn/css/img/ajax.GIF" class="ajax-result" id="login_loading"/><br/>
                        <!--<span style="font-size: 12px;float: right"><a href="<?php _e(SITE_URL)?>/user/lost_password" title="إعادة تعيين كلمة المرور">نسيت كلمة المرور؟</a></span>-->
                        <span style="font-size: 12px;float: right"><a id="show_lost_password_page" title="إعادة تعيين كلمة المرور" href="javascript::void(0)">نسيت كلمة المرور؟</a></span>
                    </form>
                </div>
            </div>
            <div class="body" id="lost_pass_page" style="display: none;">
                <div class="loginPage">
                    <div class="alert alert-info" style="line-height: 25px;font-size: 12px; text-align: right;">
                        <ul>
                            <li>سأقوم يا سيدي بإرسال رسالة إلى بريدك الالكتروني تحتوي على رابط لاستعادة كلمة المرور .</li>
                        </ul>
                    </div>
                    <div class="ajax-result alert" id="lost_result"></div>
                    <form id="lost_password_form">
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="أدخل البريد الالكتروني" name="lost_password" id="lost_password"/>
                        </div>
                        <button type="submit" class="btn btn-primary" name="login" value="yes">إرسال</button>&nbsp;
                        <img src="<?php echo SITE_URL?>/ad-admin/cdn/css/img/ajax.GIF" class="ajax-result" id="lost_password_loading"/>
                    </form>
                </div>
            </div>
<?php include 'Footer.php'; ?>