<?php declare(strict_types=1);

namespace App\Controller;

use App\Entity\Training;
use App\Repository\TrainingRepository;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class TrainingController
{
    /**
     * @var EngineInterface
     */
    private $templatingEngine;

    /**
     * @var TrainingRepository
     */
    private $trainingRepository;

    public function __construct(EngineInterface $templatingEngine, TrainingRepository $trainingRepository)
    {
        $this->templatingEngine = $templatingEngine;
        $this->trainingRepository = $trainingRepository;
    }

    /**
     * @Route(path="/trainings/", name="trainings")
     */
    public function default(): Response
    {
        return $this->templatingEngine->renderResponse('training/default.twig', [
            'trainings' => $this->trainingRepository->fetchAll(),
        ]);
    }

    /**
     * @Route(path="/training-detail/{training}", name="training-detail")
     */
    public function detail(Training $training): Response
    {
        return $this->templatingEngine->renderResponse('training/detail.twig', [
            'training' => $training,
            'trainer' => $training->getTrainer(),
        ]);
    }
}
