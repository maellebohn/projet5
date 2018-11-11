<?php

declare(strict_types=1);

namespace App\Tests\UI\Form\Handler;

use App\Domain\DTO\UpdateInfoDTO;
use App\Domain\Models\Interfaces\InfosInterface;
use App\Repository\Interfaces\InfosRepositoryInterface;
use App\UI\Form\Handler\UpdateInfoTypeHandler;
use App\UI\Form\Handler\Interfaces\UpdateInfoTypeHandlerInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UpdateInfoTypeHandlerTest extends TestCase
{
    /**
     * @var InfosRepositoryInterface
     */
    private $infosRepository;

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
        $this->validator = $this->createMock(ValidatorInterface::class);
        $this->validator->method('validate')->willReturn([]);
    }

    public function testConstruct ()
    {
        $updateInfoTypeHandler = new UpdateInfoTypeHandler(
            $this->infosRepository,
            $this->validator
        );

        static::assertInstanceOf(
            UpdateInfoTypeHandlerInterface::class,
            $updateInfoTypeHandler
        );
    }

    public function testWrongHandlingProcess ()
    {
        $formInterfaceMock = $this->createMock(FormInterface::class);
        $infoInterfaceMock = $this->createMock(InfosInterface::class);

        $updateInfoTypeHandler = new UpdateInfoTypeHandler(
            $this->infosRepository,
            $this->validator
        );

        $formInterfaceMock->method('isValid')->willReturn(false);
        $formInterfaceMock->method('isSubmitted')->willReturn(false);

        static::assertFalse(
            $updateInfoTypeHandler->handle($formInterfaceMock, $infoInterfaceMock)
        );
    }

    public function testRightHandlingProcess ()
    {
        $formInterfaceMock = $this->createMock(FormInterface::class);
        $infoInterfaceMock = $this->createMock(InfosInterface::class);

        $updateInfoDTOMock = new UpdateInfoDTO(
            'alimentation',
            null,
            'alimentation',
            'bien nourrir ses perroquets'
        );

        $updateInfoTypeHandler = new UpdateInfoTypeHandler(
            $this->infosRepository,
            $this->validator
        );

        $formInterfaceMock->method('isValid')->willReturn(true);
        $formInterfaceMock->method('isSubmitted')->willReturn(true);
        $formInterfaceMock->method('getData')->willReturn($updateInfoDTOMock);

        static::assertTrue(
            $updateInfoTypeHandler->handle($formInterfaceMock, $infoInterfaceMock)
        );
    }
}