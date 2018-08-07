<?php

declare(strict_types=1);

namespace App\UI\Form\Type;

use App\Domain\DTO\Interfaces\UserResetPasswordDTOInterface;
use App\Domain\DTO\UserResetPasswordDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AskResetPasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class)
            ->add('email', EmailType::class);
    }

    public function configureOptions (OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => UserResetPasswordDTOInterface::class,
            'empty_data' => function (FormInterface $form) {
                return new UserResetPasswordDTO(
                    $form->get('username')->getData(),
                    $form->get('email')->getData()
                );
            },
            "validation_groups" => ['resetpassword']
        ]);
    }
}
