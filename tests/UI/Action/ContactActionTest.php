<?php

declare(strict_types=1);

namespace App\Tests\UI\Action;

use App\UI\Action\ContactAction;
use App\UI\Action\Interfaces\ContactActionInterface;
use App\UI\Form\Handler\Interfaces\ContactTypeHandlerInterface;
use App\UI\Responder\ContactResponder;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Twig\Environment;

class ContactActionTest extends KernelTestCase
{
    /**
     * @var ContactTypeHandlerInterface
     */
    private $contactTypeHandler;

    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     *{@inheritdoc}
     */
    public function setUp ()
    {
        static::bootKernel();

        $this->formFactory = static::$kernel->getContainer()->get('form.factory');
        $this->contactTypeHandler = $this->createMock(ContactTypeHandlerInterface::class);
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

    public function testWrongFormHandling()
    {
        $request = Request::create(
            '/contact',
            'POST'
        );

        $this->contactTypeHandler->method('handle')->willReturn(false);
        $responder = new ContactResponder(
            $this->createMock(Environment::class)
        );


        $contactAction = new ContactAction(
            $this->formFactory,
            $this->contactTypeHandler
        );

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
            $this->createMock(Environment::class)
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