<?php declare(strict_types=1);

namespace OpenLecture\Provision\Data;

use Doctrine\Common\Collections\ArrayCollection;

final class ProvisionData
{
    /**
     * @var int
     */
    private $incomeAmount = 0;

    /**
     * @var PartnerData[]
     */
    private $partners = [];

    public function __construct()
    {
        $this->partners = new ArrayCollection();
    }

    public function setIncomeAmount(int $incomeAmount): void
    {
        $this->incomeAmount = $incomeAmount;
    }

    public function getIncomeAmount(): int
    {
        return $this->incomeAmount;
    }

    public function addPartner(PartnerData $partnerData): void
    {
        $this->partners[] = $partnerData;
    }

    /**
     * @return ArrayCollection|PartnerData[]
     */
    public function getPartners()
    {
        return $this->partners;
    }

    /**
     * @param PartnerData[] $partners
     */
    public function setPartners(array $partners): void
    {
        $this->partners = $partners;
    }
}
