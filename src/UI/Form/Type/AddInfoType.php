<?php

declare(strict_types=1);

namespace App\UI\Form\Type;

use App\Domain\DTO\NewInfoDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddInfoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, ['label' => 'Titre'])
            ->add('author', TextType::class, ['label' => 'Auteur'])
            ->add('image', FileType::class, ['label' => 'Image'])
            ->add('content', TextareaType::class, ['label' => 'Texte']);
    }

    public function configureOptions (OptionsResolver $resolver)
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
            "validation_groups" => ['contact']
        ]);
    }
}
