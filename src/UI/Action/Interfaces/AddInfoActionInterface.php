<?php

declare(strict_types=1);

namespace App\UI\Action\Interfaces;

use App\UI\Form\Handler\Interfaces\AddInfoTypeHandlerInterface;
use App\UI\Responder\Interfaces\AddInfoResponderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;

interface AddInfoActionInterface
{
    /**
     * AddInfoActionInterface constructor.
     *
     * @param FormFactoryInterface        $formFactory
     * @param AddInfoTypeHandlerInterface $addInfoTypeHandler
     */
    public function __construct(
        FormFactoryInterface $formFactory,
        AddInfoTypeHandlerInterface $addInfoTypeHandler
    );

    /**
     * @param Request                   $request
     * @param AddInfoResponderInterface $responder
     * @return mixed
     */
    public function __invoke(
        Request $request,
        AddInfoResponderInterface $responder
    );
}
