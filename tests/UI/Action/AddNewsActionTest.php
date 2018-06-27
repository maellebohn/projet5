<?php

declare(strict_types=1);

namespace App\Tests\UI\Action;

use App\UI\Action\AddNewsAction;
use App\UI\Action\Interfaces\AddNewsActionInterface;
use App\UI\Form\Handler\Interfaces\AddNewsTypeHandlerInterface;
use App\UI\Responder\AddNewsResponder;
use Blackfire\Bridge\PhpUnit\TestCaseTrait;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

class AddNewsActionTest extends KernelTestCase
{
    use TestCaseTrait;

    /**
     * @var AddNewsTypeHandlerInterface
     */
    private $addNewsTypeHandler;

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
        $this->addNewsTypeHandler = $this->createMock(AddNewsTypeHandlerInterface::class);
        $this->router = $this->createMock(UrlGeneratorInterface::class);
        $this->router->method('generate')->willReturn('/addnews');
    }

    public function testConstruct()
    {
        $addNewsAction = new AddNewsAction(
            $this->formFactory,
            $this->addNewsTypeHandler
        );

        static::assertInstanceOf(
            AddNewsActionInterface::class,
            $addNewsAction
        );
    }

    /**
     * @group Blackfire
     */
    public function testWrongFormHandling()
    {
        $addNewsAction = new AddNewsAction(
            $this->formFactory,
            $this->addNewsTypeHandler
        );

        $this->addNewsTypeHandler->method('handle')->willReturn(false);
        $responder = new AddNewsResponder(
            $this->createMock(Environment::class),
            $this->router
        );

        $request = Request::create(
            '/addnews',
            'POST'
        );

        $probe = static::$blackfire->createProbe();

        $addNewsAction($request, $responder);

        static::$blackfire->endProbe($probe);


        static::assertInstanceOf(
            Response::class,
            $addNewsAction($request, $responder)
        );
    }

    public function testGoodFormHandling()
    {
        $addNewsAction = new AddNewsAction(
            $this->formFactory,
            $this->addNewsTypeHandler
        );

        $this->addNewsTypeHandler->method('handle')->willReturn(true);
        $responder = new AddNewsResponder(
            $this->createMock(Environment::class),
            $this->router
        );

        $request = Request::create(
            '/addnews',
            'POST'
        );

        static::assertInstanceOf(
            RedirectResponse::class,
            $addNewsAction($request, $responder)
        );
    }
}