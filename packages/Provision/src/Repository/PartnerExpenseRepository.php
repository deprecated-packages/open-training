<?php declare(strict_types=1);

namespace OpenTraining\Provision\Repository;

use App\Entity\TrainingTerm;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use OpenTraining\Provision\Entity\Partner;
use OpenTraining\Provision\Entity\PartnerExpense;

final class PartnerExpenseRepository
{
    /**
     * @var ObjectRepository|EntityRepository
     */
    private $objectRepository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->objectRepository = $entityManager->getRepository(PartnerExpense::class);
    }

    /**
     * @return Partner[]
     */
    public function getExpenseForTrainingTerm(TrainingTerm $trainingTerm): float
    {
        return (float) $this->objectRepository->createQueryBuilder('pe')
            ->select('SUM(pe.amount) as expense')
            ->where('pe.trainingTerm = :trainingTerm')
            ->setParameter(':trainingTerm', $trainingTerm)
            ->getQuery()
            ->getSingleScalarResult();
    }
}
