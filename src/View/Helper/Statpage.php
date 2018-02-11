<?php
/*
помощник возвращает содержимое страницы по ее име в виде строки.
Для вывода в скоипте вида используйте echo
*/

namespace Mf\Statpage\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Mf\Statpage\Service\Statpage as Statpage_service;
use Mf\Statpage\Exception\EmptyException;
/**
 * помощник - вывода стат страниц
 */
class Statpage extends AbstractHelper 
{
	protected $statpage_service;

/*
собственно вызов помощника
$sysname - системное имя в просто страницах,
Опции:
locale - строка локали, по умолчанию "ru_RU",
page_type  - тип страницы, по умолчанию 2 (Statpage_service::SPECIAL), 
flag_seo - заполнять СЕО-теги извлекаемой страницы, по умолчанию false (нет)
err_mode - что делать при ошибке: empty - вернуть "" (по умолчанию), exception - исключение
*/
public function __invoke($sysname,array $options=null)
{
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
    
    if (isset($options["seo"])) {
        $flag_seo=(bool)$options["seo"];
    }else {
        $flag_seo=false;
    }
    if (!isset($options["err_mode"])){$options["err_mode"]="empty";}
    
	try
		{
			$this->statpage_service->SetLocale($locale);					//новая локаль
			$this->statpage_service->SetPageType($type);			//публичные
			$page=$this->statpage_service->LoadFromSysname($sysname);				//URL страницы (транслит имени)
			
			if ($flag_seo) {
				$view=$this->getView();
				$view->headTitle($page->GetTitle());
				$view->headMeta()->appendName('keywords', $page->GetKeywords());
				$view->headMeta()->appendName('description', $page->GetDescription() );
			}
			return $page->getContent();
		}
	catch (EmptyException $e){
		if (strtolower($options["err_mode"])=="empty"){return "";}
		throw new EmptyException("Страница $sysname не найдена, возможно у нее установлен не верный статус.");
	}
}


public function __construct ($statpage_service)
	{
		$this->statpage_service=$statpage_service;
		
	}

}