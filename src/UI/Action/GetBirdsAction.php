<?php

declare(strict_types=1);

namespace App\UI\Action;

use App\Repository\Interfaces\BirdsRepositoryInterface;
use App\UI\Action\Interfaces\GetBirdsActionInterface;
use App\UI\Responder\Interfaces\GetBirdsResponderInterface;
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

    public function __construct (
        BirdsRepositoryInterface $birdsRepository,
        GetBirdsResponderInterface $responder
    ) {
        $this->birdsRepository = $birdsRepository;
        $this->responder = $responder;
    }

    public function __invoke()
    {
        $responder = $this->responder;

        return $responder($this->birdsRepository->findAll());
    }

}