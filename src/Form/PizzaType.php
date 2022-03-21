<?php

namespace App\Form;

use App\Entity\Base;
use App\Entity\Pizza;
use App\Entity\Size;
use App\Form\DataTransformer\ToppingDataTransformer;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class PizzaType extends AbstractType
{

private  ToppingDataTransformer $toppingDataTransformer;

    /**
     * @param ToppingDataTransformer $toppingDataTransformer
     */
    public function __construct(ToppingDataTransformer $toppingDataTransformer)
    {
        $this->toppingDataTransformer = $toppingDataTransformer;
    }


    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
           ->add('base',EntityType::class,[
               'class'=>Base::class,
               'choice_label'=>'name',
               'label'=>'Base',
           ])
            ->add('size', EntityType::class,[
                'class'=>Size::class,
                'choice_label'=>'size',
                'label'=>'Size',
            ])
            ->add('toppings',CollectionType::class,[
                'entry_type'=>PizzaToppingType::class,
                'allow_delete'=>true,
                'allow_add'=>true,
                'by_reference' => false,
                'label'=> false
            ]);

        $builder->get('toppings')->addModelTransformer($this->toppingDataTransformer);


//
//        ->add('toppings', CollectionType::class,[
//
//            'entry_type'=>PizzaToppingType::class,
//            'prototype'=>true,
//            'allow_add'=>true,
//            'allow_delete'=>true,
//            'label'=>false




    }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Pizza::class,


        ]);
    }
}
