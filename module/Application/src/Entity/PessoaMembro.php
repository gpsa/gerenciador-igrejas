<?php

namespace Application\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * PessoaMembro
 *
 * @ORM\Table(name="pessoa_membro")
 * @ORM\Entity
 */
class PessoaMembro
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
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=100, nullable=true)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="sexo", type="string", length=255, nullable=true)
     */
    private $sexo;

    /**
     * @var string
     *
     * @ORM\Column(name="endereco", type="string", length=255, nullable=true)
     */
    private $endereco;

    /**
     * @var string
     *
     * @ORM\Column(name="cep", type="string", length=255, nullable=true)
     */
    private $cep;

    /**
     * @var string
     *
     * @ORM\Column(name="telefone_residencial", type="string", length=255, nullable=true)
     */
    private $telefoneResidencial;

    /**
     * @var string
     *
     * @ORM\Column(name="telefone_comercial", type="string", length=255, nullable=true)
     */
    private $telefoneComercial;

    /**
     * @var string
     *
     * @ORM\Column(name="telefone_celular", type="string", length=255, nullable=true)
     */
    private $telefoneCelular;

    /**
     * @var string
     *
     * @ORM\Column(name="nome_pai", type="string", length=255, nullable=true)
     */
    private $nomePai;

    /**
     * @var string
     *
     * @ORM\Column(name="nome_mae", type="string", length=255, nullable=true)
     */
    private $nomeMae;

    /**
     * @var string
     *
     * @ORM\Column(name="estado_civil", type="string", length=255, nullable=true)
     */
    private $estadoCivil;

    /**
     * @var string
     *
     * @ORM\Column(name="nome_conjuge", type="string", length=255, nullable=true)
     */
    private $nomeConjuge;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_nascimento_conjuge", type="date", nullable=true)
     */
    private $dataNascimentoConjuge;

    /**
     * @var integer
     *
     * @ORM\Column(name="conjuge_evangelico", type="integer", nullable=true)
     */
    private $conjugeEvangelico = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="conjuge_igreja", type="integer", nullable=true)
     */
    private $conjugeIgreja = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="filhos", type="integer", nullable=true)
     */
    private $filhos = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="nome_filho1", type="string", length=255, nullable=true)
     */
    private $nomeFilho1;

    /**
     * @var integer
     *
     * @ORM\Column(name="idade_filho1", type="integer", nullable=true)
     */
    private $idadeFilho1 = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="nome_filho2", type="string", length=255, nullable=true)
     */
    private $nomeFilho2;

    /**
     * @var integer
     *
     * @ORM\Column(name="idade_filho2", type="integer", nullable=true)
     */
    private $idadeFilho2 = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="nome_filho3", type="string", length=255, nullable=true)
     */
    private $nomeFilho3;

    /**
     * @var integer
     *
     * @ORM\Column(name="idade_filho3", type="integer", nullable=true)
     */
    private $idadeFilho3 = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_batismo", type="date", nullable=true)
     */
    private $dataBatismo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_nascimento", type="date", nullable=true)
     */
    private $dataNascimento;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_congregacao", type="date", nullable=true)
     */
    private $dataCongregacao;

    /**
     * @var string
     *
     * @ORM\Column(name="cargo", type="string", length=50, nullable=true)
     */
    private $cargo;

    /**
     * @var string
     *
     * @ORM\Column(name="envelope", type="string", length=3, nullable=true)
     */
    private $envelope;

    /**
     * @var string
     *
     * @ORM\Column(name="categoria", type="string", length=3, nullable=true)
     */
    private $categoria;


    /**
     * One Product has Many Features.
     * @ORM\OneToMany(targetEntity="FinancasDizimo", mappedBy="membro", fetch="EXTRA_LAZY")
     */
    private $dizimos;


    public function __construct()
    {
        $this->dizimos = new ArrayCollection();

        return $this;
    }


    /**
     * Get memId
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Set memNome
     *
     * @param string $nome
     *
     * @return PessoaMembro
     */
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get memNome
     *
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set memSexo
     *
     * @param string $sexo
     *
     * @return PessoaMembro
     */
    public function setSexo($sexo)
    {
        $this->sexo = $sexo;

        return $this;
    }

    /**
     * Get memSexo
     *
     * @return string
     */
    public function getSexo()
    {
        return $this->sexo;
    }

    /**
     * Set memEndereco
     *
     * @param string $endereco
     *
     * @return PessoaMembro
     */
    public function setEndereco($endereco)
    {
        $this->endereco = $endereco;

        return $this;
    }

    /**
     * Get memEndereco
     *
     * @return string
     */
    public function getEndereco()
    {
        return $this->endereco;
    }

    /**
     * Set memCep
     *
     * @param string $cep
     *
     * @return PessoaMembro
     */
    public function setCep($cep)
    {
        $this->cep = $cep;

        return $this;
    }

    /**
     * Get memCep
     *
     * @return string
     */
    public function getCep()
    {
        return $this->cep;
    }

    /**
     * Set memTelefoneResidencial
     *
     * @param string $telefoneResidencial
     *
     * @return PessoaMembro
     */
    public function setTelefoneResidencial($telefoneResidencial)
    {
        $this->telefoneResidencial = $telefoneResidencial;

        return $this;
    }

    /**
     * Get memTelefoneResidencial
     *
     * @return string
     */
    public function getTelefoneResidencial()
    {
        return $this->telefoneResidencial;
    }

    /**
     * Set memTelefoneComercial
     *
     * @param string $telefoneComercial
     *
     * @return PessoaMembro
     */
    public function setTelefoneComercial($telefoneComercial)
    {
        $this->telefoneComercial = $telefoneComercial;

        return $this;
    }

    /**
     * Get memTelefoneComercial
     *
     * @return string
     */
    public function getTelefoneComercial()
    {
        return $this->telefoneComercial;
    }

    /**
     * Set memTelefoneCelular
     *
     * @param string $telefoneCelular
     *
     * @return PessoaMembro
     */
    public function setTelefoneCelular($telefoneCelular)
    {
        $this->telefoneCelular = $telefoneCelular;

        return $this;
    }

    /**
     * Get memTelefoneCelular
     *
     * @return string
     */
    public function getTelefoneCelular()
    {
        return $this->telefoneCelular;
    }

    /**
     * Set memNomePai
     *
     * @param string $nomePai
     *
     * @return PessoaMembro
     */
    public function setNomePai($nomePai)
    {
        $this->nomePai = $nomePai;

        return $this;
    }

    /**
     * Get memNomePai
     *
     * @return string
     */
    public function getNomePai()
    {
        return $this->nomePai;
    }

    /**
     * Set memNomeMae
     *
     * @param string $nomeMae
     *
     * @return PessoaMembro
     */
    public function setNomeMae($nomeMae)
    {
        $this->nomeMae = $nomeMae;

        return $this;
    }

    /**
     * Get memNomeMae
     *
     * @return string
     */
    public function getNomeMae()
    {
        return $this->nomeMae;
    }

    /**
     * Set memEstadoCivil
     *
     * @param string $estadoCivil
     *
     * @return PessoaMembro
     */
    public function setEstadoCivil($estadoCivil)
    {
        $this->estadoCivil = $estadoCivil;

        return $this;
    }

    /**
     * Get memEstadoCivil
     *
     * @return string
     */
    public function getEstadoCivil()
    {
        return $this->estadoCivil;
    }

    /**
     * Set memNomeConjuge
     *
     * @param string $nomeConjuge
     *
     * @return PessoaMembro
     */
    public function setNomeConjuge($nomeConjuge)
    {
        $this->nomeConjuge = $nomeConjuge;

        return $this;
    }

    /**
     * Get memNomeConjuge
     *
     * @return string
     */
    public function getNomeConjuge()
    {
        return $this->nomeConjuge;
    }

    /**
     * Set memDataNascimentoConjuge
     *
     * @param \DateTime $dataNascimentoConjuge
     *
     * @return PessoaMembro
     */
    public function setDataNascimentoConjuge($dataNascimentoConjuge)
    {
        $this->dataNascimentoConjuge = $dataNascimentoConjuge;

        return $this;
    }

    /**
     * Get memDataNascimentoConjuge
     *
     * @return \DateTime
     */
    public function getDataNascimentoConjuge()
    {
        return $this->dataNascimentoConjuge;
    }

    /**
     * Set memConjugeEvangelico
     *
     * @param integer $conjugeEvangelico
     *
     * @return PessoaMembro
     */
    public function setConjugeEvangelico($conjugeEvangelico)
    {
        $this->conjugeEvangelico = $conjugeEvangelico;

        return $this;
    }

    /**
     * Get memConjugeEvangelico
     *
     * @return integer
     */
    public function getConjugeEvangelico()
    {
        return $this->conjugeEvangelico;
    }

    /**
     * Set memConjugeIgreja
     *
     * @param integer $conjugeIgreja
     *
     * @return PessoaMembro
     */
    public function setConjugeIgreja($conjugeIgreja)
    {
        $this->conjugeIgreja = $conjugeIgreja;

        return $this;
    }

    /**
     * Get memConjugeIgreja
     *
     * @return integer
     */
    public function getConjugeIgreja()
    {
        return $this->conjugeIgreja;
    }

    /**
     * Set memFilhos
     *
     * @param integer $filhos
     *
     * @return PessoaMembro
     */
    public function setFilhos($filhos)
    {
        $this->filhos = $filhos;

        return $this;
    }

    /**
     * Get memFilhos
     *
     * @return integer
     */
    public function getFilhos()
    {
        return $this->filhos;
    }

    /**
     * Set memNomeFilho1
     *
     * @param string $nomeFilho1
     *
     * @return PessoaMembro
     */
    public function setNomeFilho1($nomeFilho1)
    {
        $this->nomeFilho1 = $nomeFilho1;

        return $this;
    }

    /**
     * Get memNomeFilho1
     *
     * @return string
     */
    public function getNomeFilho1()
    {
        return $this->nomeFilho1;
    }

    /**
     * Set memIdadeFilho1
     *
     * @param integer $idadeFilho1
     *
     * @return PessoaMembro
     */
    public function setIdadeFilho1($idadeFilho1)
    {
        $this->idadeFilho1 = $idadeFilho1;

        return $this;
    }

    /**
     * Get memIdadeFilho1
     *
     * @return integer
     */
    public function getIdadeFilho1()
    {
        return $this->idadeFilho1;
    }

    /**
     * Set memNomeFilho2
     *
     * @param string $nomeFilho2
     *
     * @return PessoaMembro
     */
    public function setNomeFilho2($nomeFilho2)
    {
        $this->nomeFilho2 = $nomeFilho2;

        return $this;
    }

    /**
     * Get memNomeFilho2
     *
     * @return string
     */
    public function getNomeFilho2()
    {
        return $this->nomeFilho2;
    }

    /**
     * Set memIdadeFilho2
     *
     * @param integer $idadeFilho2
     *
     * @return PessoaMembro
     */
    public function setIdadeFilho2($idadeFilho2)
    {
        $this->idadeFilho2 = $idadeFilho2;

        return $this;
    }

    /**
     * Get memIdadeFilho2
     *
     * @return integer
     */
    public function getIdadeFilho2()
    {
        return $this->idadeFilho2;
    }

    /**
     * Set memNomeFilho3
     *
     * @param string $nomeFilho3
     *
     * @return PessoaMembro
     */
    public function setNomeFilho3($nomeFilho3)
    {
        $this->nomeFilho3 = $nomeFilho3;

        return $this;
    }

    /**
     * Get memNomeFilho3
     *
     * @return string
     */
    public function getNomeFilho3()
    {
        return $this->nomeFilho3;
    }

    /**
     * Set memIdadeFilho3
     *
     * @param integer $idadeFilho3
     *
     * @return PessoaMembro
     */
    public function setIdadeFilho3($idadeFilho3)
    {
        $this->idadeFilho3 = $idadeFilho3;

        return $this;
    }

    /**
     * Get memIdadeFilho3
     *
     * @return integer
     */
    public function getIdadeFilho3()
    {
        return $this->idadeFilho3;
    }

    /**
     * Set memDataBatismo
     *
     * @param \DateTime $dataBatismo
     *
     * @return PessoaMembro
     */
    public function setDataBatismo($dataBatismo)
    {
        $this->dataBatismo = $dataBatismo;

        return $this;
    }

    /**
     * Get memDataBatismo
     *
     * @return \DateTime
     */
    public function getDataBatismo()
    {
        return $this->dataBatismo;
    }

    /**
     * Set memDataNascimento
     *
     * @param \DateTime $dataNascimento
     *
     * @return PessoaMembro
     */
    public function setDataNascimento($dataNascimento)
    {
        $this->dataNascimento = $dataNascimento;

        return $this;
    }

    /**
     * Get memDataNascimento
     *
     * @return \DateTime
     */
    public function getDataNascimento()
    {
        return $this->dataNascimento;
    }

    /**
     * Set memDataCongregacao
     *
     * @param \DateTime $dataCongregacao
     *
     * @return PessoaMembro
     */
    public function setDataCongregacao($dataCongregacao)
    {
        $this->dataCongregacao = $dataCongregacao;

        return $this;
    }

    /**
     * Get memDataCongregacao
     *
     * @return \DateTime
     */
    public function getDataCongregacao()
    {
        return $this->dataCongregacao;
    }

    /**
     * Set memCargo
     *
     * @param string $cargo
     *
     * @return PessoaMembro
     */
    public function setCargo($cargo)
    {
        $this->cargo = $cargo;

        return $this;
    }

    /**
     * Get memCargo
     *
     * @return string
     */
    public function getCargo()
    {
        return $this->cargo;
    }

    /**
     * Set memEnvelope
     *
     * @param string $envelope
     *
     * @return PessoaMembro
     */
    public function setEnvelope($envelope)
    {
        $this->envelope = $envelope;

        return $this;
    }

    /**
     * Get memEnvelope
     *
     * @return string
     */
    public function getEnvelope()
    {
        return $this->envelope;
    }

    /**
     * Set memCategoria
     *
     * @param string $categoria
     *
     * @return PessoaMembro
     */
    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;

        return $this;
    }

    /**
     * Get memCategoria
     *
     * @return string
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * @return mixed
     */
    public function getDizimos()
    {
        return $this->dizimos;
    }

    /**
     * @param mixed $dizimos
     * @return PessoaMembro
     */
    public function setDizimos($dizimos)
    {
        $this->dizimos = $dizimos;
        return $this;
    }


}
