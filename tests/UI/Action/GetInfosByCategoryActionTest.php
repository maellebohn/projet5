<?php

declare(strict_types=1);

namespace App\Tests\UI\Action;

use App\Repository\Interfaces\InfosRepositoryInterface;
use App\UI\Action\GetInfosByCategoryAction;
use App\UI\Action\Interfaces\GetInfosByCategoryActionInterface;
use App\UI\Responder\GetInfosByCategoryResponder;
use App\UI\Responder\Interfaces\GetInfosByCategoryResponderInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class GetInfosByCategoryActionTest extends WebTestCase
{
    /**
     * @var InfosRepositoryInterface
     */
    private $infosRepository;

    /**
     * @var GetInfosByCategoryResponderInterface
     */
    private $responder;

    /**
     *{@inheritdoc}
     */
    public function setUp ()
    {
        $this->infosRepository = $this->createMock(InfosRepositoryInterface::class);
        $this->infosRepository->method('findBy')->willReturn([]);
        $this->responder = new GetInfosByCategoryResponder($this->createMock(Environment::class));
    }

    public function testConstruct()
    {
        $getInfosByCategoryAction = new GetInfosByCategoryAction(
            $this->infosRepository,
            $this->responder
        );

        static::assertInstanceOf(
            GetInfosByCategoryActionInterface::class,
            $getInfosByCategoryAction
        );
    }

    /**
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function testReservationView()
    {
        $getInfosByCategoryAction = new GetInfosByCategoryAction(
            $this->infosRepository,
            $this->responder
        );

        $request = Request::create(
            '/conseils/{category}',
            'GET'
        );

        static::assertInstanceOf(
            Response::class,
            $getInfosByCategoryAction($request)
        );
    }
}