<?php include 'Header.php'; ?>
<div class="underHeader">
    <div style="float: right;">
        <ol class="breadcrumb" style="background: #F9F9F9;font-size: 12px;">
            <span class="glyphicon glyphicon-home" style="font-size: 15px;color: #999"></span>&nbsp;
            <li><a href="<?php _e(SITE_URL) ?>">الواجهة</a></li>
            <li><a href="<?php _e(SITE_URL)?>/ad-admin">لوحة التحكم</a></li>
            <li class="active"><?php if($pTitle == "لوحة التحكم"){_e("الرئيسية");}else{_e($pTitle);}?></li>
        </ol>
    </div>
    <form action="<?php _e(SITE_URL) ?>/user/logout" method="post" style="float: left">
        <button class="btn btn-danger" name="logout" value="yes">خروج</button>
    </form>
</div>
<div class="clearfix"></div>