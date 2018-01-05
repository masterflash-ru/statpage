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

delete from design_tables where table_name='statpage';
delete from design_tables where table_name='statpage_text';
INSERT INTO `design_tables` (`interface_name`, `table_name`, `table_type`, `col_name`, `caption_style`, `row_type`, `col_por`, `pole_spisok_sql`, `pole_global_const`, `pole_prop`, `pole_type`, `pole_style`, `pole_name`, `default_sql`, `functions_befo`, `functions_after`, `functions_befo_out`, `functions_befo_del`, `properties`, `value`, `validator`, `sort_item_flag`, `col_function_array`) VALUES 
  ('statpage', 'statpage', 0, 'sysname', '', 3, 0, '', '', 'size=80', '2', '', 'sysname', '', '', '', '', '', 'N;', '', 'N;', 0, 'N;'),
  ('statpage', 'statpage', 0, 'tpl', '', 2, 5, '', '', '', '4', '', 'tpl', '', '', '', 'Statpage\\Lib\\Func\\GetTplList', '', 'a:2:{i:0;s:1:\"0\";i:1;s:1:\"1\";}', '', 'N;', 0, 'N;'),
  ('statpage', 'statpage', 0, 'tpl', '', 3, 0, '', '', '', '4', '', 'tpl', '', '', '', 'Statpage\\Lib\\Func\\GetTplList', '', 'a:2:{i:0;s:1:\"0\";i:1;s:1:\"1\";}', '', 'N;', 0, 'N;'),
  ('statpage', 'statpage', 0, 'title', '', 2, 10, '', '', 'cols=130 rows=3', '3', '', 'title', '', '', '', '', '', 'N;', '', 'N;', 0, 'N;'),
  ('statpage', 'statpage', 0, 'title', '', 3, 0, '', '', 'cols=130 rows=3', '3', '2', 'title', '', '', '', '', '', 'N;', '', 'N;', 0, 'N;'),
  ('statpage', 'statpage', 0, 'keywords', '', 2, 11, '', '', 'cols=130 rows=3', '3', '', 'keywords', '', '', '', '', '', 'N;', '', 'N;', 0, 'N;'),
  ('statpage', 'statpage', 0, 'keywords', '', 3, 0, '', '', 'cols=130 rows=3', '3', '2', 'keywords', '', '', '', '', '', 'N;', '', 'N;', 0, 'N;'),
  ('statpage', 'statpage', 0, 'description', '', 2, 12, '', '', 'cols=130 rows=3', '3', '', 'description', '', '', '', '', '', 'N;', '', 'N;', 0, 'N;'),
  ('statpage', 'statpage', 0, 'name,content,keywords,description,title,tpl,page_type', '', 0, 1, 'select statpage.*,\r\n(select title from statpage_text where locale=''$pole_dop0'' and statpage_text.statpage=statpage.id) as title ,\r\n(select keywords from statpage_text where locale=''$pole_dop0'' and statpage_text.statpage=statpage.id) as keywords,\r\n(select description from statpage_text where locale=''$pole_dop0'' and statpage_text.statpage=statpage.id) as description,\r\n(select content from statpage_text where locale=''$pole_dop0'' and statpage_text.statpage=statpage.id) as content,\r\n(select tpl from statpage_text where locale=''$pole_dop0'' and statpage_text.statpage=statpage.id) as tpl,\r\n(select page_type from statpage_text where locale=''$pole_dop0'' and statpage_text.statpage=statpage.id) as page_type\r\n\r\nfrom statpage order by name', '', '0,0,0,0', 'name', '0', 'id', 'delete from statpage  where id=$id;\r\ndelete from statpage_text where statpage=$id', '', '', '', '', 'Statpage\\Lib\\Func\\Save', 0x613A323A7B733A32343A22666F726D5F656C656D656E74735F6E65775F7265636F7264223B733A313A2231223B733A32343A22666F726D5F656C656D656E74735F6A6D705F7265636F7264223B733A313A2231223B7D, 'statpage', 1, ''),
  ('statpage', 'statpage', 0, '', '', 1, 0, '', '', 'onChange=this.form.submit()', '4', '', '', '', '', '', 'Statpage\\Lib\\Func\\GetLocales', '', 'a:2:{i:0;s:1:\"0\";i:1;s:1:\"0\";}', '', '', 0, ''),
  ('statpage', 'statpage', 0, 'name', '', 2, 1, '', '', 'size=80', '2', '', 'name', '', '', '', '', '', 'N;', '', 'N;', 0, 'N;'),
  ('statpage', 'statpage', 0, 'name', '', 3, 0, '', '', 'size=80', '2', '2', 'name', '', '', '', '', '', 'N;', '', 'N;', 0, 'N;'),
  ('statpage', 'statpage', 0, 'content', '', 2, 6, '', '[\"statpage\"][''media_folder'']', ',', '39', '', 'content', '', '', 'Statpage\\Lib\\Func\\ClearContent', '', '', 'a:4:{i:0;s:3:\"600\";i:1;s:3:\"800\";i:2;s:7:\"default\";i:3;s:7:\"default\";}', '', 'N;', 0, 'N;'),
  ('statpage', 'statpage', 0, 'content', '', 3, 0, '', '[\"statpage\"][''media_folder'']', ',', '39', '', 'content', '', '', 'Statpage\\Lib\\Func\\ClearContent', '', '', 'a:4:{i:0;s:3:\"600\";i:1;s:3:\"800\";i:2;s:7:\"default\";i:3;s:7:\"default\";}', '', 'N;', 0, 'N;'),
  ('statpage', 'statpage', 0, 'description', '', 3, 0, '', '', 'cols=130 rows=3', '3', '2', 'description', '', '', '', '', '', 'N;', '', 'N;', 0, 'N;'),
  ('statpage', 'statpage', 0, 'url', '', 2, 2, '', '', 'size=120', '2', '', 'url', '', 'Statpage\\Lib\\Func\\CreateUrl', '', '', '', 'N;', '', 'N;', 0, 'N;'),
  ('statpage', 'statpage', 0, 'url', '', 3, 0, '', '', 'size=120', '2', '', 'url', '', 'Statpage\\Lib\\Func\\CreateUrl', '', '', '', 'N;', '', 'N;', 0, 'N;'),
  ('statpage', 'statpage', 0, '1', '', 2, 29, '', '', '', '19', '', 'save', '', '', '', '', '', 'a:2:{i:0;s:1:\"1\";i:1;s:16:\"Добавить\";}', '', 'N;', 0, 'N;'),
  ('statpage', 'statpage', 0, '1', '', 3, 0, '', '', ',', '17', '', 'save,del', '', '', '', '', '', 'a:4:{i:0;s:1:\"1\";i:1;s:1:\"0\";i:2;s:33:\"Сохранить,Удалить\";i:3;s:1:\"0\";}', '', 'N;', 0, 'N;'),
  ('statpage', 'statpage', 0, 'language', '', 2, 0, '', '', '', '0', '', 'pole_dop0', '', '', '', '', '', '', '', '', 0, ''),
  ('statpage', 'statpage', 0, 'language', '', 3, 0, '', '0,0', '', '0', '', 'pole_dop0', '', '', '', '', '', '', '', '', 0, ''),
  ('statpage', 'statpage', 0, 'page_type', '', 2, 4, '', '', '', '4', '', 'page_type', '', '', '', '\\Statpage\\Lib\\Func\\GetPageType', '', 'a:2:{i:0;s:1:\"0\";i:1;s:1:\"0\";}', '', 'N;', 0, 'N;'),
  ('statpage', 'statpage', 0, 'page_type', '', 3, 0, '', '', '', '4', '', 'page_type', '', '', '', '\\Statpage\\Lib\\Func\\GetPageType', '', 'a:2:{i:0;s:1:\"0\";i:1;s:1:\"1\";}', '', 'N;', 0, 'N;'),
  ('statpage', 'statpage', 0, 'sysname', '', 2, 2, '', '', 'size=80', '2', '', 'sysname', '', '', '', '', '', 'N;', '', 'N;', 0, 'N;');

