<?php
namespace Mf\Statpage\Service\Admin\JqGrid\Plugin;

use Interop\Container\ContainerInterface;

/*

*/

class FactoryGetConfigStatpage
{

public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
{
	$config=$container->get("config");
    return new $requestedName($config["statpage"]);
}
}

