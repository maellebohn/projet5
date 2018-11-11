<?php

declare(strict_types=1);

namespace App\Tests\UI\Form\Handler;

use App\Domain\DTO\UpdateNewsDTO;
use App\Domain\Models\Interfaces\NewsInterface;
use App\Repository\Interfaces\NewsRepositoryInterface;
use App\UI\Form\Handler\UpdateNewsTypeHandler;
use App\UI\Form\Handler\Interfaces\UpdateNewsTypeHandlerInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UpdateNewsTypeHandlerTest extends TestCase
{
    /**
     * @var NewsRepositoryInterface
     */
    private $newsRepository;

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
        $this->validator = $this->createMock(ValidatorInterface::class);
        $this->validator->method('validate')->willReturn([]);
    }

    public function testConstruct ()
    {
        $updateNewsTypeHandler = new UpdateNewsTypeHandler(
            $this->newsRepository,
            $this->validator
        );

        static::assertInstanceOf(
            UpdateNewsTypeHandlerInterface::class,
            $updateNewsTypeHandler
        );
    }

    public function testWrongHandlingProcess ()
    {
        $formInterfaceMock = $this->createMock(FormInterface::class);
        $newsInterfaceMock = $this->createMock(NewsInterface::class);

        $updateNewsTypeHandler = new UpdateNewsTypeHandler(
            $this->newsRepository,
            $this->validator
        );

        $formInterfaceMock->method('isValid')->willReturn(false);
        $formInterfaceMock->method('isSubmitted')->willReturn(false);

        static::assertFalse(
            $updateNewsTypeHandler->handle($formInterfaceMock, $newsInterfaceMock)
        );
    }

    public function testRightHandlingProcess ()
    {
        $formInterfaceMock = $this->createMock(FormInterface::class);
        $newsInterfaceMock = $this->createMock(NewsInterface::class);

        $updateNewsDTOMock = new UpdateNewsDTO(
            'alimentation',
            null,
            'bien nourrir ses perroquets'
        );

        $updateNewsTypeHandler = new UpdateNewsTypeHandler(
            $this->newsRepository,
            $this->validator
        );

        $formInterfaceMock->method('isValid')->willReturn(true);
        $formInterfaceMock->method('isSubmitted')->willReturn(true);
        $formInterfaceMock->method('getData')->willReturn($updateNewsDTOMock);

        static::assertTrue(
            $updateNewsTypeHandler->handle($formInterfaceMock, $newsInterfaceMock)
        );
    }
}