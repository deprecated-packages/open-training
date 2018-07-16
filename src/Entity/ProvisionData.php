<?php declare(strict_types=1);

namespace App\Entity;

final class ProvisionData
{
    /**
     * @var int
     */
    private $incomeAmount = 0;

    /**
     * @var int
     */
    private $lectorPaidAmount = 0;

    /**
     * @var int
     */
    private $organizerPaidAmount = 0;

    public function getOwnerPaidAmount(): int
    {
        return $this->ownerPaidAmount;
    }

    public function setOwnerPaidAmount(int $ownerPaidAmount): void
    {
        $this->ownerPaidAmount = $ownerPaidAmount;
    }

    /**
     * @var int
     */
    private $ownerPaidAmount = 0;

    public function setIncomeAmount(int $incomeAmount): void
    {
        $this->incomeAmount = $incomeAmount;
    }

    public function getIncomeAmount(): int
    {
        return $this->incomeAmount;
    }

    public function getLectorPaidAmount(): int
    {
        return $this->lectorPaidAmount;
    }

    public function setLectorPaidAmount(int $lectorPaidAmount): void
    {
        $this->lectorPaidAmount = $lectorPaidAmount;
    }

    public function getOrganizerPaidAmount(): int
    {
        return $this->organizerPaidAmount;
    }

    public function setOrganizerPaidAmount(int $organizerPaidAmount): void
    {
        $this->organizerPaidAmount = $organizerPaidAmount;
    }
}
