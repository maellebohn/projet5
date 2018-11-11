<?php

declare(strict_types=1);

namespace App\UI\Form\Type;

use App\Domain\DTO\Interfaces\UpdateNewsDTOInterface;
use App\Domain\DTO\UpdateNewsDTO;
use App\UI\Form\DataTransformer\ImageTransformer;
use App\UI\Form\Subscriber\ImageFieldSubscriber;
use App\UI\Form\Subscriber\TinymceFieldSubscriber;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UpdateNewsType extends AbstractType
{
    /**
     * @var ImageTransformer
     */
    private $transformer;

    /**
     * @var ImageFieldSubscriber
     */
    private $imageFieldSubscriber;

    /**
     * @var TinymceFieldSubscriber
     */
    private $tinymceFieldSubscriber;

    /**
     * UpdateNewsType constructor.
     *
     * @param ImageTransformer       $transformer
     * @param ImageFieldSubscriber   $imageFieldSubscriber
     * @param TinymceFieldSubscriber $tinymceFieldSubscriber
     */
    public function __construct(
        ImageTransformer $transformer,
        ImageFieldSubscriber $imageFieldSubscriber,
        TinymceFieldSubscriber $tinymceFieldSubscriber
    ) {
        $this->transformer = $transformer;
        $this->imageFieldSubscriber = $imageFieldSubscriber;
        $this->tinymceFieldSubscriber = $tinymceFieldSubscriber;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class)
            ->add('image', FileType::class, ['required' => false])
            ->add('content', TextareaType::class);

        $builder->get('image')
            ->addModelTransformer($this->transformer);

        $builder->addEventSubscriber($this->imageFieldSubscriber);
    }

    public function configureOptions (OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => UpdateNewsDTOInterface::class,
            'empty_data' => function (FormInterface $form) {
                return new UpdateNewsDTO(
                    $form->get('title')->getData(),
                    $form->get('image')->getData(),
                    $form->get('content')->getData()
                );
            },
            "validation_groups" => ['updatenews']
        ]);
    }
}
