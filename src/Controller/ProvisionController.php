<?php declare(strict_types=1);

namespace App\Controller;

use App\Entity\TrainingTerm;
use App\Repository\TrainingTermRepository;
use OpenTraining\Provision\ProvisionResolver;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\Form\FormFactoryInterface;
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
        FormFactoryInterface $formFactory,
        TrainingTermRepository $trainingTermRepository
    ) {
        $this->provisionResolver = $provisionResolver;
        $this->templatingEngine = $templatingEngine;
        $this->formFactory = $formFactory;
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
        return $this->templatingEngine->renderResponse('provision/detail.twig', [
            'trainingTerm' => $trainingTerm,
            // $this->provisionResolver->resolveForTraining(/*$provisionData*/);
        ]);
    }

//         @todo move to database
//        $partnerDatas[] = new PartnerData('Lector', 0.5, $provisionFormRequest->getOwnerExpenses());
//        $partnerDatas[] = new PartnerData('Organizer', 0.25, $provisionFormRequest->getOwnerExpenses());
//        $partnerDatas[] = new PartnerData('Owner', 0.25, $provisionFormRequest->getOwnerExpenses());
//        return new ProvisionData($provisionFormRequest->getIncomeAmount(), $partnerDatas);
}
