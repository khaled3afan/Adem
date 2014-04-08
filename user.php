<?php

session_start();

include './includes/function.php';
include './classes/class.db.php';
include './db.php';

$loginDB = new FrQuery();

/* GET SITE URL FROM DB */
$siteUrl = $loginDB->getSettingVal("site_url");
define("SITE_URL",$siteUrl);

/* GET SITE NAME */
$siteName = $loginDB->getSettingVal("site_name");

/* GET SITE DESCRIP */
$siteDescrip = $loginDB->getSettingVal("site_descrip");


/**
 * STRART WORK
 */
if(isset($_POST['password'])&& $_REQUEST['action']=="login"){ 
    $password = $loginDB->getSettingVal("password");
    $post_password = clearPOST($_POST['password']);
    $inputPassword = md5(md5($post_password));
    if($post_password == ""){
        $ErrorMsg = "أدخل كلمة المرور.";
    }elseif(!empty ($post_password)){
        if($inputPassword === $password){
            $_SESSION['admin'] = "yes";
            $_SESSION['login'] = "yes";
            go("index.php?page=cp");
        }else{
            $ErrorMsg = "كلمة المرور ليست صحيحة .";
        }
    }
}elseif(isset ($_POST['logout']) && $_REQUEST['action']=="logout"){
    $pageTitle = "الخروج";
    $logout = clearPOST($_POST['logout']);
    
    if($logout == ""){
        $ErrorMsg = "يا سيدي , هناك خطأ ما هنا ..";
    }elseif(!empty($_SESSION['admin']) and !empty ($_SESSION['login'])){
        
        $end = session_destroy();
        if(isset($end)){
            $logout_Messge = TRUE;
        }else{
            $ErrorMsg = "حسنًا آسف يا سيدي .. لكن لا أعلم ما المشكلة! أنا في محرج منك >.<";
        }
    }else{
        $ErrorMsg = "يا سيدي .. أنت لم تدخل حتى تخرج .. لديك مشكلةٌ ما في المنطق ؟";
    }
}else{
	$pageTitle = "الدخول";
	$pageKeyWord = array("");
	$pageDescript = "";
	include './views/vCplogin.php';
	die();
}
/* VIEWS */
$pageKeyWord = array("");
$pageDescript = "";
include './views/vLogin.php';