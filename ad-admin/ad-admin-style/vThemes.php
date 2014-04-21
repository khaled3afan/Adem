<?php include 'vCpHeader.php';
$DB_HOME = new AD_Query;
?>
<div class="admin_body">
    <ul class="nav nav-tabs">
        <li><a href="<?php _e(SITE_URL)?>/ad-admin/">أهلًا!</a></li>
        <li><a href="<?php _e(SITE_URL)?>/ad-admin/edit">بيانات الواجهة</a></li>
        <li class="active"><a href="<?php _e(SITE_URL)?>/ad-admin/themes">القوالب</a></li>
        <li><a href="<?php _e(SITE_URL)?>/ad-admin/settings">الإعدادات</a></li>
    </ul>
    <div class="content">
        <div class="tab-content">
            <div class="alert alert-warning" style="font-size: 12px;">لمعرفة كيفية إضافة قوالب جديدة يرجى قراءة هذا المستند : <a href="http://github.com/4FSB/adem">[ أديم ]  إضافة قوالب جديدة .</a></div>
            <div class="container" style="width: 100%">
                <?php
                if(isset($return)){

                    if($return['success'] == 1){
                ?>
                <div class="alert alert-success">تمت العملية بنجاح!</div>
                <?php
                    }else{
                ?>
                <div class="alert alert-danger"><?php echo $return['msg'] ?></div>
                <?php
                    }

                }
                ?>
                <div class="row">
                    <?php
                    $a = 0;
                    while ($a < count($themes['dirs'])){
                    ?>
                    <div class="col-md-6">
                        <div class="thumbnail">
                            <?php
                            if($themes['img'][$a] == "TRUE"){
                            ?>
                            <img src="<?php echo SITE_URL?>/ad-content/ad-themes/<?php echo $themes['dirs'][$a] ?>/photo.JPG" class="thumbnail" alt="<?php echo $themes['dirs'][$a]?>" style="margin-top: 10px;"/>
                            <?php
                            }else{
                            ?>
                            <img src="<?php echo SITE_URL?>/ad-admin/ad-admin-style/cdn/img/noStyleIMG.JPG" class="thumbnail" alt="<?php echo $themes['dirs'][$a]?>" style="margin-top: 10px;"/>
                            <?php
                            }
                            ?>
                            <div class="caption">
                                <h4><?php echo $themes['dirs'][$a]?></h4>
                                <?php if($themes['dirs'][$a] == THEME_NAME){ ?>
                                <p><button type="button" class="btn btn-success disabled" role="button">فعّال</button></p>
                                <?php }else{ ?>
                                <form action="<?php echo SITE_URL?>/ad-admin/themes" method="post">
                                    <p><button type="submit" class="btn btn-primary" role="button">تفعيل</button></p>
                                    <input type="hidden" name="theme_set" value="<?php echo $themes['dirs'][$a]; ?>"/>
                                </form>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <?php $a++;} ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'Footer.php'; ?>