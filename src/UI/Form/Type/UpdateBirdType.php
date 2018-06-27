<?php

declare(strict_types=1);

namespace App\UI\Form\Type;

use App\Domain\DTO\UpdateBirdDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UpdateBirdType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('birthdate', TextType::class)
            ->add('price', TextType::class)
            ->add('description', TextareaType::class);
    }

    public function configureOptions (OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => UpdateBirdDTO::class,
            'empty_data' => function (FormInterface $form) {
                return new UpdateBirdDTO(
                    $form->get('name')->getData(),
                    $form->get('birthdate')->getData(),
                    $form->get('price')->getData(),
                    $form->get('description')->getData()
                );
            },
            "validation_groups" => ['updatebird']
        ]);
    }
}
