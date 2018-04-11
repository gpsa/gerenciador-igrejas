<?php
/**
 * Created by PhpStorm.
 * User: guilherme
 * Date: 02/01/18
 * Time: 09:33
 */

namespace Application\Entity\OAuth2;


use Doctrine\ORM\EntityRepository;

class UsuarioRepository extends EntityRepository
{
    public function getUsuarioByPasswordMD5(...$params)
    {
        $dql = <<<DQL
SELECT u FROM Application\Entity\OAuth2\Usuario u WHERE u.username = :usuario AND (LENGTH(u.password) = 32 AND u.password = :senha)
DQL;

        $q = $this->getEntityManager()->createQuery($dql);
        $q->setParameters([
            'usuario' => $params[0],
            'senha' => md5($params[1])
        ]);

        return $q->getOneOrNullResult();
    }
}