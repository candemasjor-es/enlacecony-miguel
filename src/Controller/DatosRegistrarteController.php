<?php

namespace App\Controller;

use App\Entity\DatosRegistrarte;
use App\Form\DatosRegistrarte1Type;
use App\Repository\DatosRegistrarteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/datosregistrarte')]
class DatosRegistrarteController extends AbstractController
{
    #[Route('/', name: 'app_datos_registrarte_index', methods: ['GET'])]
    public function index(DatosRegistrarteRepository $datosRegistrarteRepository): Response
    {
        return $this->render('datos_registrarte/index.html.twig', [
            'datos_registrartes' => $datosRegistrarteRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_datos_registrarte_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $datosRegistrarte = new DatosRegistrarte();
        $form = $this->createForm(DatosRegistrarte1Type::class, $datosRegistrarte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($datosRegistrarte);
            $entityManager->flush();

            return $this->redirectToRoute('app_datos_registrarte_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('datos_registrarte/new.html.twig', [
            'datos_registrarte' => $datosRegistrarte,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_datos_registrarte_show', methods: ['GET'])]
    public function show(DatosRegistrarte $datosRegistrarte): Response
    {
        return $this->render('datos_registrarte/show.html.twig', [
            'datos_registrarte' => $datosRegistrarte,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_datos_registrarte_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, DatosRegistrarte $datosRegistrarte, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(DatosRegistrarte1Type::class, $datosRegistrarte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_datos_registrarte_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('datos_registrarte/edit.html.twig', [
            'datos_registrarte' => $datosRegistrarte,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_datos_registrarte_delete', methods: ['POST'])]
    public function delete(Request $request, DatosRegistrarte $datosRegistrarte, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$datosRegistrarte->getId(), $request->request->get('_token'))) {
            $entityManager->remove($datosRegistrarte);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_datos_registrarte_index', [], Response::HTTP_SEE_OTHER);
    }
}
