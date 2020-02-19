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
    /**
     * Undocumented function
     *
     * @param string $name
     * @return Usuario|null
     */
    public function getByName($name)
    {
        return $this->findOneBy(['username' => $name]);
    }

    /**
     * Undocumented function
     *
     * @param array ...$params
     * @return Usuario|null
     */
    public function getUsuarioByPasswordMD5(...$params)
    {
        $dql = <<<DQL
SELECT u FROM Application\Entity\OAuth2\Usuario u 
WHERE u.username = :usuario AND (LENGTH(u.password) = 32 AND u.password = :senha) AND u.state = :state
DQL;

        $q = $this->getEntityManager()->createQuery($dql);
        $q->setParameters([
            'usuario' => $params[0],
            'senha' => md5($params[1]),
            'state' => $params[2] ?? 1
        ]);

        return $q->getOneOrNullResult();
    }
}
