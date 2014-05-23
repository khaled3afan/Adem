<?php
include './ad-define.php';

$view = new AD_View(THEME_NAME);
$db = new AD_Query;

/* get INFO from DB */
$info_query = "SELECT * FROM info ORDER BY `info_id` ASC  LIMIT 0,10";
$info = $db->DB_Query($info_query);

/* get SOCIAL from DB */
$social_query = "SELECT * FROM social WHERE sc_link !='' limit 0,10";
$social = $db->DB_Query($social_query);

/* UPDATE VISITE */
$db->DB_Query("UPDATE settings SET sett_value=sett_value+1 WHERE sett_name='visits'");
// View
$view->view("index",array(
	"key"=>array(),
	"title"=>"index",
	"Des"=>"",
	// send queries to view files
	"social"=>$social,
	"info"=>$info
));