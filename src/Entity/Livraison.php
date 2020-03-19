<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LivraisonRepository")
 */
class Livraison
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
    private $numl;

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

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $dateliv;

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

    public function getNuml(): ?string
    {
        return $this->numl;
    }

    public function setNuml(string $numl): self
    {
        $this->numl = $numl;

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

    public function getdateliv(): ?\DateTimeInterface
    {
        return $this->dateliv;
    }

    public function setdateliv(\DateTimeInterface $dateliv): self
    {
        $this->dateliv = $dateliv;

        return $this;
    }
}