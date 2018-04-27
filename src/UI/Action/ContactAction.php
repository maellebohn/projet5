<?php

declare(strict_types=1);

namespace App\UI\Action;

use App\UI\Action\Interfaces\ContactActionInterface;
use App\UI\Form\Handler\Interfaces\ContactTypeHandlerInterface;
use App\UI\Form\Type\ContactType;
use App\UI\Responder\Interfaces\ContactResponderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route(
 *     path="/contact",
 *     name="contact"
 * )
 */

class ContactAction implements ContactActionInterface
{
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var ContactTypeHandlerInterface
     */
    private $contactTypeHandler;

    public function __construct(
        FormFactoryInterface $formFactory,
        ContactTypeHandlerInterface $contactTypeHandler
    ) {
        $this->formFactory = $formFactory;
        $this->contactTypeHandler = $contactTypeHandler;
    }

    /**
     * @param Request $request
     * @param ContactResponderInterface $responder
     * @return mixed
     */
    public function __invoke(Request $request, ContactResponderInterface $responder)
    {
        $contactType = $this->formFactory->create(ContactType::class)
                                         ->handleRequest($request);

        if($this->contactTypeHandler->handle($contactType)) {
            //$this->eventDispatcher->dispatch(ContactForm::Name,
            return $responder(true);
        }

        return $responder(false, $contactType);
    }
}
