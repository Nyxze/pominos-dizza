<?php

namespace App\Controller;

use App\Entity\Topping;
use App\Form\PizzaToppingType;
use App\Form\ToppingType;
use App\Repository\ToppingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/topping')]
class ToppingController extends AbstractController
{
    #[Route('/', name: 'admin_topping_list', methods: ['GET'])]
    public function index(ToppingRepository $toppingRepository): Response
    {
        return $this->render('admin/topping/list.html.twig', [
            'toppings' => $toppingRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'admin_topping_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ToppingRepository $toppingRepository): Response
    {
        $topping = new Topping();
        $form = $this->createForm(ToppingType::class, $topping);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $toppingRepository->add($topping);
            return $this->redirectToRoute('admin_topping_list', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/topping/new.html.twig', [
            'topping' => $topping,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'admin_topping_show', methods: ['GET'])]
    public function show(Topping $topping): Response
    {
        return $this->render('admin/topping/show.html.twig', [
            'topping' => $topping,
        ]);
    }

    #[Route('/{id}/edit', name: 'admin_topping_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Topping $topping, ToppingRepository $toppingRepository): Response
    {
        $form = $this->createForm(ToppingType::class, $topping);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $toppingRepository->add($topping);
            return $this->redirectToRoute('admin_topping_list', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/topping/edit.html.twig', [
            'topping' => $topping,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'admin_topping_delete', methods: ['POST'])]
    public function delete(Request $request, Topping $topping, ToppingRepository $toppingRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$topping->getId(), $request->request->get('_token'))) {
            $toppingRepository->remove($topping);
        }

        return $this->redirectToRoute('admin_topping_list', [], Response::HTTP_SEE_OTHER);
    }
}
