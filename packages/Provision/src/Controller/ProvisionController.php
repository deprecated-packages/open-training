<?php declare(strict_types=1);

namespace OpenTraining\Provision\Controller;

use App\Entity\TrainingTerm;
use App\Repository\TrainingTermRepository;
use OpenTraining\Provision\ProvisionResolver;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @todo admin only
 * @see https://symfony.com/doc/current/controller/service.html#alternatives-to-base-controller-methods
 */
final class ProvisionController
{
    /**
     * @var ProvisionResolver
     */
    private $provisionResolver;

    /**
     * @var EngineInterface
     */
    private $templatingEngine;

    /**
     * @var TrainingTermRepository
     */
    private $trainingTermRepository;

    public function __construct(
        ProvisionResolver $provisionResolver,
        EngineInterface $templatingEngine,
        TrainingTermRepository $trainingTermRepository
    ) {
        $this->provisionResolver = $provisionResolver;
        $this->templatingEngine = $templatingEngine;
        $this->trainingTermRepository = $trainingTermRepository;
    }

    /**
     * @Route(path="/provision/", name="provision")
     */
    public function default(): Response
    {
        return $this->templatingEngine->renderResponse('provision/default.twig', [
            'termsToPayProvision' => $this->trainingTermRepository->fetchFinishedWithoutPaidProvision(),
        ]);
    }

    /**
     * @Route(path="/provision-detail/{trainingTerm}", name="provision-detail")
     */
    public function detail(TrainingTerm $trainingTerm): Response
    {
        dump($this->provisionResolver->resolveForTrainingTerm($trainingTerm));
        die;

        return $this->templatingEngine->renderResponse('provision/detail.twig', [
            'trainingTerm' => $trainingTerm,
        ]);
    }
}
