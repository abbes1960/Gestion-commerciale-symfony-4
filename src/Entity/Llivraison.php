<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LlivraisonRepository")
 */
class Llivraison
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
    private $numl;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Produit")
     */
    private $produit;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $pv;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $qte;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $tva;

    /**
     * @ORM\Column(type="integer")
     */
    private $lig;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getProduit(): ?Produit
    {
        return $this->produit;
    }

    public function setProduit(?Produit $produit): self
    {
        $this->produit = $produit;

        return $this;
    }

    public function getPv(): ?string
    {
        return $this->pv;
    }

    public function setPv(string $pv): self
    {
        $this->pv = $pv;

        return $this;
    }

    public function getQte(): ?string
    {
        return $this->qte;
    }

    public function setQte(string $qte): self
    {
        $this->qte = $qte;

        return $this;
    }

    public function getTva(): ?string
    {
        return $this->tva;
    }

    public function setTva(string $tva): self
    {
        $this->tva = $tva;

        return $this;
    }

    public function getLig(): ?int
    {
        return $this->lig;
    }

    public function setLig(int $lig): self
    {
        $this->lig = $lig;

        return $this;
    }
}
