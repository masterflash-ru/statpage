<?php
/**
контроллер работы со статичными страницами

 */

namespace Mf\Statpage\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Mf\Statpage\Exception;
use Mf\Statpage\Service\Statpage;

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
	$locale=$this->params('locale',$this->statpage_service->GetDefaultLocale());
	
	try
	{
		
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
