<?php
namespace Statpage\Service;

//для заполнения сущностей в стилистике ZF
use Zend\Hydrator\Reflection as ReflectionHydrator;
use ADO\ResultSet\HydratingResultSet;
use Locale;
use ADO\Service\RecordSet;
use ADO\Service\Command;
use Statpage\Entity\Page;
use Statpage\Exception;

class Statpage 
{
	const PUBLIC=1;
	const SPECIAL=2;
	const NONPUBLIC=0;
	
    protected $connection; 
    protected $cache;
	protected $page_type;
	protected $locale;
	protected $config;
    
    public function __construct($connection, $cache,$config) 
    {
        $this->connection = $connection;
        $this->cache = $cache;
		$this->config=$config;
		$this->page_type=Statpage::PUBLIC;
		$this->locale=$config["locale_default"];
    }
    

/**
собственно чтение по url
*/
public function LoadFromUrl($url)
{
	return $this->Load($url,"url");
}

/**
собственно чтение по Sysname
*/
public function LoadFromSysname($url)
{
	return $this->Load($url,"sysname");
}

/**
собственно чтение по Id
*/
public function LoadFromId($id)
{
	return $this->Load($id,"id");
}

/**
собственно чтение по url или по sysname
*/
protected function Load($url,$type="url")
    {
		//создаем ключ кеша
		$key="statpage_{$type}{$this->page_type}_{$this->locale}_".preg_replace('/[^0-9a-zA-Z_\-]/iu', '',$url);
        //пытаемся считать из кеша
        $result = false;
        $page= $this->cache->getItem($key, $result);
        if (!$result)
        {
            //промах кеша, создаем
			$c=new Command();
			$c->NamedParameters=true;
			$c->ActiveConnection=$this->connection;
			$p=$c->CreateParameter('url', adChar, adParamInput, 50, $url);//генерируем объек параметров
			$c->Parameters->Append($p);//добавим в коллекцию
			$c->CommandText="select * 
							from statpage_text,statpage 
								where page_type={$this->page_type} and statpage.id=statpage_text.statpage and $type=:url and locale='{$this->locale}'";
			$rs=new RecordSet();
			$rs->CursorType =adOpenKeyset;
			$rs->Open($c);
	
			$resultSet = new HydratingResultSet(new ReflectionHydrator, new Page);
			$resultSet->initialize($rs);
		   
		   $page=$resultSet->current();
            //сохраним в кеш
            $this->cache->setItem($key, $page);
			$this->cache->setTags($key,["statpage"]);
        }
    return $page;
	}
  

  
  /*устновить тип считываемых страниц*/
public function SetPageType($page_type)
{
	if (!in_array($page_type,[Statpage::NONPUBLIC,Statpage::SPECIAL,Statpage::PUBLIC])) {throw new Exception\InvalidPageTypeException("Не поддерживаемый тип страниц");}
	$this->page_type=$page_type;
}

/*прочитать тип страниц для считывания*/
public function GetPageType()
{
	return $this->page_type;
}
 
//установка локали
public function SetLocale($locale=NULL)
{
	if (!empty($locale)) 
		{
			//проверим на допустимость имени локали
			if (!in_array($locale,$this->config["locale_enable_list"])) 
				{
					throw new Exception\EmptyException("Попытка установить не допустимую локаль");
				}
			$this->locale=$locale;
		}
}

//получить локали
public function GetLocale()
	{
		return $this->locale;
	}
//получить дефолтную локаль, которая указана в конфиге приложения
public function GetDefaultLocale()
{
	return $this->config["locale_default"];
}



}

