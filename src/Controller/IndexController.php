<?php
/**
контроллер работы со статичными страницами

 */

namespace Statpage\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Statpage\Exception;
use Statpage\Service\Statpage;

class IndexController extends AbstractActionController
{
	protected $connection;
	protected $statpage_service;

public function __construct ($connection,$statpage_service)
	{
		$this->connection=$connection;
		$this->statpage_service=$statpage_service;
	}


public function indexAction()
{
	$url=$this->params('page',"404");
	$locale=$this->params('locale',NULL);
	
	try
	{
		//получим дефолтную локаль, что бы проверить передана ли она в URL
		//это нужно для исключения дубляжей URL
		$default_locale=$this->statpage_service->GetDefaultLocale();	//разрешенные локали
		
		if ($locale && $this->statpage_service->isMultiLocale() && $default_locale==$locale) {throw new Exception\LocaleException("Запрещено использовать в URL локаль, которая установлена по умолчанию, для исключения дубляжей URL");}
		if ($locale && !$this->statpage_service->isMultiLocale()) {throw new Exception\LocaleException("Запрещено использовать в URL локаль для моноязычного сайта");}
		
		$this->statpage_service->SetLocale($locale);					//новая локаль
		$this->statpage_service->SetPageType(Statpage::PUBLIC);			//публичные
		$page=$this->statpage_service->LoadFromUrl($url);				//URL страницы (транслит имени)
		
		$view=new ViewModel(["page"=>$page]);
		if  ($page->getTpl()) {$view->setTemplate($page->getTpl()) ;}
		return $view;
	}
	catch (\Exception $e) 
		{
			//любое исключение - 404
			$this->getResponse()->setStatusCode(404);
		}
	
  
}

}
