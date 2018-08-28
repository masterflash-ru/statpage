-- MySQL dump 10.13  Distrib 5.6.37, for FreeBSD11.0 (i386)
--
-- Host: localhost    Database: simba4
-- ------------------------------------------------------
-- Server version	5.6.37

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

INSERT INTO `design_tables` (`interface_name`, `table_name`, `table_type`, `col_name`, `caption_style`, `row_type`, `col_por`, `pole_spisok_sql`, `pole_global_const`, `pole_prop`, `pole_type`, `pole_style`, `pole_name`, `default_sql`, `functions_befo`, `functions_after`, `functions_befo_out`, `functions_befo_del`, `properties`, `value`, `validator`, `sort_item_flag`, `col_function_array`) VALUES 
  ('statpage', 'statpage', 0, 'seo_options', '', 2, 14, '', NULL, '', '24', NULL, 'seo_options', NULL, '', '', '', '', 'N;', '', 'N;', NULL, 'N;'),
  ('statpage', 'statpage', 0, 'seo_options', '', 3, NULL, '', NULL, '', '24', NULL, 'seo_options', NULL, '', '', '', '', 'N;', '', 'N;', NULL, 'N;'),
  ('statpage', 'statpage', 0, 'layout', '', 2, 6, '', NULL, '', '4', NULL, 'layout', NULL, '', '', '\\Mf\\Statpage\\Lib\\Func\\GetLayoutList', '', 'a:3:{i:0;s:1:\"0\";i:1;s:1:\"1\";i:2;s:1:\"0\";}', '', 'N;', NULL, 'N;'),
  ('statpage', 'statpage', 0, 'layout', '', 3, NULL, '', NULL, '', '4', NULL, 'layout', NULL, '', '', '\\Mf\\Statpage\\Lib\\Func\\GetLayoutList', '', 'a:3:{i:0;s:1:\"0\";i:1;s:1:\"1\";i:2;s:1:\"0\";}', '', 'N;', NULL, 'N;');



INSERT INTO `design_tables_text_interfase` (`language`, `table_type`, `interface_name`, `item_name`, `text`) VALUES 
  ('ru_RU', 0, 'statpage', 'caption_col_seo_options', 'SEO опции'),
  ('ru_RU', 0, 'statpage', 'caption_col_layout', 'Макет');
  

--
-- Table structure for table `statpage_text`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
ALTER TABLE `statpage_text` 
 ADD `seo_options` varchar(2000) DEFAULT NULL COMMENT 'опции для сео',
 ADD `layout` char(127) DEFAULT NULL COMMENT 'макет вывода'
;
 /*!40101 SET character_set_client = @saved_cs_client */;


/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

