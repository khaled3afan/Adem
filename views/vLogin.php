<?php include 'Header.php'; ?>
<div class="body">
    <?php if(isset($logout_Messge)&& $logout_Messge == TRUE){ ?>
    <div class="alert alert-success" style="text-align: center">أتمنى لك أمتع الأوقات يا سيدي العزيز.. عد لزيارتي مرة أخرى :)</div>
    <?php }else{?>
    <div class="alert alert-danger" style="text-align: center">
        <p><?php _e($ErrorMsg) ?></p>
    </div>
    <p><a href="<?php _e(SITE_URL) ?>/user.php?action=login">العودة لصفحة الدخول</a></p>
    <?php }?>
</div>
<?php include 'Footer.php'; ?>