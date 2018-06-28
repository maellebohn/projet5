<?php

declare(strict_types=1);

namespace App\UI\Form\Type;

use App\Domain\DTO\Interfaces\NewNewsDTOInterface;
use App\Domain\DTO\NewNewsDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddNewsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class)
            ->add('author', TextType::class)
            ->add('image', FileType::class, ['required' => false])
            ->add('content', TextareaType::class);
    }

    public function configureOptions (OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => NewNewsDTOInterface::class,
            'empty_data' => function (FormInterface $form) {
                return new NewNewsDTO(
                    $form->get('title')->getData(),
                    $form->get('author')->getData(),
                    $form->get('image')->getData(),
                    $form->get('content')->getData()
                );
            },
            "validation_groups" => ['addnews']
        ]);
    }
}
