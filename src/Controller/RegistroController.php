<?php

namespace App\Controller;

use App\Form\DatosRegistrarteType;
use App\Repository\DatosRegistrarteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\DatosRegistrarte;


class RegistroController extends AbstractController
{
    #[Route('/registro', name: 'app_registro')]
    public function index(Request $request, DatosRegistrarteRepository $repository): Response
    {
        $form = $this->createForm(DatosRegistrarteType::class);
        $form->handleRequest($request);
        $usuarioEncontrado = false;
        $usuario = null;
        

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $usuario = $data->getUsuario();
            $usuarioEncontrado = $repository->findByUsuario($usuario);
            $datosRegistrarte = $repository->findOneBy(['Usuario' => $usuario]);
        }
        $datosRegistrarte = $repository->findOneBy(['Usuario' => $usuario]);
        return $this->render('registro/index.html.twig', [
            'form' => $form->createView(),
            'usuarioEncontrado' => $usuarioEncontrado,
            'usuario' => $usuario,
            'datosRegistrarte' => $datosRegistrarte, 
        ]);
    }
    #[Route('/registro/{usuario}', name: 'app_registro_modal', methods: ['GET'])]
    public function show(DatosRegistrarte $Usuario): Response 
    {
        return $this->render('registro/_modal.html.twig', [
            'usuario' => $Usuario,
        ]);
    }
}
