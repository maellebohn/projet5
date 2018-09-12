<?php

declare(strict_types=1);

namespace App\UI\Form\Type;

use App\Domain\DTO\Interfaces\UpdateInfoDTOInterface;
use App\Domain\DTO\UpdateInfoDTO;
use App\UI\Form\DataTransformer\ImageTransformer;
use App\UI\Form\Subscriber\ImageFieldSubscriber;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UpdateInfoType extends AbstractType
{
    private $transformer;

    public function __construct(ImageTransformer $transformer)
    {
        $this->transformer = $transformer;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class)
            ->add('image', FileType::class, ['required' => false])
            ->add('category', ChoiceType::class, [
                'choices' => [
                    'alimentation' => 'alimentation',
                    'education' => 'education',
                    'installation' => 'installation',
                    'pathologie' => 'pathologie'
                ]
            ])
            ->add('content', TextareaType::class);

        $builder->get('image')
            ->addModelTransformer($this->transformer);

        $builder->addEventSubscriber(new ImageFieldSubscriber());
    }

    public function configureOptions (OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => UpdateInfoDTOInterface::class,
            'empty_data' => function (FormInterface $form) {
                return new UpdateInfoDTO(
                    $form->get('title')->getData(),
                    $form->get('image')->getData(),
                    $form->get('category')->getData(),
                    $form->get('content')->getData()
                );
            },
            "validation_groups" => ['updateinfo']
        ]);
    }
}
