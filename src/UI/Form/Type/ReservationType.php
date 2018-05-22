<?php

declare(strict_types=1);

namespace App\UI\Form\Type;

use App\Domain\DTO\NewInfoDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('email', EmailType::class);
    }

/*    public function configureOptions (OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => NewInfoDTO::class,
            'empty_data' => function (FormInterface $form) {
                return new NewInfoDTO(
                    $form->get('title')->getData(),
                    $form->get('author')->getData(),
                    $form->get('image')->getData(),
                    $form->get('content')->getData()
                );
            },
            "validation_groups" => ['addinfo']
        ]);
    }*/
}
