<?php declare(strict_types=1);

namespace App\Controller;

use App\Entity\Comment;
use App\Form\CommentType;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

/**
 * @see https://symfony.com/doc/current/controller/service.html#alternatives-to-base-controller-methods
 */
final class ProvisionController
{
    /**
     * @var EngineInterface
     */
    private $engine;

    public function __construct(Environment $twigEnvironment)
    {
        $this->engine = $twigEnvironment;
    }

    /**
     * @Route(path="/provision")
     * See https://symfony.com/doc/current/quick_tour/the_controller.html#using-formats
     */
    public function __invoke(Request $request)
    {
        $template = (string) $this->engine->render('provision/default.twig');

        return new Response($template);
    }

    /**
     * @Route(path="/process-provision-form", methods={"POST"}, name="process_provision_form")
     */
    public function processProvision(Request $request): Response
    {
        dump($request);
        die;

        $comment = new Comment();
        $comment->setAuthor($this->getUser());
        $post->addComment($comment);

        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();

            // When triggering an event, you can optionally pass some information.
            // For simple applications, use the GenericEvent object provided by Symfony
            // to pass some PHP variables. For more complex applications, define your
            // own event object classes.
            // See https://symfony.com/doc/current/components/event_dispatcher/generic_event.html
            $event = new GenericEvent($comment);

            return $this->redirectToRoute('blog_post', ['slug' => $post->getSlug()]);
        }

        return $this->render('blog/comment_form_error.html.twig', [
            'post' => $post,
            'form' => $form->createView(),
        ]);
    }
}
