<?php declare(strict_types=1);

namespace App\Repository;

use App\Entity\Place;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

final class PlaceRepository
{
    /**
     * @var EntityRepository|ObjectRepository
     */
    private $entityRepository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityRepository = $entityManager->getRepository(Place::class);
    }

    public function getMainPlace(): Place
    {
        $places = $this->entityRepository->findAll();

        return array_pop($places);
    }
}
