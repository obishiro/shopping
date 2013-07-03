-- phpMyAdmin SQL Dump
-- version 3.5.8.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 23, 2013 at 11:21 PM
-- Server version: 5.5.31-0ubuntu0.13.04.1
-- PHP Version: 5.4.9-4ubuntu2.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dbshopping`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE IF NOT EXISTS `account` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Acc_no` varchar(45) DEFAULT NULL,
  `Acc_name` varchar(200) DEFAULT NULL,
  `Acc_type` varchar(200) DEFAULT NULL,
  `Acc_bank` varchar(200) DEFAULT NULL,
  `Acc_branch` varchar(200) DEFAULT NULL,
  `Acc_tel` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `agent`
--

CREATE TABLE IF NOT EXISTS `agent` (
  `Agt_id` int(11) NOT NULL AUTO_INCREMENT,
  `Agt_name` varchar(200) DEFAULT NULL,
  `Agt_address` text,
  `Agt_tel` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`Agt_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `agent`
--

INSERT INTO `agent` (`Agt_id`, `Agt_name`, `Agt_address`, `Agt_tel`) VALUES
(1, 'ร้านทดสอบระบบ', 'กทม', '02222222'),
(2, 'ปนัดดา', 'กทม.', '0801909121');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `Cus_id` int(11) NOT NULL AUTO_INCREMENT,
  `Cus_usr` varchar(45) DEFAULT NULL,
  `Cus_pwd` varchar(45) DEFAULT NULL,
  `Cus_name` varchar(100) DEFAULT NULL,
  `Cus_surname` varchar(100) DEFAULT NULL,
  `Cus_address` varchar(200) DEFAULT NULL,
  `Cus_tel` varchar(45) DEFAULT NULL,
  `Cus_email` varchar(45) DEFAULT NULL,
  `User` varchar(25) NOT NULL,
  PRIMARY KEY (`Cus_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`Cus_id`, `Cus_usr`, `Cus_pwd`, `Cus_name`, `Cus_surname`, `Cus_address`, `Cus_tel`, `Cus_email`, `User`) VALUES
(8, 'test', '1234', 'obishiro', 'upatum', 'surin', '0813209321', 'kscomsci@gmail.com', '');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE IF NOT EXISTS `employees` (
  `Emp_id` int(11) NOT NULL AUTO_INCREMENT,
  `Emp_usr` varchar(45) DEFAULT NULL,
  `Emp_pwd` varchar(45) DEFAULT NULL,
  `Emp_name` varchar(100) DEFAULT NULL,
  `Emp_surname` varchar(100) DEFAULT NULL,
  `Emp_tel` varchar(10) DEFAULT NULL,
  `Emp_email` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`Emp_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE IF NOT EXISTS `order_detail` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Order_id` varchar(45) DEFAULT NULL,
  `Pro_Id` varchar(11) DEFAULT NULL,
  `Pro_name` varchar(255) DEFAULT NULL,
  `Pro_unit` int(11) DEFAULT NULL,
  `Pro_price` int(11) DEFAULT NULL,
  `Pro_total` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=48 ;

-- --------------------------------------------------------

--
-- Table structure for table `order_product`
--

CREATE TABLE IF NOT EXISTS `order_product` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Order_id` varchar(11) DEFAULT NULL,
  `Cus_id` varchar(45) DEFAULT NULL,
  `Order_date` date DEFAULT NULL,
  `Order_total` varchar(45) DEFAULT NULL,
  `Acc_id` varchar(45) DEFAULT NULL,
  `Order_status` varchar(45) DEFAULT NULL,
  `Order_send` varchar(10) DEFAULT NULL,
  `Order_datesend` date DEFAULT NULL,
  `ems_id` varchar(45) DEFAULT NULL,
  `file_recive` varchar(30) NOT NULL,
  `date_send` varchar(30) NOT NULL,
  `User` varchar(25) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=39 ;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Pro_id` varchar(100) DEFAULT NULL,
  `Pro_name` varchar(255) DEFAULT NULL,
  `Pro_img` varchar(100) DEFAULT NULL,
  `Pro_detail` longtext,
  `Pro_price` int(10) DEFAULT NULL,
  `Pro_unit` varchar(6) DEFAULT NULL,
  `Pro_type_id` varchar(45) DEFAULT NULL,
  `Scrape_status` varchar(50) DEFAULT NULL,
  `Main_product_type` int(10) DEFAULT NULL,
  `Sub_product_type` int(10) DEFAULT NULL,
  `Pro_view` int(11) DEFAULT NULL,
  `User` varchar(50) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=70 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`Id`, `Pro_id`, `Pro_name`, `Pro_img`, `Pro_detail`, `Pro_price`, `Pro_unit`, `Pro_type_id`, `Scrape_status`, `Main_product_type`, `Sub_product_type`, `Pro_view`, `User`) VALUES
