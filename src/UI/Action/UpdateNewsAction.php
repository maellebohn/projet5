<?php

declare(strict_types=1);

namespace App\UI\Action;

use App\Domain\DTO\UpdateNewsDTO;
use App\Repository\Interfaces\NewsRepositoryInterface;
use App\UI\Action\Interfaces\UpdateNewsActionInterface;
use App\UI\Form\Handler\Interfaces\UpdateNewsTypeHandlerInterface;
use App\UI\Form\Type\UpdateNewsType;
use App\UI\Responder\Interfaces\UpdateNewsResponderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(
 *     path="/updatenews/{id}",
 *     name="update_news"
 * )
 */
class UpdateNewsAction implements UpdateNewsActionInterface
{
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var NewsRepositoryInterface
     */
    private $newsRepository;

    /**
     * @var UpdateNewsTypeHandlerInterface
     */
    private $updateNewsTypeHandler;

    /**
     * UpdateNewsAction constructor.
     *
     * @param NewsRepositoryInterface        $newsRepository
     * @param FormFactoryInterface           $formFactory
     * @param UpdateNewsTypeHandlerInterface $updateNewsTypeHandler
     */
    public function __construct (
        NewsRepositoryInterface $newsRepository,
        FormFactoryInterface $formFactory,
        UpdateNewsTypeHandlerInterface $updateNewsTypeHandler
    ) {
        $this->newsRepository = $newsRepository;
        $this->formFactory = $formFactory;
        $this->updateNewsTypeHandler = $updateNewsTypeHandler;
    }


    /**
     * @param Request                      $request
     * @param UpdateNewsResponderInterface $responder
     *
     * @return mixed
     */
    public function __invoke(
        Request $request,
        UpdateNewsResponderInterface $responder
    ) {
        $news = $this->newsRepository->findOneBy(['id' => $request->attributes->get('id')]);
        $dto = new UpdateNewsDTO(
            $news->getTitle(),
            $news->getAuthor(),
            $news->getImage(),
            $news->getContent()
        );

        $updateNewsType = $this->formFactory->create(UpdateNewsType::class, $dto)
                                            ->handleRequest($request);

        if($this->updateNewsTypeHandler->handle($updateNewsType)) {
            return $responder(true);
        }

        return $responder(false, $news, $updateNewsType);
    }
}
