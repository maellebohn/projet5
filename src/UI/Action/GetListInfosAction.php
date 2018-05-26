<?php

declare(strict_types=1);

namespace App\UI\Action;

use App\Repository\Interfaces\BirdsRepositoryInterface;
use App\Repository\Interfaces\InfosRepositoryInterface;
use App\UI\Action\Interfaces\GetListInfosActionInterface;
use App\UI\Responder\Interfaces\GetListInfosResponderInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(
 *     path="/admin",
 *     name="admin"
 * )
 */
final class GetListInfosAction implements GetListInfosActionInterface
{
    /**
     * @var InfosRepositoryInterface
     */
    private $infosRepository;

    /**
     * @var BirdsRepositoryInterface
     */
    private $birdsRepository;

    /**
     * @var GetListInfosResponderInterface
     */
    private $responder;

    public function __construct (
        InfosRepositoryInterface $infosRepository,
        GetListInfosResponderInterface $responder,
        BirdsRepositoryInterface $birdsRepository
    ) {
        $this->infosRepository = $infosRepository;
        $this->responder = $responder;
        $this->birdsRepository = $birdsRepository;
    }

    public function __invoke()
    {
        $responder = $this->responder;

        return $responder($this->infosRepository->findAll());
    }

}