<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProduitRepository")
 */
class Produit
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $prixHT;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CategorieProduit", inversedBy="produits")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categorieProduit;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\LigneFacture", mappedBy="produit")
     */
    private $ligneFactures;

    public function __construct()
    {
        $this->ligneFactures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrixHT()
    {
        return $this->prixHT;
    }

    public function setPrixHT($prixHT): self
    {
        $this->prixHT = $prixHT;

        return $this;
    }

    public function getCategorieProduit(): ?CategorieProduit
    {
        return $this->categorieProduit;
    }

    public function setCategorieProduit(?CategorieProduit $categorieProduit): self
    {
        $this->categorieProduit = $categorieProduit;

        return $this;
    }

    /**
     * @return Collection|LigneFacture[]
     */
    public function getLigneFactures(): Collection
    {
        return $this->ligneFactures;
    }

    public function addLigneFacture(LigneFacture $ligneFacture): self
    {
        if (!$this->ligneFactures->contains($ligneFacture)) {
            $this->ligneFactures[] = $ligneFacture;
            $ligneFacture->setProduit($this);
        }

        return $this;
    }

    public function removeLigneFacture(LigneFacture $ligneFacture): self
    {
        if ($this->ligneFactures->contains($ligneFacture)) {
            $this->ligneFactures->removeElement($ligneFacture);
            // set the owning side to null (unless already changed)
            if ($ligneFacture->getProduit() === $this) {
                $ligneFacture->setProduit(null);
            }
        }

        return $this;
    }
}
