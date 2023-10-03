<?php

namespace App\Controller;

use App\DataTransformer\RolesToArrayTransformer;
use App\Entity\User;
use App\Form\AttendType;
use App\Form\RolesType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;

#[Route('/profile')]
class ProfileController extends AbstractController
{
    private $rolesTransformer;
    private EntityManagerInterface $entityManager;

    public function __construct(RolesToArrayTransformer $rolesTransformer,EntityManagerInterface $entityManager)
    {
        $this->rolesTransformer = $rolesTransformer;
        $this->entityManager = $entityManager;
    }
    

    #[Route('/', name: 'app_profile')]
    public function index(): Response
    {
        $user = $this->getUser();

        return $this->render('profile/index.html.twig', [
            'user' => $user,
        ]);
    }
    #[Route('/{id}', name: 'app_profile_no_attend', methods: ['GET', 'POST'])]
    public function editProfile(User $user)
    {
        $newRoles = ['ROLE_NO'];
        $user->setRoles($newRoles);

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $this->redirectToRoute('app_profile', ['id' => $user->getId()]);
    }

    #[Route('/{id}/edit', name: 'app_profile_edit', methods: ['GET', 'POST'])]
    public function editAttend(User $user, Request $request, EntityManagerInterface $entityManager): Response
    {
        $newRoles = ['ROLE_YES'];
        $user->setRoles($newRoles);
        $form = $this->createForm(AttendType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_profile', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('profile/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }
}