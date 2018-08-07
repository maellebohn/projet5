<?php

declare(strict_types=1);

namespace App\Tests\UI\Form\Handler;

use App\Domain\DTO\NewBirdDTO;
use App\Repository\Interfaces\BirdsRepositoryInterface;
use App\UI\Form\Handler\AddBirdTypeHandler;
use App\UI\Form\Handler\Interfaces\AddBirdTypeHandlerInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class AddBirdTypeHandlerTest extends TestCase
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
    public function setUp ()
    {
        $this->birdsRepository = $this->createMock(BirdsRepositoryInterface::class);
        $this->validator = $this->createMock(ValidatorInterface::class);
        $this->validator->method('validate')->willReturn([]);
    }

    public function testConstruct ()
    {
        $addBirdTypeHandler = new AddBirdTypeHandler(
            $this->birdsRepository,
            $this->validator
        );

        static::assertInstanceOf(
            AddBirdTypeHandlerInterface::class,
            $addBirdTypeHandler
        );
    }

    public function testWrongHandlingProcess ()
    {
        $formInterfaceMock = $this->createMock(FormInterface::class);

        $addBirdTypeHandler = new AddBirdTypeHandler(
            $this->birdsRepository,
            $this->validator
        );

        $formInterfaceMock->method('isValid')->willReturn(false);
        $formInterfaceMock->method('isSubmitted')->willReturn(false);

        static::assertFalse(
            $addBirdTypeHandler->handle($formInterfaceMock)
        );
    }

    public function testRightHandlingProcess ()
    {
        $formInterfaceMock = $this->createMock(FormInterface::class);

        $newBirdDTOMock = new NewBirdDTO(
            'inoue',
            1530741600,
            200,
            'femelle'
        );

        $addBirdTypeHandler = new AddBirdTypeHandler(
            $this->birdsRepository,
            $this->validator
        );

        $formInterfaceMock->method('isValid')->willReturn(true);
        $formInterfaceMock->method('isSubmitted')->willReturn(true);
        $formInterfaceMock->method('getData')->willReturn($newBirdDTOMock);

        static::assertTrue(
            $addBirdTypeHandler->handle($formInterfaceMock)
        );
    }
}