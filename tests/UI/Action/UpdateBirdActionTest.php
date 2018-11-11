<?php

declare(strict_types=1);

namespace App\Tests\UI\Action;

use App\Domain\Models\Interfaces\BirdsInterface;
use App\Repository\Interfaces\BirdsRepositoryInterface;
use App\UI\Action\UpdateBirdAction;
use App\UI\Action\Interfaces\UpdateBirdActionInterface;
use App\UI\Form\Handler\Interfaces\UpdateBirdTypeHandlerInterface;
use App\UI\Responder\UpdateBirdResponder;
use Blackfire\Bridge\PhpUnit\TestCaseTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

class UpdateBirdActionTest extends WebTestCase
{
    use TestCaseTrait;

    /**
     * @var UpdateBirdTypeHandlerInterface
     */
    private $updateBirdTypeHandler;

    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var UrlGeneratorInterface
     */
    private $router;

    /**
     * @var BirdsRepositoryInterface
     */
    private $birdsRepository;

    /**
     * @var BirdsInterface
     */
    private $bird;

    /**
     * @var \DateTimeInterface
     */
    private $date;

    /**
     *{@inheritdoc}
     */
    protected function setUp ()
    {
        $this->formFactory = $this->createMock(FormFactoryInterface::class);
        $this->updateBirdTypeHandler = $this->createMock(UpdateBirdTypeHandlerInterface::class);
        $this->router = $this->createMock(UrlGeneratorInterface::class);
        $this->router->method('generate')->willReturn('/admin');
        $this->birdsRepository = $this->createMock(BirdsRepositoryInterface::class);
        $this->bird = $this->createMock(BirdsInterface::class);
        $this->birdsRepository->method('findOneBy')->willReturn($this->bird);
        $this->bird->method('getName')->willReturn('inoue');
        $this->bird->method('getBirthdate')->willReturn(new \DateTime('2018-03-05'));
        $this->bird->method('getPrice')->willReturn(200);
        $this->bird->method('getDescription')->willReturn('femelle');
    }

    public function testConstruct()
    {
        $updateBirdAction = new UpdateBirdAction(
            $this->birdsRepository,
            $this->formFactory,
            $this->updateBirdTypeHandler
        );

        static::assertInstanceOf(
            UpdateBirdActionInterface::class,
            $updateBirdAction
        );
    }

    /**
     * @group Blackfire
     */
    public function testWrongFormHandling()
    {
        $formInterfaceMock = $this->createMock(FormInterface::class);
        $formInterfaceMock->method('handleRequest')->willReturnSelf();
        $this->formFactory->method('create')->willReturn($formInterfaceMock);

        $updateBirdAction = new UpdateBirdAction(
            $this->birdsRepository,
            $this->formFactory,
            $this->updateBirdTypeHandler
        );

        $this->updateBirdTypeHandler->method('handle')->willReturn(false);

        $responder = new UpdateBirdResponder(
            $this->createMock(Environment::class),
            $this->router
        );

        $request = Request::create('/updatebird/1e1796b3-8e1a-452e-85d5-2b0248ed3cde', 'GET');
        $requestMock = $request->duplicate([],[],['id' => '1e1796b3-8e1a-452e-85d5-2b0248ed3cde']);

        $probe = static::$blackfire->createProbe();

        $updateBirdAction($requestMock, $responder);

        static::$blackfire->endProbe($probe);


        static::assertInstanceOf(
            Response::class,
            $updateBirdAction($requestMock, $responder)
        );
    }

    public function testGoodFormHandling()
    {
        $formInterfaceMock = $this->createMock(FormInterface::class);
        $formInterfaceMock->method('handleRequest')->willReturnSelf();
        $this->formFactory->method('create')->willReturn($formInterfaceMock);

        $updateBirdAction = new UpdateBirdAction(
            $this->birdsRepository,
            $this->formFactory,
            $this->updateBirdTypeHandler
        );

        $this->updateBirdTypeHandler->method('handle')->willReturn(true);

        $responder = new UpdateBirdResponder(
            $this->createMock(Environment::class),
            $this->router
        );

        $request = Request::create('/updatebird/1e1796b3-8e1a-452e-85d5-2b0248ed3cde', 'GET');
        $requestMock = $request->duplicate([],[],['id' => '1e1796b3-8e1a-452e-85d5-2b0248ed3cde']);

        static::assertInstanceOf(
            RedirectResponse::class,
            $updateBirdAction($requestMock, $responder)
        );
    }
}