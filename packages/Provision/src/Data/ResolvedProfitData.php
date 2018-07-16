<?php declare(strict_types=1);

namespace OpenLecture\Provision\Data;

final class ResolvedProfitData
{
    /**
     * @var float
     */
    private $lectorProfit;

    /**
     * @var float
     */
    private $organizerProfit;

    /**
     * @var float
     */
    private $ownerProfit;

    public function __construct(float $lectorProfit, float $organizerProfit, float $ownerProfit)
    {
        $this->lectorProfit = $lectorProfit;
        $this->organizerProfit = $organizerProfit;
        $this->ownerProfit = $ownerProfit;
    }

    public function getLectorProfit(): float
    {
        return $this->lectorProfit;
    }

    public function getOrganizerProfit(): float
    {
        return $this->organizerProfit;
    }

    public function getOwnerProfit(): float
    {
        return $this->ownerProfit;
    }
}
