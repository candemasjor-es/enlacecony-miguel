<?php

namespace App\Controller;

use App\DataTransformer\RolesToArrayTransformer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;

#[Route('/pequeno')]
class ProfileNinoController extends AbstractController
{
    private $rolesTransformer;
    private EntityManagerInterface $entityManager;

    public function __construct(RolesToArrayTransformer $rolesTransformer, EntityManagerInterface $entityManager)
    {
        $this->rolesTransformer = $rolesTransformer;
        $this->entityManager = $entityManager;
    }
    
    #[Route('/{id}', name: 'app_profilenino', methods: ['GET'])]
    public function index(User $user): Response
    {
        $user = $this->getUser();
        return $this->render('profile_nino/index.html.twig', [
            'controller_name' => 'ProfileNinoController',
            'user' => $user,
        ]);
    }
    #[Route('/no/{id}', name: 'app_profilenino_no', methods: ['GET', 'POST'])]
public function indexNo(User $user): Response
{ 
    $newRoles = ['ROLE_YES'];
    $user->setRoles($newRoles);
    $this->entityManager->persist($user);
    $this->entityManager->flush();

    
    return $this->render('profile_nino/_no.html.twig', [
        'id' => $user->getId(),
    ]);
}
}