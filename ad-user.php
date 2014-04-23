<?php
session_start();

include './ad-define.php';
include ASB_PATH.DIRECTORY_SEPARATOR."ad-includes".DIRECTORY_SEPARATOR."libs".DIRECTORY_SEPARATOR."PHPMailer".DIRECTORY_SEPARATOR."PHPMailerAutoload.php";
$view = new AD_View(null,"ad-admin/ad-admin-style");

$loginDB = new AD_Query();

if(isset($_REQUEST['action']) && !empty($_REQUEST['action'])){
    
    switch ($_REQUEST['action']):
        
        /* login */
        case "login":
            if(is_admin() == FALSE){
                if(isset($_POST['password'])){
                    $return = [];
                    if(!empty($_POST['password'])){
                        $post_password = clearPOST($_POST['password']);
                        $passINDB = $loginDB->getSettingVal("password");
                        $passwordMD5 = md5(md5($post_password));
                        
                        if($passwordMD5 == $passINDB){
                            // creat SESSION
                            $_SESSION['is_admin'] = "TRUE";
                            $_SESSION['logined'] = "TRUE";
                            $return['success'] = 1;
                            echo json_encode($return);
                            die;
                            //header("location: ".SITE_URL."/ad-admin");
                        }else{
                            $return['success'] = 0;
                            $return['msg'] = "كلمة المرور المدخلة غير صحيحة .";
                            echo json_encode($return);
                            die;
                        }
                    }else{
                        $return['success'] = 0;
                        $return['msg'] = "أدخل كلمة المرور .";
                        echo json_encode($return);
                        die;
                    }
                }
            }else{
                header("location: ".SITE_URL."/ad-admin");
            }
            // view
            $view->view("login",array(
                "title" => "الدخول للوحة التحكم.",
                "key"=>array(),
                "Des" => ""
            ));
            break;
        
        /* logout */
        case "logout":
            if(isset($_SESSION['is_admin'])){
                if(is_admin() == TRUE){
                    if(session_destroy()){
                        $logout_Messge = TRUE;
                        $view->set("logout_Messge",$logout_Messge);
                    }else{
                        $logout_Messge = FALSE;
                    }
                }else{
                    header("location: ".SITE_URL."/user/login");
                }
            }else{
                header("location: ".SITE_URL."/user/login");
            }
            // view
            $view->view("logout",array(
                "title" => "الخروج .",
                "key"=>array(),
                "Des" => ""
            ));
            break;
        
        case "lost_password":
            
            if(isset($_POST['lost_password'])){
                $lost_password = clearPOST($_POST['lost_password']);
                $return = [];
                if(!empty($lost_password)){
                    $getEmail = $loginDB->getSettingVal("email");
                    if($lost_password == $getEmail){
                        
                        if(isset($_SESSION['auth_reset'])){
                            unset($_SESSION["auth_reset"]);
                        }
                        
                        $token = md5(md5(md5(microtime())));
                        $_SESSION['auth_reset'] = $token;
                        
                        
                        $mail = new PHPMailer();
                        $mail->IsSMTP();
                        $mail->SMTPAuth = true; 
                        $mail->SMTPSecure = "ssl"; 
                        $mail->Host = MAIL_SMTP; 
                        $mail->Port = 465;
                        $mail->Username = $_RESET_EMAIL_SEND_FROM; 
                        $mail->Password = $_RESET_EMAIL_PASSWORD;  
                        $mail->CharSet = 'UTF-8';
                        $mail->AddAddress($getEmail);
                        $mail->SetFrom($_RESET_EMAIL_SEND_FROM,"سكربت أديم");
                        $mail->Subject = "[أديم] إعادة تعيين كلمة المرور .";
                        $mail->Body = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
                                    <html>
                                    <head>
                                      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                                      <title>[Adem] Reset Password</title>
                                    </head>
                                    <body dir="rtl">
                                      <div style="width: 640px; font-family: Arial, Helvetica, sans-serif; font-size: 11px;" dir="rtl">
                                        <h1>أهلًا بعودتك سيدي!</h1>
                                        <h2>
                                        لتغيير كلمة المرور : <span style="color:red;"><a href="'.SITE_URL.'/user/lost_password?reset=password&auth='.$token.'">اضغط هنا</a></span>
                                        </h2>
                                      </div>
                                    </body>
                                    </html>';
                        $mail->AltBody = 'This is a plain-text message body';
                        if(!$mail->send()){
                            $return['success'] = 0;
                            $return['msg'] = "آسف يا سيدي ، حدث خطأ في الاتصال بالخادم .. أرجو المحاولة مرة أخرى .";
                            echo json_encode($return);
                        }else{
                            $return['success'] = 1;
                            $return['msg'] = "رائع .. تم إرسال الرسالة بنجاح!";
                            echo json_encode($return);
                        }
                        
                    }else{
                        $return['success'] = 0;
                        $return['msg'] = "المعذرة ، البريد المدخل غير موجود بقاعدة البيانات .";
                        echo json_encode($return);
                    }
                }else{
                    $return['success'] = 0;
                    $return['msg'] = "أرجو منك يا سيدي إدخال البريد الاكتروني .. كي أستطيع خدمتك! :)";
                    echo json_encode($return);
                }
            }elseif(isset($_REQUEST['reset']) && $_REQUEST['reset'] == "password"){
                if(isset($_REQUEST['auth']) && $_REQUEST['auth'] == $_SESSION['auth_reset']){
                    
                    if(isset($_REQUEST['send']) && $_REQUEST['send']== TRUE){
                        
                        if(isset($_POST['new_pass']) && isset($_POST['r_new_pass'])){
                            $return = [];
                            $new = clearPOST($_POST['new_pass']);
                            $new_r = clearPOST($_POST['r_new_pass']);
                            if(!empty($new) && !empty($new_r)){
                                
                                if($new == $new_r){
                                    
                                    $getPassword = $loginDB->getSettingVal("password");
                                    $md5New = md5(md5($new));
                                    if($md5New != $getPassword){
                                        $update = $loginDB->updateSetting("password",$md5New);
                                        if(isset($update)){
                                            $return['success'] = 1;
                                            $return['msg'] = "مبارك! تم تغيير كلمة المرور .. مرحبًا بك يا سيدي مرة أخرى !";
                                            unset($_SESSION['auth_reset']);
                                            echo json_encode($return);
                                        }else{
                                            $return['success'] = 0;
                                            $return['msg'] = "آسف يا سيدي ، حدث خطأ في آخر اللحظات .. أيمكنك إعادة المحاولة مرة أخرى في وقت لاحق؟";
                                            echo json_encode($return);
                                        }
                                    }else{
                                        $return['success'] = 0;
                                        $return['msg'] = "سيدي كلمة المرور التي أدخلتها ألا تذكرك بشيءٍ ما ؟";
                                        echo json_encode($return);
                                    }
                                }else{
                                    $return['success'] = 0;
                                    $return['msg'] = "كلمتا المرور ليستا متطابقتين !";
                                    echo json_encode($return);
                                }
                                
                                die();
                            }else{
                                $return['success'] = 0;
                                $return['msg'] = "الرجاء ملئ الحقلين سويًا .";
                                echo json_encode($return);
                                die();
                            }
                            die();
                        }
                        die();
                        
                    }elseif(!isset($_REQUEST['send'])){
                        $view->view("lost_password",array(
                            "title" => "إعادة تعيين كلمة المرور .",
                            "key"=>array(),
                            "Des" => ""
                        ));
                    }
                }else{
				
                    header("location: ".SITE_URL."");;
                }
            }else{
                header("location: ".SITE_URL."/user/login");;
            }
            
            break;
        /* no GET */
        default :
            header("location: ".SITE_URL."/user/login");;
            break;
        
    /* END SWITCH */
    endswitch;
}else{
    header("location: ".SITE_URL."/user/login");
}