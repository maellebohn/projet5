<?php

declare(strict_types=1);

namespace App\UI\Action;

use App\Repository\Interfaces\InfosRepositoryInterface;
use App\UI\Action\Interfaces\GetAlimentationCatInfosActionInterface;
use App\UI\Responder\Interfaces\GetAlimentationCatInfosResponderInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(
 *     path="/reservation",
 *     name="reservation"
 * )
 */
final class GetAlimentationCatInfosAction implements GetAlimentationCatInfosActionInterface
{
    /**
     * @var InfosRepositoryInterface
     */
    private $infosRepository;

    /**
     * @var GetAlimentationCatInfosResponderInterface
     */
    private $responder;

    public function __construct (
        InfosRepositoryInterface $infosRepository,
        GetAlimentationCatInfosResponderInterface $responder
    ) {
        $this->infosRepository = $infosRepository;
        $this->responder = $responder;
    }

    public function __invoke()
    {
        $responder = $this->responder;

        return $responder($this->infosRepository->findBy(
            array('category' => 'alimentation'),
            array('date' => 'desc')
        ));
    }

}