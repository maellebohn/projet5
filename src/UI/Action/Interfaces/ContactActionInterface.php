<?php

declare(strict_types=1);

namespace App\UI\Action\Interfaces;

use App\UI\Form\Handler\Interfaces\ContactTypeHandlerInterface;
use App\UI\Responder\Interfaces\ContactResponderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;

interface ContactActionInterface
{
    /**
     * ContactAction constructor.
     *
     * @param FormFactoryInterface        $formFactory
     * @param ContactTypeHandlerInterface $contactTypeHandler
     */
    public function __construct(
        FormFactoryInterface $formFactory,
        ContactTypeHandlerInterface $contactTypeHandler
    );

    /**
     * @param Request                   $request
     * @param ContactResponderInterface $responder
     * @return mixed
     */
    public function __invoke(
        Request $request,
        ContactResponderInterface $responder
    );
}