INSERT INTO `design_tables_text_interfase` (`language`, `table_type`, `interface_name`, `item_name`, `text`) VALUES 
  ('ru_RU', 0, 'statpage', 'caption_col_name', 'Имя элемента'),
  ('ru_RU', 0, 'statpage', 'caption_col_sysname', 'Системное имя'),
  ('ru_RU', 0, 'statpage', 'caption_dop_0', 'Язык сайта:'),
  ('ru_RU', 0, 'statpage', 'button2', 'Сохранить,Удалить'),
  ('ru_RU', 0, 'statpage', 'button1', 'Добавить'),
  ('ru_RU', 0, 'statpage', 'caption_col_title', 'TITLE'),
  ('ru_RU', 0, 'statpage', 'caption_col_keywords', 'KEYWORDS'),
  ('ru_RU', 0, 'statpage', 'caption_col_description', 'DESCRIPTION'),
  ('ru_RU', 0, 'statpage', 'caption_col_tpl', 'Шаблон (statpage_*.html)'),
  ('ru_RU', 0, 'statpage', 'caption_col_1', 'Операция'),
  ('ru_RU', 0, 'statpage', 'caption0', 'ПРОСТО СТРАНИЦЫ'),
  ('ru_RU', 0, 'statpage', 'caption_col_url', 'URL страницы, /page/'),
  ('ru_RU', 0, 'statpage', 'caption_col_page_type', 'Состояние'),
  ('ru_RU', 0, 'statpage', 'caption_col_content', 'Контент');


--
-- Table structure for table `statpage`
--

DROP TABLE IF EXISTS `statpage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `statpage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(127) NOT NULL COMMENT 'имя-описание',
  `sysname` varchar(50) NOT NULL DEFAULT '' COMMENT 'системное имя страницы (если нужно)',
  `url` char(127) DEFAULT NULL COMMENT 'URL страницы',
  PRIMARY KEY (`id`),
  KEY `sysname` (`sysname`),
  KEY `url` (`url`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `statpage_text`
--

DROP TABLE IF EXISTS `statpage_text`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `statpage_text` (
  `statpage` int(11) NOT NULL,
  `locale` char(10) NOT NULL COMMENT 'имя локали (ru_RU)',
  `title` varchar(255) NOT NULL DEFAULT '',
  `keywords` varchar(255) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  `tpl` char(127) DEFAULT NULL COMMENT 'имя шаблона-контейнера',
  `page_type` int(11) DEFAULT NULL COMMENT 'типа страницы: 1-публиковать на сайте, 0-нет, 2-внутренняя',
  `content` text COMMENT 'контент страницы',
  PRIMARY KEY (`statpage`,`locale`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Dumping routines for database 'simba4'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

