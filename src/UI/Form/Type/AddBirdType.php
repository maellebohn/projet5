<?php

declare(strict_types=1);

namespace App\UI\Form\Type;

use App\Domain\DTO\Interfaces\NewBirdDTOInterface;
use App\Domain\DTO\NewBirdDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddBirdType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('birthdate', TextType::class)//birthdaytype gettimestamp
            ->add('price', IntegerType::class)//moneytype
            ->add('description', TextareaType::class);
    }

    public function configureOptions (OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => NewBirdDTOInterface::class,
            'empty_data' => function (FormInterface $form) {
                return new NewBirdDTO(
                    $form->get('name')->getData(),
                    $form->get('birthdate')->getData(),
                    $form->get('price')->getData(),
                    $form->get('description')->getData()
                );
            },
            "validation_groups" => ['addbird']
        ]);
    }
}
