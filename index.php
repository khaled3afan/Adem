<?php
include './ad-define.php';
$db = new AD_Query;
$view = new AD_View(THEME_NAME);


/* get INFO from DB */

$info = $db->DB_Select("info",array(
    "order"=>["info_id","ASC"],
    "limit"=>[0,3]
    ));

/* get SOCIAL from DB */
$social = $db->DB_Select("social",array("where"=>["sc_link","!="," "]));


// update visitor
$visit = $db->DB_Query("UPDATE settings SET sett_value=sett_value+1 WHERE sett_name='visits'");

// View
$view->view("index",array(
    "key"=>$db->getSettingVal("site_keywords"),
    "title"=>"index",
    "Des"=>$db->getSettingVal("site_descrip"),
    "social"=>$social,
    "info"=>$info
));

$db->DB_Free($social);
$db->DB_Free($info);