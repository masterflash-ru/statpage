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


DROP TABLE IF EXISTS `st`;
rename table statpage to `st`;


DROP TABLE IF EXISTS `statpage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `statpage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(255) DEFAULT NULL,
  `sysname` char(127) DEFAULT NULL,
  `url` char(255) DEFAULT NULL,
  `locale` char(5) DEFAULT NULL,
  `tpl` char(50) DEFAULT NULL,
  `page_type` int(11) DEFAULT NULL,
  `lastmod` datetime NOT NULL,
  `seo_options` varchar(2000) DEFAULT NULL,
  `layout` char(127) DEFAULT NULL,
  `content` text,
  `title` char(255) DEFAULT NULL,
  `keywords` char(255) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `url` (`url`),
  KEY `sysname` (`sysname`),
  KEY `locale` (`locale`),
  KEY `page_type` (`page_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='статичные страницы';
/*!40101 SET character_set_client = @saved_cs_client */;

insert into statpage (name,sysname,url,locale,tpl,page_type,lastmod,seo_options,layout,content,title,keywords,description)
select s.name,s.sysname,s.url,
t.locale,t.tpl,t.page_type,t.lastmod,t.seo_options,t.layout,t.content,t.title,t.keywords,t.description
 from st as s, statpage_text as t where s.id=t.statpage;


DROP TABLE `statpage_text`;
DROP TABLE `st`;

/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

