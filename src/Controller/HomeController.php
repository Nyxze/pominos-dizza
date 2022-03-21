<?php

namespace App\Controller;

use App\Repository\PizzaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(PizzaRepository $pizzaRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'pizzas' => $pizzaRepository->findAll(),
        ]);
    }
}
