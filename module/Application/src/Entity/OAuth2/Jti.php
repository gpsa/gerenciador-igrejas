<?php

namespace Application\Entity\OAuth2;

use Doctrine\ORM\Mapping as ORM;

/**
 * Jti
 * @ORM\Table(name="oauth_jti")
 * @ORM\Entity
 */
class Jti
{
    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    private $subject;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    private $audience;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @var \DateTime
     */
    private $expires;

    /**
     * @var string
     * @ORM\Column(type="text", nullable=true)
     */
    private $jti;

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
     * @ORM\ManyToOne(targetEntity="Client", inversedBy="jti")
     * @ORM\JoinColumn(name="client_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     */
    private $client;

    public function exchangeArray(array $array)
    {
        foreach ($array as $key => $value) {
            switch ($key) {
                case 'client':
                    $this->setClient($value);
                    break;
                case 'subject':
                    $this->setSubject($value);
                    break;
                case 'audience':
                    $this->setAudience($value);
                    break;
                case 'expires':
                    $this->setExpires($value);
                    break;
                case 'jti':
                    $this->setJti($value);
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
            'client' => $this->getClient(),
            'subject' => $this->getSubject(),
            'audience' => $this->getAudience(),
            'expires' => $this->getExpires(),
            'jti' => $this->getJti(),
        );
    }

    /**
     * Set subject
     *
     * @param string $subject
     * @return Jti
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
     * Set audience
     *
     * @param string $audience
     * @return Jti
     */
    public function setAudience($audience)
    {
        $this->audience = $audience;

        return $this;
    }

    /**
     * Get audience
     *
     * @return string
     */
    public function getAudience()
    {
        return $this->audience;
    }

    /**
     * Set expires
     *
     * @param \DateTime $expires
     * @return Jti
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
     * Set jti
     *
     * @param string $jti
     * @return Jti
     */
    public function setJti($jti)
    {
        $this->jti = $jti;

        return $this;
    }

    /**
     * Get jti
     *
     * @return string
     */
    public function getJti()
    {
        return $this->jti;
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
     * @return Jti
     */
    public function setClient(Client $client)
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
