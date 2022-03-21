<?php

namespace App\Manager;

use App\Entity\Cart;
use App\Entity\Factory\OrderFactory;
use App\Service\CartSessionStorage;
use Doctrine\ORM\EntityManager;

class CartManager
{


private CartSessionStorage $cartSessionStorage;
private OrderFactory $orderFactory;

    /**
     * @param CartSessionStorage $cartSessionStorage
     * @param OrderFactory $orderFactory
     */
    public function __construct(CartSessionStorage $cartSessionStorage, OrderFactory $orderFactory)
    {
        $this->cartSessionStorage = $cartSessionStorage;
        $this->orderFactory = $orderFactory;
    }

    public function getCurrentCart():Order
    {
        $cart = $this->cartSessionStorage->getCart();
        if(!$cart){

            $cart = $this->orderFactory->create();
        }

        return $cart;
    }

}