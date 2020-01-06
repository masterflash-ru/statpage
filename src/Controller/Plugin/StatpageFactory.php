<?php
/**
* фабрика для плагина контроллера, плагин проедназначен для доступа к страницам внутри контроллеров
* например, для генерации писем уведомлений юзерам
*/

namespace Mf\Statpage\Controller\Plugin;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\FactoryInterface;
use Laminas\ServiceManager\ServiceLocatorInterface;

use Mf\Statpage\Service\Statpage;


class StatpageFactory implements FactoryInterface
{
    /**
     * 
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $statpage_service=$container->get(Statpage::class);
        return new $requestedName($statpage_service);
    }
    /**
     * Create and return Statpage instance
     *
     * For use with Laminas-servicemanager v2; proxies to __invoke().
     *
     * @param ServiceLocatorInterface $container
     * @return Statpage
     */
    public function createService(ServiceLocatorInterface $container)
    {
        return $this($container, Statpage::class);
    }

}
