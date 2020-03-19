<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommandeRepository")
 */
class Commande
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $Numc;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Client")
     */
    private $client;

    /**
     * @ORM\Column(type="date")
     */
    private $datecomm;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $observation;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $totht;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $tottva;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $totttc;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumc(): ?string
    {
        return $this->Numc;
    }

    public function setNumc(string $Numc): self
    {
        $this->Numc = $Numc;

        return $this;
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

    public function getdatecomm(): ?\DateTimeInterface
    {
        return $this->datecomm;
    }

    public function setdatecomm(\DateTimeInterface $datecomm): self
    {
        $this->datecomm = $datecomm;

        return $this;
    }

    public function getObservation(): ?string
    {
        return $this->observation;
    }

    public function setObservation(string $observation): self
    {
        $this->observation = $observation;

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

    public function getTottva(): ?string
    {
        return $this->tottva;
    }

    public function setTottva(string $tottva): self
    {
        $this->tottva = $tottva;

        return $this;
    }

    public function getTotttc(): ?string
    {
        return $this->totttc;
    }

    public function setTotttc(string $totttc): self
    {
        $this->totttc = $totttc;

        return $this;
    }
}
