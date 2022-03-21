<?php

namespace App\Form\DataTransformer;

use App\Repository\ToppingRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class ToppingDataTransformer implements DataTransformerInterface
{

    private ToppingRepository $toppingRepository;

    /**
     * @param ToppingRepository $toppingRepository
     */
    public function __construct(ToppingRepository $toppingRepository)
    {
        $this->toppingRepository = $toppingRepository;
    }

    public function transform(mixed $value)
    {



return $value->toArray()  ;
    }


    public function reverseTransform(mixed $value)
    {
        $toppingCollection = new ArrayCollection();

        foreach ($value as $toppingName){
            $topping = $this->toppingRepository->findOneByName($toppingName->getName());
            if ($topping){
                $toppingCollection->add($topping);
            }else
            {
                return "Don't exists";
            }
        }

        return $toppingCollection;

    }
}