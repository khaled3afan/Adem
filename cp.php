<?php
session_start();

if(isset($_SESSION['admin'])&& $_SESSION['admin'] == "yes"){
    
    /* VIEWS */
    
    if(isset($_GET['cp'])){
        $admin_page = "./admin/".$_GET['cp'].".php";
        if(is_file($admin_page) && file_exists($admin_page)){
            include_once $admin_page;
        }else{
            go("index.php?page=404");
        }
    }else{
        include_once './admin/Home.php';
    }
    
    
}else{
    /* VIEWS */
    $pageTitle = "دخول";
    $pageDescript = "nofollow";
    $pageKeyWord = array("");
    include './views/vCpLogin.php';
    
}