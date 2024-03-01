<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;


class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $cls_input = 'width:100%;padding:.5rem;border-radius:0.375rem; border: 1px solid #adadada4';
        $builder
            ->add('email', EmailType::class, [
                'attr' => [
                    'style' => $cls_input
                ],
                'label' => false,
                'mapped' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Debes agregar un correo electrónico.',
                    ])
                ],
            ])
            ->add('username', TextType::class, [
                'attr' => [
                    'style' => $cls_input
                ],
                'label' => false,
                'mapped' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Debes agregar un nombre de usuario.',
                    ]),
                    new Length([
                        'min' => 5,
                        'minMessage' => 'debe ser mayor a {{ limit }} caracteres',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ])
                ],
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'label' => false,
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Debes aceptar los terminos y condiciones.',
                    ]),
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                'label' => false,
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => [
                    'autocomplete' => 'new-password',
                    'style' => $cls_input
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Debes agregar una contraseña.',
                    ]),
                    new Length([
                        'min' => 8,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
