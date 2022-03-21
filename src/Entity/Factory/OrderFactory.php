<?php

namespace App\Entity\Factory;

use App\Entity\Order;
use App\Entity\OrderItem;
use App\Entity\Pizza;

class OrderFactory
{

    public function create(): Order{

        $order = new Order();
        $order->setStatus(Order::STATUS_CART)
            ->setCreatedAt(new \DateTime())
            ->setUpdatedAt(new \DateTime());

        return $order;
    }

    public function createitem(Pizza $pizza):OrderItem
    {
        $item = new OrderItem();
        $item->setPizza($pizza)->setQuantity(1);

        return $item;
    }


}