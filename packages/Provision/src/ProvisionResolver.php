<?php declare(strict_types=1);

namespace OpenLecture\Provision;

use App\Entity\ProvisionData;

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

    // @todo move input and output data objects here to "src/Data"

    public function resolve(ProvisionData $provisionData)
    {
        dump($provisionData->getIncomeAmount());

        $profit = $provisionData->getIncomeAmount() - $provisionData->getLectorPaidAmount() - $provisionData->getOrganizerPaidAmount() - $provisionData->getOwnerPaidAmount();

        // @todo split 2 methods per lector/organizer

        // compute provision to lector
        // compute provision to organizer

        $profitLector = $profit * self::PROVISION_LECTOR;
        $profitOrganizer = $profit * self::PROVISION_ORGANIZER;

        // taxes paid twice instead of lectors/organizers from the original income
        $profitLector *= (1 - self::TAX_BALANCER_LECTOR);
        $profitOrganizer *= (1 - self::TAX_BALANCER_LECTOR);

        $profitLector = $profitLector + $provisionData->getLectorPaidAmount();
        $profitOrganizer = $profitOrganizer + $provisionData->getOrganizerPaidAmount();

        dump($profitLector);
        dump($profitOrganizer);
        die;

        dump($provisionData);
        die;
    }

}