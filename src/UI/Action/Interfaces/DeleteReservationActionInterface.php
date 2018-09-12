<?php

declare(strict_types=1);

namespace App\UI\Action\Interfaces;

use App\Repository\Interfaces\BirdsRepositoryInterface;
use App\UI\Responder\Interfaces\DeleteReservationResponderInterface;
use Symfony\Component\HttpFoundation\Request;

interface DeleteReservationActionInterface
{
    /**
     * DeleteReservationAction constructor.
     *
     * @param BirdsRepositoryInterface $birdsRepository
     */
    public function __construct (BirdsRepositoryInterface $birdsRepository);

    /**
     * @param Request                             $request
     * @param DeleteReservationResponderInterface $responder
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     */
    public function __invoke(
        Request $request,
        DeleteReservationResponderInterface $responder
    );
}
