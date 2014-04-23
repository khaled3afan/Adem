<?php
/**
 * @package Adem
 * @version 0.2
 * @since 0.1
 * @category connect DB
 * @author Fares AlBelady
 */

// ضع اسم قاعدة البيانات
// SET YOUR DB NAME
define("DB_NAME","DB_NAME");


// ضع اسم المستخدم لقاعدة البيانات
// SET YOUR DB USER
define("DB_USER","DB_USER");

// ضغ كلمة المرور لقاعدة البيانات
// SET YOUR DB PASSWORD
define("DB_PASS","DB_PASSWORD");

// ضع مستضيف قاعدة البيانات ، في العادة يكون بقيمة ( localhost ) إذا حدث خطأ راسل مستضيفك ليعطيك الاسم الخاص به .
// SET YOUR DB HOST , default is be ( localhost ) 
define("DB_HOST","localhost");

// ضع رابط بروتوكول الايميل SMTP .
// SET YOUR STMP MAIL
// expamle : mail.mysite.com or smtp.mysite.com
// GMAIL : smtp.gamil.com  ننصح باستخدامه.
define("MAIL_SMTP","smtp.gmail.com");


// الايميل الذي سترسل منه رسالة استعادة كلمة المرور
// لابد أن يكون البريد مستضاف تحت ذات البروتوكول
// SET your Email will reset password Msg send from it.
$_RESET_EMAIL_SEND_FROM = "EMAIL"; // هنا 


// كلمة مرور الايميل 
// SET your Email Password 
$_RESET_EMAIL_PASSWORD = "EMAIL_PASSWORD" ; // هنا .

/*
شكرًا لك ! ، إلى هنا أديم أصبح جاهزًا للعمل! .
فقط ادخل على ملف adem.sql وضع بياناتك وارفعها إلى قاعدة البيانات .

- فارس ، مطوّر سكربت أديم .
- شكرًا لك .

*/


/* START WORK ! */

include ASB_PATH.DIRECTORY_SEPARATOR.'ad-includes'.DIRECTORY_SEPARATOR.'class.AD_Connect.php';

$connect = new AD_Connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);