<?php

namespace App\UI\Action;

use App\UI\Action\Interfaces\ContactActionInterface;
use App\UI\Responder\Interfaces\ContactResponderInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormFactoryInterface;
use App\UI\Form\Type\ContactType;
use App\UI\Form\Handler\Interfaces\ContactTypeHandlerInterface;
use App\UI\Form\Handler\ContactTypeHandler;

/**
* @Route(
  *    path="/contact"
  * )
**/

class ContactAction implements ContactActionInterface
{
    private $formFactory;

    private $contactTypeHandler;

    public function __construct(
        FormFactoryInterface $formFactory,
        ContactTypeHandlerInterface $contactTypeHandler
    ) {
        $this->formFactory = $formFactory;
        $this->contactTypeHandler = $contactTypeHandler;
    }

    public function __invoke(Request $request, ContactResponderInterface $responder)
    {
        $contactType = $this->formFactory->create(ContactType::class)
                                         ->handleRequest($request);

        if($this->contactTypeHandler->handle($contactType)) {
            return $responder(true);
        }

        return $responder(false, $contactType);
    }
}
