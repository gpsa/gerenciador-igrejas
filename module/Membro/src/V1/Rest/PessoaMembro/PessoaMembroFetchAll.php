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
use Laminas\ServiceManager\Exception\ServiceNotCreatedException;
use Laminas\ServiceManager\Exception\ServiceNotFoundException;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Laminas\Stdlib\Parameters;
use Laminas\ApiTools\Doctrine\QueryBuilder\Query\Provider\DefaultOrm;
use Laminas\ApiTools\Rest\ResourceEvent;

class PessoaMembroFetchAll extends DefaultOrm
{

    public function createQuery(ResourceEvent $event, $entityClass, $parameters)
    {
        /* @var $q QueryBuilder */
        $q = parent::createQuery($event, $entityClass, $parameters);
        $q->select('partial row.{state,id,nome,telefoneResidencial,dataNascimento,categoria}');

        return $q;
    }
}
