<?php declare(strict_types=1);

namespace OpenLecture\Provision\Data;

use OpenLecture\Provision\Exception\InvalidProvisionRateTotalException;

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
        $this->ensureProvisionRateTotalIsOne($partnerDatas);

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

    /**
     * @param PartnerData[] $partnerDatas
     */
    private function ensureProvisionRateTotalIsOne(array $partnerDatas): void
    {
        $provisionRateTotal = 0;
        foreach ($partnerDatas as $partnerData) {
            $provisionRateTotal += $partnerData->getProvisionRate();
        }

        if ($provisionRateTotal === 1.0) {
            return;
        }

        new InvalidProvisionRateTotalException(sprintf(
            'The provision total rate mut be 1, instead of %f.',
            $provisionRateTotal
        ));
    }
}
