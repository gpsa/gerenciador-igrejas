<?php

/**
 * Created by PhpStorm.
 * User: guilherme
 * Date: 02/01/18
 * Time: 09:16
 */

namespace Application\EventSubscriber;


use Application\Entity\OAuth2\Usuario;
use Application\Entity\OAuth2\UsuarioRepository;
use Doctrine\ORM\EntityManager;
use Zend\EventManager\Event;
use Zend\EventManager\AbstractListenerAggregate;
use Zend\EventManager\EventManagerInterface;
use ZF\OAuth2\Doctrine\Adapter\DoctrineAdapter;

class OAuth2AggregateListener extends AbstractListenerAggregate
{
    protected $handlers = array();
    protected $logInAs;

    /**
     * Doctrine Entity Manager
     * @var EntityManager
     */
    protected $em;

    /**
     * @var DoctrineAdapter
     */
    protected $adapter;

    public function __construct(EntityManager $em, $adapter)
    {
        $this->em = $em;
        $this->adapter = $adapter;
        return $this;
    }

    public function attach(EventManagerInterface $events, $priority = 1)
    {
        $this->handlers[] = $events->attach('checkUserCredentials', array($this, 'checkUserCredentials'), $priority);
    }

    /**
     * Do work such as non-standard encrypted password checking
     */
    public function checkUserCredentials(Event $e)
    {
        /** @var $rpUsuario UsuarioRepository */
        $rpUsuario = $this->em->getRepository(Usuario::class);
        /** @var $ret Usuario|null */
        $usuario = $rpUsuario->getByName($e->getParam('username')) ?? false;

        //$adapter = $container->get('ZF\OAuth2\Doctrine\Adapter\DoctrineAdapter');
        $hashMD5Ok = $usuario && strcmp($usuario->getPassword(), md5($e->getParam('password'))) === 0;

        if (!$usuario || !($usuario && $usuario->getState() === 1)) {
            return $e->stopPropagation();
        } elseif (!($usuario instanceof Usuario && $hashMD5Ok)) {
            return false;
        }

        // Atualiza a senha para o BCrypt configurado
        if ($hashMD5Ok) {
            $hashMD5Ok && $usuario->setPassword($this->adapter->getBcrypt()->create($e->getParam('password')));
            $this->em->flush($usuario);
        }
    }
}
