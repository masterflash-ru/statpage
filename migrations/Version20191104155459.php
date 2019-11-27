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
        $this->mysql_add_create_table=" ENGINE=MyIsam DEFAULT CHARSET=utf8";
        $table = new Ddl\CreateTable("statpage");
        $table->addColumn(new Ddl\Column\Integer('id',false,null,["AUTO_INCREMENT"=>true]));
        $table->addColumn(new Ddl\Column\Char('name', 255,true,null,["COMMENT"=>"Имя страницы"]));
        $table->addColumn(new Ddl\Column\Char('sysname', 255,true,null,["COMMENT"=>"Системное имя страницы"]));
        $table->addColumn(new Ddl\Column\Char('url', 255,true,null,["COMMENT"=>"URL"]));
        $table->addColumn(new Ddl\Column\Char('locale', 5,true,null,["COMMENT"=>"Локаль формата ru_RU","KEY"=>"locale"]));
        $table->addColumn(new Ddl\Column\Char('tpl', 50,true,null,["COMMENT"=>"Шаблон вывода"]));
        $table->addColumn(new Ddl\Column\Integer('page_type',true,null,["COMMENT"=>"Код типа страницы"]));
        $table->addColumn(new Ddl\Column\Datetime('lastmod', true,null,["COMMENT"=>"дата модификации"]));
        $table->addColumn(new Ddl\Column\Varchar('seo_options', 2000,true,null,["COMMENT"=>"SEO опции"]));
        $table->addColumn(new Ddl\Column\Varchar('layout', 127,true,null,["COMMENT"=>"Макет layout"]));
        $table->addColumn(new Ddl\Column\Text('content', 0,true,null,["COMMENT"=>"контент страницы"]));
        $table->addColumn(new Ddl\Column\Char('title', 255,true,null));
        $table->addColumn(new Ddl\Column\Char('keywords', 255,true,null));
        $table->addColumn(new Ddl\Column\Varchar('description', 3000,true,null));
        $table->addConstraint(
            new Ddl\Constraint\PrimaryKey(['id'])
        );
        $table->addConstraint(
            new Ddl\Constraint\UniqueKey(['url'])
        );
        $table->addConstraint(
            new Ddl\Index\Index(['sysname'],'sysname')
        );
        $table->addConstraint(
            new Ddl\Index\Index(['locale'],'locale')
        );
        $table->addConstraint(
            new Ddl\Index\Index(['page_type'],'page_type')
        );
        $this->addSql($table);
    }

    public function down($schema,$adapter)
    {
        $drop = new Ddl\DropTable('statpage');
        $this->addSql($drop);
    }
}
