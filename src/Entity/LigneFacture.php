<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VenteRepository")
 */
class LigneFacture
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $quantite;

    /**
     * @ORM\Column(type="string")
     */
    private $remiseType;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $remise;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Produit", inversedBy="ligneFactures")
     * @ORM\JoinColumn(nullable=false)
     */
    private $produit;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Facture", inversedBy="ligneFactures")
     * @ORM\JoinColumn(nullable=false)
     */
    private $facture;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getQuantite()
    {
        return $this->quantite;
    }

    /**
     * @param mixed $quantite
     */
    public function setQuantite($quantite): void
    {
        $this->quantite = $quantite;
    }

    public function getRemiseType()
    {
        return $this->remiseType;
    }

    public function setRemiseType($remiseType): self
    {
        $this->remiseType = $remiseType;

        return $this;
    }


    /**
     * @return mixed
     */
    public function getRemise()
    {
        return $this->remise;
    }

    /**
     * @param mixed $remise
     */
    public function setRemise($remise): void
    {
        $this->remise = $remise;
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

    public function getFacture(): ?Facture
    {
        return $this->facture;
    }

    public function setFacture(?Facture $facture): self
    {
        $this->facture = $facture;

        return $this;
    }
}
