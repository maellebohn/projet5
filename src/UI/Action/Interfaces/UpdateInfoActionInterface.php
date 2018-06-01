<?php

declare(strict_types=1);

namespace App\UI\Action\Interfaces;

use App\Repository\Interfaces\InfosRepositoryInterface;
use App\UI\Form\Handler\Interfaces\UpdateInfoTypeHandlerInterface;
use App\UI\Responder\Interfaces\UpdateInfoResponderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;

interface UpdateInfoActionInterface
{
    /**
     * UpdateInfoAction constructor.
     *
     * @param InfosRepositoryInterface       $infosRepository
     * @param FormFactoryInterface           $formFactory
     * @param UpdateInfoTypeHandlerInterface $updateInfoTypeHandler
     */
    public function __construct (
        InfosRepositoryInterface $infosRepository,
        FormFactoryInterface $formFactory,
        UpdateInfoTypeHandlerInterface $updateInfoTypeHandler
    );

    /**
     * @param Request $request
     * @param UpdateInfoResponderInterface $responder
     * @return mixed
     */
    public function __invoke(
        Request $request,
        UpdateInfoResponderInterface $responder
    );
}
