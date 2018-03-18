<?php
namespace Mf\Statpage\Service;

/*
сервис обработки прерывания GetMap simba.sitemap

*/
use Exception;

class GetMap 
{
	protected $Router;
	protected $type="sitemapindex";
    protected $locale="ru_RU";
    protected $name;
    protected $statpageService;

	
    public function __construct($Router, array $options,$statpageService) 
    {
        $this->statpageService=$statpageService;
		$this->Router=$Router;
		if(isset($options["type"])){
            $this->type=$options["type"];
        }
		if(isset($options["locale"])){
            $this->locale=$options["locale"];
        }
		if(isset($options["name"])){
            $this->name=$options["name"];
        }
    }
    
    
	/**
    * сам обработчик
    */
	public function GetMap()
	{
        if ($this->type=="sitemapindex"){
            /*получить информацию для генерации sitemapindex*/
            $maxLastMod=$this->statpageService->getMaxLastMod();
            return ["name"=>"page","lastmod"=>$maxLastMod->getLastmod()];
        }
        /*получение списка всех страниц и генерация URL*/
        if ($this->type=="sitemap"){
            if ($this->name!="page"){
                /*если запрос не принадлежит этому модулю то выход*/
                return [];
            }
            $items=$this->statpageService->getMap();
            $rez=[];
            foreach ($items as $item){
                $rez[]=[
                    "uri"=>$this->Router->assemble(["page"=>$item->getUrl()], ['name' => 'page_ru_RU']),
                    "lastmod"=>$item->getLastmod(),
                    "changefreq"=>"weekly"
                ];
            }
            return $rez;
        }
        throw new  Exception("Недопустимый тип sitemap");
	}
	
}
