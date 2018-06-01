<?php

declare(strict_types=1);

namespace App\UI\Action\Interfaces;

use App\Repository\Interfaces\BirdsRepositoryInterface;
use App\UI\Responder\Interfaces\GetBirdsResponderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;

interface GetBirdsActionInterface
{
    /**
     * GetBirdsAction constructor.
     *
     * @param BirdsRepositoryInterface   $birdsRepository
     * @param GetBirdsResponderInterface $responder
     * @param FormFactoryInterface       $formFactory
     */
    public function __construct (
        BirdsRepositoryInterface $birdsRepository,
        GetBirdsResponderInterface $responder,
        FormFactoryInterface $formFactory
    );

    /**
     * @param Request $request
     *
     * @return mixed|\Symfony\Component\HttpFoundation\Response
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(Request $request);
}
