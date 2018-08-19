<?php declare(strict_types=1);

namespace OpenTraining\Provision\Repository;

use App\Entity\TrainingTerm;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use OpenTraining\Provision\Entity\Partner;

final class PartnerRepository
{
    /**
     * @var ObjectRepository|EntityRepository
     */
    private $objectRepository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->objectRepository = $entityManager->getRepository(Partner::class);
    }

    /**
     * @return Partner[]
     */
    public function fetchAll(): array
    {
        return $this->objectRepository->findAll();
    }

    /**
     * @todo value object
     *
     * @return mixed[]
     */
    public function fetchAllWithExpenseForTrainingTerm(TrainingTerm $trainingTerm): array
    {
        $result = $this->objectRepository->createQueryBuilder('p')
            ->leftJoin('p.expenses', 'pe')
            ->select('p.name, SUM(pe.amount) AS expense')
            ->groupBy('p.id')
            ->getQuery()
            ->getResult();

        // @todo value object
        dump($result);
        die;
    }
}
