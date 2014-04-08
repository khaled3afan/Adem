<?php
ob_start();

include './db.php';
include './classes/class.db.php';
include './includes/function.php';



$db = new FrQuery();

///////// GET SITE URL FROM DB ///////////////////////////
$siteUrl = $db->getSettingVal("site_url");
define("SITE_URL",$siteUrl);

///////////////////////////////////////////////////////////

if(isset($_GET['page'])){
    $file = $_GET['page'].".php";
    if(is_file($file) && file_exists($file)){
        include $file;
    }else{
        go("index.php?page=404");
    }
}else{
    
    $info_query = "SELECT * FROM info LIMIT 0,10";
    $info = $db->DB_Query($info_query);
    
    $social_query = "SELECT * FROM social WHERE sc_link !='' limit 0,10";
    $social = $db->DB_Query($social_query);
    
    $db->DB_Query("UPDATE settings SET sett_value=sett_value+1 WHERE sett_name='visits'");
    /* VIEW */
    $pageKeyWord = array('فارس','فارس البلادي','غريب وطن','تصميم','برمجة',"كتب","قراءة","أدب","منطق");
    $pageTitle = "الواجهة";
    $pageDescript = "غريب وطن";
    include_once './views/vIndex.php';
    
}