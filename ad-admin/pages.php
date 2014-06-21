<?php
session_start();

include '../ad-define.php';
if(is_admin()){
    $DB_Pages = new AD_Query();
    $view = new AD_View(null,"ad-admin-style");
    
    /***** ADD NEW CODE AREA ! *****/   
    if(isset($_GET['add-new'])){
        
        
        if(isset($_POST['add'])  && $_POST['add'] == "YES"){
            $return = [];
            $title = clearPOST($_POST['p_title']);
            $content = addslashes($_POST['p_content']);
            $des = clearPOST($_POST['p_des']);
            $key = clearPOST($_POST['p_key']);
            $url = clearPOST($_POST['p_url']);
            $comments = clearPOST($_POST['p_comments']);
            
            
            
            if(!empty($title) && !empty($content)){
                $comments = $comments == "true" ? "1" : "0";
                if($url == ""){
                    $url = rand(00000,99999);
                }else{
                    $space = stripos($url," ");
                }
                
                if($des == ""){
                    $cut = substr($page['page_content'],0,200);
                    $des = strip_tags($cut);
                }
                
                if((isset($space) && $space == false) || !isset($space)){
                    $chek = $DB_Pages->DB_Num($DB_Pages->DB_Select("pages",['where'=>['page_url','=',$url]]));
                    if($chek == 0){
                        $date = date("d / M / Y - H:m:s A",time());
                        $queryADD = $DB_Pages->DB_Query("INSERT INTO pages (page_url,page_title,page_content,`page_Des`,page_keyword,page_date,allow_comments)"
                                . " VALUES ('$url','$title','$content','$des','$key','$date','$comments')");
                        if(isset($queryADD)){
                            $return['success'] = 1;
                            $return['msg'] = "تمت إضافة الصفحة بنجاح!";
                            $return['url'] = "".SITE_URL."/page/".$url."";
                            echo json_encode($return);
                            die;
                        }
                    }else{
                        $return['success'] = 0;
                        $return['msg'] = "هذا الرابط مستخدم من قبل .";
                        echo json_encode($return);
                        die;
                    }
                }else{
                    $return['msg'] = "في الرابط امسح المسافات .";
                    $return['success'] = 0;
                    echo json_encode($return);
                    die;
                }
                die;
            }else{
                $return['success'] = 0;
                $return['msg'] = "أدخل عنوان الصفحة واسمها على الأقل .";
                echo json_encode($return);
                die;
            }
            die;
        }
        $view->view("vAddNewPage",[
            "title"=>"إضافة صفحة جديدة",
            "Des"=>null,
            "Key"=>null
        ]);
        die;
    }
    
    
    
    /***** PAGES LIST CODE AREA ! *****/  
    $GetPage = !isset($_GET['page']) ? "1" : (int)$_GET['page'];
    $page = clearPOST($GetPage);
    $at_page = 10;
    $qPage = $DB_Pages->DB_Select("pages");
    $at_db = $DB_Pages->DB_Num($qPage);
    $DB_Pages->DB_Free($qPage);
    $count = (int)  ceil($at_db / $at_page);
    
    // Select
    $start = ($page -1) * $at_page;
    $end = $at_page;
    
    if($count != 0){
        $QEShow = $DB_Pages->DB_Select("pages",array("limit"=>[$start,$end]));
        $view->set("pagesQEditShow",$QEShow);
    }
    
    
    /***** EDIT CODE AREA ! *****/  
    
    if(isset($_GET['edit'])){
        $gEdit = clearPOST($_GET['edit']);
        if(!empty($gEdit)){
            
            // SEND DATA TO VIEW FILE!
            $getData = $DB_Pages->DB_Select("pages",['where'=>['page_id','=',$gEdit]]);
            $pageData = $DB_Pages->DB_FetAs($getData);
            if($DB_Pages->DB_Num($getData) == 1){
                $view->set("EditPage",$pageData);
            }
            
            if(isset($_POST['edit']) && $_POST['edit'] == "YES"){
                $return = [];
                $title = clearPOST($_POST['p_title']);
                $content = addslashes($_POST['p_content']);
                $des = clearPOST($_POST['p_des']);
                $key = clearPOST($_POST['p_key']);
                $url = clearPOST($_POST['p_url']);
                $comments = clearPOST($_POST['p_comments']);



                if(!empty($title) && !empty($content)){
                    $comments = $comments == "true" ? "1" : "0";
                    if($url == ""){
                        $url = rand(00000,99999);
                    }else{
                        $space = stripos($url," ");
                    }
                    if($des == ""){
                        $cut = substr($content,0,200);
                        $des = strip_tags($cut);
                    }
                    
                    if((isset($space) && $space == false) || !isset($space)){
                        $chek = $DB_Pages->DB_Select("pages",['where'=>['page_url','=',$url]]);
                        $num_ck = $DB_Pages->DB_Num($chek);
                        $chek = $DB_Pages->DB_FetAs($chek);
                        if(($chek['page_url'] == $pageData['page_url']) || ($num_ck == 0) ){
                            $upQuery = $DB_Pages->DB_Query("UPDATE pages SET "
                                    . "page_url='$url',page_title='$title',page_content='$content',`page_Des`='$des',"
                                    . "page_keyword='$key',allow_comments='$comments' WHERE page_id='".mysql_real_escape_string($gEdit)."'");
                            if(isset($upQuery)){
                                $return['success'] = 1;
                                $return['msg'] = "تم تعديل الصفحة بنجاح!";
                                $return['url'] = "".SITE_URL."/page/".$url."";
                                echo json_encode($return);
                                die;
                            }
                        }else{
                            $return['success'] = 0;
                            $return['msg'] = "هذا الرابط مستخدم من قبل .";
                            echo json_encode($return);
                            die;
                        }
                    }else{
                        $return['msg'] = "في الرابط امسح المسافات .";
                        $return['success'] = 0;
                        echo json_encode($return);
                        die;
                    }
                    die;
                }else{
                    $return['success'] = 0;
                    $return['msg'] = "أدخل عنوان الصفحة واسمها على الأقل .";
                    echo json_encode($return);
                    die;
                }
            }
            
            $view->view("vPageEdit",array(
                "title"=>"تعديل صفحة ( ".$pageData['page_title']." )",
                "Des"=>null,
                "Key"=>null
            ));
        }
        die;
    }
    
    /***** DELETE CODE AREA ! *****/  
    if(isset($_POST['delete_page'])){
        $del = clearPOST($_POST['delete_page']);
        $return = array();
        if(!empty($del)){
            $check = $DB_Pages->DB_Num($DB_Pages->DB_Select("pages",['where'=>["page_id","=",$del]]));
            if($check == 1){
                $q = $DB_Pages->DB_Query("DELETE FROM pages WHERE page_id='".mysql_real_escape_string($del)."'"); 
                if(isset($q)){
                    $check_del = $DB_Pages->DB_Num($DB_Pages->DB_Select("pages",['where'=>["page_id","=",$del]]));
                    if($check_del == 0){
                        $return['success'] = 1;
                        $return['msg'] = "تم الحذف بنجاح!";
                        echo json_encode($return);
                        die;
                    }else{
                        $return['success'] = 0;
                        $return['msg'] = "حصل خطأ ما في الحذف";
                        echo json_encode($return);
                        die;
                    }
                }
            }else{
                if($check > 1){
                    $return['success'] = 0;
                    $return['msg'] = "هناك أكثر من صفحة بهذا الرقم";
                    echo json_encode($return);
                    die;
                }elseif($check < 1){
                    $return['success'] = 0;
                    $return['msg'] = "لا توجد صفحة بهذا الرقم";
                    echo json_encode($return);
                    die;
                }else{
                    
                }
            }
        }else{
            $return['success'] = 0;
            $return['msg'] = "البيانات فارغة.";
            echo json_encode($return);
            die;
        }
    }
    
    
    // VIEW
    $view->view("vPages",array(
        "title"=>"الصفحات",
        "key"=>NULL,
        "des"=>NULL,
        "page_get"=>$page,
        "page_count"=>$count,
    ));
}else{
    header("location: ".SITE_URL."/user/login");
}