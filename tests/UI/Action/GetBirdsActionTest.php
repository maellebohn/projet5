<?php

declare(strict_types=1);

namespace App\Tests\UI\Action;

use App\Repository\Interfaces\BirdsRepositoryInterface;
use App\UI\Action\GetBirdsAction;
use App\UI\Action\Interfaces\GetBirdsActionInterface;
use App\UI\Form\Handler\Interfaces\ReservationTypeHandlerInterface;
use App\UI\Responder\GetBirdsResponder;
use App\UI\Responder\Interfaces\GetBirdsResponderInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Form\FormFactoryInterface;
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
     * @var GetBirdsResponderInterface
     */
    private $responder;

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
    public function setUp ()
    {
        $this->formFactory = $this->createMock(FormFactoryInterface::class);
        $this->birdsRepository = $this->createMock(BirdsRepositoryInterface::class);
        $this->birdsRepository->method('findAll')->willReturn([]);
        $this->router = $this->createMock(UrlGeneratorInterface::class);
        $this->router->method('generate')->willReturn('/reservation');
        $this->responder = new GetBirdsResponder($this->createMock(Environment::class), $this->router);
        $this->reservationTypeHandler = $this->createMock(ReservationTypeHandlerInterface::class);
    }

    public function testConstruct()
    {
        $getBirdsAction = new GetBirdsAction(
            $this->birdsRepository,
            $this->responder,
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
        $getBirdsAction = new GetBirdsAction(
            $this->birdsRepository,
            $this->responder,
            $this->formFactory,
            $this->reservationTypeHandler
        );

        $this->reservationTypeHandler->method('handle')->willReturn(false);

        $request = Request::create(
            '/reservation',
            'POST'
        );

        static::assertInstanceOf(
            Response::class,
            $getBirdsAction($request)
        );
    }

    /**
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function testGoodFormHandling()
    {
        $getBirdsAction = new GetBirdsAction(
            $this->birdsRepository,
            $this->responder,
            $this->formFactory,
            $this->reservationTypeHandler
        );

        $this->reservationTypeHandler->method('handle')->willReturn(true);

        $request = Request::create(
            '/reservation',
            'POST'
        );

        static::assertInstanceOf(
            Response::class,
            $getBirdsAction($request)
        );
    }
}