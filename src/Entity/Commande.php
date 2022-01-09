<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommandeRepository::class)
 */
class Commande
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $numero;


    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="commandes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $userCommande;

    /**
     * @ORM\ManyToMany(targetEntity=Restaurant::class, mappedBy="commandes")
     */
    private $restaurants;

    /**
     * @ORM\Column(type="integer")
     */
    private $PrixTotal;

 

    /**
     * @ORM\OneToMany(targetEntity=CommandeProducts::class, mappedBy="commande")
     */
    private $produitsCommandes;

    public function __construct()
    {
        $this->restaurants = new ArrayCollection();
        $this->produitsCommandes = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumero(): ?int
    {
        return $this->numero;
    }

    public function setNumero(int $numero): self
    {
        $this->numero = $numero;

        return $this;
    }


    public function getUserCommande(): ?User
    {
        return $this->userCommande;
    }

    public function setUserCommande(?User $userCommande): self
    {
        $this->userCommande = $userCommande;

        return $this;
    }

  

    /**
     * @return Collection|Restaurant[]
     */
    public function getRestaurants(): Collection
    {
        return $this->restaurants;
    }

    public function addRestaurant(Restaurant $restaurant): self
    {
        if (!$this->restaurants->contains($restaurant)) {
            $this->restaurants[] = $restaurant;
            $restaurant->addCommande($this);
        }

        return $this;
    }

    public function removeRestaurant(Restaurant $restaurant): self
    {
        if ($this->restaurants->removeElement($restaurant)) {
            $restaurant->removeCommande($this);
        }

        return $this;
    }

    public function getPrixTotal(): ?int
    {
        return $this->PrixTotal;
    }

    public function setPrixTotal(int $PrixTotal): self
    {
        $this->PrixTotal = $PrixTotal;

        return $this;
    }


    /**
     * @return Collection|CommandeProducts[]
     */
    public function getProduitsCommandes(): Collection
    {
        return $this->produitsCommandes;
    }

    public function addProduitsCommande(CommandeProducts $produitsCommande): self
    {
        if (!$this->produitsCommandes->contains($produitsCommande)) {
            $this->produitsCommandes[] = $produitsCommande;
            $produitsCommande->setCommande($this);
        }

        return $this;
    }

    public function removeProduitsCommande(CommandeProducts $produitsCommande): self
    {
        if ($this->produitsCommandes->removeElement($produitsCommande)) {
            // set the owning side to null (unless already changed)
            if ($produitsCommande->getCommande() === $this) {
                $produitsCommande->setCommande(null);
            }
        }

        return $this;
    }
}
