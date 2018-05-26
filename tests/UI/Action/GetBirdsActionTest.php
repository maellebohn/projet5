<?php

declare(strict_types=1);

namespace App\Tests\UI\Action;

use App\Repository\Interfaces\BirdsRepositoryInterface;
use App\UI\Action\GetBirdsAction;
use App\UI\Action\Interfaces\GetBirdsActionInterface;
use App\UI\Responder\GetBirdsResponder;
use App\UI\Responder\Interfaces\GetBirdsResponderInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class GetBirdsActionTest extends KernelTestCase
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
     *{@inheritdoc}
     */
    public function setUp ()
    {
        $this->birdsRepository = $this->createMock(BirdsRepositoryInterface::class);
        $this->birdsRepository->method('findAll')->willReturn([]);
        $this->responder = new GetBirdsResponder($this->createMock(Environment::class));
        ;
    }

    public function testConstruct()
    {
        $getBirdsAction = new GetBirdsAction(
            $this->birdsRepository,
            $this->responder
        );

        static::assertInstanceOf(
            GetBirdsActionInterface::class,
            $getBirdsAction
        );
    }

    public function testReservationView()
    {
        $getBirdsAction = new GetBirdsAction(
            $this->birdsRepository,
            $this->responder
        );


        static::assertInstanceOf(
            Response::class,
            $getBirdsAction()
        );
    }
}