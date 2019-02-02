<?php
/**
 * Created by PhpStorm.
 * User: guilherme
 * Date: 08/01/18
 * Time: 15:17
 */

namespace Membro\V1\Rest\PessoaMembro;

use Doctrine\ORM\QueryBuilder;
use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;
use ZF\Doctrine\QueryBuilder\Query\Provider\DefaultOrm;
use ZF\Rest\ResourceEvent;

class PessoaMembroFetchAll extends DefaultOrm
{

    public function createQuery(ResourceEvent $event, $entityClass, $parameters)
    {

        /* @var $q QueryBuilder */
        $q = parent::createQuery($event, $entityClass, $parameters);
        $q->select('partial row.{id,nome,telefoneResidencial,dataNascimento,categoria}');

        return $q;
    }
}