<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LcommandeRepository")
 */
class Lcommande
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
     * @ORM\ManyToOne(targetEntity="App\Entity\produit")
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
     * @ORM\Column(type="string", length=50)
     */
    private $lig;

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

    public function getProduit(): ?produit
    {
        return $this->produit;
    }

    public function setProduit(?produit $produit): self
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

    public function getLig(): ?string
    {
        return $this->lig;
    }

    public function setLig(string $lig): self
    {
        $this->lig = $lig;

        return $this;
    }
}
