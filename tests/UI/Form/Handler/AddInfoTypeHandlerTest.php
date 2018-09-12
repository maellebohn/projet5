<?php

declare(strict_types=1);

namespace App\Tests\UI\Form\Handler;

use App\Domain\DTO\NewInfoDTO;
use App\Helper\Interfaces\FileUploaderHelperInterface;
use App\Repository\Interfaces\InfosRepositoryInterface;
use App\UI\Form\Handler\AddInfoTypeHandler;
use App\UI\Form\Handler\Interfaces\AddInfoTypeHandlerInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class AddInfoTypeHandlerTest extends TestCase
{
    /**
     * @var InfosRepositoryInterface
     */
    private $infosRepository;

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
        $this->infosRepository = $this->createMock(InfosRepositoryInterface::class);
        $this->fileUploaderHelper = $this->createMock(FileUploaderHelperInterface::class);
        $this->validator = $this->createMock(ValidatorInterface::class);
        $this->validator->method('validate')->willReturn([]);
    }

    public function testConstruct ()
    {
        $addInfoTypeHandler = new AddInfoTypeHandler(
            $this->infosRepository,
            $this->fileUploaderHelper,
            $this->validator
        );

        static::assertInstanceOf(
            AddInfoTypeHandlerInterface::class,
            $addInfoTypeHandler
        );
    }

    public function testWrongHandlingProcess ()
    {
        $formInterfaceMock = $this->createMock(FormInterface::class);

        $addInfoTypeHandler = new AddInfoTypeHandler(
            $this->infosRepository,
            $this->fileUploaderHelper,
            $this->validator
        );

        $formInterfaceMock->method('isValid')->willReturn(false);
        $formInterfaceMock->method('isSubmitted')->willReturn(false);

        static::assertFalse(
            $addInfoTypeHandler->handle($formInterfaceMock)
        );
    }

    public function testRightHandlingProcess ()
    {
        $formInterfaceMock = $this->createMock(FormInterface::class);
        $image = $this->createMock(UploadedFile::class);
        $image->method('getClientOriginalName')->willReturn('/tmp/hdhzdzdndjdzndnzd');
//mock user interface

        $newInfoDTOMock = new NewInfoDTO(
            'alimentation',
            'toto',
            $image,
            'education',
            'bien nourrir ses perroquets'
        );

        $addInfoTypeHandler = new AddInfoTypeHandler(
            $this->infosRepository,
            $this->fileUploaderHelper,
            $this->validator
        );

        $formInterfaceMock->method('isValid')->willReturn(true);
        $formInterfaceMock->method('isSubmitted')->willReturn(true);
        $formInterfaceMock->method('getData')->willReturn($newInfoDTOMock);

        static::assertTrue(
            $addInfoTypeHandler->handle($formInterfaceMock)
        );
    }
}