<?php
include './ad-define.php';


if(isset($_GET['p'])){
    if(!empty($_GET['p'])){
        $file = $_GET['p'].".php";
        if(is_file($file) && file_exists($file)){
            include $file;
        }else{
            $view = new AD_View(THEME_NAME);
            $view->view("404",array(
                "key"=>array(),
                "title"=>"خطأ ، تعذر إيجاد الصفحة.",
                "Des"=>"",
            ));
        }
    }else{
        $view = new AD_View(THEME_NAME);
        $view->view("404",array(
            "key"=>array(),
            "title"=>"خطأ ، تعذر إيجاد الصفحة.",
            "Des"=>"",
        ));
    }
}else{
    
    $view = new AD_View(THEME_NAME);
    $db = new AD_Query;
    
    /* get INFO from DB */
    $info_query = "SELECT * FROM info ORDER BY `info_id` ASC  LIMIT 0,10";
    $info = $db->DB_Query($info_query);
    
    /* get SOCIAL from DB */
    $social_query = "SELECT * FROM social WHERE sc_link !='' limit 0,10";
    $social = $db->DB_Query($social_query);
    
    // View
    $view->view("index",array(
        "key"=>array(),
        "title"=>"index",
        "Des"=>"",
        "social"=>$social,// send queries to view files
        "info"=>$info
    ));
}