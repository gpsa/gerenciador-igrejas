<?php
/**
 * Created by PhpStorm.
 * User: guilherme
 * Date: 01/01/18
 * Time: 12:26
 */

namespace Usuario\V1\Rest\Usuario;


use Laminas\Hydrator\Filter\FilterInterface;

class UsuarioFilter implements FilterInterface
{
    private $whitelist = [
        'id', 'username', 'displayName', 'ultimoAcesso', 'state', 'email'
    ];

    /**
     * Should return true, if the given filter
     * does not match
     *
     * @param string $property The name of the property
     * @return bool
     */
    public function filter($property)
    {
        return in_array($property,$this->whitelist, true);
    }

}