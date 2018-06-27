<?php

declare(strict_types=1);

namespace App\UI\Action\Interfaces;

use App\Repository\Interfaces\BirdsRepositoryInterface;
use App\UI\Form\Handler\Interfaces\UpdateBirdTypeHandlerInterface;
use App\UI\Responder\Interfaces\UpdateBirdResponderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;

interface UpdateBirdActionInterface
{
    /**
     * UpdateBirdAction constructor.
     *
     * @param BirdsRepositoryInterface       $birdsRepository
     * @param FormFactoryInterface           $formFactory
     * @param UpdateBirdTypeHandlerInterface $updateBirdTypeHandler
     */
    public function __construct (
        BirdsRepositoryInterface $birdsRepository,
        FormFactoryInterface $formFactory,
        UpdateBirdTypeHandlerInterface $updateBirdTypeHandler
    );

    /**
     * @param Request $request
     * @param UpdateBirdResponderInterface $responder
     * @return mixed
     */
    public function __invoke(
        Request $request,
        UpdateBirdResponderInterface $responder
    );
}
