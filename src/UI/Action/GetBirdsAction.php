<?php

declare(strict_types=1);

namespace App\UI\Action;

use App\Repository\Interfaces\BirdsRepositoryInterface;
use App\UI\Action\Interfaces\GetBirdsActionInterface;
use App\UI\Form\Handler\Interfaces\ReservationTypeHandlerInterface;
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
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var ReservationTypeHandlerInterface
     */
    private $reservationTypeHandler;

    /**
     * GetBirdsAction constructor.
     *
     * @param BirdsRepositoryInterface        $birdsRepository
     * @param FormFactoryInterface            $formFactory
     * @param ReservationTypeHandlerInterface $reservationTypeHandler
     */
    public function __construct (
        BirdsRepositoryInterface $birdsRepository,
        FormFactoryInterface $formFactory,
        ReservationTypeHandlerInterface $reservationTypeHandler
    ) {
        $this->birdsRepository = $birdsRepository;
        $this->formFactory = $formFactory;
        $this->reservationTypeHandler = $reservationTypeHandler;
    }

    /**
     * @param Request                    $request
     * @param GetBirdsResponderInterface $responder
     *
     * @return mixed|\Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(
        Request $request,
        GetBirdsResponderInterface $responder
    ) {
        $reservationType = $this->formFactory->create(ReservationType::class)
                                             ->handleRequest($request);

        if($this->reservationTypeHandler->handle($reservationType)) {
            return $responder(true, $this->birdsRepository->findAll());
        }

        return $responder(false, $this->birdsRepository->findAll(), $reservationType);
    }
}