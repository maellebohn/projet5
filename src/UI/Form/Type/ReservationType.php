<?php

declare(strict_types=1);

namespace App\UI\Form\Type;

use App\Domain\DTO\Interfaces\NewReservationFormSubmittedDTOInterface;
use App\Domain\DTO\NewReservationFormSubmittedDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
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
            ->add('email', EmailType::class)
            ->add('message', TextareaType::class)
            ->add('id', HiddenType::class);
    }

    public function configureOptions (OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => NewReservationFormSubmittedDTOInterface::class,
            'empty_data' => function (FormInterface $form) {
                return new NewReservationFormSubmittedDTO(
                    $form->get('name')->getData(),
                    $form->get('email')->getData(),
                    $form->get('message')->getData(),
                    $form->get('id')->getData()
                );
            },
            "validation_groups" => ['reservation']
        ]);
    }
}
