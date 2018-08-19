<?php declare(strict_types=1);

namespace OpenTraining\Provision;

use OpenTraining\Provision\Data\PartnerData;
use OpenTraining\Provision\Data\ProvisionData;

final class ProvisionResolver
{
    /**
     * @todo reword to database approach
     *
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
            $partnerProfit = $this->resolvePartnerProfit($profit, $partnerData);
            $partnerData->changeProfit($partnerProfit);
        }
    }

    private function resolvePartnerProfit(int $profit, PartnerData $partnerData): int
    {
        $result = $profit * $partnerData->getProvisionRate();

        // to cover his or her taxes payment from original income
        if ($partnerData->isOfficialInvoicer() === false) {
            $result *= (1 - self::TAX_BALANCER_LECTOR);
        }

        // cover his or her expenses
        return (int) $result + $partnerData->getExpenses();
    }
}
