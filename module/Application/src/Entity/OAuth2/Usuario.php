<?php

namespace Application\Entity\OAuth2;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use ZF\OAuth2\Doctrine\Entity\UserInterface;
use Zend\Stdlib\ArraySerializableInterface;

/**
 * Usuario
 *
 * @ORM\Table(name="usuario", indexes={@ORM\Index(name="idx_usuario_id", columns={"id"})})
 * @ORM\Entity(repositoryClass="UsuarioRepository")
 */
class Usuario implements UserInterface, ArraySerializableInterface
{

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=255, nullable=false)
     */
    protected $username;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=128, nullable=false)
     */
    protected $password;

    /**
     * @var string
     *
     * @ORM\Column(name="display_name", type="string", length=100, nullable=true)
     */
    protected $displayName;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="ultimo_acesso", type="datetime", nullable=true)
     */
    protected $ultimoAcesso;

    /**
     * @var integer
     *
     * @ORM\Column(name="state", type="integer", nullable=false, options={"default" : 0})
     */
    protected $state;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    protected $email;

    /**
     * @var ArrayCollection|Client[]
     */
    protected $client;
    protected $accessToken;
    protected $authorizationCode;
    protected $refreshToken;

    protected $profile;
    protected $country;
    protected $phone_number;

    public function exchangeArray(array $data)
    {
        foreach ($data as $key => $value) {
            switch ($key) {
                case 'username':
                    $this->setUsername($value);
                    break;
                case 'password':
                    $this->setPassword($value);
                    break;
                case 'profile':
                    $this->setProfile($value);
                    break;
                case 'email':
                    $this->setEmail($value);
                    break;
                case 'country':
                    $this->setAddress($value);
                    break;
                case 'phone_number':
                case 'phoneNumber':
                    $this->setPhone($value);
                    break;
                case 'display_name':
                case 'displayName':
                    $this->setDisplayName($value);
                    break;
                case 'ultimo_acesso':
                case 'ultimoAcesso':
                    $this->setUltimoAcesso($value);
                    break;
                default:
                    break;
            }
        }

        return $this;
    }

    public function getArrayCopy()
    {
        return array(
            'id' => $this->getId(),
            'username' => $this->getUsername(),
            'password' => $this->getPassword(),
            'profile' => $this->getProfile(),
            'state' => $this->getState(),
            'email' => $this->getEmail(),
            'country' => $this->getCountry(),
            'phone_number' => $this->getPhoneNumber(), // underscore formatting for openid
            'display_name' => $this->getDisplayName(),
            'ultimo_acesso' => $this->getUltimoAcesso(),
        );
    }


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Set username
     *
     * @param string $username
     *
     * @return Usuario
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return Usuario
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set displayName
     *
     * @param string $displayName
     *
     * @return Usuario
     */
    public function setDisplayName($displayName)
    {
        $this->displayName = $displayName;

        return $this;
    }

    /**
     * Get displayName
     *
     * @return string
     */
    public function getDisplayName()
    {
        return $this->displayName;
    }

    /**
     * Set UltimoAcesso
     *
     * @param DateTime $UltimoAcesso
     *
     * @return Usuario
     */
    public function setUsuUltimoAcesso($ultimoAcesso)
    {
        $this->ultimoAcesso = $ultimoAcesso;

        return $this;
    }

    /**
     * Get UltimoAcesso
     *
     * @return DateTime
     */
    public function getUsuUltimoAcesso()
    {
        return $this->ultimoAcesso;
    }

    public function getState()
    {
        return (int) $this->state;
    }

    public function setState($state)
    {
        $this->state = (int) $state;
        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    public function getPhoneNumber()
    {
        return $this->phone_number;
    }

    public function setPhoneNumber($value)
    {
        $this->phone_number = $value;

        return $this;
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function setCountry($value)
    {
        $this->country = $value;

        return $this;
    }

    public function getProfile()
    {
        return $this->profile;
    }

    public function setProfile($value)
    {
        $this->profile = $value;

        return $this;
    }

    public function getClient()
    {
        return $this->client;
    }

    public function getAccessToken()
    {
        return $this->accessToken;
    }

    public function getAuthorizationCode()
    {
        return $this->authorizationCode;
    }

    public function getRefreshToken()
    {
        return $this->refreshToken;
    }

    /**
     * @return DateTime
     */
    public function getUltimoAcesso()
    {
        return $this->ultimoAcesso;
    }

    /**
     * @param DateTime $ultimoAcesso
     * @return Usuario
     */
    public function setUltimoAcesso($ultimoAcesso)
    {
        $this->ultimoAcesso = $ultimoAcesso;
        return $this;
    }
}
