<?php
namespace Mf\Statpage\Service\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
фабрика
 */
class StatpageFactory implements FactoryInterface
{

public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
		 $connection=$container->get('DefaultSystemDb');
		 $cache = $container->get('DefaultSystemCache');
		 $config = $container->get('Config');
        
        return new $requestedName($connection, $cache,$config);
    }
}

