<?php

declare(strict_types=1);

namespace App\UI\Action;

use App\UI\Action\Interfaces\AddNewsActionInterface;
use App\UI\Form\Handler\Interfaces\AddNewsTypeHandlerInterface;
use App\UI\Form\Type\AddNewsType;
use App\UI\Responder\Interfaces\AddNewsResponderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route(
 *     path="/addnews",
 *     name="add_news"
 * )
 */
final class AddNewsAction implements AddNewsActionInterface
{
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var AddNewsTypeHandlerInterface
     */
    private $addNewsTypeHandler;

    /**
     * AddNewsAction constructor.
     *
     * @param FormFactoryInterface        $formFactory
     * @param AddNewsTypeHandlerInterface $addNewsTypeHandler
     */
    public function __construct(
        FormFactoryInterface $formFactory,
        AddNewsTypeHandlerInterface $addNewsTypeHandler
    ) {
        $this->formFactory = $formFactory;
        $this->addNewsTypeHandler = $addNewsTypeHandler;
    }

    /**
     * @param Request                   $request
     * @param AddNewsResponderInterface $responder
     *
     * @return mixed|\Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(Request $request, AddNewsResponderInterface $responder)
    {
        $addNewsType = $this->formFactory->create(AddNewsType::class)
                                         ->handleRequest($request);

        if($this->addNewsTypeHandler->handle($addNewsType)) {
            return $responder(true);
        }

        return $responder(false, $addNewsType);
    }
}
