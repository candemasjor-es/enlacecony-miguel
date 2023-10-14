<?php

namespace App\Controller;

use App\DataTransformer\RolesToArrayTransformer;
use App\Entity\User;
use App\Entity\Personas;
use App\Form\AttendType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Id;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

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

    #[Route('/edit/{id}', name: 'app_profile_edit', methods: ['GET', 'POST'])]
    public function editAttend(User $user, Request $request, EntityManagerInterface $entityManager): Response
{
    $user = $this->getUser();
    $numeroPersonas = $request->request->get('numero_personas');
    $personas = [];

    for ($i = 1; $i <= $numeroPersonas; $i++) {
        $persona = new Personas();
        $persona->setUser($user);
        $personas[] = $persona;
        }
    $form = $this->createFormBuilder(['personas' => $personas])
    ->add('User', EntityType::class, [
        'class' => User::class,
        'choice_label' => 'id',
        'required' => true,
        'attr' => [
            'style' => 'display:none;'
        ],
        'label' => false,
    ])
        ->add('personas', CollectionType::class, [
            'entry_type' => AttendType::class,
            'allow_add' => true,
            'allow_delete' => true,
            'by_reference' => false,
            'label' => false,
            'entry_options' => [
                'label' => false,  // Esto quita las etiquetas de los campos dentro de la colección
                'data' => null,  // Esto quita los valores predeterminados de los campos dentro de la colección
            ],
        ])
        ->getForm();
        $form->get('User')->setData($user);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        foreach ($form->get('personas')->getData() as $persona) {
            $persona->setUser($user);
            $entityManager->persist($persona);
        }
        $entityManager->flush();
        $user = $this->getUser();
        $userId = $user->getId(); // Obtener el ID del usuario
        return $this->redirectToRoute('app_ninopersonas', ['id' => $userId], Response::HTTP_SEE_OTHER);
    }

    return $this->render('profile/edit.html.twig', [
        'form' => $form->createView(),
        'user' => $user,
    ]);
}
#[Route('/edit/persona/{id}', name: 'app_profile_persona', methods: ['GET', 'POST'])]
    public function persona(User $user, Request $requestr)
    
    {
        $this->generateUrl('app_profile_persona', ['id' => $user->getId()]);
        return $this->render('profile/personas.html.twig', [
            'user' => $user,
        ]);
    }
}