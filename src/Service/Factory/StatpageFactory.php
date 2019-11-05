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
		 $config = $container->get('Config');
		 $connection=$container->get($config["statpage"]["config"]["database"]);
		 $cache = $container->get($config["statpage"]["config"]["cache"]);
        
        return new $requestedName($connection, $cache,$config);
    }
}

