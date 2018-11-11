<?php

declare(strict_types=1);

namespace App\Tests\UI\Form\Handler;

use App\Domain\DTO\NewInfoDTO;
use App\Domain\Models\Interfaces\UsersInterface;
use App\Helper\Interfaces\FileUploaderHelperInterface;
use App\Repository\Interfaces\InfosRepositoryInterface;
use App\UI\Form\Handler\AddInfoTypeHandler;
use App\UI\Form\Handler\Interfaces\AddInfoTypeHandlerInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
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
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * @var TokenInterface
     */
    private $tokenInterface;

    /**
     * @var UsersInterface
     */
    private $user;

    /**
     *{@inheritdoc}
     */
    protected function setUp ()
    {
        $this->infosRepository = $this->createMock(InfosRepositoryInterface::class);
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
        $addInfoTypeHandler = new AddInfoTypeHandler(
            $this->infosRepository,
            $this->fileUploaderHelper,
            $this->validator,
            $this->tokenStorage
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
            $this->validator,
            $this->tokenStorage
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

        $newInfoDTOMock = new NewInfoDTO(
            'alimentation',
            'education',
            'bien nourrir ses perroquets',
            null

        );

        $addInfoTypeHandler = new AddInfoTypeHandler(
            $this->infosRepository,
            $this->fileUploaderHelper,
            $this->validator,
            $this->tokenStorage
        );

        $formInterfaceMock->method('isValid')->willReturn(true);
        $formInterfaceMock->method('isSubmitted')->willReturn(true);
        $formInterfaceMock->method('getData')->willReturn($newInfoDTOMock);

        static::assertTrue(
            $addInfoTypeHandler->handle($formInterfaceMock)
        );
    }
}