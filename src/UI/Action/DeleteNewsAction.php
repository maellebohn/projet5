<?php

declare(strict_types=1);

namespace App\UI\Action;

use App\Repository\Interfaces\NewsRepositoryInterface;
use App\UI\Action\Interfaces\DeleteNewsActionInterface;
use App\UI\Responder\Interfaces\DeleteNewsResponderInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(
 *     path="/deletenews/{id}",
 *     name="delete_news"
 * )
 */
// @Security("is_granted('ROLE_ADMIN')")
class DeleteNewsAction implements DeleteNewsActionInterface
{
    /**
     * @var NewsRepositoryInterface
     */
    private $newsRepository;

    /**
     * DeleteNewsAction constructor.
     *
     * @param NewsRepositoryInterface $newsRepository
     */
    public function __construct (NewsRepositoryInterface $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }

    /**
     * @param Request                      $request
     * @param DeleteNewsResponderInterface $responder
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     */
    public function __invoke(
        Request $request,
        DeleteNewsResponderInterface $responder
    ) {
        $this->newsRepository->deleteById($request->attributes->get('id'));

        return $responder();
    }
}
