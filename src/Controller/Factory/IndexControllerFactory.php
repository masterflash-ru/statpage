<?php
namespace Statpage\Controller\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Statpage\Controller\IndexController;
use Statpage\Service\Statpage;



/**
 */
class IndexControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
		$statpage_service=$container->get(Statpage::class);
		
		return new IndexController($statpage_service);
    }
}

