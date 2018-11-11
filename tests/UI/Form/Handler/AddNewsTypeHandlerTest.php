<?php

declare(strict_types=1);

namespace App\Tests\UI\Form\Handler;

use App\Domain\DTO\NewNewsDTO;
use App\Domain\Models\Interfaces\UsersInterface;
use App\Helper\Interfaces\FileUploaderHelperInterface;
use App\Repository\Interfaces\NewsRepositoryInterface;
use App\UI\Form\Handler\AddNewsTypeHandler;
use App\UI\Form\Handler\Interfaces\AddNewsTypeHandlerInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
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
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * @var UsersInterface
     */
    private $user;

    /**
     * @var TokenInterface
     */
    private $tokenInterface;

    /**
     *{@inheritdoc}
     */
    protected function setUp ()
    {
        $this->newsRepository = $this->createMock(NewsRepositoryInterface::class);
        $this->fileUploaderHelper = $this->createMock(FileUploaderHelperInterface::class);
        $this->validator = $this->createMock(ValidatorInterface::class);
        $this->validator->method('validate')->willReturn([]);
        $this->tokenStorage = $this->createMock(TokenStorageInterface::class);
        $this->tokenInterface = $this->createMock(TokenInterface::class);
        $this->tokenStorage->method('getToken')->willReturn($this->tokenInterface);
        $this->user = $this->createMock(UsersInterface::class);
        $this->tokenInterface->method('getUser')->willReturn($this->user);
    }

    public function testConstruct ()
    {
        $addNewsTypeHandler = new AddNewsTypeHandler(
            $this->newsRepository,
            $this->fileUploaderHelper,
            $this->validator,
            $this->tokenStorage

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
            $this->validator,
            $this->tokenStorage
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

        $newNewsDTOMock = new NewNewsDTO(
            'alimentation',
            null,
            'bien nourrir ses perroquets'
        );

        $addNewsTypeHandler = new AddNewsTypeHandler(
            $this->newsRepository,
            $this->fileUploaderHelper,
            $this->validator,
            $this->tokenStorage
        );

        $formInterfaceMock->method('isValid')->willReturn(true);
        $formInterfaceMock->method('isSubmitted')->willReturn(true);
        $formInterfaceMock->method('getData')->willReturn($newNewsDTOMock);

        static::assertTrue(
            $addNewsTypeHandler->handle($formInterfaceMock)
        );
    }
}