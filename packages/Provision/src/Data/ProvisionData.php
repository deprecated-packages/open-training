<?php declare(strict_types=1);

namespace OpenLecture\Provision\Data;

final class ProvisionData
{
    /**
     * @var int
     */
    private $incomeAmount = 0;

    /**
     * @var PartnerData[]
     */
    private $partnerDatas = [];

    /**
     * @param PartnerData[] $partnerDatas
     */
    public function __construct(int $incomeAmount, array $partnerDatas)
    {
        $this->partnerDatas = $partnerDatas;
        $this->incomeAmount = $incomeAmount;
    }

    public function getIncomeAmount(): int
    {
        return $this->incomeAmount;
    }

    /**
     * @return PartnerData[]
     */
    public function getPartnerDatas(): array
    {
        return $this->partnerDatas;
    }
}
