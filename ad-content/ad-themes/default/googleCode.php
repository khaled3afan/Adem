<?php
$getCode = $Meta->getSettingVal('google_code');
if(isset($getCode) && $getCode != ""){
    ?>
<!-- GOOGLE CODE -->
<?php
    echo $getCode;
?>
<!-- END GOOGLE CODE -->
<?php
}