<?php

declare(strict_types=1);

namespace App\UI\Action;

use App\Repository\Interfaces\BirdsRepositoryInterface;
use App\UI\Action\Interfaces\DeleteBirdActionInterface;
use App\UI\Responder\Interfaces\DeleteBirdResponderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route(
 *     path="/deletebird/{id}",
 *     name="delete_bird"
 * )
 */
class DeleteBirdAction implements DeleteBirdActionInterface
{
    /**
     * @var BirdsRepositoryInterface
     */
    private $birdsRepository;

    /**
     * DeleteBirdAction constructor.
     *
     * @param BirdsRepositoryInterface $birdsRepository
     */
    public function __construct (BirdsRepositoryInterface $birdsRepository)
    {
        $this->birdsRepository = $birdsRepository;
    }

    /**
     * @param Request                      $request
     * @param DeleteBirdResponderInterface $responder
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     */
    public function __invoke(
        Request $request,
        DeleteBirdResponderInterface $responder
    ) {
        $bird = $this->birdsRepository->findOneBy(['id' => $request->attributes->get('id')]);

        $this->birdsRepository->remove($bird);

        return $responder();
    }
}
