<?php declare(strict_types=1);

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

final class SecurityController extends AbstractController
{
    /**
     * @var AuthenticationUtils
     */
    private $authenticationUtils;

    public function __construct(AuthenticationUtils $authenticationUtils)
    {
        $this->authenticationUtils = $authenticationUtils;
    }

    /**
     * @Route("/login/", name="security_login")
     */
    public function loginAction(): Response
    {
        $error = $this->authenticationUtils->getLastAuthenticationError();
        // last username entered by the user

        return $this->render('security/login.html.twig', [
            // last username entered by the user
            'last_username' => $this->authenticationUtils->getLastUsername(),
            'error' => $error,
        ]);
    }
}
