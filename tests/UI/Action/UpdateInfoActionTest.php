<?php

declare(strict_types=1);

namespace App\Tests\UI\Action;

use App\Domain\Models\Interfaces\InfosInterface;
use App\Repository\Interfaces\InfosRepositoryInterface;
use App\UI\Action\UpdateInfoAction;
use App\UI\Action\Interfaces\UpdateInfoActionInterface;
use App\UI\Form\Handler\Interfaces\UpdateInfoTypeHandlerInterface;
use App\UI\Responder\UpdateInfoResponder;
use Blackfire\Bridge\PhpUnit\TestCaseTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

class UpdateInfoActionTest extends WebTestCase
{
    use TestCaseTrait;

    /**
     * @var UpdateInfoTypeHandlerInterface
     */
    private $updateInfoTypeHandler;

    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var UrlGeneratorInterface
     */
    private $router;

    /**
     * @var InfosRepositoryInterface
     */
    private $infosRepository;

    /**
     * @var InfosInterface
     */
    private $info;

    /**
     *{@inheritdoc}
     */
    protected function setUp ()
    {
        $this->formFactory = $this->createMock(FormFactoryInterface::class);
        $this->updateInfoTypeHandler = $this->createMock(UpdateInfoTypeHandlerInterface::class);
        $this->router = $this->createMock(UrlGeneratorInterface::class);
        $this->router->method('generate')->willReturn('/admin');
        $this->infosRepository = $this->createMock(InfosRepositoryInterface::class);
        $this->info = $this->createMock(InfosInterface::class);
        $this->infosRepository->method('findOneBy')->willReturn($this->info);
        $this->info->method('getTitle')->willReturn('alimentation');
        $this->info->method('getImage')->willReturn(null);
        $this->info->method('getCategory')->willReturn('education');
        $this->info->method('getContent')->willReturn('bien nourrir ses perroquets');
    }

    public function testConstruct()
    {
        $updateInfoAction = new UpdateInfoAction(
            $this->infosRepository,
            $this->formFactory,
            $this->updateInfoTypeHandler
        );

        static::assertInstanceOf(
            UpdateInfoActionInterface::class,
            $updateInfoAction
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

        $updateInfoAction = new UpdateInfoAction(
            $this->infosRepository,
            $this->formFactory,
            $this->updateInfoTypeHandler
        );

        $this->updateInfoTypeHandler->method('handle')->willReturn(false);
        $responder = new UpdateInfoResponder(
            $this->createMock(Environment::class),
            $this->router
        );

        $request = Request::create('/updateinfo/1e1796b3-8e1a-452e-85d5-2b0248ed3cde', 'GET');
        $requestMock = $request->duplicate([],[],['id' => '1e1796b3-8e1a-452e-85d5-2b0248ed3cde']);

        $probe = static::$blackfire->createProbe();

        $updateInfoAction($requestMock, $responder);

        static::$blackfire->endProbe($probe);


        static::assertInstanceOf(
            Response::class,
            $updateInfoAction($requestMock, $responder)
        );
    }

    public function testGoodFormHandling()
    {
        $formInterfaceMock = $this->createMock(FormInterface::class);
        $formInterfaceMock->method('handleRequest')->willReturnSelf();
        $this->formFactory->method('create')->willReturn($formInterfaceMock);

        $updateInfoAction = new UpdateInfoAction(
            $this->infosRepository,
            $this->formFactory,
            $this->updateInfoTypeHandler
        );

        $this->updateInfoTypeHandler->method('handle')->willReturn(true);
        $responder = new UpdateInfoResponder(
            $this->createMock(Environment::class),
            $this->router
        );

        $request = Request::create('/updateinfo/1e1796b3-8e1a-452e-85d5-2b0248ed3cde', 'GET');
        $requestMock = $request->duplicate([],[],['id' => '1e1796b3-8e1a-452e-85d5-2b0248ed3cde']);

        static::assertInstanceOf(
            RedirectResponse::class,
            $updateInfoAction($requestMock, $responder)
        );
    }
}