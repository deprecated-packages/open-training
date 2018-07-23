<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TrainerRepository")
 */
class Trainer
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
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $phone;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Training", mappedBy="trainings")
     */
    private $trainins;

    public function __construct()
    {
        $this->trainins = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * @return Collection|Training[]
     */
    public function getTrainins(): Collection
    {
        return $this->trainins;
    }

    public function addTrainin(Training $trainin): self
    {
        if (!$this->trainins->contains($trainin)) {
            $this->trainins[] = $trainin;
            $trainin->setTrainings($this);
        }

        return $this;
    }

    public function removeTrainin(Training $trainin): self
    {
        if ($this->trainins->contains($trainin)) {
            $this->trainins->removeElement($trainin);
            // set the owning side to null (unless already changed)
            if ($trainin->getTrainings() === $this) {
                $trainin->setTrainings(null);
            }
        }

        return $this;
    }
}
