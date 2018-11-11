<?php

declare(strict_types=1);

namespace App\UI\Action;

use App\Repository\Interfaces\BirdsRepositoryInterface;
use App\UI\Action\Interfaces\DeleteReservationActionInterface;
use App\UI\Responder\Interfaces\DeleteReservationResponderInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(
 *     path="/deletereservation/{id}",
 *     name="delete_reservation"
 * )
 *
 *  @Security("is_granted('ROLE_ADMIN')")
 */
class DeleteReservationAction implements DeleteReservationActionInterface
{
    /**
     * @var BirdsRepositoryInterface
     */
    private $birdsRepository;

    /**
     * DeleteReservationAction constructor.
     *
     * @param BirdsRepositoryInterface $birdsRepository
     */
    public function __construct (BirdsRepositoryInterface $birdsRepository)
    {
        $this->birdsRepository = $birdsRepository;
    }

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
    ) {
        $bird = $this->birdsRepository->findOneBy(['id' => $request->attributes->get('id')]);

        $bird->deleteReservation();

        $this->birdsRepository->update();

        return $responder();
    }
}
