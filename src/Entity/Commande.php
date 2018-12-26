<?php

namespace App\Entity;

use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $reference;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $prixHT;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $prixTTC;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $ecoHT;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $ecoTTC;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Client", inversedBy="commandes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $client;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\LigneCommande", mappedBy="commande")
     */
    private $ligneCommandes;

    public function __construct()
    {
        $this->ligneCommandes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): self
    {
        $this->reference = $reference;

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
            $ligneCommande->setCommande($this);
        }

        return $this;
    }

    public function removeLigneCommande(LigneCommande $ligneCommande): self
    {
        if ($this->ligneCommandes->contains($ligneCommande)) {
            $this->ligneCommandes->removeElement($ligneCommande);
            // set the owning side to null (unless already changed)
            if ($ligneCommande->getCommande() === $this) {
                $ligneCommande->setCommande(null);
            }
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPrixHT()
    {
        return $this->prixHT;
    }

    /**
     * @param mixed $prixHT
     */
    public function setPrixHT($prixHT): void
    {
        $this->prixHT = $prixHT;
    }

    /**
     * @return mixed
     */
    public function getPrixTTC()
    {
        return $this->prixTTC;
    }

    /**
     * @param mixed $prixTTC
     */
    public function setPrixTTC($prixTTC): void
    {
        $this->prixTTC = $prixTTC;
    }

    /**
     * @return mixed
     */
    public function getEcoHT()
    {
        return $this->ecoHT;
    }

    /**
     * @param mixed $ecoHT
     */
    public function setEcoHT($ecoHT): void
    {
        $this->ecoHT = $ecoHT;
    }

    /**
     * @return mixed
     */
    public function getEcoTTC()
    {
        return $this->ecoTTC;
    }

    /**
     * @param mixed $ecoTTC
     */
    public function setEcoTTC($ecoTTC): void
    {
        $this->ecoTTC = $ecoTTC;
    }
}
