<?php

namespace App\Controller;

use App\Form\DatosRegistrarteType;
use App\Repository\DatosRegistrarteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\DatosRegistrarte;
use Doctrine\ORM\EntityManagerInterface;


class RegistroController extends AbstractController
{
    #[Route('/registro', name: 'app_registro')]
    public function index(Request $request, DatosRegistrarteRepository $repository, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(DatosRegistrarteType::class);
        $form->handleRequest($request);

        $usuarioEncontrado = false;
        $datosRegistrarte = null;
        $registroForm = $this->createForm(DatosRegistrarteType::class); // Define $registroForm aquí

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $nombre = $data->getNombre();
            $apellidos = $data->getApellidos();
            $datosRegistrarte = $repository->findOneBy([
                'nombre' => $nombre,
                'apellidos' => $apellidos
            ]);
            if ($datosRegistrarte) {
                $registroForm = $this->createForm(DatosRegistrarteType::class);
                $registroForm->handleRequest($request);
                if (!$usuarioEncontrado && $registroForm->isSubmitted() && $registroForm->isValid()) {
                    $nuevoEmail = $data->getEmail();
                    if ($nuevoEmail !== null) {
                        $datosRegistrarte->setEmail($nuevoEmail);
                        $entityManager->flush();
                        return $this->redirectToRoute('app_registro_gracias', [], Response::HTTP_SEE_OTHER);
                    }
                }
            } else {
                $this->addFlash('error', 'Nombre y apellidos no encontrados.');
            }
            $usuarioEncontrado = $datosRegistrarte !== null;
        }


        return $this->render('registro/index.html.twig', [
            'form' => $form->createView(),
            'registroForm' => $registroForm->createView(),
            'usuarioEncontrado' => $usuarioEncontrado,
            'datosRegistrarte' => $datosRegistrarte,
        ]);
    }
    #[Route('/registro/gracias', name: 'app_registro_gracias')]
    public function gracias(): Response
    {

        return $this->render('registro/gracias.html.twig', [
        ]);
    }
}
