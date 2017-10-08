<?php
namespace Statpage\Service;

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
    
	
	public function GetDescriptors()
	{
		//данный модуль содержит только сайтовские описатели описатели
		if ($this->options["name"]) {return [];}

		//Линейные таблицы
		$info["page"]["description"]="Просто страницы (опубликованные)";
		$rez['name']=[];
		$rez['url']=[];
		$rez['mvc']=[];
		foreach ($this->config["locale_enable_list"] as $locale)
			{//цикл по локалям
				$rs=$this->connection->Execute("select name,url from statpage_text,statpage where page_type=1  and statpage.id=statpage_text.statpage and locale='$locale' order by name");
				if ($locale==$this->config["locale_default"]) {$locale=NULL;}
				while (!$rs->EOF)
					{
						$url = $this->Router->assemble(["page"=>$rs->Fields->Item["url"]->Value,"locale"=>$locale], ['name' => 'page']);
						$mvc=[
								"route"=>"page",
								'params'=>["page"=>$rs->Fields->Item["url"]->Value,"locale"=>$locale],
							];
						if(empty($locale)) {$l=" локаль по умолчанию - ".$this->config["locale_default"];}
							else {$l=$locale;}
						$rez["name"][]=$rs->Fields->Item["name"]->Value." - ".$l;
						$rez["mvc"][]= serialize($mvc);
						$rez["url"][]=$url;
						$rs->MoveNext();
					}
			}
		$info["page"]["urls"]=$rez;
		
		return $info;
	}
	
}



