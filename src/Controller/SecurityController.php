<?php
// src/Controller/SecurityController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Request;
use App\Form\UserType;
use App\Form\ForgotPasswordType;
use App\Form\ResetPasswordType;
use App\Entity\User;
use App\Handler\SecurityRegisterHandler;
use App\Handler\SecurityConfirmHandler;
use App\Handler\SecurityForgotPasswordHandler;
use App\Handler\SecurityResetPasswordHandler;


class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="security_login")
     */
	public function login(AuthenticationUtils $authenticationUtils)
	{
	    // get the login error if there is one
	    $error = $authenticationUtils->getLastAuthenticationError();

	    // last username entered by the user
	    $lastUsername = $authenticationUtils->getLastUsername();

	    return $this->render('security/login.html.twig', array(
	        'last_username' => $lastUsername,
	        'error'         => $error,
	    ));
	}

    /**
     * @Route("/register", name="security_register")
     */
    public function register(Request $request, SecurityRegisterHandler $handler)
    {
        $form = $this->createForm(UserType::class)->handleRequest($request);
        if ($handler->handle($form)) {
            return $this->redirectToRoute('trick_index');
        }
        return $this->render(
            'security/register.html.twig', [
                'form' => $form->createView(),
            ]
        );
    }	

    /**
     * @Route("/confirm/{confirmationToken}", methods={"GET"}, name="security_confirm")
     */
    public function confirm(User $user, SecurityConfirmHandler $handler)
    {
        $handler->handle($user);
        return $this->redirectToRoute('security_login');
    } 

    /**
     * @Route("/forgot-password", name="security_forgot-password")
     */
    public function forgotPassword(Request $request, SecurityForgotPasswordHandler $handler)
    {
        $form = $this->createForm(ForgotPasswordType::class)->handleRequest($request);
        if ($handler->handle($form)) {
            return $this->redirectToRoute('trick_index');
        }
        return $this->render(
            'security/forgot-password.html.twig', [
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/reset-password/{resetToken}", methods={"GET", "POST"}, name="security_reset-password")
     */
    public function resetPassword(User $user, Request $request, SecurityResetPasswordHandler $handler)
    {
        $form = $this->createForm(ResetPasswordType::class, $user)->handleRequest($request);
        if ($handler->handle($form, $user)) {
            return $this->redirectToRoute('trick_index');
        }        
        return $this->render(
            'security/reset-password.html.twig', [
                'form' => $form->createView(),
            ]
        );
    } 
}