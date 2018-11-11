<?php

declare(strict_types=1);

namespace App\Tests\UI\Action;

use App\Repository\Interfaces\InfosRepositoryInterface;
use App\UI\Action\GetInfoAction;
use App\UI\Action\Interfaces\GetInfoActionInterface;
use App\UI\Responder\GetInfoResponder;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Twig\Environment;

class GetInfoActionTest extends WebTestCase
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
        $this->infosRepository->method('findOneBy');
    }

    public function testConstruct()
    {
        $getInfoAction = new GetInfoAction($this->infosRepository);

        static::assertInstanceOf(
            GetInfoActionInterface::class,
            $getInfoAction
        );
    }

    /**
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function testGetInfoView()
    {
        $getInfoAction = new GetInfoAction($this->infosRepository);

        $responder = new GetInfoResponder($this->createMock(Environment::class));

        $request = Request::create('/info/1e1796b3-8e1a-452e-85d5-2b0248ed3cde', 'GET');
        $requestMock = $request->duplicate();

        static::assertInstanceOf(
            Response::class,
            $getInfoAction($requestMock, $responder)
        );
    }
}