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
final class GetListNewsAction implements GetListNewsActionInterface
{
    /**
     * @var NewsRepositoryInterface
     */
    private $newsRepository;

    /**
     * GetListNewsAction constructor.
     *
     * @param NewsRepositoryInterface $newsRepository
     */
    public function __construct (NewsRepositoryInterface $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }

    /**
     * @param GetListNewsResponderInterface $responder
     *
     * @return mixed|\Symfony\Component\HttpFoundation\Response
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(GetListNewsResponderInterface $responder)
    {
        return $responder($this->newsRepository->findAll());
    }

}