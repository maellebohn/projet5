<?php

namespace App\Tests\UI\Form\Type;

use App\Domain\DTO\NewInfoDTO;
use App\UI\Form\Subscriber\TinymceFieldSubscriber;
use App\UI\Form\Type\AddInfoType;
use Symfony\Component\Form\PreloadedExtension;
use Symfony\Component\Form\Test\TypeTestCase;
use Symfony\Component\HttpFoundation\File\File;

class AddInfoTypeTest extends TypeTestCase
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
        $type = new AddInfoType($this->tinymceFieldSubscriber);

        return [ new PreloadedExtension([$type],[])];
    }

    public function testWithGoodData()
    {
        $form = $this->factory->create(AddInfoType::class);

        $form->submit([
            'title' => 'alimentation',
            'image' => new File('public/images/accueil1.jpg'),
            'category' => 'education',
            'content' => 'bien nourrir ses perroquets'
        ]);

        static::assertTrue(
            $form->isSubmitted()
        );

        static::assertInstanceOf(NewInfoDTO::class,
            $form->getData()
        );

        static::assertTrue(
            $form->isValid()
        );
    }
}