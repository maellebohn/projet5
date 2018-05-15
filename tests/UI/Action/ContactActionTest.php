<?php

declare(strict_types=1);

namespace App\Tests\UI\Action;

use App\UI\Action\ContactAction;
use App\UI\Action\Interfaces\ContactActionInterface;
use App\UI\Form\Handler\Interfaces\ContactTypeHandlerInterface;
use App\UI\Responder\ContactResponder;
use Blackfire\Bridge\PhpUnit\TestCaseTrait;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

class ContactActionTest extends KernelTestCase
{
    use TestCaseTrait;

    /**
     * @var ContactTypeHandlerInterface
     */
    private $contactTypeHandler;

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
        $this->contactTypeHandler = $this->createMock(ContactTypeHandlerInterface::class);
        $this->router = $this->createMock(UrlGeneratorInterface::class);
        $this->router->method('generate')->willReturn('/contact');

    }

    public function testConstruct()
    {
        $contactAction = new ContactAction(
            $this->formFactory,
            $this->contactTypeHandler
        );

        static::assertInstanceOf(
            ContactActionInterface::class,
            $contactAction
        );
    }

    /**
     * @group Blackfire
     */
    public function testWrongFormHandling()
    {
        $contactAction = new ContactAction(
            $this->formFactory,
            $this->contactTypeHandler
        );

        $this->contactTypeHandler->method('handle')->willReturn(false);
        $responder = new ContactResponder(
            $this->createMock(Environment::class),
            $this->router
        );

        $request = Request::create(
            '/contact',
            'POST'
        );

        $probe = static::$blackfire->createProbe();

        $contactAction($request, $responder);

        static::$blackfire->endProbe($probe);


        static::assertInstanceOf(
            Response::class,
            $contactAction($request, $responder)
        );
    }

    public function testGoodFormHandling()
    {
        $contactAction = new ContactAction(
            $this->formFactory,
            $this->contactTypeHandler
        );

        $this->contactTypeHandler->method('handle')->willReturn(true);
        $responder = new ContactResponder(
            $this->createMock(Environment::class),
            $this->router
    );

        $request = Request::create(
            '/contact',
            'POST'
        );

        static::assertInstanceOf(
            RedirectResponse::class,
            $contactAction($request, $responder)
        );
    }
}