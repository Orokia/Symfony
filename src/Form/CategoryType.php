<?php

namespace App\Form;

use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
              
                'attr'=>[
                    'placeholder'=> 'Enter  Name',
                    'class'=>'form-control'
                ],
                'row_attr'=>[
                    'class'=>'form-group mb-3'
                ],
            ]
                )
            ->add('description', TextareaType::class, [
              
                'attr'=>[
                    'placeholder'=> 'Enter  Name',
                    'class'=>'form-control'
                ],
                'row_attr'=>[
                    'class'=>'form-group mb-3'
                ],
            ])
            ->add('ajouter', SubmitType::class, [
    
    'attr' => [
        'class' => 'btn btn-primary w-100'
    ]
]);
        
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Category::class,
        ]);
    }
}
