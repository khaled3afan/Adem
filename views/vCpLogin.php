<?php include 'Header.php'; ?>
            <div class="body">
                <div class="loginPage">
                    <div class="alert alert-danger" id="errorMessge"></div>
                    <form action="<?php _e(SITE_URL)?>/user.php?action=login" id="loginForm" method="POST">
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="أدخل كلمة المرور" name="password" id="password"/>
                        </div>
                        <button type="submit" class="btn btn-primary" name="login" value="yes">دخول</button>
                    </form>
                </div>
            </div>
<?php include 'Footer.php'; ?>