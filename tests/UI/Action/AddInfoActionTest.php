<?php

declare(strict_types=1);

namespace App\Tests\UI\Action;

use App\UI\Action\AddInfoAction;
use App\UI\Action\Interfaces\AddInfoActionInterface;
use App\UI\Form\Handler\Interfaces\AddInfoTypeHandlerInterface;
use App\UI\Responder\AddInfoResponder;
use Blackfire\Bridge\PhpUnit\TestCaseTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

class AddInfoActionTest extends WebTestCase
{
    use TestCaseTrait;

    /**
     * @var AddInfoTypeHandlerInterface
     */
    private $addInfoTypeHandler;

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
        $this->formFactory = $this->createMock(FormFactoryInterface::class);
        $this->addInfoTypeHandler = $this->createMock(AddInfoTypeHandlerInterface::class);
        $this->router = $this->createMock(UrlGeneratorInterface::class);
        $this->router->method('generate')->willReturn('/addinfo');
    }

    public function testConstruct()
    {
        $addInfoAction = new AddInfoAction(
            $this->formFactory,
            $this->addInfoTypeHandler
        );

        static::assertInstanceOf(
            AddInfoActionInterface::class,
            $addInfoAction
        );
    }

    /**
     * @group Blackfire
     */
    public function testWrongFormHandling()
    {
        $addInfoAction = new AddInfoAction(
            $this->formFactory,
            $this->addInfoTypeHandler
        );

        $this->addInfoTypeHandler->method('handle')->willReturn(false);
        $responder = new AddInfoResponder(
            $this->createMock(Environment::class),
            $this->router
        );

        $request = Request::create(
            '/addinfo',
            'POST'
        );

        $probe = static::$blackfire->createProbe();

        $addInfoAction($request, $responder);

        static::$blackfire->endProbe($probe);


        static::assertInstanceOf(
            Response::class,
            $addInfoAction($request, $responder)
        );
    }

    public function testGoodFormHandling()
    {
        $addInfoAction = new AddInfoAction(
            $this->formFactory,
            $this->addInfoTypeHandler
        );

        $this->addInfoTypeHandler->method('handle')->willReturn(true);
        $responder = new AddInfoResponder(
            $this->createMock(Environment::class),
            $this->router
        );

        $request = Request::create(
            '/addinfo',
            'POST'
        );

        static::assertInstanceOf(
            RedirectResponse::class,
            $addInfoAction($request, $responder)
        );
    }
}