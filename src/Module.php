<?php
/**
модуль обработки просто страниц системы Simba
 */

namespace Mf\Statpage;

use Laminas\Mvc\MvcEvent;
use Laminas\Session\Container;
use Laminas\EventManager\Event;

use Mf\Statpage\Service\GetControllersInfo;
use Mf\Statpage\Service\GetMap;


class Module
{

public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }


public function onBootstrap(MvcEvent $event)
{
    $ServiceManager=$event->getApplication()-> getServiceManager();
	$eventManager = $event->getApplication()->getEventManager();
    $sharedEventManager = $eventManager->getSharedManager();
    
    // объявление слушателя для получения списка MVC для генерации меню сайта 
	$sharedEventManager->attach("simba.admin", "GetControllersInfoAdmin", [$this, 'GetControllersInfoAdmin']);
    
    //объявление слушателя для получения всех MVC адресов разбитых по языкам
    $sharedEventManager->attach("simba.admin", "GetMvc", function(Event $event) use ($ServiceManager){
        $category=$event->getParam("category",NULL);
        $service=$ServiceManager->build(GetControllersInfo::class,["category"=>$category]);
        return $service->GetMvc();
    });
    
    
    //слушатель для генерации карты сайта
    $sharedEventManager->attach("simba.sitemap", "GetMap", function(Event $event) use ($ServiceManager){
        $name=$event->getParam("name",NULL);
        $type=$event->getParam("type",NULL);
        $locale=$event->getParam("locale",NULL);
        $service=$ServiceManager->build(GetMap::class,["name"=>$name,"locale"=>$locale,"type"=>$type]);
        return $service->GetMap();
    });

}


/*
 УСТАРЕЛО
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
