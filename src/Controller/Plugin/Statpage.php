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
    
    
    
public function __construct($statpage_service) 
{
    $this->statpage_service = $statpage_service;
}
/*
собственно вызов помощника
$sysname - системное имя в просто страницах,
Опции:
locale - строка локали, по умолчанию "ru_RU",
page_type  - тип страницы, по умолчанию 2 (Statpage_service::SPECIAL), 
err_mode - что делать при ошибке: empty - вернуть "" (по умолчанию), exception - исключение
*/
public function __invoke($sysname = null,array $options=null)
{
    //if (empty($sysname)){return $this;}
    if (isset($options["locale"])) {
        $locale=$options["locale"];
    }else {
        $locale="ru_RU";
    }
   
    if (isset($options["type"])) {
        $type=(int)$options["type"];
    }else {
        $type=Statpage_service::SPECIAL;
    }
    

    if (!isset($options["err_mode"])){$options["err_mode"]="empty";}
    
	try
		{
			$this->statpage_service->SetLocale($locale);					//новая локаль
			$this->statpage_service->SetPageType($type);			//публичные
			$page=$this->statpage_service->LoadFromSysname($sysname);				//URL страницы (транслит имени)
			
			return $page->getContent();
		}
	catch (EmptyException $e){
		if (strtolower($options["err_mode"])=="empty"){return "";}
		throw new EmptyException("Страница $sysname не найдена, возможно у нее установлен не верный статус.");
	}
}

}