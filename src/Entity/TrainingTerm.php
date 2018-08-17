<?php declare(strict_types=1);

namespace App\Entity;

use DateTime;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class TrainingTerm
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(type="datetime", length=255)
     * @var DateTimeInterface
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Training")
     * @var Training
     */
    private $training;

    public function __toString(): string
    {
        return $this->date->format('Y-m-d H:i');
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?DateTimeInterface
    {
        return $this->date;
    }

    public function getTraining(): ?Training
    {
        return $this->training;
    }

    public function setDate(DateTimeInterface $date): void
    {
        $this->date = $date;
    }

    public function setTraining(Training $training): void
    {
        $this->training = $training;
    }

    public function isActive(): bool
    {
        return $this->date > new DateTime('now');
    }
}
