<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FournisseurRepository")
 */
class Fournisseur
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $mail;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Taxe", mappedBy="fournisseur")
     */
    private $taxes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CategorieProduit", mappedBy="fournisseur")
     */
    private $categorieProduits;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Produit", mappedBy="fournisseur")
     */
    private $produits;

    public function __toString()
    {
        return $this->getNom();
    }

    public function __construct()
    {
        $this->taxes = new ArrayCollection();
        $this->categorieProduits = new ArrayCollection();
        $this->produits = new ArrayCollection();
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

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(?string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * @return Collection|Taxe[]
     */
    public function getTaxes(): Collection
    {
        return $this->taxes;
    }

    public function addTax(Taxe $tax): self
    {
        if (!$this->taxes->contains($tax)) {
            $this->taxes[] = $tax;
            $tax->setFournisseur($this);
        }

        return $this;
    }

    public function removeTax(Taxe $tax): self
    {
        if ($this->taxes->contains($tax)) {
            $this->taxes->removeElement($tax);
            // set the owning side to null (unless already changed)
            if ($tax->getFournisseur() === $this) {
                $tax->setFournisseur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|CategorieProduit[]
     */
    public function getCategorieProduits(): Collection
    {
        return $this->categorieProduits;
    }

    public function addCategorieProduit(CategorieProduit $categorieProduit): self
    {
        if (!$this->categorieProduits->contains($categorieProduit)) {
            $this->categorieProduits[] = $categorieProduit;
            $categorieProduit->setFournisseur($this);
        }

        return $this;
    }

    public function removeCategorieProduit(CategorieProduit $categorieProduit): self
    {
        if ($this->categorieProduits->contains($categorieProduit)) {
            $this->categorieProduits->removeElement($categorieProduit);
            // set the owning side to null (unless already changed)
            if ($categorieProduit->getFournisseur() === $this) {
                $categorieProduit->setFournisseur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Produit[]
     */
    public function getProduits(): Collection
    {
        return $this->produits;
    }

    public function addProduit(Produit $produit): self
    {
        if (!$this->produits->contains($produit)) {
            $this->produits[] = $produit;
            $produit->setFournisseur($this);
        }

        return $this;
    }

    public function removeProduit(Produit $produit): self
    {
        if ($this->produits->contains($produit)) {
            $this->produits->removeElement($produit);
            // set the owning side to null (unless already changed)
            if ($produit->getFournisseur() === $this) {
                $produit->setFournisseur(null);
            }
        }

        return $this;
    }
}
