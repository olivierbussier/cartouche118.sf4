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
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $marge;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CategorieProduit", inversedBy="produits")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categorieProduit;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\LigneCommande", mappedBy="produit")
     */
    private $ligneCommandes;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Marque", inversedBy="produits")
     * @ORM\JoinColumn(nullable=false)
     */
    private $marque;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Fournisseur", inversedBy="produits")
     */
    private $fournisseur;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $code;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $caract1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $caract2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $caract3;

    public function __construct()
    {
        $this->ligneCommandes = new ArrayCollection();
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
     * @return Collection|LigneCommande[]
     */
    public function getLigneCommandes(): Collection
    {
        return $this->ligneCommandes;
    }

    public function addLigneCommande(LigneCommande $ligneCommande): self
    {
        if (!$this->ligneCommandes->contains($ligneCommande)) {
            $this->ligneCommandes[] = $ligneCommande;
            $ligneCommande->setProduit($this);
        }

        return $this;
    }

    public function removeLigneCommande(LigneCommande $ligneCommande): self
    {
        if ($this->ligneCommandes->contains($ligneCommande)) {
            $this->ligneCommandes->removeElement($ligneCommande);
            // set the owning side to null (unless already changed)
            if ($ligneCommande->getProduit() === $this) {
                $ligneCommande->setProduit(null);
            }
        }

        return $this;
    }

    public function getMarque(): ?Marque
    {
        return $this->marque;
    }

    public function setMarque(?Marque $marque): self
    {
        $this->marque = $marque;

        return $this;
    }

    public function getFournisseur(): ?Fournisseur
    {
        return $this->fournisseur;
    }

    public function setFournisseur(?Fournisseur $fournisseur): self
    {
        $this->fournisseur = $fournisseur;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getMarge()
    {
        return $this->marge;
    }

    /**
     * @param mixed $marge
     */
    public function setMarge($marge): void
    {
        $this->marge = $marge;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getCaract1(): ?string
    {
        return $this->caract1;
    }

    public function setCaract1(string $caract1): self
    {
        $this->caract1 = $caract1;

        return $this;
    }

    public function getCaract2(): ?string
    {
        return $this->caract2;
    }

    public function setCaract2(?string $caract2): self
    {
        $this->caract2 = $caract2;

        return $this;
    }

    public function getCaract3(): ?string
    {
        return $this->caract3;
    }

    public function setCaract3(?string $caract3): self
    {
        $this->caract3 = $caract3;

        return $this;
    }
}
