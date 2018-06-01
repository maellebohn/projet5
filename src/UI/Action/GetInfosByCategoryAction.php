<?php

declare(strict_types=1);

namespace App\UI\Action;

use App\Repository\Interfaces\InfosRepositoryInterface;
use App\UI\Action\Interfaces\GetInfosByCategoryActionInterface;
use App\UI\Responder\Interfaces\GetInfosByCategoryResponderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(
 *     path="/conseils/{category}",
 *     name="conseils_by_category"
 * )
 */
final class GetInfosByCategoryAction implements GetInfosByCategoryActionInterface
{
    /**
     * @var InfosRepositoryInterface
     */
    private $infosRepository;

    /**
     * @var GetInfosByCategoryResponderInterface
     */
    private $responder;

    /**
     * GetInfosByCategoryAction constructor.
     *
     * @param InfosRepositoryInterface             $infosRepository
     * @param GetInfosByCategoryResponderInterface $responder
     */
    public function __construct (
        InfosRepositoryInterface $infosRepository,
        GetInfosByCategoryResponderInterface $responder
    ) {
        $this->infosRepository = $infosRepository;
        $this->responder = $responder;
    }

    /**
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(Request $request)
    {
        $responder = $this->responder;

        return $responder($this->infosRepository->findBy(
            array('category'=>$request->attributes->get('category')),
            array('dateCreation' => 'desc')
        ));
    }
}