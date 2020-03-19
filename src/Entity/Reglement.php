<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ReglementRepository")
 */
class Reglement
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Facture")
     */
    private $facture;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $modereg;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $montant;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $numpiece;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $echeance;

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

    public function getFacture(): ?Facture
    {
        return $this->facture;
    }

    public function setFacture(?Facture $facture): self
    {
        $this->facture = $facture;

        return $this;
    }

    public function getModereg(): ?string
    {
        return $this->modereg;
    }

    public function setModereg(string $modereg): self
    {
        $this->modereg = $modereg;

        return $this;
    }

    public function getMontant(): ?string
    {
        return $this->montant;
    }

    public function setMontant(string $montant): self
    {
        $this->montant = $montant;

        return $this;
    }

    public function getNumpiece(): ?string
    {
        return $this->numpiece;
    }

    public function setNumpiece(string $numpiece): self
    {
        $this->numpiece = $numpiece;

        return $this;
    }

    public function getEcheance(): ?string
    {
        return $this->echeance;
    }

    public function setEcheance(string $echeance): self
    {
        $this->echeance = $echeance;

        return $this;
    }
}
