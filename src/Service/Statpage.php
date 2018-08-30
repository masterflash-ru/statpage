<?php
namespace Mf\Statpage\Service;

//для заполнения сущностей в стилистике ZF
use Zend\Hydrator\Reflection as ReflectionHydrator;
use ADO\ResultSet\HydratingResultSet;
use Locale;
use ADO\Service\RecordSet;
use ADO\Service\Command;
use Mf\Statpage\Entity\Page;
use Mf\Statpage\Entity\SeoOptions;
use Exception;

class Statpage 
{
    /*константы не используются, но оставлены для совестимости*/
    const PUBLIC=1;
    const SPECIAL=2;
    const NONPUBLIC=0;

    protected $connection; 
    protected $cache;
    protected $page_type;
    protected $locale;
    protected $config;
    protected $pageStatusEnable=[];
    protected $ServerDefaultUri;

    public function __construct($connection, $cache,$config) 
    {
        $this->connection = $connection;
        $this->cache = $cache;
        $this->config=$config;
        $this->page_type=(int)$config["statpage"]["defaultStatus"];
        $this->locale=$config["locale_default"];
        $this->ServerDefaultUri=$config["ServerDefaultUri"];
        $this->pageStatusEnable=array_keys($config["statpage"]["status"]);
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
  if (!$result){
    //промах кеша, создаем
    $c=new Command();
    $c->NamedParameters=true;
    $c->ActiveConnection=$this->connection;
    $p=$c->CreateParameter('url', adChar, adParamInput, 127, $url);//генерируем объек параметров
    $c->Parameters->Append($p);//добавим в коллекцию
    $c->CommandText="select * 
          from statpage_text,statpage 
              where page_type={$this->page_type} and 
                                    statpage.id=statpage_text.statpage and 
                                    $type=:url and 
                                    locale='{$this->locale}'";
    $rs=new RecordSet();

    $rs->Open($c);
    if ($rs->EOF) {throw new  Exception("Запись в STATPAGE не найдена");}
    $resultSet = new HydratingResultSet(new ReflectionHydrator, new Page);
    $resultSet->initialize($rs);

    $page=$resultSet->current();
      
    //опции перезапишем в виде объекта
    $s=unserialize($page->getSeo_options());
    $seoOptions=new SeoOptions();
    $seoOptions->setRobots($s["robots"]);
    $seoOptions->setCanonical($s["canonical"]);
    $page->setSeo_options($seoOptions);
      
    //сохраним в кеш
    $this->cache->setItem($key, $page);
    $this->cache->setTags($key,["statpage"]);
  }
    return $page;
}

 /**
 * получить список всех URL, дату модификации, для создания карты сайта
 */
 public function getMap()
 {
    $key="statpage_sitemap_all_{$this->locale}";
    //пытаемся считать из кеша
    $result = false;
    $items= $this->cache->getItem($key, $result);
    if (!$result){
        $rs=new RecordSet();
        $rs->CursorType = adOpenKeyset;
        $rs->open("select lastmod,url,seo_options
            from statpage_text,statpage 
              where
                        page_type=1 and 
                        statpage.id=statpage_text.statpage and 
                        locale='{$this->locale}'",$this->connection);
        $items=$rs->FetchEntityAll(Page::class);
        //пробежим и удалим если есть опции noindex или canonical
        foreach ($items as $k=>$v){
            $seo=unserialize($v->getSeo_options());
            if (!empty($seo["robots"]) || !empty($seo["canonical"])){
                unset($items[$k]);
            }
        }
      //сохраним в кеш
      $this->cache->setItem($key, $items);
      $this->cache->setTags($key,["statpage"]);
    }
  return $items;
 }

/*
* получить максимальную дату модификации и кол-во элементов
* которые публикуются через этот модуль (имеют статус 2)
**/
public function getMaxLastMod()
{
    $rs=new RecordSet();
    $rs->open("select max(lastmod) as lastmod, count(*) as recordcount from statpage_text,statpage
            where 
              locale='".$this->locale."' and 
              statpage.id=statpage_text.statpage and
              url>'' and 
              page_type =1",$this->connection);
    $items=$rs->FetchEntity(Page::class);
return $items;
}

  
  /*устновить тип считываемых страниц*/
public function SetPageType($page_type)
{
  if (!in_array($page_type,$this->pageStatusEnable)) {throw new Exception ("Не поддерживаемый тип страниц");}
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
  if (!empty($locale)) {
        //проверим на допустимость имени локали
        if (!in_array($locale,$this->config["locale_enable_list"])) {
            throw new Exception("Попытка установить не допустимую локаль");
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

/*получить канонический адрес сайта*/
public function getServerDefaultUri()
{
    return $this->ServerDefaultUri;
}

}

