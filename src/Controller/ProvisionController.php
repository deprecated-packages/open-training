<?php declare(strict_types=1);

namespace App\Controller;

use App\Form\ProvisionFormType;
use OpenLecture\Provision\Data\PartnerData;
use OpenLecture\Provision\Data\ProvisionData;
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
     * @Route(path="/provision/")
     * See https://symfony.com/doc/current/quick_tour/the_controller.html#using-formats
     */
    public function __invoke(): Response
    {
        return $this->render('provision/default.twig');
    }

    /**
     * @Route(path="/provision-result", methods={"POST"}, name="process_provision_form")
     */
    public function processProvision(Request $request): Response
    {
        $provisionData = new ProvisionData();

        $form = $this->createProvisionForm($provisionData);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            dump($provisionData);
            die;

            $resolvedProfitData = $this->provisionResolver->resolve($provisionData);

            return $this->render('provision/result.twig', [
                'resolvedProfitData' => $resolvedProfitData,
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
     * @param mixed|null $data
     */
    private function createProvisionForm($data = null): FormInterface
    {
        // default values
        if (! $data) {
            $data = new ProvisionData();

            $partners = [];

            $partnerData = new PartnerData();
            $partnerData->setName('lector');
            $partnerData->setProvisionRatio(0.5);
            $partners['Lector'] = $partnerData;

            $partnerData = new PartnerData();
            $partnerData->setName('organizer');
            $partnerData->setProvisionRatio(0.25);
            $partners['Organizer'] = $partnerData;

            $partnerData = new PartnerData();
            $partnerData->setName('owner');
            $partnerData->setProvisionRatio(0.25);
            $partners['Owner'] = $partnerData;

            $data->setPartners($partners);
        }

        return $this->createForm(ProvisionFormType::class, $data);
    }
}
