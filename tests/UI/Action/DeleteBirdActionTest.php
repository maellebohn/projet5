<?php

declare(strict_types=1);

namespace App\Tests\UI\Action;

use App\Repository\Interfaces\BirdsRepositoryInterface;
use App\UI\Action\DeleteBirdAction;
use App\UI\Action\Interfaces\DeleteBirdActionInterface;
use App\UI\Responder\DeleteBirdResponder;
use App\UI\Responder\Interfaces\DeleteBirdResponderInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

class DeleteBirdActionTest extends WebTestCase
{
    /**
     * @var BirdsRepositoryInterface
     */
    private $birdsRepository;

    /**
     * @var DeleteBirdResponderInterface
     */
    private $responder;

    /**
     * @var UrlGeneratorInterface
     */
    private $router;

    /**
     *{@inheritdoc}
     */
    public function setUp ()
    {
        $this->birdsRepository = $this->createMock(BirdsRepositoryInterface::class);
        $this->birdsRepository->method('deleteById');
        $this->router = $this->createMock(UrlGeneratorInterface::class);
        $this->router->method('generate')->willReturn('/admin');
        $this->responder = new DeleteBirdResponder($this->createMock(Environment::class), $this->router);
    }
    //mocker responder
    //

    public function testConstruct()
    {
        $deleteBirdAction = new DeleteBirdAction(
            $this->birdsRepository,
            $this->responder
        );

        static::assertInstanceOf(
            DeleteBirdActionInterface::class,
            $deleteBirdAction
        );
    }

    public function testReservationView()
    {
        $deleteBirdAction = new DeleteBirdAction(
            $this->birdsRepository,
            $this->responder
        );


        static::assertInstanceOf(
            Response::class,
            $deleteBirdAction()
        );
    }
}