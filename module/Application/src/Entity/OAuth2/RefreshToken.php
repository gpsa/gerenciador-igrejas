<?php

namespace Application\Entity\OAuth2;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use ApiSkeletons\OAuth2\Doctrine\Entity\UserInterface;

/**
 * RefreshToken
 * @ORM\Table(name="oauth_refresh_token")
 * @ORM\Entity
 */
class RefreshToken
{
    /**
     * @var string
     * @ORM\Column(name="refresh_token",type="string", nullable=true)
     */
    private $refreshToken;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $expires;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var Client
     * @ORM\ManyToOne(targetEntity="Client", inversedBy="refreshToken")
     * @ORM\JoinColumn(name="client_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     */
    private $client;

    /**
     * @var \Doctrine\Common\Collections\Collection
     * @ORM\ManyToMany(targetEntity="Scope", mappedBy="refreshToken")
     */
    private $scope;

    /**
     * UserInterface
     * @var object
     */
    private $user;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->scope = new ArrayCollection();
    }

    public function exchangeArray(array $array)
    {
        foreach ($array as $key => $value) {
            switch ($key) {
                case 'refreshToken':
                    $this->setRefreshToken($value);
                    break;
                case 'expires':
                    $this->setExpires($value);
                    break;
                case 'client':
                    $this->setClient($value);
                    break;
                case 'scope':
                    // Clear old collection
                    foreach ($value as $remove) {
                        $this->removeScope($remove);
                        $remove->removeRefreshToken($this);
                    }

                    // Add new collection
                    foreach ($value as $scope) {
                        $this->addScope($scope);
                        $scope->removeRefreshToken($this);
                    }
                    break;
                case 'user':
                    $this->setUser($value);
                    break;
                default:
                    // @codeCoverageIgnoreStart
                    break;
            }
            // @codeCoverageIgnoreEnd
        }

        return $this;
    }

    public function getArrayCopy()
    {
        return array(
            'id' => $this->getId(),
            'refreshToken' => $this->getRefreshToken(),
            'expires' => $this->getExpires(),
            'client' => $this->getClient(),
            'scope' => $this->getScope(),
            'user' => $this->getUser(),
        );
    }

    /**
     * Set refreshToken
     *
     * @param string $refreshToken
     * @return RefreshToken
     */
    public function setRefreshToken($refreshToken)
    {
        $this->refreshToken = $refreshToken;

        return $this;
    }

    /**
     * Get refreshToken
     *
     * @return string
     */
    public function getRefreshToken()
    {
        return $this->refreshToken;
    }

    /**
     * Set expires
     *
     * @param \DateTime $expires
     * @return RefreshToken
     */
    public function setExpires($expires)
    {
        $this->expires = $expires;

        return $this;
    }

    /**
     * Get expires
     *
     * @return \DateTime
     */
    public function getExpires()
    {
        return $this->expires;
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

    /**
     * Set client
     *
     * @param Client $client
     * @return RefreshToken
     */
    public function setClient(?Client $client)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Add scope
     *
     * @param Scope $scope
     * @return RefreshToken
     */
    public function addScope(Scope $scope)
    {
        $this->scope[] = $scope;

        return $this;
    }

    /**
     * Remove scope
     *
     * @param Scope $scope
     */
    public function removeScope(Scope $scope)
    {
        $this->scope->removeElement($scope);
    }

    /**
     * Get scope
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getScope()
    {
        return $this->scope;
    }


    /**
     * Set user
     *
     * @param $user
     * @return AuthorizationCode
     */
    public function setUser(UserInterface $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return Usuario
     */
    public function getUser()
    {
        return $this->user;
    }
}
