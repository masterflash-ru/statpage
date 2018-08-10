<?php
/*
помощник возвращает содержимое страницы по ее име в виде строки.
Для вывода в скоипте вида используйте echo
*/

namespace Mf\Statpage\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Mf\Statpage\Service\Statpage as Statpage_service;
use Exception;
/**
 * помощник - вывода стат страниц
 */
class Statpage extends AbstractHelper 
{
  protected $statpage_service;
  protected $options=[
    "locale"=>"ru_RU",			//имя локали
    "pageType"=>2,				//тип страниц для извлечения, 2 (Statpage_service::SPECIAL)
    "errMode"=>"empty",			//тип обработки ошибок,empty - вернуть "" (по умолчанию), exception - исключение
    "seo" => false,             //заполнять СЕО-теги извлекаемой страницы, по умолчанию false (нет)
  ];

public function __construct ($statpage_service)
{
  $this->statpage_service=$statpage_service;
}

/*
собственно вызов помощника
$sysname - системное имя в просто страницах, если null, тогда возвращает данный объект
Опции:
locale - строка локали, по умолчанию "ru_RU",
pageType  - тип страницы, по умолчанию 2 (Statpage_service::SPECIAL), 
seo - заполнять СЕО-теги извлекаемой страницы, по умолчанию false (нет)
errMode - что делать при ошибке: empty - вернуть "" (по умолчанию), exception - исключение
*/
public function __invoke($sysname = null,array $options=[])
{
    if (empty($sysname)){return $this;}
    
    //костыль для совестимости
    if (!empty($options["flag_seo"])){
        $options["seo"]=$options["flag_seo"];
        unset($options["flag_seo"]);
    }

    $this->setOptions($options);
    $page=$this->getPage($sysname);
    if (empty($page)) {
        return "";
    }
    
    if ($this->options["seo"]) {
        $view=$this->getView();
        $view->headTitle($page->GetTitle());
        $view->headMeta()->appendName('keywords', $page->GetKeywords());
        $view->headMeta()->appendName('description', $page->GetDescription() );
    }
    
    return $page->getContent();
    
}


    /**
    * установить опции,
    * пока принимаем только массив!
    * если на входе пустой массив, тогда копируем опции по умолчанию
    * результат - заполняет опциями $this->options
    * возвращает $this для построения цепи запросов
    */
    public function setOptions(array $options=[])
    {
        $this->options=array_replace_recursive($this->options,$options);
        return $this;
    }
    
    /**
    * установить одну опцию
    * $name - имя опуии (ключ массива $this->options), $value - значение
    * возвращает $this для построения цепи запросов
    */
    public function setOption($name,$value)
    {
        if (array_key_exists($name,$this->options)){
            $this->options[$name]=$value;
        }
        return $this;
    }

    /**
    * получить массив опций
    */
    public function getOptions()
    {
        return $this->options;
    }

    
    /**
    * собственно чтение страницы
    * $sysname - системное имя страницы 
    * возвращает Mf\Statpage\Entity\Page
    * если не найдено, то зависит от настроек $this->options["errMode"] - вернет null либо исключение
    */
    public function getPage($sysname)
    {
        $this->statpage_service->setLocale($this->options["locale"]);
        $this->statpage_service->setPageType((int)$this->options["pageType"]);
        try {
            return $this->statpage_service->LoadFromSysname($sysname);
        } catch (Exception $e){
            if (strtolower($this->options["errMode"])=="empty"){return null;}
            throw new Exception("Страница $sysname не найдена, возможно у нее установлен не верный статус.");
        }
    }

}