<?php

declare(strict_types=1);

namespace App\UI\Action;

use App\Repository\Interfaces\NewsRepositoryInterface;
use App\UI\Action\Interfaces\GetListNewsActionInterface;
use App\UI\Responder\Interfaces\GetListNewsResponderInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(
 *     path="/news",
 *     name="news"
 * )
 */
class GetListNewsAction implements GetListNewsActionInterface
{
    /**
     * @var NewsRepositoryInterface
     */
    private $newsRepository;

    /**
     * @var GetListNewsResponderInterface
     */
    private $responder;

    public function __construct (
        NewsRepositoryInterface $newsRepository,
        GetListNewsResponderInterface $responder
    ) {
        $this->newsRepository = $newsRepository;
        $this->responder = $responder;
    }

    public function __invoke()
    {
        $responder = $this->responder;

        return $responder($this->newsRepository->findAll());
    }

}