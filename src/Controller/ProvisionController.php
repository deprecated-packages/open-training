<?php declare(strict_types=1);

namespace App\Controller;

use App\Form\ProvisionFormType;
use App\Request\ProvisionFormRequest;
use OpenTraining\Provision\Data\PartnerData;
use OpenTraining\Provision\Data\ProvisionData;
use OpenTraining\Provision\ProvisionResolver;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;

/**
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
     * @var RouterInterface
     */
    private $router;

    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    public function __construct(
        ProvisionResolver $provisionResolver,
        EngineInterface $templatingEngine,
        RouterInterface $router,
        FormFactoryInterface $formFactory
    ) {
        $this->provisionResolver = $provisionResolver;
        $this->templatingEngine = $templatingEngine;
        $this->router = $router;
        $this->formFactory = $formFactory;
    }

    /**
     * @Route(path="/provision/", name="provision")
     * See https://symfony.com/doc/current/quick_tour/the_controller.html#using-formats
     */
    public function default(): Response
    {
        return $this->templatingEngine->renderResponse('provision/default.twig');
    }

    /**
     * @Route(path="/provision-result", methods={"POST"}, name="process_provision_form")
     */
    public function processProvisionForm(Request $request): Response
    {
        $provisionFormRequest = new ProvisionFormRequest();

        $form = $this->createProvisionForm($provisionFormRequest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $provisionData = $this->createProvisionDataFromProvisionFormRequest($provisionFormRequest);

            $this->provisionResolver->resolve($provisionData);

            return $this->templatingEngine->renderResponse('provision/result.twig', [
                'provisionData' => $provisionData,
            ]);
        }

        return $this->templatingEngine->renderResponse('provision/default.twig');
    }

    /**
     * Call in Twig template as:
     * {{ render(controller('App\\Controller\\ProvisionController::componentProvisionForm()')) }}
     */
    public function componentProvisionForm(): Response
    {
        return $this->templatingEngine->renderResponse('component/provisionForm.twig', [
            'form' => $this->createProvisionForm()->createView(),
        ]);
    }

    /**
     * @param mixed|null $data
     */
    private function createProvisionForm($data = null): FormInterface
    {
        return $this->formFactory->create(ProvisionFormType::class, $data, [
            'action' => $this->router->generate('process_provision_form'),
        ]);
    }

    private function createProvisionDataFromProvisionFormRequest(
        ProvisionFormRequest $provisionFormRequest
    ): ProvisionData {
        $partnerDatas[] = new PartnerData('Lector', 0.5, $provisionFormRequest->getOwnerExpenses());
        $partnerDatas[] = new PartnerData('Organizer', 0.25, $provisionFormRequest->getOwnerExpenses());
        $partnerDatas[] = new PartnerData('Owner', 0.25, $provisionFormRequest->getOwnerExpenses());

        return new ProvisionData($provisionFormRequest->getIncomeAmount(), $partnerDatas);
    }
}
