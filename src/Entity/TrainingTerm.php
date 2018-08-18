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
     * @ORM\Column(type="datetime")
     * @var DateTimeInterface
     */
    private $deadlineDateTime;

    /**
     * @ORM\Column(type="datetime")
     * @var DateTimeInterface
     */
    private $startDateTime;

    /**
     * @ORM\Column(type="datetime")
     * @var DateTimeInterface
     */
    private $endDateTime;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Training")
     * @var Training
     */
    private $training;

    public function __toString(): string
    {
        return $this->startDateTime->format('Y-m-d H:i');
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTraining(): ?Training
    {
        return $this->training;
    }

    public function setTraining(Training $training): void
    {
        $this->training = $training;
    }

    public function isActive(): bool
    {
        return $this->startDateTime > new DateTime('now');
    }

    public function getStartDateTime(): ?DateTimeInterface
    {
        return $this->startDateTime;
    }

    public function setStartDateTime(DateTimeInterface $startDateTime): void
    {
        $this->startDateTime = $startDateTime;
    }

    public function getEndDateTime(): ?DateTimeInterface
    {
        return $this->endDateTime;
    }

    public function setEndDateTime(DateTimeInterface $endDateTime): void
    {
        $this->endDateTime = $endDateTime;
    }

    public function getDeadlineDateTime(): ?DateTimeInterface
    {
        return $this->deadlineDateTime;
    }

    public function setDeadlineDateTime(DateTimeInterface $registrationDeadlineDateTime): void
    {
        $this->deadlineDateTime = $registrationDeadlineDateTime;
    }

    public function getStartDateTimeInFormat(string $format): string
    {
        return $this->startDateTime->format($format);
    }

    public function getEndDateTimeInFormat(string $format): string
    {
        return $this->endDateTime->format($format);
    }
}
