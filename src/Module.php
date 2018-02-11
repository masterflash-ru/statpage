<?php
/**
модуль обработки просто страниц системы Simba
 */

namespace Mf\Statpage;

use Zend\Mvc\MvcEvent;
use Zend\Session\Container;
use Zend\EventManager\Event;

use Mf\Statpage\Service\GetControllersInfo;

class Module
{

public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }


public function onBootstrap(MvcEvent $event)
{
	$eventManager = $event->getApplication()->getEventManager();
    $sharedEventManager = $eventManager->getSharedManager();
    // объявление слушателя для проверки авторизации админа 
	$sharedEventManager->attach("simba.admin", "GetControllersInfoAdmin", [$this, 'GetControllersInfoAdmin']);
}


/*
слушает событие GetControllersInfoAdmin 
для визуаллизации в админке маршрутов/путей в меню админки
в параметрах передается:
name=>имя_раздела "admin", ""
container - объект с интерфейсом Interop\Container\ContainerInterface - то что передается в фабрики
*/
public function GetControllersInfoAdmin(Event $event)
{
	$name=$event->getParam("name",NULL);
	$container=$event->getParam("container",NULL);
	$locale=$event->getParam("locale",NULL);
	//сервис который будет возвращать
	$service=$container->build(GetControllersInfo::class,["name"=>$name,"locale"=>$locale]);
	return $service->GetDescriptors();
}

}
