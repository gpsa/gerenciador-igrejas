<?php

namespace Application\Entity\OAuth2;

use Doctrine\ORM\Mapping as ORM;


/**
 * Jwt
 * @ORM\Table(name="oauth_jwt")
 * @ORM\Entity
 */
class Jwt
{
    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    private $subject;

    /**
     * @var string
     * @ORM\Column(name="public_key", type="text", nullable=true)
     */
    private $publicKey;

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
     * @ORM\ManyToOne(targetEntity="Client", inversedBy="jwt")
     * @ORM\JoinColumn(name="client_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     */
    private $client;

    public function getArrayCopy()
    {
        return array(
            'id' => $this->getId(),
            'client' => $this->getClient(),
            'subject' => $this->getSubject(),
            'publicKey' => $this->getPublicKey(),
        );
    }

    /**
     * Set subject
     *
     * @param string $subject
     * @return Jwt
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get subject
     *
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set publicKey
     *
     * @param string $publicKey
     * @return Jwt
     */
    public function setPublicKey($publicKey)
    {
        $this->publicKey = $publicKey;

        return $this;
    }

    /**
     * Get publicKey
     *
     * @return string
     */
    public function getPublicKey()
    {
        return $this->publicKey;
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
     * @return Jwt
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
}
