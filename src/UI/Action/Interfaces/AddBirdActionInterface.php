<?php

declare(strict_types=1);

namespace App\UI\Action\Interfaces;

use App\UI\Form\Handler\Interfaces\AddBirdTypeHandlerInterface;
use App\UI\Responder\Interfaces\AddBirdResponderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;

interface AddBirdActionInterface
{
    /**
     * AddBirdActionInterface constructor.
     *
     * @param FormFactoryInterface        $formFactory
     * @param AddBirdTypeHandlerInterface $addBirdTypeHandler
     */
    public function __construct(
        FormFactoryInterface $formFactory,
        AddBirdTypeHandlerInterface $addBirdTypeHandler
    );

    /**
     * @param Request                   $request
     * @param AddBirdResponderInterface $responder
     *
     * @return mixed
     */
    public function __invoke(
        Request $request,
        AddBirdResponderInterface $responder
    );
}
