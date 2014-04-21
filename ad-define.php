<?php
/**
 * @package Adem Project.
 * @version 0.1 .
 * @since 0.2 .
 * @category includes file , Defines .
 * @author Fares AlBelady 
 * 
 */

define("ASB_PATH",__DIR__);

include ASB_PATH."\db.php";
include ASB_PATH."\ad-includes\class.AD_AutoLoader.php";
include ASB_PATH.DIRECTORY_SEPARATOR."ad-includes".DIRECTORY_SEPARATOR."function.php";

$a = new AD_AutoLoader(ASB_PATH."\ad-includes");
$DB_Define = new AD_Query;

/* رابط الموقع */
define("SITE_URL",$DB_Define->getSettingVal("site_url"));
if(!defined("SITE_URL")):
    define("SITE_URL",$DB_Define->getSettingVal("site_url"));
endif;
/* اسم الثيم */

define("THEME_NAME",$DB_Define->getSettingVal("theme_name"));
if(!defined("THEME_NAME")):
    define("THEME_NAME",$DB_Define->getSettingVal("theme_name"));
endif;

define("ADMIN_FOLDER",__DIR__.DIRECTORY_SEPARATOR."ad-admin");

/* مسار مجل الثيم */
define("THEME_FOLDER",SITE_URL."/ad-content/ad-themes/".THEME_NAME."");
if(!defined("THEME_FOLDER")):
    define("THEME_FOLDER",SITE_URL."/ad-content/ad-themes/".THEME_NAME."");
endif;