<?php

namespace App\Controller;

use App\Entity\Factory\OrderFactory;
use App\Entity\Order;
use App\Entity\OrderItem;
use App\Entity\Pizza;
use App\Form\AddToCartType;
use App\Form\CustomPizzaType;
use App\Form\PizzaType;
use App\Repository\OrderRepository;
use App\Repository\PizzaRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/pizza')]
class PizzaController extends AbstractController
{
    #[Route('/', name: 'app_pizza_list')]
    public function list(PizzaRepository $pizzaRepository): Response
    {
        return $this->render('pizza/index.html.twig', [
            'pizzas' => $pizzaRepository->findAll(),
        ]);
    }



    #[Route('/{id<\d+>}', name: 'app_pizza_details', methods: ['GET'])]
    public function show(Request $request, Pizza $pizza): Response
        {
            $form  = $this->createForm(AddToCartType::class);
            $form->handleRequest($request);


            if ($form->isSubmitted() && $form->isValid()) {

                return $this->redirectToRoute('admin_pizza_list', [], Response::HTTP_SEE_OTHER);
            }


            return $this->render('/pizza/details.html.twig', [
                'pizza' => $pizza,
                'form'=>$form->createView()
            ]);
        }

    #[Route('/add/{id}', name: 'app_pizza_add', methods: ['GET'])]
    public function addOrderItem(Request $request,
                             Pizza $pizza,
                             UserRepository $userRepository,
    OrderRepository $orderRepository){
        // Rajouter un item a une commande de l'utilisateur de l'utilisateur

        $user = $userRepository->find($this->getUser());
        $orderFactory = new OrderFactory();
        $item = $orderFactory->createItem($pizza);
        //Chercher si il y'a déja une commande en cart pour ce user
        //Si oui, ajouter cet item dans cette commande, sinon en crée une nouvelle
        $test = $orderRepository->findOneBy(
            ['user'=>$this->getUser(),
                'status'=>Order::STATUS_CART
                ]
        );
       dump($test);

       if($test){

           $order = $test;
           $order->addItem($item);
           $orderRepository->add($order);
       }else{
           $order = $orderFactory->create();
           $order->setUser($user);
           $order->addItem($item);

       }


        $orderRepository->add($order);


        return $this->redirectToRoute('app_pizza_list'
        );

    }

    #[Route('/checkout', name: 'app_pizza_checkout', methods: ['GET'])]
    public function checkOut(Request $request,
                             Pizza $pizza,
                             UserRepository $userRepository,
                             OrderRepository $orderRepository){
        // Rajouter un item a une commande de l'utilisateur de l'utilisateur

        return $this->renderForm('home/index.html.twig'
        );

    }
    #[Route('/custom/new', name: 'app_pizza_custom', methods: ['GET','POST'])]
    public function customPizza(Request $request
                                ){

        $pizza = new Pizza();
        $form = $this->createForm(PizzaType::class, $pizza);
        $orderFactory = new OrderFactory();
        $test = $orderFactory->createitem($pizza);
        dump($test);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {


            return $this->redirectToRoute('app_pizza_list', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('/pizza/_form.html.twig', [
            'pizza' => $pizza,
            'form' => $form->createView(),
        ]);

    }

}
