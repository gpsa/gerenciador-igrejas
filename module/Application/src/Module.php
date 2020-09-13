<?php

/**
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @copyright Copyright (c) 2014-2016 Zend Technologies USA Inc. (http://www.zend.com)
 */

namespace Application;

use Laminas\ApiTools\Hal\Collection;
use Laminas\EventManager\EventInterface;
use Laminas\ServiceManager\ServiceManager;
use Laminas\Uri\UriFactory;

class Module implements \Zend\ModuleManager\Feature\BootstrapListenerInterface
{
    /** @var ServiceManager */
    private $container;

    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function onBootstrap(EventInterface $e)
    {
        // Registra o uso do schema chrome-extension
        UriFactory::registerScheme('chrome-extension', 'Zend\Uri\Uri');

        $this->container = $e->getParam('application')->getServiceManager();
        $adapter = $this->container->get('oauth2.doctrineadapter.default');

        # Carrega um OAuth2 Listener para tratar senhas antigas com MD5
        $listenerAggregate = new EventSubscriber\OAuth2AggregateListener(
            $this->container->get('doctrine.entitymanager.orm_default'),
            $adapter
        );
        $listenerAggregate->attach($adapter->getEventManager(), 10100);
    }
}
