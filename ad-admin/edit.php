<?php

$DB_edit = new AD_Query();

$view = new AD_View(null,"ad-admin-style");
/*
 * START WORK!
 *
 */



/**
 * @see class.db.php
 * @see vEdit.php
 * FOR WHILE IN vEdit.php , USER CHOOSE ONE RESULT OF THIS QUERY
 */
$getINFOS = $DB_edit->DB_Query("SELECT info_id,info_name FROM info ORDER BY info_id ASC");
$view->set("getINFOS",$getINFOS);

/**
 * AJAX
 * @see $getINFOS
 * GET DATA OF CHOOSED FIELD
 */
if(isset($_POST['chooseInfoID']) && $_POST['chooseInfoID'] != 0 && !empty($_POST['chooseInfoID'])){
    $chooseINFO = clearPOST($_POST['chooseInfoID']);
    $getCHOOSED = $DB_edit->DB_Query("SELECT * FROM info WHERE info_id = '$chooseINFO'");
    $__INFO__ = $DB_edit->DB_FetAs($getCHOOSED);
    echo json_encode($__INFO__);
    die();

}


/**
 * @see class.db.php
 * @since 0.1
 * FOR DELETE
 */
if(isset($_GET['delete'])){
    $delete = clearGET($_GET['delete']);
    $query_cheack = $DB_edit->DB_Query("SELECT info_id FROM info WHERE info_id='$delete'");
    $num = $DB_edit->DB_Num($query_cheack);
    
    if($num == 1){
        
        if(is_admin() == TRUE){
            
            $delete_info_query = $DB_edit->DB_Query("DELETE FROM info WHERE info_id='$delete'"); 
            if(isset($delete_info_query)){
                $return = array(
                    "done"=>"تم الحذف بنجاح ..!",
                    "refresh"=>'<meta http-equiv="Refresh" content="3;URL='.SITE_URL.'/?page=cp&cp=edit />'
                );
                echo json_encode($return);
                die();
            }else{
                $return = "حصل خطأ في حذف الحقل المطلوب حاول مرة أخرى .";
                echo $return;
                die();
            }
            
        }else{
            die("لا تمتلك الصلاحيات لعرض هذه الصفحة .");
        }
        
    }else{
        $return = "الحقل المطلوب غير موجود .";
        echo $return;
        die();
    }
    die();
}


/**
 * UPDATE FIELD CHOOSED
 */
if(isset($_POST['upInfoName']) && isset($_POST['upContent']) && isset($_POST['upStyleID']) && isset($_POST['upTooltip']) && isset($_POST['upInfoID'])){
    $upName = clearPOST($_POST['upInfoName']);
    $upTip = clearPOST($_POST['upTooltip']);
    $upContent = addslashes($_POST['upContent']);
    $upSID = clearPOST($_POST['upStyleID']);
    $upID = clearPOST($_POST['upInfoID']);
    $return = array();
    if(is_admin() == TRUE){
        $update = "UPDATE info SET info_name='$upName',`info_styleID`='$upSID',info_tooltip='$upTip',info_content='$upContent'"
                . "WHERE info_id='$upID'";
        $queryUP = $DB_edit->DB_Query($update);
        if(isset($queryUP)){
            $return['status'] = "1";
            $return['message'] = "تم تحديث البيانات بنجاح يا سيدي !";
            echo json_encode($return);
            die;
        }else{
            $return['status'] = "0";
            $return['message'] = "حصلت مشكلة ما يا سيدي :( ، حاول مرة أخرى.";
            echo json_encode($return);
            die;
        }
    }else{
        die("لا تمتلك الصلاحيات لفعل هذا .");
    }
    die;
}



