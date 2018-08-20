<?php declare(strict_types=1);

namespace OpenTraining\Provision\Data;

final class PartnerData
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $expenses = 0;

    /**
     * @var float
     */
    private $provisionRate;

    /**
     * @var int|null
     */
    private $profit;

    /**
     * Is the one who is responsible for main invoicing.
     *
     * He or she has main tax handicap, as he or she pays taxes for whole amount,
     * compared to others, who only pays partially.
     *
     * @var bool
     */
    private $isOfficialInvoicer;

    public function __construct(string $name, float $provisionRate, int $expenses, bool $isOfficialInvoicer = false)
    {
        $this->expenses = $expenses;
        $this->name = $name;
        $this->provisionRate = $provisionRate;
        $this->isOfficialInvoicer = $isOfficialInvoicer;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getProvisionRate(): float
    {
        return $this->provisionRate;
    }

    public function getExpenses(): int
    {
        return $this->expenses;
    }

    public function changeProfit(int $profit): void
    {
        $this->profit = $profit;
    }

    public function getProfit(): ?int
    {
        return $this->profit;
    }

    public function isOfficialInvoicer(): bool
    {
        return $this->isOfficialInvoicer;
    }
}
