-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;

-- --------------------------------------------------------

--
-- بنية الجدول `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `sid` int(11) NOT NULL AUTO_INCREMENT,
  `sett_name` varchar(255) NOT NULL,
  `sett_value` text NOT NULL,
  PRIMARY KEY (`sid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;


INSERT INTO `settings` (`sid`, `sett_name`, `sett_value`) VALUES
(1, 'site_url', ''),
(2, 'site_name', 'أديم'),
(3, 'site_descrip', 'سكربت للمواقع الشخصية والتعريفية .'),
(4, 'google_code', ''),
(5, 'email', ''),
(6, 'password', '8a8e83876e81242bee8a620b2967dc33');
-- Password : adem
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

INSERT INTO `social` (`sc_id`, `sc_name`, `sc_link`) VALUES
(1, 'twitter', 'http://Twitter.com'),
(2, 'facebook', 'http://Facebook.com'),
(3, 'google-plus', 'http://plus.google.com'),
(4, 'instagram', 'http://instagram.com'),
(5, 'tumblr', 'http://tumblr.com'),
(6, 'skype', 'http://skype.com'),
(7, 'youtube', 'http://youtube.com'),
(8, 'github', 'http://github.com');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
