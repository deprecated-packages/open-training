<?php declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Place
{
    /**
     * @var int
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @var int
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $name;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $mapUrl;

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function changeName(string $name): void
    {
        $this->name = $name;
    }

    public function getMapUrl(): string
    {
        return $this->mapUrl;
    }

    public function changeMapUrl(string $mapUrl): void
    {
        $this->mapUrl = $mapUrl;
    }
}
