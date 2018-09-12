<?php

declare(strict_types=1);

namespace App\UI\Action;

use App\Repository\Interfaces\BirdsRepositoryInterface;
use App\Repository\Interfaces\InfosRepositoryInterface;
use App\Repository\Interfaces\NewsRepositoryInterface;
use App\UI\Action\Interfaces\AdminActionInterface;
use App\UI\Responder\Interfaces\AdminResponderInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(
 *     path="/admin",
 *     name="admin"
 * )
 */
final class AdminAction implements AdminActionInterface
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
     * @var NewsRepositoryInterface
     */
    private $newsRepository;

    /**
     * AdminAction constructor.
     *
     * @param InfosRepositoryInterface  $infosRepository
     * @param BirdsRepositoryInterface  $birdsRepository
     * @param NewsRepositoryInterface   $newsRepository
     */
    public function __construct (
        InfosRepositoryInterface $infosRepository,
        BirdsRepositoryInterface $birdsRepository,
        NewsRepositoryInterface $newsRepository
    ) {
        $this->infosRepository = $infosRepository;
        $this->birdsRepository = $birdsRepository;
        $this->newsRepository = $newsRepository;
    }

    /**
     * @param AdminResponderInterface $responder
     *
     * @return mixed|\Symfony\Component\HttpFoundation\Response
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(AdminResponderInterface $responder)
    {
        return $responder(
            $this->infosRepository->findAll(),
            $this->newsRepository->findAll(),
            $this->birdsRepository->findAll()
        );
    }

}