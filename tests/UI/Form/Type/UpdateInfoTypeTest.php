<?php

namespace App\Tests\UI\Form\Type;

use App\Domain\DTO\UpdateInfoDTO;
use App\UI\Form\DataTransformer\ImageTransformer;
use App\UI\Form\Subscriber\ImageFieldSubscriber;
use App\UI\Form\Subscriber\TinymceFieldSubscriber;
use App\UI\Form\Type\UpdateInfoType;
use Symfony\Component\Form\PreloadedExtension;
use Symfony\Component\Form\Test\TypeTestCase;
use Symfony\Component\HttpFoundation\File\File;

class UpdateInfoTypeTest extends TypeTestCase
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
        $type = new UpdateInfoType(
            $this->transformer,
            $this->imageFieldSubscriber,
            $this->tinymceFieldSubscriber
        );

        return [ new PreloadedExtension([$type],[])];
    }

    public function testWithGoodData()
    {
        $form = $this->factory->create(UpdateInfoType::class);

        $form->submit([
            'title' => 'alimentation',
            'image' => new File('public/images/accueil1.jpg'),
            'category' => 'education',
            'content' => 'bien nourrir ses perroquets'
        ]);

        static::assertTrue(
            $form->isSubmitted()
        );

        static::assertInstanceOf(UpdateInfoDTO::class,
            $form->getData()
        );

        static::assertTrue(
            $form->isValid()
        );
    }
}