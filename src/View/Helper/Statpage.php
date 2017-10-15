<?php
/*
*/

namespace Statpage\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Statpage\Service\Statpage as Statpage_service;
use Statpage\Exception\EmptyException;
/**
 * помощник - вывода стат страниц
 */
class Statpage extends AbstractHelper 
{
	protected $statpage_service;

/*
собственно вызов помощника
$sysname - системное имя в просто страницах,
$locale - строка локали, по умолчанию "ru_RU",
$page_type  - тип страницы, по умолчанию 2 (Statpage_service::SPECIAL), 
$flag_seo - заполнять СЕО-теги извлекаемой страницы, по умолчанию false (нет)
*/
public function __invoke($sysname,$locale="ru_RU",$page_type=Statpage_service::SPECIAL, $flag_seo=false)
{
	try
		{
			$this->statpage_service->SetLocale($locale);					//новая локаль
			$this->statpage_service->SetPageType($page_type);			//публичные
			$page=$this->statpage_service->LoadFromSysname($sysname);				//URL страницы (транслит имени)
			echo $page->getContent();
			if ($flag_seo) {
				$view=$this->getView();
				$view->headTitle($page->GetTitle());
				$view->headMeta()->appendName('keywords', $page->GetKeywords());
				$view->headMeta()->appendName('description', $page->GetDescription() );
			}
		}
	catch (EmptyException $e){echo "";}
}


public function __construct ($statpage_service)
	{
		$this->statpage_service=$statpage_service;
		
	}

}