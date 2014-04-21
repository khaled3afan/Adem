<?php
$Meta = new AD_Query();

/* GET SITE NAME */
$siteName = $Meta->getSettingVal("site_name");

/* GET SITE DESCRIP */
$siteDescrip = $Meta->getSettingVal("site_descrip");

?>
<!DOCTYPE html>
<html>
    <head>
        <title><?php if($pTitle == "index" ){
        _e($siteName); _e(" | "); _e($siteDescrip);
        }else{
            _e($pTitle);
        }
        ?>
        </title>
        <meta charset="UTF-8">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="<?php _e(THEME_FOLDER) ?>/cdn/bootstrap/css/bootstrap-rtl.css"/>
        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
        <link rel="stylesheet" href="<?php _e(THEME_FOLDER) ?>/cdn/css/v3.css"/>
        <meta name="description" content="<?php _e($pDes)?>" />
        <meta name="keywords" content="<?php _e(implode(",",$pKey));?>" />
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css"/>
        <script type="text/javascript">
            function go(to){
                window.location = to;
            }
        </script>
    </head>
    <body>
        <div class="warp">
            <div class="header">
                <div class="logo">
                    <a href="<?php _e(SITE_URL)?>"><?php _e($siteName) ?></a>
                    <br/>
                    <br/>
                    <span id="description"><?php _e($siteDescrip) ?></span>
                </div>
            </div>