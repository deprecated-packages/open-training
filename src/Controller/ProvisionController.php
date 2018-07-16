<?php declare(strict_types=1);

namespace App\Controller;

use App\Entity\ProvisionData;
use App\Form\ProvisionFormType;
use OpenLecture\Provision\ProvisionResolver;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @see https://symfony.com/doc/current/controller/service.html#alternatives-to-base-controller-methods
 */
final class ProvisionController extends AbstractController
{
    /**
     * @var ProvisionResolver
     */
    private $provisionResolver;

    public function __construct(ProvisionResolver $provisionResolver)
    {
        $this->provisionResolver = $provisionResolver;
    }

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
        $provisionData = new ProvisionData();

        $form = $this->createProvisionForm($provisionData);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $privisionResult = $this->provisionResolver->resolve($provisionData);

            dump($privisionResult);
            die;

            dump($provisionData);
            die;

            return $this->redirectToRoute('provision_result', [
                'amount' => $provisionData->getAmount(),
            ]);
        }

        return $this->render('provision/default.twig');
    }

    /**
     * Call in Twig template as:
     * {{ render(controller('App\\Controller\\ProvisionController::renderProvisionForm()')) }}
     */
    public function renderProvisionForm(): Response
    {
        return $this->render('component/provisionForm.twig', [
            'form' => $this->createProvisionForm()->createView(),
        ]);
    }

    /**
     * @param mixed $data
     */
    private function createProvisionForm($data = null): FormInterface
    {
        return $this->createForm(ProvisionFormType::class, $data);
    }
}
