<?php

namespace Application\Doctrine;

/**
 * Created by PhpStorm.
 * User: guilherme
 * Date: 08/01/18
 * Time: 15:44
 */
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class ORMQueryBuilderFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return (new $requestedName)->setServiceLocator($container);
    }
}
