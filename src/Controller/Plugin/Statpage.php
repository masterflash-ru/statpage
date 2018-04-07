<?php
/**
*плагин для контроллеров позволяет делать обращения к статичным страницам, например, для извлечения сообщений юзерам
*/

namespace Mf\Statpage\Controller\Plugin;


use Zend\Mvc\Controller\Plugin\AbstractPlugin;
use Mf\Statpage\Service\Statpage as Statpage_service;
use Mf\Statpage\Exception\EmptyException;

/**
 * 
 */
class Statpage extends AbstractPlugin
{
    /**
    * экземпляр Mf\Statpage\Service\Statpage
    */
    protected $statpage_service;
	protected $options=[
		"locale"=>"ru_RU",			//имя локали
		"pageType"=>2,				//тип страниц для извлечения, 2 (Statpage_service::SPECIAL)
		"errMode"=>"empty",			//тип обработки ошибок,empty - вернуть "" (по умолчанию), exception - исключение
	];

    
    
public function __construct($statpage_service) 
{
    $this->statpage_service = $statpage_service;
}
/*
собственно вызов помощника
$sysname - системное имя в просто страницах,
Опции:
locale - строка локали, по умолчанию "ru_RU",
pageType  - тип страницы, по умолчанию 2 (Statpage_service::SPECIAL), 
errMode - что делать при ошибке: empty - вернуть "" (по умолчанию), exception - исключение
*/
public function __invoke($sysname = null,array $options=[])
{
    if (empty($sysname)){return $this;}
    $this->setOptions($options);
    $page=$this->getPage($sysname);
    
    if (empty($page)) {
        return "";
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
        } catch (EmptyException $e){
            if (strtolower($this->options["errMode"])=="empty"){return null;}
            throw new EmptyException("Страница $sysname не найдена, возможно у нее установлен не верный статус.");
        }
    }
}