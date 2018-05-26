<?php

declare(strict_types=1);

namespace App\Tests\UI\Action;

use App\Repository\Interfaces\InfosRepositoryInterface;
use App\UI\Action\GetListInfosAction;
use App\UI\Action\Interfaces\GetListInfosActionInterface;
use App\UI\Responder\GetListInfosResponder;
use App\UI\Responder\Interfaces\GetListInfosResponderInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class GetListInfosActionTest extends KernelTestCase
{
    /**
     * @var InfosRepositoryInterface
     */
    private $infosRepository;

    /**
     * @var GetListInfosResponderInterface
     */
    private $responder;

    /**
     *{@inheritdoc}
     */
    public function setUp ()
    {
        $this->infosRepository = $this->createMock(InfosRepositoryInterface::class);
        $this->infosRepository->method('findAll')->willReturn([]);
        $this->responder = new GetListInfosResponder($this->createMock(Environment::class));
        ;
    }

    public function testConstruct()
    {
        $getListInfosAction = new GetListInfosAction(
            $this->infosRepository,
            $this->responder
        );

        static::assertInstanceOf(
            GetListInfosActionInterface::class,
            $getListInfosAction
        );
    }

    public function testReservationView()
    {
        $getListInfosAction = new GetListInfosAction(
            $this->infosRepository,
            $this->responder
        );


        static::assertInstanceOf(
            Response::class,
            $getListInfosAction()
        );
    }
}