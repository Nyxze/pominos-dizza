<?php

namespace App\Form;

use App\Entity\Pizza;
use App\Entity\Topping;
use App\Form\DataTransformer\TestDataTransformer;
use App\Form\DataTransformer\ToppingDataTransformer;
use App\Repository\ToppingRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PizzaToppingType extends AbstractType
{
    private TestDataTransformer $testDataTransformer;
    private ToppingRepository $toppingRepository;

    /**
     * @param ToppingDataTransformer $toppingDataTransformer
     * @param $toppingRepository
     */
    public function __construct(TestDataTransformer $testDataTransformer, ToppingRepository $toppingRepository)
    {
        $this->testDataTransformer = $testDataTransformer;
        $this->toppingRepository = $toppingRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {


        $builder
            ->add('name',EntityType::class,
            ['class'=>Topping::class])
            ->add('deleteButton', ButtonType::class, [
                'attr' => [
                    'class' => 'btn btn-danger delete',
                    'style' => 'margin-top: 33px'
                ],
                'label' => 'X'
            ]);

        $builder->get('name')->addModelTransformer($this->testDataTransformer);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Topping::class,
            'attr' => ['class' => 'd-flex'],
            'label'=>false
        ]);
    }
}
