<?php include 'vCpHeader.php';?>
<div class="admin_body">
    <ul class="nav nav-tabs">
        <li class="active"><a href="<?php _e(SITE_URL)?>/?page=cp">أهلًا!</a></li>
        <li><a href="<?php _e(SITE_URL)?>/?page=cp&cp=edit">بيانات الواجهة</a></li>
        <li><a href="<?php _e(SITE_URL)?>/?page=cp&cp=settings">الإعدادات</a></li>
    </ul>
    <div class="content">
        <div class="tab-content">
            <div class="alert alert-warning"><h2>أهلًا بعودتك ..</h2></div>
            <div class="row">
                <div class="col-md-6 col-md-4">
                    <div class="thumbnail">
                        <div class="caption">
                            <h3>آخر مرة زرتني فيها ..</h3>
                            <p class="text-danger">كانت في  : <span><?php _e(date("Y m d"));?></span></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-md-4">
                    <div class="thumbnail">
                        <div class="caption">
                            <h3>إحصائيات موقعك</h3>
                            <p class="text-success">أود إخبارك يا سيدي أنه قد بلغ عدد زيارات موقعك لـ <?php _e($DB_HOME->getSettingVal("visits"));?> زيارة .</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'Footer.php'; ?>