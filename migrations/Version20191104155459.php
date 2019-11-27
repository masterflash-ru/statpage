<?php

namespace Mf\Statpage;

use Mf\Migrations\AbstractMigration;
use Mf\Migrations\MigrationInterface;
use Zend\Db\Sql\Ddl;

class Version20191104155459 extends AbstractMigration implements MigrationInterface
{
    public static $description = "Create table for Statpage";

    public function up($schema,$adapter)
    {
        switch ($this->db_type){
            case "mysql":{
                $this->addSql("CREATE TABLE `statpage` (
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
                ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='статичные страницы'");
                break;
            }
            default:{
                throw new \Exception("the database {$this->db_type} is not supported !");
            }
        }
    }

    public function down($schema,$adapter)
    {
        $drop = new Ddl\DropTable('statpage');
        $this->addSql($drop);
    }
}
