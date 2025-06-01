<?php 
namespace App\Security;

use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class CustomAuthenticationSuccessHandler implements AuthenticationSuccessHandlerInterface
{
    private $router;

    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token): RedirectResponse
    {
        $user = $token->getUser();

        // Redirection selon le rôle
        if (in_array('ROLE_ADMIN', $user->getRoles())) {
            return new RedirectResponse($this->router->generate('admin_home'));
        }

        if (in_array('ROLE_CANDIDAT', $user->getRoles())) {
            return new RedirectResponse($this->router->generate('candidat_home'));
        }

        if (in_array('ROLE_ENSEIGNANT', $user->getRoles())) {
            return new RedirectResponse($this->router->generate('enseignant_home'));
        }

        // Redirection par défaut
        return new RedirectResponse($this->router->generate('app_home'));
    }
}
