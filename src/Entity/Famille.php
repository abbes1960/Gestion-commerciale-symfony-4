<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FamilleRepository")
 */
class Famille
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
    private $libelle;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Produit", mappedBy="famille")
     */
    private $Produits;

    public function __construct()
    {
        $this->Produits = new ArrayCollection();
    }

   

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return Collection|Produit[]
     */
    public function getProduits(): Collection
    {
        return $this->Produits;
    }

    public function addProduit(Produit $produit): self
    {
        if (!$this->Produits->contains($produit)) {
            $this->Produits[] = $produit;
            $produit->setFamille($this);
        }

        return $this;
    }

    public function removeProduit(Produit $produit): self
    {
        if ($this->Produits->contains($produit)) {
            $this->Produits->removeElement($produit);
            // set the owning side to null (unless already changed)
            if ($produit->getFamille() === $this) {
                $produit->setFamille(null);
            }
        }

        return $this;
    }

    
}
