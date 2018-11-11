<?php

declare(strict_types=1);

namespace App\Tests\UI\Action;

use App\Repository\Interfaces\BirdsRepositoryInterface;
use App\UI\Action\GetBirdsAction;
use App\UI\Action\Interfaces\GetBirdsActionInterface;
use App\UI\Form\Handler\Interfaces\ReservationTypeHandlerInterface;
use App\UI\Responder\GetBirdsResponder;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

class GetBirdsActionTest extends WebTestCase
{
    /**
     * @var BirdsRepositoryInterface
     */
    private $birdsRepository;

    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var ReservationTypeHandlerInterface
     */
    private $reservationTypeHandler;

    /**
     * @var UrlGeneratorInterface
     */
    private $router;

    /**
     *{@inheritdoc}
     */
    protected function setUp ()
    {
        $this->formFactory = $this->createMock(FormFactoryInterface::class);
        $this->birdsRepository = $this->createMock(BirdsRepositoryInterface::class);
        $this->birdsRepository->method('findAll')->willReturn([]);
        $this->reservationTypeHandler = $this->createMock(ReservationTypeHandlerInterface::class);
        $this->router = $this->createMock(UrlGeneratorInterface::class);
        $this->router->method('generate')->willReturn('/reservation');
    }

    public function testConstruct()
    {
        $getBirdsAction = new GetBirdsAction(
            $this->birdsRepository,
            $this->formFactory,
            $this->reservationTypeHandler
        );

        static::assertInstanceOf(
            GetBirdsActionInterface::class,
            $getBirdsAction
        );
    }

    /**
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function testWrongFormHandling()
    {
        $formInterfaceMock = $this->createMock(FormInterface::class);
        $formInterfaceMock->method('handleRequest')->willReturnSelf();
        $this->formFactory->method('create')->willReturn($formInterfaceMock);

        $getBirdsAction = new GetBirdsAction(
            $this->birdsRepository,
            $this->formFactory,
            $this->reservationTypeHandler
        );

        $this->reservationTypeHandler->method('handle')->willReturn(false);

        $responder = new GetBirdsResponder($this->createMock(Environment::class), $this->router);

        $requestMock = $this->createMock(Request::class);

        static::assertInstanceOf(
            Response::class,
            $getBirdsAction($requestMock, $responder)
        );
    }

    /**
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function testGoodFormHandling()
    {
        $formInterfaceMock = $this->createMock(FormInterface::class);
        $formInterfaceMock->method('handleRequest')->willReturnSelf();
        $this->formFactory->method('create')->willReturn($formInterfaceMock);

        $getBirdsAction = new GetBirdsAction(
            $this->birdsRepository,
            $this->formFactory,
            $this->reservationTypeHandler
        );

        $this->reservationTypeHandler->method('handle')->willReturn(true);

        $responder = new GetBirdsResponder(
            $this->createMock(Environment::class),
            $this->router
        );

        $requestMock = $this->createMock(Request::class);

        static::assertInstanceOf(
            Response::class,
            $getBirdsAction($requestMock, $responder)
        );
    }
}