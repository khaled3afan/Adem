<!DOCTYPE html>
<html>
    <head>
        <title><?php TMPL_SiteTitle();?></title>
        <meta charset="UTF-8">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="<?php TMPL_ThemeUrl() ?>/cdn/bootstrap/css/bootstrap-rtl.css"/>
        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
        <link rel="stylesheet" href="<?php TMPL_ThemeUrl() ?>/cdn/css/v3.css"/>
        <meta name="description" content="<?php TMPL_Descrip() ?>" />
        <meta name="keywords" content="<?php TMPL_Keywords() ?>" />
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
                    <a href="<?php TMPL_SiteUrl() ?>"><?php TMPL_SiteName() ?></a>
                    <br/>
                    <br/>
                    <span id="description"><?php TMPL_SiteDescrip() ?></span>
                </div>
            </div>