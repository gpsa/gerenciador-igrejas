<?php
/**
 * Created by PhpStorm.
 * User: guilherme
 * Date: 03/02/18
 * Time: 12:50
 */

namespace Usuario\V1\Rest\Usuario;


use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;

class UsuarioFactory implements \Zend\ServiceManager\Factory\FactoryInterface
{
    /**
     * Create an object
     *
     * @param  ContainerInterface $container
     * @param  string $requestedName
     * @param  null|array $options
     * @return object
     * @throws ServiceNotFoundException if unable to resolve the service.
     * @throws ServiceNotCreatedException if an exception is raised when
     *     creating a service.
     * @throws ContainerException if any other error occurs
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        // TODO: Implement __invoke() method.
        echo "OI";
        exit;
    }

    public function __invoke2($container)
    {
        echo "OI";
        exit;
        // TODO: Implement __invoke() method.
    }

}