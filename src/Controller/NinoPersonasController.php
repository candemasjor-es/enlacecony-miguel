<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NinoPersonasController extends AbstractController
{
    #[Route('/nino/{id}', name: 'app_ninopersonas', methods: ['GET', 'POST']) ]
    public function index(User $user): Response
    {
        $user = $this->getUser();

        return $this->render('nino_personas/index.html.twig', [
            'controller_name' => 'NinoPersonasController',
            'user' => $user,
        ]);
    }
}
