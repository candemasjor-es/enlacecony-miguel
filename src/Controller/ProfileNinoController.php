<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;

#[Route('/pequeno')]
class ProfileNinoController extends AbstractController
{
    #[Route('/{id}', name: 'app_profilenino', methods: ['GET'])]
    public function index(User $user): Response
    {
        
        return $this->render('profile_nino/index.html.twig', [
            'controller_name' => 'ProfileNinoController',
            'user' => $user,
        ]);
    }
}