/* ADD NEW */
if(isset($_POST['newIName']) && isset($_POST['newITip']) && isset($_POST['newISID']) && isset($_POST['newIContent'])){
    $nName = clearPOST($_POST['newIName']);
    $nTooltip = clearPOST($_POST['newITip']);
    $nContent = addslashes($_POST['newIContent']);
    $nSID = clearPOST($_POST['newISID']);
    $return = array();
    if($nSID == ""){ $code = creatCode(3);}
    if($nName == "" || $nContent == ""){
        $return['success'] = 0;
        $return['messege'] = "سيدي ، املأ حقلي الاسم والمحتوى .";
        echo json_decode($return);
    }else{
        if(is_admin() == TRUE){
            
            $insert = $DB_edit->DB_Query("INSERT INTO info (info_name,`info_styleID`,info_tooltip,info_content)"
                    . " VALUES ('$nName','$nSID','$nTooltip','$nContent')");
            if($insert){
                $return['success'] = 1;
                $return['messege'] = "تمت الإضافة بنجاح !";
                echo json_encode($return);
            }
            
            
        }else{
            $return['success'] = 0;
            $return['messege'] = "لا تمتلك الصلاحيات اللازمة .";
            echo json_decode($return);
        }
    }
    die;
}




if(isset($_POST['update_social']) && $_POST['update_social'] == "save"){
    $facebook = clearPOST($_POST['facebook']);
    $twitter = clearPOST($_POST['twitter']);
    $google = clearPOST($_POST['google_plus']);
    $tumblr = clearPOST($_POST['tumblr']);
    $instagram = clearPOST($_POST['instagram']);
    $skype = clearPOST($_POST['skype']);
    $youtube = clearPOST($_POST['youtube']);
    $github = clearPOST($_POST['github']);
    
    $return = array();
    $return['msg'] = "تم تحديث : ";
    if(is_admin() == TRUE){
        $return['success'] = 1;
        if(isset($facebook)){
            $update_fb = $DB_edit->updateSocial("facebook",$facebook);
            if($update_fb){
                $return['msg'] .= "فيسبوك . ";
            }else{
                $return['msg'] .= "لم يتم تحديث الفيسبوك ";
            }
        }
        if(isset($twitter)){
            $update_tw = $DB_edit->updateSocial("twitter",$twitter);
            if($update_tw){
                $return['msg'] .= "تويتر . ";
            }else{
                $return['msg'] .= " ، لم يتم تحديث تويتر ";
            }
        }
        if(isset($google)){
            $update_gl = $DB_edit->updateSocial("google-plus",$google);
            if($update_gl){
                $return['msg'] .= "قوقل بلس . ";
            }else{
                $return['msg'] .= " ، لم يتم تحديث قوقل بلس";
            }
        }
        if(isset($tumblr)){
            $update_tu = $DB_edit->updateSocial("tumblr",$tumblr);
            if($update_tu){
                $return['msg'] .= " تمبلر . ";
            }else{
                $return['msg'] .= " ، لم يتم تحديث تمبلر";
            }
        }
        if(isset($skype)){
            $update_sk = $DB_edit->updateSocial("skype",$skype);
            if($update_sk){
                $return['msg'] .= " سكايب . ";
            }else{
                $return['msg'] .= " ، لم يتم تحديث سكايب";
            }
        }
        if(isset($instagram)){
            $update_ins = $DB_edit->updateSocial("instagram",$instagram);
            if($update_ins){
                $return['msg'] .= " انستقرام . ";
            }else{
                $return['msg'] .= " ، لم يتم تحديث انستقرام";
            }
        }
        if(isset($youtube)){
            $update_ytb = $DB_edit->updateSocial("youtube",$youtube);
            if($update_ytb){
                $return['msg'] .= " يوتيوب . ";
            }else{
                $return['msg'] .= " ، لم يتم تحديث يوتيوب";
            }
        }
        if(isset($github)){
            $update_gh = $DB_edit->updateSocial("github",$github);
            if($update_gh){
                $return['msg'] .= " قيت هب . ";
            }else{
                $return['msg'] .= " ، لم يتم تحديث قيت هب";
            }
        }
        echo json_encode($return);
        die;
    }else{
        $return['success'] = 0;
        exit("حصل خطأ .");
    }
    exit("ERROR");
}
/* VIEWS */

$view->view("vEdit",array(
   "title"=>"بيانات الواجهة",
    "key"=>array(),
    "Des"=>""
));