<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ClientRepository")
 */
class Client
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $fullName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $additional;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Note", mappedBy="client")
     */
    private $notes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Commande", mappedBy="client")
     * @ORM\OrderBy({"createdAt" = "DESC"})
     */
    private $commandes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Adresse", mappedBy="client")
     */
    private $adresses;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Telephone", mappedBy="client")
     */
    private $telephones;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Email", mappedBy="client")
     */
    private $emails;

    /**
     * peut être:
     *  - Personne morale
     *  - Personne physique
     *
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Client", inversedBy="liensClients")
     */
    private $liensPersonnesMorales;

    /**
     *  Dans le cas d'une personne morale, pointe vers tous les clients qui y sont rattachés
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Client", mappedBy="liensPersonnesMorales")
     */
    private $liensClients;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\RemisesClient", mappedBy="client", orphanRemoval=true)
     */
    private $remisesClients;

    /**
     * @ORM\Column(type="boolean")
     */
    private $deleted;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $organization;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $prefix;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $suffix;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $titre;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $photo;

    public function __construct()
    {
        $this->notes = new ArrayCollection();
        $this->commandes = new ArrayCollection();
        $this->adresses = new ArrayCollection();
        $this->telephones = new ArrayCollection();
        $this->emails = new ArrayCollection();
        $this->liensPersonnesMorales = new ArrayCollection();
        $this->liensClients = new ArrayCollection();
        $this->remisesClients = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getNom();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param mixed $prenom
     */
    public function setPrenom($prenom): void
    {
        $this->prenom = $prenom;
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

    /**
     * @return Collection|Note[]
     */
    public function getNotes(): Collection
    {
        return $this->notes;
    }

    public function addNote(Note $note): self
    {
        if (!$this->notes->contains($note)) {
            $this->notes[] = $note;
            $note->setClient($this);
        }

        return $this;
    }

    public function removeNote(Note $note): self
    {
        if ($this->notes->contains($note)) {
            $this->notes->removeElement($note);
            // set the owning side to null (unless already changed)
            if ($note->getClient() === $this) {
                $note->setClient(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Commande[]
     */
    public function getCommandes(): Collection
    {
        return $this->commandes;
    }

    public function addCommande(Commande $commande): self
    {
        if (!$this->commandes->contains($commande)) {
            $this->commandes[] = $commande;
            $commande->setClient($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): self
    {
        if ($this->commandes->contains($commande)) {
            $this->commandes->removeElement($commande);
            // set the owning side to null (unless already changed)
            if ($commande->getClient() === $this) {
                $commande->setClient(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Adresse[]
     */
    public function getAdresses(): Collection
    {
        return $this->adresses;
    }

    public function addAdress(Adresse $adress): self
    {
        if (!$this->adresses->contains($adress)) {
            $this->adresses[] = $adress;
            $adress->setClient($this);
        }

        return $this;
    }

    public function removeAdress(Adresse $adress): self
    {
        if ($this->adresses->contains($adress)) {
            $this->adresses->removeElement($adress);
            // set the owning side to null (unless already changed)
            if ($adress->getClient() === $this) {
                $adress->setClient(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Telephone[]
     */
    public function getTelephones(): Collection
    {
        return $this->telephones;
    }

    public function addTelephone(Telephone $telephone): self
    {
        if (!$this->telephones->contains($telephone)) {
            $this->telephones[] = $telephone;
            $telephone->setClient($this);
        }

        return $this;
    }

    public function removeTelephone(Telephone $telephone): self
    {
        if ($this->telephones->contains($telephone)) {
            $this->telephones->removeElement($telephone);
            // set the owning side to null (unless already changed)
            if ($telephone->getClient() === $this) {
                $telephone->setClient(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Email[]
     */
    public function getEmails(): Collection
    {
        return $this->emails;
    }

    public function addEmail(Email $email): self
    {
        if (!$this->emails->contains($email)) {
            $this->emails[] = $email;
            $email->setClient($this);
        }

        return $this;
    }

    public function removeEmail(Email $email): self
    {
        if ($this->emails->contains($email)) {
            $this->emails->removeElement($email);
            // set the owning side to null (unless already changed)
            if ($email->getClient() === $this) {
                $email->setClient(null);
            }
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * @param mixed $fullName
     */
    public function setFullName($fullName): void
    {
        $this->fullName = $fullName;
    }

    /**
     * @return mixed
     */
    public function getAdditional()
    {
        return $this->additional;
    }

    /**
     * @param mixed $additional
     */
    public function setAdditional($additional): void
    {
        $this->additional = $additional;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getLiensPersonnesMorales(): Collection
    {
        return $this->liensPersonnesMorales;
    }

    public function addLiensClient(self $liensClient): self
    {
        if (!$this->liensPersonnesMorales->contains($liensClient)) {
            $this->liensPersonnesMorales[] = $liensClient;
        }

        return $this;
    }

    public function removeLiensClient(self $liensClient): self
    {
        if ($this->liensPersonnesMorales->contains($liensClient)) {
            $this->liensPersonnesMorales->removeElement($liensClient);
        }

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getLiensClients(): Collection
    {
        return $this->liensClients;
    }

    public function addClient(self $client): self
    {
        if (!$this->liensClients->contains($client)) {
            $this->liensClients[] = $client;
            $client->addLiensClient($this);
        }

        return $this;
    }

    public function removeClient(self $client): self
    {
        if ($this->liensClients->contains($client)) {
            $this->liensClients->removeElement($client);
            $client->removeLiensClient($this);
        }

        return $this;
    }

    /**
     * @return Collection|RemisesClient[]
     */
    public function getRemisesClients(): Collection
    {
        return $this->remisesClients;
    }

    public function addRemisesClient(RemisesClient $remisesClient): self
    {
        if (!$this->remisesClients->contains($remisesClient)) {
            $this->remisesClients[] = $remisesClient;
            $remisesClient->setClient($this);
        }

        return $this;
    }

    public function removeRemisesClient(RemisesClient $remisesClient): self
    {
        if ($this->remisesClients->contains($remisesClient)) {
            $this->remisesClients->removeElement($remisesClient);
            // set the owning side to null (unless already changed)
            if ($remisesClient->getClient() === $this) {
                $remisesClient->setClient(null);
            }
        }

        return $this;
    }

    public function getDeleted(): ?bool
    {
        return $this->deleted;
    }

    public function setDeleted(bool $deleted): self
    {
        $this->deleted = $deleted;

        return $this;
    }

    public function getOrganization(): ?string
    {
        return $this->organization;
    }

    public function setOrganization(?string $organization): self
    {
        $this->organization = $organization;

        return $this;
    }

    public function getPrefix(): ?string
    {
        return $this->prefix;
    }

    public function setPrefix(?string $prefix): self
    {
        $this->prefix = $prefix;

        return $this;
    }

    public function getSuffix(): ?string
    {
        return $this->suffix;
    }

    public function setSuffix(?string $suffix): self
    {
        $this->suffix = $suffix;

        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(?string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }
}
