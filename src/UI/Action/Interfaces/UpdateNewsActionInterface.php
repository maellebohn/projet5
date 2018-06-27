<?php

declare(strict_types=1);

namespace App\UI\Action\Interfaces;

use App\Repository\Interfaces\NewsRepositoryInterface;
use App\UI\Form\Handler\Interfaces\UpdateNewsTypeHandlerInterface;
use App\UI\Responder\Interfaces\UpdateNewsResponderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;

interface UpdateNewsActionInterface
{
    /**
     * UpdateNewsAction constructor.
     *
     * @param NewsRepositoryInterface        $newsRepository
     * @param FormFactoryInterface           $formFactory
     * @param UpdateNewsTypeHandlerInterface $updateNewsTypeHandler
     */
    public function __construct (
        NewsRepositoryInterface $newsRepository,
        FormFactoryInterface $formFactory,
        UpdateNewsTypeHandlerInterface $updateNewsTypeHandler
    );

    /**
     * @param Request $request
     * @param UpdateNewsResponderInterface $responder
     * @return mixed
     */
    public function __invoke(
        Request $request,
        UpdateNewsResponderInterface $responder
    );
}
