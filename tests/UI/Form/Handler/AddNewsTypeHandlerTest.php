<?php

declare(strict_types=1);

namespace App\Tests\UI\Form\Handler;

use App\Domain\DTO\NewNewsDTO;
use App\Helper\Interfaces\FileUploaderHelperInterface;
use App\Repository\Interfaces\NewsRepositoryInterface;
use App\UI\Form\Handler\AddNewsTypeHandler;
use App\UI\Form\Handler\Interfaces\AddNewsTypeHandlerInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class AddNewsTypeHandlerTest extends TestCase
{
    /**
     * @var NewsRepositoryInterface
     */
    private $newsRepository;

    /**
     * @var FileUploaderHelperInterface
     */
    private $fileUploaderHelper;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     *{@inheritdoc}
     */
    protected function setUp ()
    {
        $this->newsRepository = $this->createMock(NewsRepositoryInterface::class);
        $this->fileUploaderHelper = $this->createMock(FileUploaderHelperInterface::class);
        $this->validator = $this->createMock(ValidatorInterface::class);
        $this->validator->method('validate')->willReturn([]);
    }

    public function testConstruct ()
    {
        $addNewsTypeHandler = new AddNewsTypeHandler(
            $this->newsRepository,
            $this->fileUploaderHelper,
            $this->validator
        );

        static::assertInstanceOf(
            AddNewsTypeHandlerInterface::class,
            $addNewsTypeHandler
        );
    }

    public function testWrongHandlingProcess ()
    {
        $formInterfaceMock = $this->createMock(FormInterface::class);

        $addNewsTypeHandler = new AddNewsTypeHandler(
            $this->newsRepository,
            $this->fileUploaderHelper,
            $this->validator
        );

        $formInterfaceMock->method('isValid')->willReturn(false);
        $formInterfaceMock->method('isSubmitted')->willReturn(false);

        static::assertFalse(
            $addNewsTypeHandler->handle($formInterfaceMock)
        );
    }

    public function testRightHandlingProcess ()
    {
        $formInterfaceMock = $this->createMock(FormInterface::class);
        $image = $this->createMock(UploadedFile::class);
        $image->method('getClientOriginalName')->willReturn('/tmp/hdhzdzdndjdzndnzd');

        $newNewsDTOMock = new NewNewsDTO(
            'alimentation',
            'toto',
            $image,
            'bien nourrir ses perroquets'
        );

        $addNewsTypeHandler = new AddNewsTypeHandler(
            $this->newsRepository,
            $this->fileUploaderHelper,
            $this->validator
        );

        $formInterfaceMock->method('isValid')->willReturn(true);
        $formInterfaceMock->method('isSubmitted')->willReturn(true);
        $formInterfaceMock->method('getData')->willReturn($newNewsDTOMock);

        static::assertTrue(
            $addNewsTypeHandler->handle($formInterfaceMock)
        );
    }
}