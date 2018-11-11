<?php

declare(strict_types=1);

namespace App\UI\Form\Type;

use App\Domain\DTO\Interfaces\NewInfoDTOInterface;
use App\Domain\DTO\NewInfoDTO;
use App\UI\Form\Subscriber\TinymceFieldSubscriber;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddInfoType extends AbstractType
{
    /**
     * @var TinymceFieldSubscriber
     */
    private $tinymceFieldSubscriber;

    /**
     * AddInfoType constructor.
     *
     * @param TinymceFieldSubscriber $tinymceFieldSubscriber
     */
    public function __construct (TinymceFieldSubscriber $tinymceFieldSubscriber)
    {
        $this->tinymceFieldSubscriber = $tinymceFieldSubscriber;
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
    }

    public function configureOptions (OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => NewInfoDTOInterface::class,
            'empty_data' => function (FormInterface $form) {
                return new NewInfoDTO(
                    $form->get('title')->getData(),
                    $form->get('category')->getData(),
                    $form->get('content')->getData(),
                    $form->get('image')->getData()
                );
            },
            "validation_groups" => ['addinfo']
        ]);
    }
}
