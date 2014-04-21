-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 22 أبريل 2014 الساعة 00:08
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `adem`
--

-- --------------------------------------------------------

--
-- بنية الجدول `info`
--

CREATE TABLE IF NOT EXISTS `info` (
  `info_id` int(11) NOT NULL AUTO_INCREMENT,
  `info_name` varchar(255) NOT NULL,
  `info_styleID` varchar(255) NOT NULL,
  `info_tooltip` varchar(255) NOT NULL,
  `info_content` text NOT NULL,
  PRIMARY KEY (`info_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=36 ;

--
-- إرجاع أو استيراد بيانات الجدول `info`
--

-- --------------------------------------------------------

--
-- بنية الجدول `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `sid` int(11) NOT NULL AUTO_INCREMENT,
  `sett_name` varchar(255) NOT NULL,
  `sett_value` text NOT NULL,
  PRIMARY KEY (`sid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- إرجاع أو استيراد بيانات الجدول `settings`
-- 

INSERT INTO `settings` (`sid`, `sett_name`, `sett_value`) VALUES
(1, 'site_url', 'YOUR SITE URL - improtant!'),
(2, 'site_name', ''),
(3, 'site_descrip', ''),
(4, 'google_code', ''),
(5, 'email', ''),
-- استخدم MD5(MD5(كلمة المرور الخاصة بك))) 
-- كيف؟
-- توجه إلى هذا الموقع :
-- http://writecodeonline.com/php/
-- قم بكتابة الكود التالي :
-- echo md5(md5(yourpassword));
-- سوف تظهر لك كلمة المرور المشفرة في الأسفل انسخها وضعها في الفراغ .
(6, 'password', ''),
(9, 'site_keywords', ''),
(8, 'visits', '243'),
(7, 'last_login', ''),
(10, 'theme_name', 'google');

-- --------------------------------------------------------

--
-- بنية الجدول `social`
--

CREATE TABLE IF NOT EXISTS `social` (
  `sc_id` int(11) NOT NULL AUTO_INCREMENT,
  `sc_name` varchar(255) NOT NULL,
  `sc_link` varchar(255) NOT NULL,
  PRIMARY KEY (`sc_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- إرجاع أو استيراد بيانات الجدول `social`
--

INSERT INTO `social` (`sc_id`, `sc_name`, `sc_link`) VALUES
(1, 'twitter', ''),
(2, 'facebook', ''),
(3, 'google-plus', ''),
(4, 'instagram', ''),
(5, 'tumblr', ''),
(6, 'skype', ''),
(7, 'youtube', ''),
(8, 'github', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
