<?php

namespace App\Controller;

use App\DataTransformer\RolesToArrayTransformer;
use App\Entity\Personas;
use App\Entity\User;
use App\Repository\UserRepository;
use App\Repository\PersonasRepository;
use App\Repository\PersonasPequenosRepository;
use App\Repository\DatosRegistrarteRepository;
use App\Form\AttendType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/profile')]
class ProfileController extends AbstractController
{
    private $rolesTransformer;
    private EntityManagerInterface $entityManager;

    public function __construct(RolesToArrayTransformer $rolesTransformer, EntityManagerInterface $entityManager)
    {
        $this->rolesTransformer = $rolesTransformer;
        $this->entityManager = $entityManager;
    }

    #[Route('/', name: 'app_profile')]
    public function index(UserRepository $userRepository, PersonasPequenosRepository $repo, PersonasRepository $personas, DatosRegistrarteRepository $repodatos): Response
    {
        $user = $this->getUser();
        $totalUsers = $userRepository->countAllUsers();
        $totalpersonas = $personas->countAllPersonas();
        $totalPersonasPequenos = $repo->countAllPersonasPequenos();
        $totalDatos = $repodatos->countAllDatosRegistrarte();

        return $this->render('profile/index.html.twig', [
            'user' => $user,
            'totalUsers' => $totalUsers,
            'totalPersonas' => $totalpersonas,
            'totalPersonasPequenos' => $totalPersonasPequenos,
            'totalDatos' => $totalDatos,
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

        for ($i = 1; $i <= $numeroPersonas; ++$i) {
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
                    'style' => 'display:none;',
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

            return $this->redirectToRoute('app_profilenino', ['id' => $userId], Response::HTTP_SEE_OTHER);
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

    #[Route('/administrador/persona', name: 'app_administrador_persona', methods: ['GET'])]
    public function personasadmin(EntityManagerInterface $em): Response
    {
        $query = $em->createQuery('
        SELECT personas, user
        FROM App\Entity\Personas personas
        INNER JOIN personas.user user
        ORDER BY personas.id ASC
    ');
        $resultado = $query->getResult();

        return $this->render('profile/personas_administrador.html.twig', [
            'personas' => $resultado,
        ]);
    }
    #[Route('/administrador/evento', name: 'app_persona_evento', methods: ['GET'])]
    public function personasevento(EntityManagerInterface $em): Response
    {
        $query = $em->createQuery('
        SELECT personas, user
        FROM App\Entity\Personas personas
        INNER JOIN personas.user user
        ORDER BY personas.id ASC
    ');
        $resultado = $query->getResult();

        return $this->render('profile/personas_evento.html.twig', [
            'personas' => $resultado,
        ]);
    }
    #[Route('/administrador/kid', name: 'app_administrador_kid', methods: ['GET'])]
    public function kidadmin(EntityManagerInterface $em): Response
    {
        $query = $em->createQuery('
        SELECT personas_pequenos, user
        FROM App\Entity\PersonasPequenos personas_pequenos
        INNER JOIN personas_pequenos.user user
        ORDER BY personas_pequenos.id ASC
    ');
        $resultado = $query->getResult();

        return $this->render('profile/kid_administrador.html.twig', [
            'personas_pequenos' => $resultado,
        ]);
    }
}
