<?php

namespace App\Controller;

use App\Entity\DatosRegistrarte;
use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Security\LoginFormAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;

class RegistrationController extends AbstractController
{
    #[Route('/register/{id}', name: 'app_register', methods: ['GET', 'POST'])]
    public function register(DatosRegistrarte $datosRegistrarte, Request $request, UserPasswordHasherInterface $userPasswordHasher, UserAuthenticatorInterface $userAuthenticator, LoginFormAuthenticator $authenticator, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $user->setName($datosRegistrarte->getNombre());
        $user->setSurnames($datosRegistrarte->getApellidos());
        $user->setPhome('null');
        $user->setRoles(['ROLE_USER']);
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        $id = $datosRegistrarte->getId();
        $name = $datosRegistrarte->getNombre();
        $surnames = $datosRegistrarte->getApellidos();

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $userAuthenticator->authenticateUser(
                $user,
                $authenticator,
                $request
            );
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
            'id' => $id,
            'name' => $name,
            'surnames' => $surnames,
        ]);
    }
}
