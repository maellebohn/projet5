<?php

namespace App\Tests\UI\Form\Type;

use App\Domain\DTO\UpdateNewsDTO;
use App\UI\Form\DataTransformer\ImageTransformer;
use App\UI\Form\Subscriber\ImageFieldSubscriber;
use App\UI\Form\Subscriber\TinymceFieldSubscriber;
use App\UI\Form\Type\UpdateNewsType;
use Symfony\Component\Form\PreloadedExtension;
use Symfony\Component\Form\Test\TypeTestCase;
use Symfony\Component\HttpFoundation\File\File;

class UpdateNewsTypeTest extends TypeTestCase
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
     *{@inheritdoc}
     */
    protected function setUp ()
    {
        $this->transformer = $this->createMock(ImageTransformer::class);
        $this->transformer->method('transform')->willReturn(new File('public/images/accueil1.jpg'));
        $this->transformer->method('reverseTransform')->willReturn('accueil1.jpg');
        $this->imageFieldSubscriber = $this->createMock(ImageFieldSubscriber::class);
        $this->tinymceFieldSubscriber = $this->createMock(TinymceFieldSubscriber::class);
        parent::setUp();
    }

    protected function getExtensions ()
    {
        $type = new UpdateNewsType(
            $this->transformer,
            $this->imageFieldSubscriber,
            $this->tinymceFieldSubscriber
        );

        return [new PreloadedExtension([$type],[])];
    }

    public function testWithGoodData()
    {
        $form = $this->factory->create(UpdateNewsType::class);

        $form->submit([
            'title' => 'nouveaux-nés',
            'image' => new File('public/images/accueil1.jpg'),
            'content' => 'les oeufs ont éclos'
        ]);

        static::assertTrue(
            $form->isSubmitted()
        );

        static::assertInstanceOf(UpdateNewsDTO::class,
            $form->getData()
        );

        static::assertTrue(
            $form->isValid()
        );
    }
}