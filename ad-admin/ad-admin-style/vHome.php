<?php include 'vCpHeader.php';
$DB_HOME = new AD_Query;
?>
<div class="admin_body">
    <?php admin_tabs("index") ?>
    <div class="content">
        <div class="tab-content">
            <div class="alert alert-warning"><h2>أهلًا بعودتك ..</h2></div>
            <div class="row">
                <div class="col-md-6 col-md-4">
                    <div class="thumbnail">
                        <div class="caption">
                            <h3>آخر مرة زرتني فيها ..</h3>
                            <p class="text-danger">كانت في  : <span dir="ltr"><?php echo $DB_HOME->getSettingVal("last_login") ?></span></p>
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