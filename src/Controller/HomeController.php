<?php

namespace App\Controller;


use App\Entity\Order;
use App\Repository\OrderRepository;
use App\Repository\PizzaRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(OrderRepository $orderRepository,PizzaRepository $pizzaRepository, UserRepository $userRepository): Response{

        $test = $orderRepository->findOneBy(
            ['user'=>$this->getUser(),
                'status'=>Order::STATUS_CART
            ]
        );
        dump($test);
        return $this->render('home/index.html.twig', [
            'pizzas' => $pizzaRepository->findAll(),
        ]);
    }


}
