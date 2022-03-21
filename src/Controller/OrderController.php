<?php

namespace App\Controller;

use App\Entity\Order;
use App\Repository\OrderRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/order')]
class OrderController extends AbstractController
{
    #[Route('/', name: 'app_order_list')]
    public function list(OrderRepository $orderRepository): Response
    {
        $orderList = $orderRepository->createQueryBuilder('o')->select('o')
            ->where('o.user = :userId')
            ->setParameter('userId',$this->getUser()->getId())->getQuery()->getResult();

        dump($orderList);
        return $this->render('order/list.html.twig',[
            'orderList'=>$orderList
        ]);
    }
    #[Route('/checkout/{id}', name: 'app_order_checkout')]
    public function checkout(OrderRepository $orderRepository, Order $order, Request $request):Response{

        if ($this->isCsrfTokenValid('checkout'.$order->getId(), $request->request->get('_token'))) {
          $order->setStatus('checkout');

          $orderRepository->add($order);
        }

        return $this->redirectToRoute('app_order_list', [], Response::HTTP_SEE_OTHER);




    }
    #[Route('/{id}', name: 'app_order_delete', methods: ['POST'])]
    public function delete(Request $request, Order $order,
                           OrderRepository $orderRepository):Response{

        if ($this->isCsrfTokenValid('delete'.$order->getId(), $request->request->get('_token'))) {
            $orderRepository->remove($order);
        }

        return $this->redirectToRoute('app_order_list', [], Response::HTTP_SEE_OTHER);


    }

}
