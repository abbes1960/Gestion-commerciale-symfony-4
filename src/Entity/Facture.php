<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FactureRepository")
 */
class Facture
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Client")
     */
    private $client;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $base0;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $base1;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $tva1;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $base2;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $tva2;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $base3;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $tva3;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $totht;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $totrem;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $tottva;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $timbre;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $tottc;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $rs;

    /**
     * @ORM\Column(type="string", length=5)
     */
    private $montrs;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $net;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getBase0(): ?string
    {
        return $this->base0;
    }

    public function setBase0(string $base0): self
    {
        $this->base0 = $base0;

        return $this;
    }

    public function getBase1(): ?string
    {
        return $this->base1;
    }

    public function setBase1(string $base1): self
    {
        $this->base1 = $base1;

        return $this;
    }

    public function getTva1(): ?string
    {
        return $this->tva1;
    }

    public function setTva1(string $tva1): self
    {
        $this->tva1 = $tva1;

        return $this;
    }

    public function getBase2(): ?string
    {
        return $this->base2;
    }

    public function setBase2(string $base2): self
    {
        $this->base2 = $base2;

        return $this;
    }

    public function getTva2(): ?string
    {
        return $this->tva2;
    }

    public function setTva2(string $tva2): self
    {
        $this->tva2 = $tva2;

        return $this;
    }

    public function getBase3(): ?string
    {
        return $this->base3;
    }

    public function setBase3(string $base3): self
    {
        $this->base3 = $base3;

        return $this;
    }

    public function getTva3(): ?string
    {
        return $this->tva3;
    }

    public function setTva3(string $tva3): self
    {
        $this->tva3 = $tva3;

        return $this;
    }

    public function getTotht(): ?string
    {
        return $this->totht;
    }

    public function setTotht(string $totht): self
    {
        $this->totht = $totht;

        return $this;
    }

    public function getTotrem(): ?string
    {
        return $this->totrem;
    }

    public function setTotrem(string $totrem): self
    {
        $this->totrem = $totrem;

        return $this;
    }

    public function getTottva(): ?string
    {
        return $this->tottva;
    }

    public function setTottva(string $tottva): self
    {
        $this->tottva = $tottva;

        return $this;
    }

    public function getTimbre(): ?string
    {
        return $this->timbre;
    }

    public function setTimbre(string $timbre): self
    {
        $this->timbre = $timbre;

        return $this;
    }

    public function getTottc(): ?string
    {
        return $this->tottc;
    }

    public function setTottc(string $tottc): self
    {
        $this->tottc = $tottc;

        return $this;
    }

    public function getRs(): ?string
    {
        return $this->rs;
    }

    public function setRs(string $rs): self
    {
        $this->rs = $rs;

        return $this;
    }

    public function getMontrs(): ?string
    {
        return $this->montrs;
    }

    public function setMontrs(string $montrs): self
    {
        $this->montrs = $montrs;

        return $this;
    }

    public function getNet(): ?string
    {
        return $this->net;
    }

    public function setNet(string $net): self
    {
        $this->net = $net;

        return $this;
    }
}
