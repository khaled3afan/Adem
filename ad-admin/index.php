<?php
session_start();

include '../ad-define.php';

if(is_admin()){
	$view = new AD_View(null,"ad-admin-style");
	$view->view("vHome",array(
		"title"=>"لوحة التحكم",
		"key"=>array(),
		"Des"=>""
	));
    
}else{
    header("location: ".SITE_URL."/user/login");
}