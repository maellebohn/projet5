<?php

declare(strict_types=1);

namespace App\UI\Form\Type;

use App\Domain\DTO\Interfaces\UpdateBirdDTOInterface;
use App\Domain\DTO\UpdateBirdDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
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
            ->add('birthdate', BirthdayType::class, [
                'input' => 'timestamp', 'format' => 'dd MM yyyy'
            ])
            ->add('price', IntegerType::class, [
                'scale' => 0,
                'attr' => [
                    'placeholder' => 'ex : 200.00'
                ]
            ])
            ->add('description', TextareaType::class);
    }

    public function configureOptions (OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => UpdateBirdDTOInterface::class,
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
