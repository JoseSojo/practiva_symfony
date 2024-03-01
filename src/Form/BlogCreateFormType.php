<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class BlogCreateFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $cls_input = 'width:100%;padding:.5rem;border-radius:0.375rem; border: 1px solid #adadada4; heigth:100%';

        $builder
            ->add('title', TextType::class, [
                'attr' => [
                    'style' => $cls_input
                ],
                'label' => false,
                'mapped' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Debes agregar un titulo.',
                    ])
                ],
            ])
            ->add('slug', HiddenType::class, [
                'attr' => [
                    'type' => 'hidden'
                ]
            ])
            ->add('content', TextType::class, [
                'attr' => [
                    'style' => $cls_input
                ],
                'label' => false,
                'mapped' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Debes agregar una descripcion.',
                    ])
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
