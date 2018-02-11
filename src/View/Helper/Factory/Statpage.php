<?php
namespace Mf\Statpage\View\Helper\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Mf\Statpage\Service\Statpage as Statpage_service;

/**
 * универсальная фабрика для стат страниц
 * 
 */
class Statpage implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
	   $statpage_service=$container->get(Statpage_service::class);
        return new $requestedName($statpage_service);
    }
}

