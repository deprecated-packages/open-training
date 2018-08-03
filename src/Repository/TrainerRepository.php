<?php declare(strict_types=1);

namespace App\Repository;

use App\Entity\Trainer;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

final class TrainerRepository
{
    /**
     * @var EntityRepository
     */
    private $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->repository = $entityManager->getRepository(Trainer::class);
    }
}
