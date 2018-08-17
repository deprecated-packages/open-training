<?php declare(strict_types=1);

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Trainer
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @var string
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @var string
     */
    private $phone;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Training", mappedBy="trainings")
     * @var Training[]
     */
    private $trainins = [];

    public function __construct()
    {
        $this->trainins = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @return Collection|Training[]
     */
    public function getTrainings(): Collection
    {
        return $this->trainins;
    }

    public function addTraining(Training $training): void
    {
        if (! $this->trainins->contains($training)) {
            $this->trainins[] = $training;
            $training->changeTrainer($this);
        }
    }

    public function removeTraining(Training $training): void
    {
        if ($this->trainins->contains($training)) {
            $this->trainins->removeElement($training);
            // set the owning side to null (unless already changed)
            if ($training->getTrainer() === $this) {
                $training->setTrainings(null);
            }
        }
    }
}
