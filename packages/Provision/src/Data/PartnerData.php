<?php declare(strict_types=1);

namespace OpenLecture\Provision\Data;

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

    public function __construct(string $name, float $provisionRate, int $expenses)
    {
        $this->expenses = $expenses;
        $this->name = $name;
        $this->provisionRate = $provisionRate;
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
}
