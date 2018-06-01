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
     * @var AdminResponderInterface
     */
    private $responder;

    /**
     * AdminAction constructor.
     *
     * @param InfosRepositoryInterface  $infosRepository
     * @param AdminResponderInterface   $responder
     * @param BirdsRepositoryInterface  $birdsRepository
     * @param NewsRepositoryInterface   $newsRepository
     */
    public function __construct (
        InfosRepositoryInterface $infosRepository,
        AdminResponderInterface $responder,
        BirdsRepositoryInterface $birdsRepository,
        NewsRepositoryInterface $newsRepository
    ) {
        $this->infosRepository = $infosRepository;
        $this->responder = $responder;
        $this->birdsRepository = $birdsRepository;
        $this->newsRepository = $newsRepository;
    }

    /**
     * @return mixed
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke()
    {
        $responder = $this->responder;

        return $responder(
            $this->infosRepository->findAll(),
            $this->newsRepository->findAll(),
            $this->birdsRepository->findAll()
        );
    }

}