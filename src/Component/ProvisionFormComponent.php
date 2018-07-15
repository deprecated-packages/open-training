<?php declare(strict_types=1);

namespace App\Component;

use App\Form\CommentType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

/**
 * Render as:
 * {{ render(controller('App\\Component\\ProvisionFormComponent')) }}
 */
final class ProvisionFormComponent
{
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var Environment
     */
    private $twigEnvironment;

    public function __construct(FormFactoryInterface $formFactory, Environment $twigEnvironment)
    {
        $this->formFactory = $formFactory;
        $this->twigEnvironment = $twigEnvironment;
    }

    public function __invoke()
    {
        $form = $this->formFactory->create(CommentType::class);

        $template = $this->twigEnvironment->render('component/provisionForm.twig', [
            'form' => $form->createView(),
        ]);

        return new Response($template);
    }
}
