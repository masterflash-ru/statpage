<?php
namespace Statpage\Service;

/*
сервис обработки прерывания GetControllersInfoAdmin simba.admin
нужен для генерации ссылок для подстановки в меню сайта или админки для визуализации выбора
ВНИМАНИЕ!
возвращаются не ссылки, а спец массив с данными MVC

*/


class GetControllersInfo 
{
	protected $Router;
	protected $options;
	protected $connection;
	
    public function __construct($connection,$Router,$options) 
    {
		
		$this->Router=$Router;
		$this->options=$options;
		$this->connection=$connection;
		//\Zend\Debug\Debug::dump(get_class($container->get("Application")  ));
    }
    
	
	public function GetDescriptors()
	{
		//данный модуль содержит только админксие описатели
		if ($this->options["name"]) {return [];}

		//Линейные таблицы
		$info["page"]["description"]="Просто страницы (опубликованные)";
		$rs=$this->connection->Execute("select name,url from statpage_text,statpage where page_type=1  and statpage.id=statpage_text.statpage order by name");
		$rez['name']=[];
		$rez['url']=[];
		$rez['mvc']=[];
		while (!$rs->EOF)
			{
				$url = $this->Router->assemble(["page"=>$rs->Fields->Item["url"]->Value], ['name' => 'page']);
				$mvc=[
						"route"=>"page",
						'params'=>["page"=>$rs->Fields->Item["url"]->Value]
					];
				
				$rez["name"][]=$rs->Fields->Item["name"]->Value;
				$rez["mvc"][]= serialize($mvc);
				$rez["url"][]=$url;
				$rs->MoveNext();
			}
		$info["page"]["urls"]=$rez;
		
		return $info;
	}
	
}



