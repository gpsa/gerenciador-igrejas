<?php

namespace Application\Entity\OAuth2;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Scope
 * @ORM\Table(name="oauth_scope")
 * @ORM\Entity
 */
class Scope
{
    /**
     * @var string
     * @ORM\Column(type="text", nullable=true)
     */
    private $scope;

    /**
     * @var boolean
     * @ORM\Column(name="is_default", type="boolean", nullable=true)
     */
    private $isDefault;

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
     * @ORM\ManyToMany(targetEntity="Client", inversedBy="scope")
     * @ORM\JoinTable(name="oauth_client_to_scope",
     *      joinColumns={@ORM\JoinColumn(name="scope_id", referencedColumnName="id", nullable=false)},
     *      inverseJoinColumns={@ORM\JoinColumn(name="client_id", referencedColumnName="id", nullable=false)}
     *      )
     */
    private $client;

    /**
     * @var \Doctrine\Common\Collections\Collection
     * @ORM\ManyToMany(targetEntity="AuthorizationCode", inversedBy="scope")
     * @ORM\JoinTable(name="oauth_authorization_code_to_scope",
     *      joinColumns={@ORM\JoinColumn(name="scope_id", referencedColumnName="id", nullable=false)},
     *      inverseJoinColumns={@ORM\JoinColumn(name="authorization_code_id", referencedColumnName="id", nullable=false)}
     *      )
     */
    private $authorizationCode;

    /**
     * @var \Doctrine\Common\Collections\Collection
     * @ORM\ManyToMany(targetEntity="RefreshToken", inversedBy="scope")
     * @ORM\JoinTable(name="oauth_refresh_token_to_scope",
     *      joinColumns={@ORM\JoinColumn(name="scope_id", referencedColumnName="id", nullable=false,  onDelete="CASCADE")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="refresh_token_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")}
     *      )
     */
    private $refreshToken;

    /**
     * @var \Doctrine\Common\Collections\Collection
     * @ORM\ManyToMany(targetEntity="AccessToken", inversedBy="scope")
     * @ORM\JoinTable(name="oauth_access_token_to_scope",
     *      joinColumns={@ORM\JoinColumn(name="scope_id", referencedColumnName="id", nullable=false,  onDelete="CASCADE")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="access_token_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")}
     *      )
     */
    private $accessToken;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->client = new ArrayCollection();
        $this->authorizationCode = new ArrayCollection();
        $this->refreshToken = new ArrayCollection();
        $this->accessToken = new ArrayCollection();
    }

    public function getArrayCopy()
    {
        return array(
            'id' => $this->getId(),
            'scope' => $this->getScope(),
            'isDefault' => $this->getIsDefault(),
        );
    }

    /**
     * Set scope
     *
     * @param string $scope
     * @return Scope
     */
    public function setScope($scope)
    {
        $this->scope = $scope;

        return $this;
    }

    /**
     * Get scope
     *
     * @return string
     */
    public function getScope()
    {
        return $this->scope;
    }

    /**
     * Set isDefault
     *
     * @param boolean $isDefault
     * @return Scope
     */
    public function setIsDefault($isDefault)
    {
        $this->isDefault = $isDefault;

        return $this;
    }

    /**
     * Get isDefault
     *
     * @return boolean
     */
    public function getIsDefault()
    {
        return $this->isDefault;
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
     * Add client
     *
     * @param Client $client
     * @return Scope
     */
    public function addClient(Client $client)
    {
        $this->client[] = $client;

        return $this;
    }

    /**
     * Remove client
     *
     * @param Client $client
     */
    public function removeClient(Client $client)
    {
        $this->client->removeElement($client);
    }

    /**
     * Get client
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Add authorizationCode
     *
     * @param AuthorizationCode $authorizationCode
     * @return Scope
     */
    public function addAuthorizationCode(AuthorizationCode $authorizationCode)
    {
        $this->authorizationCode[] = $authorizationCode;

        return $this;
    }

    /**
     * Remove authorizationCode
     *
     * @param AuthorizationCode $authorizationCode
     */
    public function removeAuthorizationCode(AuthorizationCode $authorizationCode)
    {
        $this->authorizationCode->removeElement($authorizationCode);
    }

    /**
     * Get authorizationCode
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAuthorizationCode()
    {
        return $this->authorizationCode;
    }

    /**
     * Add refreshToken
     *
     * @param RefreshToken $refreshToken
     * @return Scope
     */
    public function addRefreshToken(RefreshToken $refreshToken)
    {
        $this->refreshToken[] = $refreshToken;

        return $this;
    }

    /**
     * Remove refreshToken
     *
     * @param RefreshToken $refreshToken
     */
    public function removeRefreshToken(RefreshToken $refreshToken)
    {
        $this->refreshToken->removeElement($refreshToken);
    }

    /**
     * Get refreshToken
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRefreshToken()
    {
        return $this->refreshToken;
    }

    /**
     * Add accessToken
     *
     * @param AccessToken $accessToken
     * @return Scope
     */
    public function addAccessToken(AccessToken $accessToken)
    {
        $this->accessToken[] = $accessToken;

        return $this;
    }

    /**
     * Remove accessToken
     *
     * @param AccessToken $accessToken
     */
    public function removeAccessToken(AccessToken $accessToken)
    {
        $this->accessToken->removeElement($accessToken);
    }

    /**
     * Get accessToken
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }
}
