<?php

declare(strict_types=1);

namespace App\UI\Action\Interfaces;

use App\UI\Form\Handler\Interfaces\AddNewsTypeHandlerInterface;
use App\UI\Responder\Interfaces\AddNewsResponderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;

interface AddNewsActionInterface
{
    /**
     * AddNewsActionInterface constructor.
     *
     * @param FormFactoryInterface        $formFactory
     * @param AddNewsTypeHandlerInterface $addNewsTypeHandler
     */
    public function __construct(
        FormFactoryInterface $formFactory,
        AddNewsTypeHandlerInterface $addNewsTypeHandler
    );

    /**
     * @param Request                   $request
     * @param AddNewsResponderInterface $responder
     *
     * @return mixed
     */
    public function __invoke(
        Request $request,
        AddNewsResponderInterface $responder
    );
}
