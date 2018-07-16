<?php declare(strict_types=1);

namespace App\Controller;

use App\Entity\Provision;
use App\Form\ProvisionFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @see https://symfony.com/doc/current/controller/service.html#alternatives-to-base-controller-methods
 */
final class ProvisionController extends AbstractController
{
    /**
     * @Route(path="/provision/", name="provision")
     * @Route(path="/provision/{amount}", name="provision_detail")
     * See https://symfony.com/doc/current/quick_tour/the_controller.html#using-formats
     */
    public function __invoke(Request $request, ?int $amount): Response
    {
        return $this->render('provision/default.twig', [
            'amount' => $amount,
        ]);
    }

    /**
     * @Route(path="/process-provision-form", methods={"POST"}, name="process_provision_form")
     */
    public function processProvision(Request $request): Response
    {
        $provision = new Provision();

        $form = $this->createForm(ProvisionFormType::class, $provision);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            return $this->redirectToRoute('provision_detail', [
                'amount' => $provision->getAmount(),
            ]);
        }

        return $this->render('provision/default.twig');
    }

    /**
     * Call in Twig template as:
     * {{ render(controller('App\\Component\\ProvisionFormComponent::renderProvisionForm()')) }}
     */
    public function renderProvisionForm(): Response
    {
        return $this->render('component/provisionForm.twig', [
            'form' => $this->createForm(ProvisionFormType::class)->createView(),
        ]);
    }
}
