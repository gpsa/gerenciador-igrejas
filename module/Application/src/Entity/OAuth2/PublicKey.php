<?php

namespace Application\Entity\OAuth2;

use Doctrine\ORM\Mapping as ORM;

/**
 * PublicKey
 * @ORM\Table(name="oauth_public_key")
 * @ORM\Entity
 */
class PublicKey
{
    /**
     * @var string
     * @ORM\Column(name="public_key", type="text", nullable=true)
     */
    private $publicKey;

    /**
     * @var string
     * @ORM\Column(name="private_key", type="text", nullable=true)
     */
    private $privateKey;

    /**
     * @var string
     * @ORM\Column(name="encryption_algorithm", type="text", nullable=true)
     */
    private $encryptionAlgorithm;

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
     * @ORM\ManyToOne(targetEntity="Client", inversedBy="publicKey")
     * @ORM\JoinColumn(name="client_id", referencedColumnName="id", nullable=false, unique=true, onDelete="CASCADE")
     */
    private $client;

    public function getArrayCopy()
    {
        return array(
            'id' => $this->getId(),
            'publicKey' => $this->getPublicKey(),
            'privateKey' => $this->getPrivateKey(),
            'encryptionAlgorithm' => $this->getEncryptionAlgorithm(),
            'client' => $this->getClient(),
        );
    }

    /**
     * Set publicKey
     *
     * @param string $publicKey
     * @return PublicKey
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
     * Set privateKey
     *
     * @param string $privateKey
     * @return PublicKey
     */
    public function setPrivateKey($privateKey)
    {
        $this->privateKey = $privateKey;

        return $this;
    }

    /**
     * Get privateKey
     *
     * @return string
     */
    public function getPrivateKey()
    {
        return $this->privateKey;
    }

    /**
     * Set encryptionAlgorithm
     *
     * @param string $encryptionAlgorithm
     * @return PublicKey
     */
    public function setEncryptionAlgorithm($encryptionAlgorithm)
    {
        $this->encryptionAlgorithm = $encryptionAlgorithm;

        return $this;
    }

    /**
     * Get encryptionAlgorithm
     *
     * @return string
     */
    public function getEncryptionAlgorithm()
    {
        return $this->encryptionAlgorithm;
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
     * @return PublicKey
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
