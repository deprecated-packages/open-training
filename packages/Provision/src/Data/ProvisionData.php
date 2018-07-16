<?php declare(strict_types=1);

namespace OpenLecture\Provision\Data;

final class ProvisionData
{
    /**
     * @var float
     */
    private $incomeAmount = 0.0;

    /**
     * @var float
     */
    private $lectorExpenses = 0.0;

    /**
     * @var float
     */
    private $organizerExpenses = 0.0;

    /**
     * @var float
     */
    private $ownerExpenses = 0.0;

    public function getOwnerExpenses(): float
    {
        return $this->ownerExpenses;
    }

    public function setIncomeAmount(float $incomeAmount): void
    {
        $this->incomeAmount = $incomeAmount;
    }

    public function getIncomeAmount(): float
    {
        return $this->incomeAmount;
    }

    public function getLectorExpenses(): float
    {
        return $this->lectorExpenses;
    }

    public function setLectorExpenses(?float $lectorExpenses): void
    {
        $this->lectorExpenses = (float) $lectorExpenses;
    }

    public function getOrganizerExpenses(): float
    {
        return $this->organizerExpenses;
    }

    public function setOrganizerExpenses(?float $organizerExpenses): void
    {
        $this->organizerExpenses = (float) $organizerExpenses;
    }

    public function setOwnerExpenses(?float $ownerExpenses): void
    {
        $this->ownerExpenses = (float) $ownerExpenses;
    }
}
