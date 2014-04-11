-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 11 أبريل 2014 الساعة 13:50
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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
