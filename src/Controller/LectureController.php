<?php declare(strict_types=1);

namespace App\Controller;

use App\Form\ProvisionFormType;
use App\Request\ProvisionFormRequest;
use OpenLecture\Provision\Data\PartnerData;
use OpenLecture\Provision\Data\ProvisionData;
use OpenLecture\Provision\ProvisionResolver;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;

final class LectureController
{
    /**
     * @var EngineInterface
     */
    private $templatingEngine;

    /**
     * @var RouterInterface
     */
    private $router;

    public function __construct(
        EngineInterface $templatingEngine,
        RouterInterface $router
    ) {
        $this->templatingEngine = $templatingEngine;
        $this->router = $router;
    }

    /**
     * @Route(path="/lectures/", name="lectures")
     */
    public function default(): Response
    {
        return $this->templatingEngine->renderResponse('lecture/default.twig');
    }
}
