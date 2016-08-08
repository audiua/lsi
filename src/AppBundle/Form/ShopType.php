<?php

namespace AppBundle\Form;

use AppBundle\Entity\FieldMap;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ShopType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description', TextareaType::class, [
                'attr' => [
                    'class' => 'ckeditor'
                ]
            ])
            ->add('apiUrl')
            ->add('repeatTime')
            ->add('responceType', ChoiceType::class, [
                'choices' => [
                    'xml'=> 'xml',
                    'csv'=> 'csv',
                    'json'=> 'json'
                ]
            ])
            ->add('csvSeparator', ChoiceType::class, [
                'choices' => [
                    ',' => ',',
                    ';' => ';',
                    'Tab' => '\t'
                ]
            ])
            ->add('responceRaw')
            ->add('fields', CollectionType::class, [
                'label' => 'Shop fields',
                'entry_type' => FieldMapType::class,
                'allow_add' => true,
                'prototype' => true,
                'allow_delete' => true,
                'by_reference' => false,
            ])
            ->add('conditions', CollectionType::class, [
                'label' => 'Shop conditions',
                'entry_type' => ShopConditionType::class,
                'allow_add' => true,
                'prototype' => true,
                'allow_delete' => true,
                'by_reference' => false,
            ])
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-success'
                ]
            ])
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Shop'
        ));
    }

    //todo add result fields in new form as fields
    //$em->getClassMetadata('AppBundle:Result')->getFieldNames();
}
