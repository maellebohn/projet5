<?php

declare(strict_types=1);

namespace App\Tests\UI\Action;

use App\Repository\Interfaces\BirdsRepositoryInterface;
use App\Repository\Interfaces\InfosRepositoryInterface;
use App\Repository\Interfaces\NewsRepositoryInterface;
use App\UI\Action\AdminAction;
use App\UI\Action\Interfaces\AdminActionInterface;
use App\UI\Responder\AdminResponder;
use App\UI\Responder\Interfaces\AdminResponderInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class AdminActionTest extends WebTestCase
{
    /**
     * @var InfosRepositoryInterface
     */
    private $infosRepository;

    /**
     * @var BirdsRepositoryInterface
     */
    private $birdsRepository;

    /**
     * @var NewsRepositoryInterface
     */
    private $newsRepository;

    /**
     *{@inheritdoc}
     */
    protected function setUp ()
    {
        $this->infosRepository = $this->createMock(InfosRepositoryInterface::class);
        $this->infosRepository->method('findAll')->willReturn([]);
        $this->newsRepository = $this->createMock(NewsRepositoryInterface::class);
        $this->newsRepository->method('findAll')->willReturn([]);
        $this->birdsRepository = $this->createMock(BirdsRepositoryInterface::class);
        $this->birdsRepository->method('findAll')->willReturn([]);
    }

    public function testConstruct()
    {
        $adminAction = new AdminAction(
            $this->infosRepository,
            $this->birdsRepository,
            $this->newsRepository
        );

        static::assertInstanceOf(
            AdminActionInterface::class,
            $adminAction
        );
    }

    /**
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function testAdminView()
    {
        $adminAction = new AdminAction(
            $this->infosRepository,
            $this->birdsRepository,
            $this->newsRepository
        );

        $responder = new AdminResponder($this->createMock(Environment::class));

        static::assertInstanceOf(
            Response::class,
            $adminAction($responder)
        );
    }
}