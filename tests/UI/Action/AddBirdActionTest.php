<?php

declare(strict_types=1);

namespace App\Tests\UI\Action;

use App\UI\Action\AddBirdAction;
use App\UI\Action\Interfaces\AddBirdActionInterface;
use App\UI\Form\Handler\Interfaces\AddBirdTypeHandlerInterface;
use App\UI\Responder\AddBirdResponder;
use Blackfire\Bridge\PhpUnit\TestCaseTrait;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

class AddBirdActionTest extends KernelTestCase
{
    use TestCaseTrait;

    /**
     * @var AddBirdTypeHandlerInterface
     */
    private $addBirdTypeHandler;

    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var UrlGeneratorInterface
     */
    private $router;

    /**
     *{@inheritdoc}
     */
    public function setUp ()
    {
        static::bootKernel();

        $this->formFactory = static::$kernel->getContainer()->get('form.factory');
        $this->addBirdTypeHandler = $this->createMock(AddBirdTypeHandlerInterface::class);
        $this->router = $this->createMock(UrlGeneratorInterface::class);
        $this->router->method('generate')->willReturn('/addbird');
    }

    public function testConstruct()
    {
        $addBirdAction = new AddBirdAction(
            $this->formFactory,
            $this->addBirdTypeHandler
        );

        static::assertInstanceOf(
            AddBirdActionInterface::class,
            $addBirdAction
        );
    }

    /**
     * @group Blackfire
     */
    public function testWrongFormHandling()
    {
        $addBirdAction = new AddBirdAction(
            $this->formFactory,
            $this->addBirdTypeHandler
        );

        $this->addBirdTypeHandler->method('handle')->willReturn(false);
        $responder = new AddBirdResponder(
            $this->createMock(Environment::class),
            $this->router
        );

        $request = Request::create(
            '/addbird',
            'POST'
        );

        $probe = static::$blackfire->createProbe();

        $addBirdAction($request, $responder);

        static::$blackfire->endProbe($probe);


        static::assertInstanceOf(
            Response::class,
            $addBirdAction($request, $responder)
        );
    }

    public function testGoodFormHandling()
    {
        $addBirdAction = new AddBirdAction(
            $this->formFactory,
            $this->addBirdTypeHandler
        );

        $this->addBirdTypeHandler->method('handle')->willReturn(true);
        $responder = new AddBirdResponder(
            $this->createMock(Environment::class),
            $this->router
        );

        $request = Request::create(
            '/addbird',
            'POST'
        );

        static::assertInstanceOf(
            RedirectResponse::class,
            $addBirdAction($request, $responder)
        );
    }
}