<?php

declare(strict_types=1);

namespace App\Tests\UI\Action;

use App\Domain\Models\Interfaces\BirdsInterface;
use App\Repository\Interfaces\BirdsRepositoryInterface;
use App\UI\Action\DeleteReservationAction;
use App\UI\Action\Interfaces\DeleteReservationActionInterface;
use App\UI\Responder\DeleteReservationResponder;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

class DeleteReservationActionTest extends WebTestCase
{
    /**
     * @var BirdsRepositoryInterface
     */
    private $birdsRepository;

    /**
     * @var UrlGeneratorInterface
     */
    private $router;

    /**
     * @var BirdsInterface
     */
    private $bird;

    /**
     *{@inheritdoc}
     */
    protected function setUp ()
    {
        $this->birdsRepository = $this->createMock(BirdsRepositoryInterface::class);
        $this->router = $this->createMock(UrlGeneratorInterface::class);
        $this->router->method('generate')->willReturn('/admin');
        $this->bird = $this->createMock(BirdsInterface::class);
        $this->birdsRepository->method('findOneBy')->willReturn($this->bird);
        $this->bird->method('deleteReservation');
    }

    public function testConstruct()
    {
        $deleteReservationAction = new DeleteReservationAction($this->birdsRepository);

        static::assertInstanceOf(
            DeleteReservationActionInterface::class,
            $deleteReservationAction
        );
    }

    public function testAfterDeleteAdminView()
    {
        $deleteReservationAction = new DeleteReservationAction($this->birdsRepository);

        $responder = new DeleteReservationResponder(
            $this->createMock(Environment::class),
            $this->router
        );

        $request = Request::create('/deletereservation/1e1796b3-8e1a-452e-85d5-2b0248ed3cde', 'GET');
        $requestMock = $request->duplicate([],[],['id' => '1e1796b3-8e1a-452e-85d5-2b0248ed3cde']);

        static::assertInstanceOf(
            Response::class,
            $deleteReservationAction($requestMock, $responder)
        );
    }
}