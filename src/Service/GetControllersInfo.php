<?php
namespace Mf\Statpage\Service;

use Laminas\Router\Exception\RuntimeException;
/*
сервис обработки прерывания GetControllersInfoAdmin simba.admin
нужен для генерации ссылок для подстановки в меню сайта или админки для визуализации выбора
ВНИМАНИЕ!
возвращаются и ссылки, и спец массив с данными MVC

*/


class GetControllersInfo 
{
	protected $Router;
	protected $options;
	protected $connection;
	protected $config;
	
    public function __construct($connection,$Router,$config,$options) 
    {
		$this->Router=$Router;
		$this->options=$options;
		$this->connection=$connection;
		$this->config=$config;
    }
    
    /**
    * получить все MVC адреса, разбитые по языкам
    */
    public function getMvc()
    {
		//данный модуль содержит только сайтовские описатели описатели
		if ($this->options["category"]!="frontend") {return ;}

		//Линейные таблицы
		$info["page"]["description"]="Просто страницы (опубликованные)";
		$rez['name']=[];
		$rez['url']=[];
		$rez['mvc']=[];
		
		
		$rs=$this->connection->Execute("select name,url,locale from statpage where page_type=1  order by name");
        while (!$rs->EOF){
            $locale=$rs->Fields->Item["locale"]->Value;
            try {
                $url = $this->Router->assemble(["page"=>$rs->Fields->Item["url"]->Value], ['name' => 'page_'.$locale]);
                $mvc=[
                    "route"=>"page_".$locale,
                    'params'=>["page"=>$rs->Fields->Item["url"]->Value],
                ];
                $rez["name"][$locale][]=$rs->Fields->Item["name"]->Value." (".$locale.")";
                $rez["mvc"][$locale][]= serialize($mvc);
                $rez["url"][$locale][]=$url;
            } catch (RuntimeException $e){
                //если нет маршрута, тогда будет ошибка, просто пропускаем добавление для это локали
            }
            
            $rs->MoveNext();
        }
        $info["page"]["urls"]=$rez;
		return $info;

        
    }
	
    /**
    * устаревший вызов, для получения списка MVC адресов, в админ панели
    */
	public function GetDescriptors()
	{
		//данный модуль содержит только сайтовские описатели описатели
		if ($this->options["name"]) {return [];}
		if (!isset($this->options["locale"])) {$this->options["locale"]=$this->config["locale_default"];}

		//Линейные таблицы
		$info["page"]["description"]="Просто страницы (опубликованные)";
		$rez['name']=[];
		$rez['url']=[];
		$rez['mvc']=[];
		
		
		$rs=$this->connection->Execute("select name,url from statpage where page_type=1 and locale='{$this->options["locale"]}' order by name");
		
			while (!$rs->EOF){
                $locale=$this->options["locale"];
                $url = $this->Router->assemble(["page"=>$rs->Fields->Item["url"]->Value], ['name' => 'page_'.$locale]);
                $mvc=[
                    "route"=>"page_".$locale,
                    'params'=>["page"=>$rs->Fields->Item["url"]->Value],
                ];

                $rez["name"][]=$rs->Fields->Item["name"]->Value." (".$locale.")";
                $rez["mvc"][]= serialize($mvc);
                $rez["url"][]=$url;
                $rs->MoveNext();
            }
        $info["page"]["urls"]=$rez;
		return $info;
	}
	
}



