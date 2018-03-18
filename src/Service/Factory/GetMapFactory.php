<?php
namespace Mf\Statpage\Service\Factory;

use Interop\Container\ContainerInterface;
use Mf\Statpage\Service\Statpage;

/*
Фабрика 
сервис обработки прерывания GetMap simba.sitemap
нужен для генерации карты сайта

$options - массив с ключами


*/

class GetMapFactory
{

public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
{
    $Router=$container->get("Application")->getMvcEvent()->getRouter();
    $statpageService=$container->get(Statpage::class);
    return new $requestedName($Router,$options,$statpageService);
 }
}

