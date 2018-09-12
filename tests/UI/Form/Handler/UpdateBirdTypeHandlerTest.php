<?php

declare(strict_types=1);

namespace App\Tests\UI\Form\Handler;

use App\Domain\DTO\UpdateBirdDTO;
use App\Domain\Models\Interfaces\BirdsInterface;
use App\Repository\Interfaces\BirdsRepositoryInterface;
use App\UI\Form\Handler\UpdateBirdTypeHandler;
use App\UI\Form\Handler\Interfaces\UpdateBirdTypeHandlerInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UpdateBirdTypeHandlerTest extends TestCase
{
    /**
     * @var BirdsRepositoryInterface
     */
    private $birdsRepository;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     *{@inheritdoc}
     */
    protected function setUp ()
    {
        $this->birdsRepository = $this->createMock(BirdsRepositoryInterface::class);
        $this->validator = $this->createMock(ValidatorInterface::class);
        $this->validator->method('validate')->willReturn([]);
    }

    public function testConstruct ()
    {
        $updateBirdTypeHandler = new UpdateBirdTypeHandler(
            $this->birdsRepository,
            $this->validator
        );

        static::assertInstanceOf(
            UpdateBirdTypeHandlerInterface::class,
            $updateBirdTypeHandler
        );
    }

    public function testWrongHandlingProcess ()
    {
        $formInterfaceMock = $this->createMock(FormInterface::class);
        $birdInterfaceMock = $this->createMock(BirdsInterface::class);

        $updateBirdTypeHandler = new UpdateBirdTypeHandler(
            $this->birdsRepository,
            $this->validator
        );

        $formInterfaceMock->method('isValid')->willReturn(false);
        $formInterfaceMock->method('isSubmitted')->willReturn(false);

        static::assertFalse(
            $updateBirdTypeHandler->handle($formInterfaceMock, $birdInterfaceMock)
        );
    }

    public function testRightHandlingProcess ()
    {
        $formInterfaceMock = $this->createMock(FormInterface::class);
        $birdInterfaceMock = $this->createMock(BirdsInterface::class);

        $updateBirdDTOMock = new UpdateBirdDTO(
            'inoue',
            1530741600,
            200,
            'femelle'
        );

        $updateBirdTypeHandler = new UpdateBirdTypeHandler(
            $this->birdsRepository,
            $this->validator
        );

        $formInterfaceMock->method('isValid')->willReturn(true);
        $formInterfaceMock->method('isSubmitted')->willReturn(true);
        $formInterfaceMock->method('getData')->willReturn($updateBirdDTOMock);

        static::assertTrue(
            $updateBirdTypeHandler->handle($formInterfaceMock, $birdInterfaceMock)
        );
    }
}