(64, 'UCWZKM', 'Mainboard', '', '', 1800, '5', '6', '0', 1, 1, NULL, '4'),
(65, 'DJ935R', 'Dress', '', '', 250, '5', '9', '0', 0, 1, NULL, '5'),
(66, '98L89P', 'CLOTH', '', '', 250, '5', '9', '0', 0, 1, NULL, '5'),
(67, 'MJVVEC', 'เสื้อแจ็คเก็ต ', '', '', 350, '5', '9', '0', 0, 1, NULL, '5'),
(68, '7HJ9NG', 'เสื้อกันหนาว', '', '', 350, '5', '9', '0', 0, 1, NULL, '5'),
(69, 'BG2TTW', 'Asrock', '', '', 1800, '5', '6', '0', 0, 1, NULL, '4');

-- --------------------------------------------------------

--
-- Table structure for table `product_type`
--

CREATE TABLE IF NOT EXISTS `product_type` (
  `Pro_type_id` int(6) NOT NULL AUTO_INCREMENT,
  `Pro_type_name` varchar(200) NOT NULL,
  `User` varchar(25) NOT NULL,
  PRIMARY KEY (`Pro_type_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `product_type`
--

INSERT INTO `product_type` (`Pro_type_id`, `Pro_type_name`, `User`) VALUES
(9, 'Dress', '5'),
(6, 'Mainboard', '4');

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE IF NOT EXISTS `purchase` (
  `Pur_id` int(11) NOT NULL AUTO_INCREMENT,
  `Pur_name` varchar(45) DEFAULT NULL,
  `Pur_date` date DEFAULT NULL,
  `Pur_net` varchar(45) DEFAULT NULL,
  `Pur_status` int(11) DEFAULT NULL,
  `Agt_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`Pur_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_detail`
--

CREATE TABLE IF NOT EXISTS `purchase_detail` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Pur_id` int(11) DEFAULT NULL,
  `Pro_id` varchar(6) DEFAULT NULL,
  `Pro_name` varchar(200) DEFAULT NULL,
  `Pur_amount` int(11) DEFAULT NULL,
  `Pur_remain` int(11) DEFAULT NULL,
  `Pur_price` int(11) DEFAULT NULL,
  `Pur_total` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=63 ;

-- --------------------------------------------------------

--
-- Table structure for table `replay_webboard`
--

CREATE TABLE IF NOT EXISTS `replay_webboard` (
  `Id` int(10) NOT NULL AUTO_INCREMENT,
  `TopicId` varchar(255) NOT NULL,
  `TopicDetail` longtext NOT NULL,
  `UsrType` varchar(50) NOT NULL,
  `UsrName` varchar(50) NOT NULL,
  `TopicDate` date NOT NULL,
  `TopicTime` time NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `replay_webboard`
--

INSERT INTO `replay_webboard` (`Id`, `TopicId`, `TopicDetail`, `UsrType`, `UsrName`, `TopicDate`, `TopicTime`) VALUES
(1, '2', 'งิิงิ', 'user', '4', '2013-03-06', '21:45:44');

-- --------------------------------------------------------

--
-- Table structure for table `scrape_detail`
--

CREATE TABLE IF NOT EXISTS `scrape_detail` (
  `Scrape_id` int(10) NOT NULL AUTO_INCREMENT,
  `Pro_id` int(10) NOT NULL DEFAULT '0',
  `Scrape_amount` int(10) NOT NULL DEFAULT '0',
  `Scrape_reason` longtext NOT NULL,
  `Scrape_date` date NOT NULL,
  PRIMARY KEY (`Scrape_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `scrape_detail`
--

INSERT INTO `scrape_detail` (`Scrape_id`, `Pro_id`, `Scrape_amount`, `Scrape_reason`, `Scrape_date`) VALUES
(1, 32, 1, 'มีสินค้าใหม่', '2013-02-20');

-- --------------------------------------------------------

--
-- Table structure for table `tb_config_office`
--

CREATE TABLE IF NOT EXISTS `tb_config_office` (
  `Id` int(10) NOT NULL AUTO_INCREMENT,
  `MMNameTh` varchar(255) DEFAULT NULL,
  `MMNameEn` varchar(255) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `MMTel` varchar(25) DEFAULT NULL,
  `MMWebName` varchar(255) DEFAULT NULL,
  `MMWebTitle` varchar(255) DEFAULT NULL,
  `MMWebKeyword` text,
  `MMWebDetail` text,
  `ImgShop` varchar(45) DEFAULT NULL,
  `User` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tb_config_office`
--

INSERT INTO `tb_config_office` (`Id`, `MMNameTh`, `MMNameEn`, `Address`, `MMTel`, `MMWebName`, `MMWebTitle`, `MMWebKeyword`, `MMWebDetail`, `ImgShop`, `User`) VALUES
(3, 'ร้านตาอบ', 'thaop', 'surin', '0813209321', 'taopshop', 'ร้านตาอบ', 'ร้านตาอบ', 'ร้านตาอบ', NULL, '5'),
(2, 'ร้านนายอบขายรอบโลก 360 shop around the world', 'obishiro', 'surin', '0813209321', 'naiop', 'ร้านนายอบขายรอบโลก', 'ร้านนายอบขายรอบโลก', 'ร้านนายอบขายรอบโลก', NULL, '4');

-- --------------------------------------------------------

--
-- Table structure for table `tb_config_theme`
--

CREATE TABLE IF NOT EXISTS `tb_config_theme` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `ThemeName` varchar(50) NOT NULL,
  `ThemePath` varchar(50) NOT NULL,
  `ThemeImg` varchar(50) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `tb_config_theme`
--

INSERT INTO `tb_config_theme` (`Id`, `ThemeName`, `ThemePath`, `ThemeImg`) VALUES
(1, 'Default', 'default', 'theme_img.png'),
(2, 'BlueTheme', 'default', 'theme_img.png'),
(3, 'GreenTheme', 'default', 'theme_img.png'),
(4, 'BlueTheme', 'default', 'theme_img.png'),
(5, 'GreenTheme', 'default', 'theme_img.png'),
(6, 'BlueTheme', 'default', 'theme_img.png'),
(7, 'GreenTheme', 'default', 'theme_img.png'),
(8, 'BlueTheme', 'default', 'theme_img.png'),
(9, 'GreenTheme', 'default', 'theme_img.png'),
(10, 'BlueTheme', 'default', 'theme_img.png'),
(11, 'GreenTheme', 'default', 'theme_img.png'),
(12, 'BlueTheme', 'default', 'theme_img.png'),
(13, 'GreenTheme', 'default', 'theme_img.png'),
(14, 'BlueTheme', 'default', 'theme_img.png'),
(15, 'GreenTheme', 'default', 'theme_img.png'),
(16, 'BlueTheme', 'default', 'theme_img.png'),
(17, 'GreenTheme', 'default', 'theme_img.png'),
(18, 'BlueTheme', 'default', 'theme_img.png'),
(19, 'GreenTheme', 'default', 'theme_img.png');

-- --------------------------------------------------------

--
-- Table structure for table `tb_config_web`
--

CREATE TABLE IF NOT EXISTS `tb_config_web` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Banner` varchar(50) DEFAULT NULL,
  `ImgMenu` varchar(45) DEFAULT NULL,
  `ImgBg` varchar(100) DEFAULT NULL,
  `HmenuColor` varchar(45) DEFAULT NULL,
  `MenuColor` varchar(45) DEFAULT NULL,
  `HvmenuColor` varchar(45) DEFAULT NULL,
  `User` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tb_config_web`
--

INSERT INTO `tb_config_web` (`Id`, `Banner`, `ImgMenu`, `ImgBg`, `HmenuColor`, `MenuColor`, `HvmenuColor`, `User`) VALUES
(3, 'XRD41K.png', '5.gif', 'flowergardenpattern847.jpg', '#1C77FF', '#FF526F', '#0DCFD6', '4'),
(4, '2B6WPM.png', '30.png', 'upholstery-leather-pattern-1505.png', '#FF0505', '#178F04', '#9CFF2B', '5');

-- --------------------------------------------------------

--
-- Table structure for table `tb_imgproduct`
--

CREATE TABLE IF NOT EXISTS `tb_imgproduct` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `ImgName` varchar(45) DEFAULT NULL,
  `Pro_id` varchar(45) DEFAULT NULL,
  `User` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=56 ;

--
-- Dumping data for table `tb_imgproduct`
--

INSERT INTO `tb_imgproduct` (`Id`, `ImgName`, `Pro_id`, `User`) VALUES
(21, 'TEXC7B.jpg', '63', '4'),
(22, 'R6QI1D.jpg', '63', '4'),
(23, '7Z1ILF.jpg', '63', '4'),
(24, 'FRD77K.jpg', '63', '4'),
(25, 'TTA3I1.jpg', '63', '4'),
(26, '9NA98F.jpg', '64', '4'),
(27, 'A597W2.jpg', '64', '4'),
(28, 'ZP73AD.jpg', '64', '4'),
(29, '5BB45S.jpg', '64', '4'),
(30, '2PVI3V.jpg', '64', '4'),
(31, '2WVJQF.jpg', '65', '5'),
(32, 'F8HRWF.jpg', '65', '5'),
(33, 'NK4KX1.jpg', '65', '5'),
(34, '2JFVMB.jpg', '65', '5'),
(35, 'HH71NP.jpg', '65', '5'),
(36, '1YV61H.jpg', '66', '5'),
(37, 'BSVW3J.jpg', '66', '5'),
(38, 'U9BJUJ.jpg', '66', '5'),
(39, 'VSBURU.jpg', '66', '5'),
(40, 'U74X8X.jpg', '66', '5'),
(41, 'A21GM2.jpg', '67', '5'),
(42, 'HAA6HL.jpg', '67', '5'),
(43, 'RIXZI6.jpg', '67', '5'),
(44, '723MAZ.jpg', '67', '5'),
(45, 'ASCDRX.jpg', '67', '5'),
(46, '4JZ4KZ.jpg', '68', '5'),
(47, 'FBXM23.jpg', '68', '5'),
(48, 'L63CYG.jpg', '68', '5'),
(49, 'I1NKCV.jpg', '68', '5'),
(50, 'I5RG3M.jpg', '68', '5'),
(51, 'FVI1ZF.jpg', '69', '4'),
(52, '6P26RR.jpg', '69', '4'),
(53, 'MTIW65.jpg', '69', '4'),
(54, 'MX4TBR.jpg', '69', '4'),
(55, '3SP6GX.jpg', '69', '4');

-- --------------------------------------------------------

--
-- Table structure for table `tb_mainshop_type`
--

CREATE TABLE IF NOT EXISTS `tb_mainshop_type` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `MMName` varchar(255) DEFAULT NULL,
  `MMDetail` varchar(100) DEFAULT NULL,
  `MMImg` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tb_mainshop_type`
--

INSERT INTO `tb_mainshop_type` (`Id`, `MMName`, `MMDetail`, `MMImg`) VALUES
(1, 'Fashion', NULL, 'bag-icon.png'),
(2, 'Music', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_submainshop_type`
--

CREATE TABLE IF NOT EXISTS `tb_submainshop_type` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `MId` varchar(45) DEFAULT NULL,
  `SMName` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tb_submainshop_type`
--

INSERT INTO `tb_submainshop_type` (`Id`, `MId`, `SMName`) VALUES
(1, '1', 'ກີບຊ໋ອບ ແລະ ອື່ນໆ');

-- --------------------------------------------------------

--
-- Table structure for table `tb_theme`
--

CREATE TABLE IF NOT EXISTS `tb_theme` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `ThemeId` int(11) NOT NULL,
  `User` varchar(50) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tb_theme`
--

INSERT INTO `tb_theme` (`Id`, `ThemeId`, `User`) VALUES
(1, 17, '4'),
(2, 1, '5'),
(3, 1, '6');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE IF NOT EXISTS `tb_user` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(45) DEFAULT NULL,
  `Lname` varchar(45) DEFAULT NULL,
  `Email` varchar(45) DEFAULT NULL,
  `Password` varchar(45) DEFAULT NULL,
  `Tel` varchar(45) DEFAULT NULL,
  `UsrType` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`Id`, `Name`, `Lname`, `Email`, `Password`, `Tel`, `UsrType`) VALUES
(4, 'Obishiro', 'Upatum', 'upatumcms@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', NULL, '2'),
(5, 'sontaya', 'upatum', 'kscomsci@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '0813209321', '2'),
(6, 'oop', 'oop', 'xcomsci_hack@hotmail.com', 'ed22c96589c7dc91f3b0ebed98f43926', '0813209321', '2');

-- --------------------------------------------------------

--
-- Table structure for table `webboard`
--

CREATE TABLE IF NOT EXISTS `webboard` (
  `Id` int(10) NOT NULL AUTO_INCREMENT,
  `TopicName` varchar(255) NOT NULL,
  `TopicDetail` longtext NOT NULL,
  `UsrType` varchar(50) NOT NULL,
  `UsrName` varchar(50) NOT NULL,
  `TopicDate` date NOT NULL,
  `View` int(6) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `webboard`
--

INSERT INTO `webboard` (`Id`, `TopicName`, `TopicDetail`, `UsrType`, `UsrName`, `TopicDate`, `View`) VALUES
(1, 'อิอิ', 'คริคริ', 'admin', '4', '2013-02-20', 4),
(2, 'คริคริ', '', 'user', '4', '2013-03-06', 15),
(3, ':)', 'เสื้อสวยมาก', 'user', '5', '2013-03-07', 5);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
