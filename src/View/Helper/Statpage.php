<?php
/*
помощник view для вывода стат страниц

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


public function __invoke($sysname,$locale="ru_RU",$page_type=Statpage_service::SPECIAL)
{
	try
		{
			$this->statpage_service->SetLocale($locale);					//новая локаль
			$this->statpage_service->SetPageType($page_type);			//публичные
			$page=$this->statpage_service->LoadFromSysname($sysname);				//URL страницы (транслит имени)
			echo $page->getContent();
		}
	catch (EmptyException $e){echo "";}
}



public function __construct ($statpage_service)
	{
		$this->statpage_service=$statpage_service;
		
	}




}
