<?php

namespace App\Form\DataTransformer;

use App\Repository\ToppingRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class TestDataTransformer implements DataTransformerInterface
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


        return $this->toppingRepository->findOneByName($value);
    }


    public function reverseTransform(mixed $value)
    {

        return $value->getName();
    }
}