<?php

declare(strict_types=1);

namespace App\UI\Form\Type;

use App\Domain\DTO\Interfaces\UserRegistrationDTOInterface;
use App\Domain\DTO\UserRegistrationDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class)
            ->add('lastname', TextType::class)
            ->add('username', TextType::class)
            ->add('email', EmailType::class)
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class
            ]);
    }

    public function configureOptions (OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => UserRegistrationDTOInterface::class,
            'empty_data' => function (FormInterface $form) {
                return new UserRegistrationDTO(
                    $form->get('firstname')->getData(),
                    $form->get('lastname')->getData(),
                    $form->get('username')->getData(),
                    $form->get('email')->getData(),
                    $form->get('password')->getData()
                );
            },
            "validation_groups" => ['registration']
        ]);
    }
}
