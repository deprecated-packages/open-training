<?php declare(strict_types=1);

namespace OpenLecture\Provision;

use OpenLecture\Provision\Data\ProvisionData;
use OpenLecture\Provision\Data\ResolvedProfitData;

final class ProvisionResolver
{
    /**
     * @var float
     */
    private const PROVISION_LECTOR = 0.5;

    /**
     * @var float
     */
    private const PROVISION_ORGANIZER = 0.25;

    /**
     * To cover dual tax payments by main invoicing entity
     * 10 000  profit ~= 2000 taxes
     *
     * @var float
     */
    private const TAX_BALANCER_LECTOR = 0.11;

    public function resolve(ProvisionData $provisionData): ResolvedProfitData
    {
        $profit = $provisionData->getIncomeAmount() - $provisionData->getLectorExpenses() - $provisionData->getOrganizerExpenses() - $provisionData->getOwnerExpenses();

        // @todo ... or per user provisin note?

        $profitLector = $this->resolveLectorProfit(
            $profit,
            $provisionData->getLectorExpenses(),
            self::PROVISION_LECTOR
        );

        $profitOrganizer = $this->resolveOrganizerProfit(
            $profit,
            $provisionData->getOrganizerExpenses(),
            self::PROVISION_ORGANIZER
        );

        $profitOwner = $profit - $profitLector - $profitOrganizer;

        return new ResolvedProfitData($profitLector, $profitOrganizer, $profitOwner);
    }

    private function resolveOrganizerProfit(float $profit, float $expenses, float $provisionRate): float
    {
        $result = $profit * $provisionRate;

        // to cover his or her taxes payment from original income
        $result *= (1 - self::TAX_BALANCER_LECTOR);

        // cover his or her expenses
        return $result + $expenses;
    }

    private function resolveLectorProfit(float $profit, float $lectorExpenses, float $provisionRate): float
    {
        $result = $profit * $provisionRate;

        // to cover his or her taxes payment from original income
        $result *= (1 - self::TAX_BALANCER_LECTOR);

        // cover his or her expenses
        return $result + $lectorExpenses;
    }
}
