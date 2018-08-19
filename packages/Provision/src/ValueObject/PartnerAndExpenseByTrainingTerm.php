<?php declare(strict_types=1);

namespace OpenTraining\Provision\ValueObject;

use App\Entity\TrainingTerm;
use OpenTraining\Provision\Entity\Partner;

final class PartnerAndExpenseByTrainingTerm
{
    /**
     * @var Partner
     */
    private $partner;

    /**
     * @var float
     */
    private $expense;

    /**
     * @var TrainingTerm
     */
    private $trainingTerm;

    public function __construct(Partner $partner, float $expense, TrainingTerm $trainingTerm)
    {
        $this->partner = $partner;
        $this->expense = $expense;
        $this->trainingTerm = $trainingTerm;
    }

    public function getPartner(): Partner
    {
        return $this->partner;
    }

    public function getExpense(): float
    {
        return $this->expense;
    }

    public function getTrainingTerm(): TrainingTerm
    {
        return $this->trainingTerm;
    }
}
