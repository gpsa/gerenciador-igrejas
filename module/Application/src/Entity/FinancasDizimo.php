<?php

namespace Application\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Datetime;

/**
 * FinancasDizimo
 *
 * @ORM\Table(name="financas_dizimo")
 * @ORM\Entity
 */
class FinancasDizimo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data", type="datetime", nullable=true)
     */
    private $data;

    /**
     * @var double
     *
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $valor;

    /**
     * @ORM\ManyToOne(targetEntity="PessoaMembro")
     * @ORM\JoinColumn(name="membro_id", referencedColumnName="id")
     * @var PessoaMembro
     */
    private $membro;

    /**
     * Get dizId
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set dizData
     *
     * @param \DateTime $data
     *
     * @return FinancasDizimo
     */
    public function setData(Datetime $data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get dizData
     *
     * @return \DateTime
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set dizValor
     *
     * @param double $valor
     *
     * @return FinancasDizimo
     */
    public function setValor($valor)
    {
        $this->valor = $valor;

        return $this;
    }

    /**
     * Get dizValor
     *
     * @return double
     */
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * Set memId
     *
     * @param PessoaMembro $membro
     *
     * @return FinancasDizimo
     */
    public function setMembro(PessoaMembro $membro)
    {
        $this->membro = $membro;

        return $this;
    }

    /**
     * Get PessoaMembro
     *
     * @return PessoaMembro
     */
    public function getMembro()
    {
        return $this->membro;
    }

    public function getMembroNome()
    {
        return $this->membro->getNome();
    }
}
