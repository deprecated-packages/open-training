<?php declare(strict_types=1);

namespace OpenTraining\Provision\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
final class Partner
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
     * @ORM\Column(type="float")
     * @var float
     */
    private $provisionRate;

    /**
     * @ORM\Column(type="boolean")
     * @var bool
     *
     * Is the one who is responsible for main invoicing.
     *
     * He or she has main tax handicap, as he or she pays taxes for whole amount,
     * compared to others, who only pays partially.
     */
    private $isOfficialInvoicer;

    /**
     * @ORM\OneToMany(targetEntity="OpenTraining\Provision\Entity\PartnerExpense", mappedBy="partner")
     * @var PartnerExpense[]|ArrayCollection
     */
    private $expenses = [];

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getProvisionRate(): float
    {
        return $this->provisionRate;
    }

    public function setProvisionRate(float $provisionRate): void
    {
        $this->provisionRate = $provisionRate;
    }

    public function isOfficialInvoicer(): bool
    {
        return $this->isOfficialInvoicer;
    }

    public function setIsOfficialInvoicer(bool $isOfficialInvoicer): void
    {
        $this->isOfficialInvoicer = $isOfficialInvoicer;
    }

    /**
     * @return ArrayCollection|PartnerExpense[]
     */
    public function getExpenses(): ArrayCollection
    {
        return $this->expenses;
    }

    /**
     * @param PartnerExpense[] $expenses
     */
    public function setExpenses(array $expenses): void
    {
        $this->expenses = $expenses;
    }
}
