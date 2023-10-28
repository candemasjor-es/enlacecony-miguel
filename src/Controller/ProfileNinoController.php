<?php

namespace App\Controller;

use App\DataTransformer\RolesToArrayTransformer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Entity\PersonasPequenos;
use App\Form\PersonasPequenosType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

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
#[Route('/new/{id}', name: 'app_profilenino_new', methods: ['GET', 'POST'])]
    public function editAttend(User $user, Request $request, EntityManagerInterface $entityManager): Response
{
    $user = $this->getUser();
    $numeroPersonas = $request->request->get('numero_personas');
    $personas = [];

    for ($i = 1; $i <= $numeroPersonas; $i++) {
        $persona = new PersonasPequenos();
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
            'entry_type' => PersonasPequenosType::class,
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
        $data = $form->getData();

    if ($form->isSubmitted() && $form->isValid()) {
        foreach ($form->get('personas')->getData() as $persona) {
            $persona->setUser($user);
            $entityManager->persist($persona); 
        }
        
        $entityManager->flush();
        $entityManager->persist($persona);
        $user = $this->getUser();
        $userId = $user->getId();
        return $this->redirectToRoute('app_profilenino_no', ['id' => $userId], Response::HTTP_SEE_OTHER);
    }

    return $this->render('profile_nino/_new_kids.html.twig', [
        'form' => $form->createView(),
        'user' => $user,
    ]);
}
}