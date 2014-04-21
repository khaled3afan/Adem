<?php include 'Header.php'; ?>
<div class="body">
    <?php if(isset($logout_Messge)){
        if($logout_Messge == TRUE){?>
    <div class="alert alert-success" style="text-align: center">أتمنى لك أمتع الأوقات يا سيدي العزيز.. عد لزيارتي مرة أخرى :)</div>
    <?php }else{
        ?>
    <div class="alert alert-danger" style="text-align: center;">حصل خطأ ما ، أعتذر .. حاول مرة أخرى سيدي العزيز!</div>
    <?php 
    }
    }
?>
</div>
<?php include 'Footer.php'; ?>