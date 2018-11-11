<?php

namespace App\Tests\UI\Form\Type;

use App\Domain\DTO\NewNewsDTO;
use App\UI\Form\Subscriber\TinymceFieldSubscriber;
use App\UI\Form\Type\AddNewsType;
use Symfony\Component\Form\PreloadedExtension;
use Symfony\Component\Form\Test\TypeTestCase;
use Symfony\Component\HttpFoundation\File\File;

class AddNewsTypeTest extends TypeTestCase
{
    /**
     * @var TinymceFieldSubscriber
     */
    private $tinymceFieldSubscriber;

    /**
     *{@inheritdoc}
     */
    protected function setUp ()
    {
        $this->tinymceFieldSubscriber = $this->createMock(TinymceFieldSubscriber::class);
        parent::setUp();
    }

    protected function getExtensions ()
    {
        $type = new AddNewsType($this->tinymceFieldSubscriber);

        return [ new PreloadedExtension([$type],[])];
    }

    public function testWithGoodData()
    {
        $form = $this->factory->create(AddNewsType::class);

        $form->submit([
            'title' => 'nouveaux-nés',
            'image' => new File('public/images/accueil1.jpg'),
            'content' => 'les oeufs ont éclos'
        ]);

        static::assertTrue(
            $form->isSubmitted()
        );

        static::assertInstanceOf(NewNewsDTO::class,
            $form->getData()
        );

        static::assertTrue(
            $form->isValid()
        );
    }
}