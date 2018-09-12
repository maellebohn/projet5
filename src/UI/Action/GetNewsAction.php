<?php

declare(strict_types=1);

namespace App\UI\Action;

use App\Repository\Interfaces\NewsRepositoryInterface;
use App\UI\Action\Interfaces\GetNewsActionInterface;
use App\UI\Responder\Interfaces\GetNewsResponderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(
 *     path="/news/{id}",
 *     name="get_news"
 * )
 */
class GetNewsAction implements GetNewsActionInterface
{
    /**
     * @var NewsRepositoryInterface
     */
    private $newsRepository;

    /**
     * GetNewsAction constructor.
     *
     * @param NewsRepositoryInterface $newsRepository
     */
    public function __construct (NewsRepositoryInterface $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }

    /**
     * @param Request                   $request
     * @param GetNewsResponderInterface $responder
     *
     * @return mixed|\Symfony\Component\HttpFoundation\Response
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(
        Request $request,
        GetNewsResponderInterface $responder
    ) {
        return $responder($this->newsRepository->findOneBy(['id' => $request->attributes->get('id')]));
    }
}
