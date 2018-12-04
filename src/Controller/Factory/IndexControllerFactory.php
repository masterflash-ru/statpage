<?php
namespace Mf\Statpage\Controller\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Mf\Statpage\Service\Statpage;



/**
 */
class IndexControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $connection=$container->get('DefaultSystemDb');
        $statpage_service=$container->get(Statpage::class);

        return new $requestedName( $connection,$statpage_service);
    }
}

