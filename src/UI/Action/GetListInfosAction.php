<?php

declare(strict_types=1);

namespace App\UI\Action;

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
class GetListInfosAction implements GetListInfosActionInterface
{
    /**
     * @var InfosRepositoryInterface
     */
    private $infosRepository;

    /**
     * @var GetListInfosResponderInterface
     */
    private $responder;

    public function __construct (
        InfosRepositoryInterface $infosRepository,
        GetListInfosResponderInterface $responder
    ) {
        $this->infosRepository = $infosRepository;
        $this->responder = $responder;
    }

    public function __invoke()
    {
        $responder = $this->responder;

        return $responder($this->infosRepository->findAll());
    }

}