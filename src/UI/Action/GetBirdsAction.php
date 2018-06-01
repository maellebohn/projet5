<?php

declare(strict_types=1);

namespace App\UI\Action;

use App\Repository\Interfaces\BirdsRepositoryInterface;
use App\UI\Action\Interfaces\GetBirdsActionInterface;
use App\UI\Form\Type\ReservationType;
use App\UI\Responder\Interfaces\GetBirdsResponderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(
 *     path="/reservation",
 *     name="reservation"
 * )
 */
final class GetBirdsAction implements GetBirdsActionInterface
{
    /**
     * @var BirdsRepositoryInterface
     */
    private $birdsRepository;

    /**
     * @var GetBirdsResponderInterface
     */
    private $responder;

    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

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
    ) {
        $this->birdsRepository = $birdsRepository;
        $this->responder = $responder;
        $this->formFactory = $formFactory;
    }


    /**
     * @param Request $request
     *
     * @return mixed|\Symfony\Component\HttpFoundation\Response
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(Request $request)
    {
        $reservationType = $this->formFactory->create(ReservationType::class)
                                             ->handleRequest($request);

        $responder = $this->responder;

        return $responder($this->birdsRepository->findAll(), $reservationType);
    }
}