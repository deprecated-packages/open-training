<?php declare(strict_types=1);

namespace OpenLecture\Provision;

use OpenLecture\Provision\Data\ProvisionData;

final class ProvisionResolver
{
    /**
     * To cover dual tax payments by main invoicing entity
     * 10 000  profit ~= 2000 taxes
     *
     * @var float
     */
    private const TAX_BALANCER_LECTOR = 0.11;

    public function resolve(ProvisionData $provisionData): void
    {
        $profit = $provisionData->getIncomeAmount();
        foreach ($provisionData->getPartnerDatas() as $partnerData) {
            $profit -= $partnerData->getExpenses();
        }

        foreach ($provisionData->getPartnerDatas() as $partnerData) {
            $partnerProfit = $this->resolvePartnerProfit(
                $profit,
                $partnerData->getExpenses(),
                $partnerData->getProvisionRate()
            );
            $partnerData->changeProfit($partnerProfit);
        }
    }

    private function resolvePartnerProfit(int $profit, int $expenses, float $provisionRate): int
    {
        $result = $profit * $provisionRate;

        // to cover his or her taxes payment from original income
        $result *= (1 - self::TAX_BALANCER_LECTOR);

        // cover his or her expenses
        return (int) $result + $expenses;
    }
}
