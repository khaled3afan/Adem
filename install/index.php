<?php
session_start();
ob_start();
include '../ad-includes/function.php';
include '../ad-includes/class.AD_AutoLoader.php';
new AD_AutoLoader("../ad-inculdes");
$db = new AD_Query;

$AD_Version = '0.5.2';

function installer_Error($text){
    echo '<div class="alert alert-danger">'.$text.'</div>';
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>مُنصّب أديم</title>
        <link rel="stylesheet" href="installer-style.css"/>
    </head>
    <body>
        <div id="warp">
            <div class="header">
                <?php if(isseT($_GET['step'])){
                    switch ($_GET['step']):
    case "done":
        ?>
                <h3>تم تنصيب <a href="//adem.faares.com">أديم</a> بنجاح!</h3>
        <?php
break;
        case "1":case"2":case"3":
                            ?>
                <h3>سيتم تنصيب <a href="//adem.faares.com">أديم</a> في 3 خطوات فقط ، إنه سهل جدًا!</h3>
                <?php
                            break;
                    endswitch;
                }
?>
                <?php if(isset($_GET['step'])){
                    switch ($_GET['step']):
                        case "1":
                        ?>
                <p>سنحتاج أولًا إلى معلومات قاعدة البيانات .</p>
                        <?php
                                break;
                        case "2":
                        ?>
                <p>ثانيًا سنحتاج إلى بيانات الدخول الخاصة بك .</p>
                        <?php
                                break;
                        case "3":
                        ?>
                <p>آخر خطوة! ، سنحتاج الآن للبيانات الخاصة بالموقع .</p>
                        <?php
                                break;
                    endswitch;
                } ?>
            </div>
            <div class="installer-box">
                <?php
                if(isset($_GET['step'])){
                    
                    switch ($_GET['step']):
                        
                        case "1":
                            if(isset($_SESSION['step_one']) && $_SESSION['step_one'] == true){header("location: index.php?step=2");}
                            ?>
                <form action="index.php?step=1" method="POST">
                    <div class="form-group">
                        <label>اسم قاعدة البيانات :</label>
                        <input type="text" class="form-control" dir="ltr" name="db_name"/>
                    </div>
                    <br/>
                    <div class="form-group">
                        <label>اسم مستخدم قاعدة البيانات :</label>
                        <input type="text" class="form-control" dir="ltr" name="db_user"/>
                    </div>
                    <br/>
                    <div class="form-group">
                        <label>كلمة مرور مستخدم قاعدة البيانات :</label>
                        <input type="password" class="form-control" dir="ltr" name="db_pass"/>
                    </div>
                    <br/>
                    <div class="form-group">
                        <label>مستضيف قاعدة البيانات :</label>
                        <input type="text" class="form-control" dir="ltr" name="db_host" placeholder="الافتراضي : localhost" value="localhost"/>
                        <span class="note">القيمة الافتراضية هي <cde>localhost</cde> إن لم تعمل معك راسل مستضيفك ليخبرك بها .</span>
                    </div>
                    <br/>
                    <button name="install" value="step_one" class="btn btn-primary">الخطوة التالية &raquo;</button>
                    <br/>
                </form>
                <br/>
                            <?php
                            if(isset($_POST['install']) && $_POST['install'] == "step_one"){
                                if(isset($_POST['db_name']) && isset($_POST['db_user']) && isset($_POST['db_pass']) && isset($_POST['db_host'])){
                                    $name = clearPOST($_POST['db_name']);
                                    $user = clearPOST($_POST['db_user']);
                                    $pass = clearPOST($_POST['db_pass']);
                                    $host = clearPOST($_POST['db_host']);
                                    if(!empty($name) && !empty($user) && !empty($pass) && !empty($host)){
                                        $test_connect = mysql_connect($host,$user,$pass) or die(installer_Error("حصل خطأ في الاتصال بقاعدة البيانات!"));
                                        $test_select = mysql_select_db($name) or die(installer_Error("لم يتم الوصول إلى  قاعدة البيانات ، تأكد من وجودها."));
                                        mysql_set_charset("UTF8");
                                        if(isset($test_connect) && $test_connect == true && isset($test_select) && $test_select == true){
                                            $_SESSION['db_name'] = $name;
                                            $_SESSION['db_user'] = $user;
                                            $_SESSION['db_pass'] = $pass;
                                            $_SESSION['db_host'] = $host;
                                            $bl_info = $db->DB_Query("CREATE TABLE IF NOT EXISTS `info` (
                                            `info_id` int(11) NOT NULL AUTO_INCREMENT,
                                            `info_name` varchar(255) NOT NULL,
                                            `info_styleID` varchar(255) NOT NULL,
                                            `info_tooltip` varchar(255) NOT NULL,
                                            `info_content` text NOT NULL,
                                            PRIMARY KEY (`info_id`)
                                          ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=36 ;");
                                            $bl_settings = $db->DB_Query("CREATE TABLE IF NOT EXISTS `settings` (
                                            `sid` int(11) NOT NULL AUTO_INCREMENT,
                                            `sett_name` varchar(255) NOT NULL,
                                            `sett_value` text NOT NULL,
                                            PRIMARY KEY (`sid`)
                                          ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;
                                          ");
                                            $bl_social = $db->DB_Query("CREATE TABLE IF NOT EXISTS `social` (
                                            `sc_id` int(11) NOT NULL AUTO_INCREMENT,
                                            `sc_name` varchar(255) NOT NULL,
                                            `sc_link` varchar(255) NOT NULL,
                                            PRIMARY KEY (`sc_id`)
                                          ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;");
                                            
                                            $bl_pages = $db->DB_Query("CREATE TABLE IF NOT EXISTS `pages` (
                                          `page_id` int(11) NOT NULL AUTO_INCREMENT,
                                          `page_url` varchar(255) NOT NULL,
                                          `page_title` varchar(255) NOT NULL,
                                          `page_content` longtext NOT NULL,
                                          `page_Des` varchar(255) NOT NULL,
                                          `page_keyword` varchar(255) NOT NULL,
                                          `page_date` varchar(255) NOT NULL,
                                          `allow_comments` tinyint(1) NOT NULL,
                                          PRIMARY KEY (`page_id`),
                                          UNIQUE KEY `page_url` (`page_url`)
                                        ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=45 ;");

                                            if(($bl_info && $bl_settings && $bl_social && $bl_pages) == true){
                                                $add_settings = $db->DB_Query("INSERT INTO `settings` (`sid`, `sett_name`, `sett_value`) VALUES
                                                (1, 'site_url', ''),
                                                (2, 'site_name', ''),
                                                (3, 'site_descrip', ''),
                                                (4, 'google_code', ''),
                                                (5, 'email', ''),
                                                (6, 'password', '8a8e83876e81242bee8a620b2967dc33'),
                                                (9, 'site_keywords', ''),
                                                (8, 'visits', ''),
                                                (7, 'last_login', ''),
                                                (10, 'theme_name', 'default');");
                                                $add_social = $db->DB_Query("INSERT INTO `social` (`sc_id`, `sc_name`, `sc_link`) VALUES
                                                (1, 'twitter', ''),
                                                (2, 'facebook', ''),
                                                (3, 'google-plus', ''),
                                                (4, 'instagram', ''),
                                                (5, 'tumblr', ''),
                                                (6, 'skype', ''),
                                                (7, 'youtube', ''),
                                                (8, 'github', '');");
                                                
                                                if(($add_social && $add_settings) == TRUE){
                                                    $_SESSION['step_one'] = true;
                                                    mysql_close($test_connect);
                                                    header("location: index.php?step=2");
                                                }else{
                                                    installer_Error("حصل خطأ في إدخال البيانات الأساسية إلى الجداول .");
                                                }
                                            }else{
                                                installer_Error("حصل خطأ في بناء الجداول .");
                                            }
                                        }else{
                                            installer_Error("حصل خطأ في الاتصال والوصول لقاعدة البيانات .");
                                        }
                                    }else{
                                        installer_Error("تأكد من إدخال كافة الحقول يا صديقي!");
                                    }
                                }else{
                                    installer_Error("لم تدخل أي بيانات يا صديقي!");
                                }
                                
                            }
                            // end step 1
                            break;
                            
                        case "2":
                            // Check if STEP ONE IS DONE!
                            if(isset($_SESSION['step_two']) && $_SESSION['step_two'] == true){header("location: index.php?step=3");}
                            elseif(!isset($_SESSION['step_one']) || $_SESSION['step_one'] != TRUE){
                                header("location: index.php?step=1");
                            }
                            ?>
                <form action="index.php?step=2" method="POST">
                    <div class="form-group">
                        <label>كلمة المرور :</label>
                        <input type="password" class="form-control" dir="ltr" name="pass"/>
                        <span class="note">يفضل لو تحتوي على رموز وأرقام وحروف وتكون أطول من 8 مُدخلات.</span>
                    </div>
                    <br/>
                    <div class="form-group">
                        <label>البريد الالكتروني الخاص باستعادة كلمة المرور :</label>
                        <input type="email" class="form-control" dir="ltr" name="email_reset"/>
                        <span class="note">تستطيع تغييره فيما بعد من لوحة التحكم .</span>
                    </div>
                    <br/>
                    <div class="alert alert-warning">
                        <span>لا يستطيع أديم إرسال الرسائل البريدية من تلقاء نفسه ، لا يزال  غير قادر .. لأجل ذلك هَب أديم بريدًا الكترونيًا يستطيع من خلاله إرسال رسالة استعادة كلمة المرور إليك .</span>
                        <span class="note">إن لم ترد ذلك ، فلن تستطيع استعادة كلمة المرور لأجل هذا فهذه الخطوة مهمة جدًا .</span>
                    </div>
                    <div class="form-group">
                        <label>البريد الالكتروني الخاص بأديم :</label>
                        <input type="email" class="form-control" dir="ltr" name="email_send"/>
                        <span class="note">يجب أن يكون Gmail .</span>
                    </div>
                    <br/>
                    <div class="form-group">
                        <label>كلمة مرور البريد الالكتروني الخاص بأديم :</label>
                        <input type="password" class="form-control" dir="ltr" name="email_pass"/>
                    </div>
                    <br/>
                    <button name="install" value="step_two" class="btn btn-primary">الخطوة التالية &raquo;</button>
                    <br/>
                </form>
                <br/>
                            <?php
                            if(isset($_POST['install']) && $_POST['install'] == "step_two"){
                                if(isset($_POST['pass']) && isset($_POST['email_reset']) && isset($_POST['email_send']) && isset($_POST['email_pass'])){
                                    $db_name = $_SESSION['db_name'];
                                    $db_pass = $_SESSION['db_pass'];
                                    $db_user = $_SESSION['db_user'];
                                    $db_host = $_SESSION['db_host'];
                                    
                                    $test_connect = mysql_connect($db_host,$db_user,$db_pass) or die(installer_Error("حصل خطأ في الاتصال بقاعدة البيانات!"));
                                    $test_select = mysql_select_db($db_name) or die(installer_Error("لم يتم الوصول إلى  قاعدة البيانات ، تأكد من وجودها."));
                                        
                                    $pass = clearPOST($_POST['pass']);
                                    $email = clearPOST($_POST['email_reset']);
                                    $e_send = clearPOST($_POST['email_send']);
                                    $e_pass = clearPOST($_POST['email_pass']);
                                    if(!empty($pass) && !empty($email) && !empty($e_send) && !empty($e_pass)){
                                        $is_gmail = stristr($e_send, '@gmail.com');
                                        if($is_gmail == "@gmail.com"){
                                            $passMD5 = md5(md5($pass));
                                            $in_pass = $db->updateSetting("password",$passMD5);
                                            $in_email = $db->updateSetting("email",$email);
                                            if(($in_email && $in_pass) == true){
                                            
                                                $config_content = '
<?php
 /**
  * @package Adem
  * @version 0.3
  * @since 0.1
  * @category connect DB
  * @author Fares AlBelady
  */

 // ضع اسم قاعدة البيانات
 // SET YOUR DB NAME
 define("DB_NAME","'.$db_name.'");


 // ضع اسم المستخدم لقاعدة البيانات
 // SET YOUR DB USER
 define("DB_USER","'.$db_user.'");

 // ضغ كلمة المرور لقاعدة البيانات
 // SET YOUR DB PASSWORD
 define("DB_PASS","'.$db_pass.'");

 // ضع مستضيف قاعدة البيانات ، في العادة يكون بقيمة ( localhost ) إذا حدث خطأ راسل مستضيفك ليعطيك الاسم الخاص به .
 // SET YOUR DB HOST , default is be ( localhost ) 
 define("DB_HOST","'.$db_host.'");

 // ضع رابط بروتوكول الايميل SMTP .
 // SET YOUR STMP MAIL
 // expamle : mail.mysite.com or smtp.mysite.com
 // GMAIL : smtp.gamil.com  ننصح باستخدامه.
 define("MAIL_SMTP","smtp.gmail.com");


 // الايميل الذي سترسل منه رسالة استعادة كلمة المرور
 // لابد أن يكون البريد مستضاف تحت ذات البروتوكول
 // SET your Email will reset password Msg send from it.
 $_RESET_EMAIL_SEND_FROM = "'.$e_send.'"; // هنا 


 // كلمة مرور الايميل 
 // SET your Email Password 
 $_RESET_EMAIL_PASSWORD = "'.$e_pass.'" ; // هنا .

 /*
 شكرًا لك ! ، إلى هنا أديم أصبح جاهزًا للعمل! .

 - فارس ، مطوّر سكربت أديم .
 - شكرًا لك .

 */


 /* START WORK ! */

 include ASB_PATH.DIRECTORY_SEPARATOR."ad-includes".DIRECTORY_SEPARATOR."class.AD_Connect.php";

 $connect = new AD_Connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);';
                                            
                                                $creat_config = file_put_contents("../ad-config.php",$config_content);
                                                if($creat_config == true){
                                                    $_SESSION['step_two'] = true;
                                                    mysql_close($test_connect);
                                                    header("location: index.php?step=3");
                                                }else{
                                                    installer_Error("حصل خطأ في إنشاء ملف <code>ad-config.php</code> .");
                                                }
                                            }else{
                                                installer_Error("حصل خطأ في إضافة كلمة المرور والبريد الالكتروني .");
                                            }
                                        }else{
                                            installer_Error("البريد الالكتروني الخاص بأديم ليس بـ Gmail ، الرجاء التأكد من ذلك .");
                                        }
                                        
                                    }else{
                                        installer_Error("تأكد من إدخال كافة الحقول يا صديقي!");
                                    }
                                }
                            }
                            
                            
                            
                            break;
                            
                            
                        case "3":
                            // Check if STEP TWO IS DONE!
                            if(isset($_SESSION['step_three']) && $_SESSION['step_three'] == true){header("location: index.php?step=done");}
                            elseif(!isset($_SESSION['step_two']) || $_SESSION['step_two'] != TRUE){
                                header("location: index.php?step=2");
                            }
                            ?>
                                <form action="index.php?step=3" method="POST">
                    <div class="form-group">
                        <label>رابط الموقع :</label>
                        <input type="url" class="form-control" dir="ltr" name="url"/>
                    </div>
                    <br/>
                    <div class="form-group">
                        <span class="note"></span><label>اسم الموقع :</label>
                        <input type="text" class="form-control" name="site_name"/>
                    </div>
                    <br/>
                    <div class="form-group">
                        <span class="note"></span><label>وصف الموقع :</label>
                        <textarea class="form-control"  name="site_des"></textarea>
                    </div>
                    <br/>
                    <div class="form-group">
                        <span class="note"></span><label>الكلمات الدلالية الخاصة بالموقع :</label>
                        <input type="text" class="form-control" name="site_key" placeholder="افصل بين كل كلمة وأخرى بـ ( , )"/>
                    </div>
                    <br/>
                    (<span class="note"></span>) : <span style="font-size: 13px;color: #990000;">تستطيع تغييره فيما بعد من لوحة التحكم .</span>
                    <br/>
                    <br/>
                    <button name="install" value="step_three" class="btn btn-primary">الخطوة التالية &raquo;</button>
                    <br/>
                </form>
                <br/>
                            <?php
                            if(isset($_POST['install']) && $_POST['install'] == "step_three"){
                                if(isset($_POST['url']) && isset($_POST['site_name']) && isset($_POST['site_des']) && isset($_POST['site_key'])){
                                    $db_name = $_SESSION['db_name'];
                                    $db_pass = $_SESSION['db_pass'];
                                    $db_user = $_SESSION['db_user'];
                                    $db_host = $_SESSION['db_host'];
                                    
                                    $test_connect = mysql_connect($db_host,$db_user,$db_pass) or die(installer_Error("حصل خطأ في الاتصال بقاعدة البيانات!"));
                                    $test_select = mysql_select_db($db_name) or die(installer_Error("لم يتم الوصول إلى  قاعدة البيانات ، تأكد من وجودها."));
                                    mysql_set_charset("UTF8");
                                    
                                    $url = clearPOST($_POST['url']);
                                    $name = clearPOST($_POST['site_name']);
                                    $des = clearPOST($_POST['site_des']);
                                    $key = clearPOST($_POST['site_key']);
                                    
                                    if(!empty($url) && !empty($name) && !empty($des) && !empty($key)){
                                        // check is end of url = /
                                        if(substr($url,-1,1) == "/"){
                                            $url = substr($url,0,strlen($url)-1);
                                        }
                                        $_SESSION['url'] = $url;
                                        
                                        $in_url = $db->updateSetting("site_url",$url);
                                        $in_name = $db->updateSetting("site_name",$name);
                                        $in_des = $db->updateSetting("site_descrip",$des);
                                        $in_key = $db->updateSetting("site_keywords",$key);
                                        
                                        if(($in_des && $in_url && $in_key && $in_name) == true){
                                            $_SESSION['step_three'] = true;
                                            mysql_close($test_connect);
                                            header("location: index.php?step=done");
                                        }else{
                                            installer_Error("حصل خطأ في إدخال البيانات .");
                                        }
                                    }else{
                                        installer_Error("تأكد من إدخال كافة الحقول يا صديقي!");
                                    } 
                                }
                            }
                            // end step 3
                            break;
                            
                        case "done":
                            
                            if(($_SESSION['step_one'] && $_SESSION['step_two'] && $_SESSION['step_three']) != true){
                                header("location: index.php?step=1");
                            }
                            ?>
                <div class="done">
                    <h1 style="color: green">تهانينا!</h1>
                    <p>تم تنصيب أديم بنجاح ، تستطيع الآن <a href="<?php echo $_SESSION['url'] ?>/user/login">الدخول للوحة التحكم.</a> واستخدام أديم ، نتمنى لك تجربة سعيدة مع أديم!</p>
                    <span class="note">لأسباب أمنية سيتم حذف مساعد التنصيب آليًا ، لذلك لا تقلق من اختفاءه فجأة!</span>
                </div>
                            <?php
							$curl = new AD_Curl();
							$data = ['url'=>$_SESSION['url'],'version'=>$AD_Version];
							$send = $curl->send_post("http://adem.faares.com/install.php",$data);
							if($send['success'] != true){
								?>
								<br/>
								<span class="note">حصل خطأ في إخبار مطوّر أديم بتنصيبك أديم ، يفضّل لو تعلمه بذلك كي يستمر بتطوير أديم .</span>
								<?php
							}
							
							
                            session_destroy();
                            // Delete Folder!!
                            AD_Folders::deleteDir("./");
                            
                            break;
                        default :
                            header("location: index.php?step=1");
                    endswitch;
                    
                }else{
                    header("location: index.php?step=1");
                }
                ?>
            </div>
        </div>
        <div class="footer">
            <p>إن واجهت أي مشكلة في التنصيب ، فمطوّر <a href="//adem.faares.com">أديم</a> ينتظر رسالتك على : <code>support@faares.com</code> ، أو قم بإخباره على تويتر : <a href="//twitter.com/4FSB" dir="ltr">@4FSB</a></p>
            <p><a href="//adem.faares.com">Adem website</a></p>
        </div>
    </body>
</html>