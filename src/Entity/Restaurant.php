<?php

namespace App\Entity;

use App\Repository\RestaurantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RestaurantRepository::class)
 */
class Restaurant
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string")
     */
    private $tel;

    /**
     * @ORM\OneToMany(targetEntity=Produit::class, mappedBy="restaurant", orphanRemoval=true)
     */
    private $produitsListe;


    /**
     * @ORM\ManyToMany(targetEntity=User::class, mappedBy="restaurant")
     */
    private $users;

    /**
     * @ORM\ManyToMany(targetEntity=Commande::class, inversedBy="restaurants")
     */
    private $commandes;

    public function __toString() {
        return $this->nom;
    }

    public function __construct()
    {
        $this->produitsListe = new ArrayCollection();
        $this->commandeList = new ArrayCollection();
        $this->users = new ArrayCollection();
        $this->commandes = new ArrayCollection();
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

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(string $tel): self
    {
        $this->tel = $tel;

        return $this;
    }

    /**
     * @return Collection|Produit[]
     */
    public function getProduitsListe(): Collection
    {
        return $this->produitsListe;
    }

    public function addProduitsListe(Produit $produitsListe): self
    {
        if (!$this->produitsListe->contains($produitsListe)) {
            $this->produitsListe[] = $produitsListe;
            $produitsListe->setRestaurant($this);
        }

        return $this;
    }

    public function removeProduitsListe(Produit $produitsListe): self
    {
        if ($this->produitsListe->removeElement($produitsListe)) {
            // set the owning side to null (unless already changed)
            if ($produitsListe->getRestaurant() === $this) {
                $produitsListe->setRestaurant(null);
            }
        }

        return $this;
    }


    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->addRestaurant($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            $user->removeRestaurant($this);
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
        }

        return $this;
    }

    public function removeCommande(Commande $commande): self
    {
        $this->commandes->removeElement($commande);

        return $this;
    }

  
}
