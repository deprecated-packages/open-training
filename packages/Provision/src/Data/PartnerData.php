<?php declare(strict_types=1);

namespace OpenLecture\Provision\Data;

final class PartnerData
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var float
     */
    private $provisionRatio;

    /**
     * @var int
     */
    private $expenses = 0;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getProvisionRatio(): float
    {
        return $this->provisionRatio;
    }

    public function setProvisionRatio(float $provisionRatio): void
    {
        $this->provisionRatio = $provisionRatio;
    }

    public function getExpenses(): int
    {
        return $this->expenses;
    }

    public function setExpenses(int $expenses): void
    {
        $this->expenses = $expenses;
    }
}
