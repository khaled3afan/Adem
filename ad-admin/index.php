<?php
session_start();

include '../ad-define.php';

if(is_admin()){
    
    
    if(isset($_REQUEST['to'])){
        
        $page = $_REQUEST['to'].".php";
        
        if(is_file($page) && file_exists($page)){
            include $page;
        }else{
            $view = new AD_View(THEME_NAME,"../ad-content\ad-themes");
            $view->view("404",array(
                "title"=>"تعذر وجود الصفحة المطلوبة.",
                "key"=>array(),
                "Des"=>""
            ));
        }
        
    }else{
        
        $view = new AD_View(null,"ad-admin-style");
        $view->view("vhome",array(
            "title"=>"لوحة التحكم",
            "key"=>array(),
            "Des"=>""
        ));
    }
    
}else{
    header("location: ".SITE_URL."/user/login");
}