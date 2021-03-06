<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ShopConditionType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('leftValue')
            ->add('operator', ChoiceType::class, [
                'choices' => [
                    '>'=> '>',
                    '<'=> '<',
                    '='=> '='
                ]
            ])
            ->add('rigthValue')
            ->add('endOperator', ChoiceType::class, [
                'placeholder' => '',
                'empty_data'  => null,
                'required' => false,
                'choices' => [
                    'OR'=> 'OR',
                    'AND'=> 'AND'
                ]
            ])
            ->add('description', TextareaType::class, [
                'required' => false,
            ])
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\ShopCondition'
        ));
    }
}
