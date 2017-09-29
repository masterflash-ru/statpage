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
        $connection=$container->get('ADO\Connection');
		$statpage_service=$container->get(Statpage::class);
		
		return new IndexController( $connection,$statpage_service);
    }
}

