<?php
include './ad-define.php';
$db = new AD_Query;
$view = new AD_View(THEME_NAME);


if(isset($_REQUEST['page'])){
    if(!empty($_REQUEST['page'])){
        $p = clearGET($_REQUEST['page']);
        if(is_end_slash($p)){
            $p = clear_end_slash($p);
        }
        if(is_page()){
            $page_info = $db->DB_FetAs($db->DB_Select("pages",array("where"=>["page_url","=",$p])));
            $GLOBALS['page_info'] = $page_info;
            $view->view("page",array(
                "title"=>"pages",
                "Des"=>$page_info['page_Des'],
                "key"=>$page_info['page_keyword'],
                "page_info"=>$GLOBALS['page_info']
            ));
        }else{
            $view->view("404",array(
                "key"=>null,
                "title"=>"404",
                "Des"=>null,
            ));
        }
    }else{
        
        $view->view("404",array(
            "key"=>array(),
            "title"=>"404",
            "Des"=>"",
        ));
        
    }
}