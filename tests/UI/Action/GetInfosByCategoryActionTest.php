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
     *{@inheritdoc}
     */
    protected function setUp ()
    {
        $this->infosRepository = $this->createMock(InfosRepositoryInterface::class);
        $this->infosRepository->method('findBy')->willReturn([]);
    }

    public function testConstruct()
    {
        $getInfosByCategoryAction = new GetInfosByCategoryAction($this->infosRepository);

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
    public function testInfosByCategoryPageView()
    {
        $getInfosByCategoryAction = new GetInfosByCategoryAction($this->infosRepository);

        $responder = new GetInfosByCategoryResponder($this->createMock(Environment::class));

        $requestMock = $this->createMock(Request::class);

        static::assertInstanceOf(
            Response::class,
            $getInfosByCategoryAction($requestMock, $responder)
        );
    }
}