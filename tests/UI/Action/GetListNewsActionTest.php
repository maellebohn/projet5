<?php

declare(strict_types=1);

namespace App\Tests\UI\Action;

use App\Repository\Interfaces\NewsRepositoryInterface;
use App\UI\Action\GetListNewsAction;
use App\UI\Action\Interfaces\GetListNewsActionInterface;
use App\UI\Responder\GetListNewsResponder;
use App\UI\Responder\Interfaces\GetListNewsResponderInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class GetListNewsActionTest extends KernelTestCase
{
    /**
     * @var NewsRepositoryInterface
     */
    private $newsRepository;

    /**
     * @var GetListNewsResponderInterface
     */
    private $responder;

    /**
     *{@inheritdoc}
     */
    public function setUp ()
    {
        $this->newsRepository = $this->createMock(NewsRepositoryInterface::class);
        $this->newsRepository->method('findAll')->willReturn([]);
        $this->responder = new GetListNewsResponder($this->createMock(Environment::class));
    }

    public function testConstruct()
    {
        $getListNewsAction = new GetListNewsAction(
            $this->newsRepository,
            $this->responder
        );

        static::assertInstanceOf(
            GetListNewsActionInterface::class,
            $getListNewsAction
        );
    }

    public function testReservationView()
    {
        $getListNewsAction = new GetListNewsAction(
            $this->newsRepository,
            $this->responder
        );


        static::assertInstanceOf(
            Response::class,
            $getListNewsAction()
        );
    }
}