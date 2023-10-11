<?php

namespace App\Controller;

use App\Entity\ElegirMenu;
use App\Form\ElegirMenuType;
use App\Repository\ElegirMenuRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/elegirmenu')]
class ElegirMenuController extends AbstractController
{
    #[Route('/{id}', name: 'app_elegirmenu_index', methods: ['GET', 'POST'])]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        $elegirMenu = new ElegirMenu();
        $form = $this->createForm(ElegirMenuType::class, $elegirMenu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($elegirMenu);
            $entityManager->flush();

            return $this->redirectToRoute('app_elegirmenu_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('elegir_menu/index.html.twig', [
            'elegir_menu' => $elegirMenu,
            'form' => $form,
            'user' => $user,
        ]);
    }
    #[Route('/admin/elegirmenu', name: 'app_elegirmenu_admin', methods: ['GET'])]
    public function admin(ElegirMenuRepository $elegirMenuRepository): Response
    {
        return $this->render('elegir_menu/admin.html.twig', [
            'elegir_menus' => $elegirMenuRepository->findAll(),
        ]);
    }

    #[Route('/admin/elegirmenu/new', name: 'app_elegirmenu_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $elegirMenu = new ElegirMenu();
        $form = $this->createForm(ElegirMenuType::class, $elegirMenu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($elegirMenu);
            $entityManager->flush();

            return $this->redirectToRoute('app_elegirmenu_admin', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('elegir_menu/new.html.twig', [
            'elegir_menu' => $elegirMenu,
            'form' => $form,
        ]);
    }

    #[Route('/admin/elegirmenu/{id}', name: 'app_elegirmenu_show', methods: ['GET'])]
    public function show(ElegirMenu $elegirMenu): Response
    {
        return $this->render('elegir_menu/show.html.twig', [
            'elegir_menu' => $elegirMenu,
        ]);
    }

    #[Route('/admin/elegirmenu/{id}/edit', name: 'app_elegirmenu_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ElegirMenu $elegirMenu, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ElegirMenuType::class, $elegirMenu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_elegirmenu_admin', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('elegir_menu/edit.html.twig', [
            'elegir_menu' => $elegirMenu,
            'form' => $form,
        ]);
    }

    #[Route('/admin/elegirmenu/{id}', name: 'app_elegirmenu_delete', methods: ['POST'])]
    public function delete(Request $request, ElegirMenu $elegirMenu, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$elegirMenu->getId(), $request->request->get('_token'))) {
            $entityManager->remove($elegirMenu);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_elegirmenu_admin', [], Response::HTTP_SEE_OTHER);
    }
}
